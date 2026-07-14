<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;

/**
 * Pure-PHP FreeSWITCH Event Socket Layer (ESL) client.
 * No external extension required.
 *
 * Usage:
 *   $esl = FreeSwitchEsl::make();
 *   $esl->connect();
 *   $esl->api('show calls as json');
 *   $esl->subscribe('CHANNEL_HANGUP_COMPLETE,CHANNEL_BRIDGE', function(array $event) { ... });
 *   $esl->disconnect();
 */
class FreeSwitchEsl
{
    private $fp = null;

    public function __construct(
        private string $host     = '127.0.0.1',
        private int    $port     = 8021,
        private string $password = 'ClueCon',
        private int    $timeout  = 5
    ) {}

    // ──────────────────────────────────────────────────────────────────────
    // Connection
    // ──────────────────────────────────────────────────────────────────────

    public function connect(): bool
    {
        $this->fp = @fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
        if (!$this->fp) {
            Log::warning("FreeSwitchEsl: cannot connect {$this->host}:{$this->port} — $errstr");
            return false;
        }
        stream_set_timeout($this->fp, $this->timeout);

        $this->readHeaders(); // auth/request greeting
        $this->write("auth {$this->password}");
        $reply = $this->readHeaders();

        return str_contains($reply, '+OK');
    }

    public function disconnect(): void
    {
        if ($this->fp) {
            @fputs($this->fp, "exit\n\n");
            @fclose($this->fp);
            $this->fp = null;
        }
    }

    public function isConnected(): bool
    {
        return $this->fp !== null && !feof($this->fp);
    }

    // ──────────────────────────────────────────────────────────────────────
    // API command (blocking, returns response body)
    // ──────────────────────────────────────────────────────────────────────

    public function api(string $command): string
    {
        $this->write("api $command");
        return $this->readBody();
    }

    // ──────────────────────────────────────────────────────────────────────
    // Background API (non-blocking, returns job UUID)
    // ──────────────────────────────────────────────────────────────────────

    public function bgapi(string $command): string
    {
        $this->write("bgapi $command");
        return trim($this->readHeaders());
    }

    // ──────────────────────────────────────────────────────────────────────
    // Event subscription loop (daemon mode)
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Subscribe to events and call $callback for each one.
     * Callback should return true to continue, false to stop.
     *
     * @param string   $events  comma-separated event names (e.g. "CHANNEL_HANGUP_COMPLETE,CHANNEL_BRIDGE")
     *                          or "ALL" for every event
     * @param callable $callback function(array $headers, string $body): bool
     * @param int      $maxEvents max events to process (PHP_INT_MAX = forever)
     */
    public function subscribe(string $events, callable $callback, int $maxEvents = PHP_INT_MAX): void
    {
        // Switch to event plain mode for machine-readable events
        $this->write("event plain $events");
        $this->readHeaders(); // +OK

        // Extend socket timeout for long-lived connections
        stream_set_timeout($this->fp, 30);

        $count = 0;
        while ($count < $maxEvents && $this->isConnected()) {
            $headers = $this->readHeaders();
            if (empty(trim($headers))) continue;

            $parsed  = $this->parseHeaders($headers);
            $length  = (int)($parsed['Content-Length'] ?? 0);
            $body    = $length > 0 ? $this->freadFull($length) : '';

            // Parse event body (plain text key: value format)
            $event = $parsed;
            if ($body && str_contains($parsed['Content-Type'] ?? '', 'text/event-plain')) {
                $event = array_merge($parsed, $this->parseHeaders($body));
            }

            $continue = $callback($event, $body);
            $count++;
            if ($continue === false) break;

            pcntl_signal_dispatch();
        }
    }

    // ──────────────────────────────────────────────────────────────────────
    // Static helpers
    // ──────────────────────────────────────────────────────────────────────

    public static function make(): self
    {
        return new self(
            host:     config('freeswitch.esl.host',     '127.0.0.1'),
            port:     (int)config('freeswitch.esl.port', 8021),
            password: config('freeswitch.esl.password',  'ClueCon'),
            timeout:  (int)config('freeswitch.esl.timeout', 5),
        );
    }

    /**
     * Run a single API command. Returns ['ok' => bool, 'output' => string, 'error' => ?string]
     */
    public static function run(string $cmd): array
    {
        $esl = self::make();
        if (!$esl->connect()) {
            return [
                'ok'     => false,
                'output' => '',
                'error'  => 'Cannot connect to FreeSWITCH ESL. Check mod_event_socket is loaded.',
                // legacy compat keys
                'connected' => false,
                'raw'       => '',
            ];
        }
        try {
            $raw = trim($esl->api($cmd));
            $esl->disconnect();
            return [
                'ok'        => true,
                'output'    => $raw,
                'error'     => null,
                'connected' => true,
                'raw'       => $raw,
            ];
        } catch (\Throwable $e) {
            $esl->disconnect();
            return [
                'ok'        => false,
                'output'    => '',
                'error'     => $e->getMessage(),
                'connected' => false,
                'raw'       => '',
            ];
        }
    }

    // ──────────────────────────────────────────────────────────────────────
    // Gateway convenience methods (used by GatewayObserver via EslClient proxy)
    // ──────────────────────────────────────────────────────────────────────

    public function reloadGateway(string $gatewayName): array
    {
        return self::run("sofia profile external rescan");
    }

    public function killGateway(string $gatewayName): array
    {
        return self::run("sofia profile external killgw {$gatewayName}");
    }

    // ──────────────────────────────────────────────────────────────────────
    // Low-level I/O
    // ──────────────────────────────────────────────────────────────────────

    private function write(string $data): void
    {
        fputs($this->fp, $data . "\n\n");
    }

    /** Read lines until blank line (header block) */
    private function readHeaders(): string
    {
        $buf = '';
        while (!feof($this->fp)) {
            $line = fgets($this->fp, 4096);
            if ($line === false || rtrim($line) === '') break;
            $buf .= $line;
        }
        return $buf;
    }

    /** Read response body (Content-Length prefixed) */
    private function readBody(): string
    {
        $headers = $this->readHeaders();
        $length  = 0;
        foreach (explode("\n", $headers) as $line) {
            if (stripos($line, 'Content-Length:') === 0) {
                $length = (int)trim(substr($line, 15));
            }
        }
        return $length > 0 ? $this->freadFull($length) : $this->drainSocket();
    }

    /** Read exactly $n bytes */
    private function freadFull(int $n): string
    {
        $buf = '';
        while (strlen($buf) < $n && !feof($this->fp)) {
            $chunk = fread($this->fp, $n - strlen($buf));
            if ($chunk === false || $chunk === '') break;
            $buf .= $chunk;
        }
        return $buf;
    }

    /** Drain socket until timeout (fallback) */
    private function drainSocket(): string
    {
        $buf  = '';
        $meta = stream_get_meta_data($this->fp);
        while (!feof($this->fp) && !($meta['timed_out'] ?? false)) {
            $chunk = fread($this->fp, 4096);
            if ($chunk === false || $chunk === '') break;
            $buf  .= $chunk;
            $meta  = stream_get_meta_data($this->fp);
        }
        return $buf;
    }

    /** Parse "Key: Value\nKey2: Value2\n" → ['Key' => 'Value', ...] */
    private function parseHeaders(string $raw): array
    {
        $result = [];
        foreach (explode("\n", $raw) as $line) {
            $line = rtrim($line);
            if ($line === '') continue;
            $pos = strpos($line, ': ');
            if ($pos !== false) {
                $result[substr($line, 0, $pos)] = urldecode(substr($line, $pos + 2));
            }
        }
        return $result;
    }
}
