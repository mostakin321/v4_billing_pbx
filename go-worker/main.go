package main

import (
	"bytes"
	"crypto/sha1"
	"encoding/json"
	"fmt"
	"log"
	"net/http"
	"os"
	"sync"
	"time"
	"github.com/cgrates/fsock"

	 // Points to the local subdirectory containing your uploaded files
)

var (
	cgrURL = getenv("CGRATES_ENDPOINT", "http://127.0.0.1:2080/jsonrpc")
	tenant = getenv("CGRATES_TENANT", "cgrates.org")
	oHost  = getenv("CGRATES_ORIGIN_HOST", "bestbuylogic.com")
	lURL   = getenv("LARAVEL_API", "http://127.0.0.1:8000/api")
	token  = getenv("KAZITEL_WORKER_SECRET", "changeme")
	addr   = getenv("WORKER_LISTEN", ":9090")

	// FreeSWITCH Socket configurations
	fsAddr = getenv("FS_ENDPOINT", "127.0.0.1:8021")
	fsPass = getenv("FS_PASSWORD", "ClueCon")
)

func getenv(k, d string) string {
	if v := os.Getenv(k); v != "" {
		return v
	}
	return d
}

var rID int

func cgr(method string, params interface{}) (json.RawMessage, error) {
	rID++
	b, _ := json.Marshal(map[string]interface{}{"id": rID, "method": method, "params": params})
	resp, err := http.Post(cgrURL, "application/json", bytes.NewBuffer(b))
	if err != nil {
		return nil, err
	}
	defer resp.Body.Close()
	var r struct {
		Result json.RawMessage `json:"result"`
		Error  interface{}     `json:"error"`
	}
	json.NewDecoder(resp.Body).Decode(&r)
	if r.Error != nil {
		return nil, fmt.Errorf("%v", r.Error)
	}
	return r.Result, nil
}

func cgrid(uid string) string {
	h := sha1.New()
	h.Write([]byte(uid + oHost))
	return fmt.Sprintf("%x", h.Sum(nil))
}

// AuthorizeEvent params — explicitly structured to handle direction paths
func authP(uid, acct, dest, now string) []interface{} {
	return []interface{}{map[string]interface{}{
		"Tenant": tenant, "ID": uid,
		"Event": map[string]interface{}{
			"ToR": "*voice", "RequestType": "*prepaid", "Category": "call",
			"Tenant": tenant, "Account": acct,
			"Subject":     fmt.Sprintf("%s:%s", tenant, acct), // Fixed tenant scope
			"Destination": dest, "SetupTime": now, "AnswerTime": now,
			"Usage": int64(3600000000000), "OriginID": uid, "OriginHost": oHost,
		},
		"GetMaxUsage": true, "GetAttributes": false,
		"AuthorizeResources": false, "GetRoutes": false,
	}}
}

// CGREvent wrapped params — updated Subject mapping
func cgrEventP(uid, acct, dest, setup, answer string, usageNs int64, extra map[string]interface{}) []interface{} {
	ev := map[string]interface{}{
		"ToR": "*voice", "RequestType": "*prepaid", "Category": "call",
		"Tenant": tenant, "Account": acct,
		"Subject":     fmt.Sprintf("%s:%s", tenant, acct), // Fixed tenant scope
		"Destination": dest, "SetupTime": setup, "AnswerTime": answer,
		"Usage": usageNs, "OriginID": uid, "OriginHost": oHost,
	}
	for k, v := range extra {
		ev[k] = v
	}
	p := map[string]interface{}{
		"CGREvent": map[string]interface{}{
			"Tenant": tenant, "ID": uid, "Time": setup, "Event": ev,
		},
	}
	return []interface{}{p}
}

// GetCost to calculate call cost
func getCost(acct, dest string, usageNs int64) float64 {
	now := time.Now().UTC().Format(time.RFC3339)
	res, err := cgr("ApierV2.GetCost", []interface{}{map[string]interface{}{
		"Tenant": tenant, "Category": "call", "ToR": "*voice",
		"Subject": acct, "Account": acct, "Destination": dest,
		"AnswerTime": now, "Usage": fmt.Sprintf("%dns", usageNs),
	}})
	if err != nil {
		return 0
	}
	var r map[string]interface{}
	json.Unmarshal(res, &r)
	if cost, ok := r["Cost"].(float64); ok {
		return cost
	}
	return 0
}

type cs struct{ CGRID, Acct, Dest, Setup, Answer string }

// Protected state via a Mutex to prevent data races between HTTP handlers and the ES inbound background thread
var (
	activeMux sync.RWMutex
	active    = map[string]*cs{}
)

func j(w http.ResponseWriter, v interface{}, code int) {
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(code)
	json.NewEncoder(w).Encode(v)
}

// --- FSOCK LOGGER ADAPTER ---
type appFsockLogger struct{}

func (appFsockLogger) Alert(m string) error   { log.Println("[FSOCK-ALERT]", m); return nil }
func (appFsockLogger) Close() error           { return nil }
func (appFsockLogger) Crit(m string) error    { log.Println("[FSOCK-CRIT]", m); return nil }
func (appFsockLogger) Debug(m string) error   { log.Println("[FSOCK-DEBUG]", m); return nil }
func (appFsockLogger) Emerg(m string) error   { log.Println("[FSOCK-EMERG]", m); return nil }
func (appFsockLogger) Err(m string) error     { log.Println("[FSOCK-ERR]", m); return nil }
func (appFsockLogger) Info(m string) error    { log.Println("[FSOCK-INFO]", m); return nil }
func (appFsockLogger) Notice(m string) error  { log.Println("[FSOCK-NOTICE]", m); return nil }
func (appFsockLogger) Warning(m string) error { log.Println("[FSOCK-WARN]", m); return nil }

func main() {
	log.Printf("Kazitel Worker v3.0 starting %s", addr)
	if res, err := cgr("CoreSv1.Ping", []map[string]string{{}}); err == nil {
		var p string
		json.Unmarshal(res, &p)
		log.Printf("CGRateS ping: %s", p)
	} else {
		log.Printf("CGRateS ping FAILED: %v", err)
	}

	// -------------------------------------------------------------
	// FREE SWITCH ES INBOUND CLIENT INITIALIZATION
	// -------------------------------------------------------------
	stopErrorChan := make(chan error, 5)
	delayGenerator := func(start, max time.Duration) func() time.Duration {
		current := start
		return func() time.Duration {
			ret := current
			current = current * 2
			if current > max {
				current = max
			}
			return ret
		}
	}

	// Dynamic background event parsing
	eventHandlers := map[string][]func(string, int){
		"CHANNEL_CREATE": {
			func(eventData string, connIdx int) {
				ev := fsock.FSEventStrToMap(eventData, nil)
				log.Printf("[FS-EVENT] Channel Created! UUID: %s, Destination: %s", ev["Unique-ID"], ev["Caller-Destination-Number"])
			},
		},
		"CHANNEL_HANGUP_COMPLETE": {
			func(eventData string, connIdx int) {
				ev := fsock.FSEventStrToMap(eventData, nil)
				log.Printf("[FS-EVENT] Channel Hangup received! UUID: %s, Cause: %s", ev["Unique-ID"], ev["Hangup-Cause"])
			},
		},
	}

	eventFilters := map[string][]string{
		"Event-Name": {"CHANNEL_CREATE", "CHANNEL_HANGUP_COMPLETE"},
	}

	log.Printf("Initializing FreeSWITCH socket pool connection to %s...", fsAddr)
	fsClient, err := fsock.NewFSock(
		fsAddr,
		fsPass,
		-1, // Infinite reconnect attempts
		30*time.Second,
		5*time.Second,
		delayGenerator,
		eventHandlers,
		eventFilters,
		appFsockLogger{},
		1,    // Single connection track group index
		true, // Enable background API tasks (bgapi)
		stopErrorChan,
	)
	if err != nil {
		log.Printf("WARNING: Failed initializing FSock Client manager: %v. Continuing standalone worker execution...", err)
	} else {
		log.Printf("FSock manager running. Active state: Connected=%t", fsClient.Connected())
	}

	// Catch asynchronous background socket errors gracefully
	go func() {
		for fsErr := range stopErrorChan {
			if fsErr != nil {
				log.Printf("[FSOCK-FATAL-ASYNC] Internal connection pool crash: %v", fsErr)
			}
		}
	}()

	// -------------------------------------------------------------
	// HTTP ROUTINGS & HANDLERS
	// -------------------------------------------------------------
	http.HandleFunc("/health", func(w http.ResponseWriter, r *http.Request) {
		ok := false
		if res, err := cgr("CoreSv1.Ping", []map[string]string{{}}); err == nil {
			var p string
			json.Unmarshal(res, &p)
			ok = p == "Pong"
		}
		fsConnected := false
		if fsClient != nil {
			fsConnected = fsClient.Connected()
		}

		activeMux.RLock()
		activeCallsLen := len(active)
		activeMux.RUnlock()

		j(w, map[string]interface{}{
			"worker":          "kazitel-worker",
			"version":         "3.0",
			"cgrates_online":  ok,
			"freeswitch_conn": fsConnected,
			"active_calls":    activeCallsLen,
			"timestamp":       time.Now().Format(time.RFC3339),
		}, 200)
	})

	http.HandleFunc("/call/authorize", func(w http.ResponseWriter, r *http.Request) {
		var req struct {
			UID  string `json:"unique_id"`
			Acct string `json:"account_id"`
			Dest string `json:"destination_number"`
			Car  string `json:"carrier_id"`
		}
		json.NewDecoder(r.Body).Decode(&req)
		if req.UID == "" || req.Acct == "" {
			j(w, map[string]string{"error": "unique_id and account_id required"}, 400)
			return
		}
		now := time.Now().UTC().Format(time.RFC3339)
		cg := cgrid(req.UID)

		// AUTO-PROVISION INTERCEPTOR:
		profileParams := map[string]interface{}{
			"Tenant":    tenant,
			"Category":  "call",
			"Subject":   fmt.Sprintf("%s:%s", tenant, req.Acct),
			"Direction": "*out",
			"RatingPlanActivations": []map[string]interface{}{
				{
					"ActivationTime": "2026-01-01T00:00:00Z",
					"RatingPlanId":   "US_Prefix",
				},
			},
		}
		_, _ = cgr("ApierV1.SetRatingProfile", []interface{}{profileParams})

		res, err := cgr("SessionSv1.AuthorizeEvent", authP(req.UID, req.Acct, req.Dest, now))
		if err != nil {
			log.Printf("[AUTH] DENIED %s: %v", req.Acct, err)
			j(w, map[string]interface{}{"authorized": false, "cgrid": cg, "reason": err.Error()}, 402)
			return
		}
		var reply map[string]interface{}
		json.Unmarshal(res, &reply)
		maxNs, _ := reply["MaxUsage"].(float64)
		maxS := int(maxNs / 1e9)
		if maxS == 0 {
			maxS = 3600
		}

		activeMux.Lock()
		active[req.UID] = &cs{CGRID: cg, Acct: req.Acct, Dest: req.Dest, Setup: now}
		activeMux.Unlock()

		log.Printf("[AUTH] OK %s cgrid=%s max=%ds", req.Acct, cg, maxS)
		j(w, map[string]interface{}{"authorized": true, "cgrid": cg, "max_seconds": maxS, "max_usage": fmt.Sprintf("%ds", maxS)}, 200)
	})

	http.HandleFunc("/call/answer", func(w http.ResponseWriter, r *http.Request) {
		var req struct {
			UID  string `json:"unique_id"`
			Acct string `json:"account_id"`
			Dest string `json:"destination_number"`
		}
		json.NewDecoder(r.Body).Decode(&req)
		now := time.Now().UTC().Format(time.RFC3339)

		activeMux.Lock()
		c, ok := active[req.UID]
		if !ok {
			c = &cs{CGRID: cgrid(req.UID), Acct: req.Acct, Dest: req.Dest, Setup: now}
			active[req.UID] = c
		}
		c.Answer = now
		activeMux.Unlock()

		// InitiateSession with CGREvent wrapper
		p := cgrEventP(req.UID, c.Acct, c.Dest, c.Setup, now, 0, nil)
		p[0].(map[string]interface{})["InitSession"] = true
		if _, err := cgr("SessionSv1.InitiateSession", p); err != nil {
			log.Printf("[ANSWER] InitiateSession: %v (non-fatal)", err)
		}
		j(w, map[string]interface{}{"success": true, "cgrid": c.CGRID}, 200)
	})

	http.HandleFunc("/call/hangup", func(w http.ResponseWriter, r *http.Request) {
		var req struct {
			UID      string `json:"unique_id"`
			Acct     string `json:"account_id"`
			Dest     string `json:"destination_number"`
			Billsec  int    `json:"billsec"`
			Duration int    `json:"duration"`
			Setup    string `json:"setup_time"`
			Answer   string `json:"answer_time"`
			CarID    string `json:"carrier_id"`
			CarName  string `json:"carrier_name"`
		}
		json.NewDecoder(r.Body).Decode(&req)

		activeMux.Lock()
		c, ok := active[req.UID]
		cg := cgrid(req.UID)
		acct, dest := req.Acct, req.Dest
		if ok {
			cg = c.CGRID
			acct = c.Acct
			dest = c.Dest
			delete(active, req.UID)
		}
		activeMux.Unlock()

		bs := req.Billsec
		if bs == 0 {
			bs = req.Duration
		}
		usNs := int64(bs) * 1_000_000_000
		now := time.Now().UTC().Format(time.RFC3339)
		setup := req.Setup
		if setup == "" {
			setup = now
		}
		answer := req.Answer
		if answer == "" {
			answer = now
		}

		// 1. Terminate session
		tp := cgrEventP(req.UID, acct, dest, setup, answer, usNs, nil)
		tp[0].(map[string]interface{})["TerminateSession"] = true
		if _, err := cgr("SessionSv1.TerminateSession", tp); err != nil {
			log.Printf("[HANGUP] TerminateSession: %v (non-fatal)", err)
		}

		// 2. Calculate actual cost
		cost := getCost(acct, dest, usNs)
		log.Printf("[HANGUP] cgrid=%s billsec=%d cost=%.6f", cg, bs, cost)

		// 3. Debit balance in CGRateS
		if cost > 0 && bs > 0 {
			_, err := cgr("ApierV1.DebitBalance", []interface{}{map[string]interface{}{
				"Tenant":      tenant,
				"Account":     acct,
				"BalanceType": "*monetary",
				"Balance":     map[string]interface{}{"ID": "*default", "Value": cost},
			}})
			if err != nil {
				log.Printf("[HANGUP] DebitBalance: %v", err)
			}
		}

		// 4. Store CDR
		if bs > 0 {
			cp := cgrEventP(req.UID, acct, dest, setup, answer, usNs, map[string]interface{}{
				"Source": "kazitel-worker",
				"Cost":   cost,
			})
			cdrP := cp[0].(map[string]interface{})
			cdrP["CGREvent"].(map[string]interface{})["Event"].(map[string]interface{})["RequestType"] = "*rated"
			if _, err := cgr("CDRsV1.ProcessCDR", cp); err != nil {
				log.Printf("[HANGUP] ProcessCDR: %v", err)
			}
		}

		// 5. Notify Laravel
		if bs > 0 {
			go func() {
				b, _ := json.Marshal(map[string]interface{}{
					"account_id": acct, "destination": dest,
					"duration_seconds": bs, "origin_id": req.UID,
					"carrier_id": req.CarID, "carrier_name": req.CarName,
					"answer_time": answer, "setup_time": setup, "cost": cost,
				})
				hreq, _ := http.NewRequest("POST", lURL+"/billing/cdr", bytes.NewBuffer(b))
				hreq.Header.Set("Content-Type", "application/json")
				hreq.Header.Set("X-Worker-Token", token)
				_, _ = (&http.Client{Timeout: 10 * time.Second}).Do(hreq)
			}()
		}

		j(w, map[string]interface{}{"success": true, "cgrid": cg, "billsec": bs, "cost": cost}, 200)
	})

	http.HandleFunc("/balance", func(w http.ResponseWriter, r *http.Request) {
		acct := r.URL.Query().Get("account_id")
		res, err := cgr("ApierV2.GetAccount", []map[string]string{{"Tenant": tenant, "Account": acct}})
		if err != nil {
			j(w, map[string]string{"error": err.Error()}, 500)
			return
		}
		var d map[string]interface{}
		json.Unmarshal(res, &d)
		bal := 0.0
		if bm, ok := d["BalanceMap"].(map[string]interface{}); ok {
			if mon, ok := bm["*monetary*out"].([]interface{}); ok && len(mon) > 0 { // Fixed map key
				if b0, ok := mon[0].(map[string]interface{}); ok {
					bal, _ = b0["Value"].(float64)
				}
			}
		}
		j(w, map[string]interface{}{"account_id": acct, "balance": bal, "data": d}, 200)
	})

	log.Fatal(http.ListenAndServe(addr, nil))
}
