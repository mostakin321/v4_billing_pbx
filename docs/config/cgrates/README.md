# CGRateS Minimum Working Configuration

This directory contains the known-good minimal CGRateS configuration used by the Kazitel ASTPP billing integration.

## Live configuration

Live file:

    /etc/cgrates/cgrates.json

Template file:

    docs/config/cgrates/cgrates.minimum.production.json

The committed template is strict JSON and does not include the live database password.

## Installation

Copy the template:

    sudo cp docs/config/cgrates/cgrates.minimum.production.json /etc/cgrates/cgrates.json

Replace CHANGE_ME with the real CGRateS storage database password.

Validate:

    python3 -m json.tool /etc/cgrates/cgrates.json

Restart:

    sudo systemctl restart cgrates
    sudo systemctl status cgrates --no-pager

## Required services

- Redis database 10
- MariaDB database cgrates
- CGRateS HTTP JSON-RPC on port 2080
- CGRateS JSON RPC on port 2012
- CGRateS GOB RPC on port 2013

## Verification

Ping:

    curl -s -X POST http://127.0.0.1:2080/jsonrpc \
      -H "Content-Type: application/json" \
      -d '{"method":"CoreSv1.Ping","params":[],"id":1}'

Balance:

    curl -s -X POST http://127.0.0.1:2080/jsonrpc \
      -H "Content-Type: application/json" \
      -d '{"method":"ApierV1.GetAccounts","params":[{"Tenant":"cgrates.org","AccountIds":["1005"]}],"id":2}'

Rating:

    cgr-console 'cost Direction="*out" Category="call" Tenant="cgrates.org" Subject="1005" Destination="1001" SetupTime="2026-07-16T05:45:00+06:00" AnswerTime="2026-07-16T05:45:01+06:00" Usage="60s"'

Expected rating plan:

    ASTPP_RP_1

## Security

Never commit:

- Live CGRateS database passwords
- /var/www/astpp/.env
- FreeSWITCH event-socket passwords
- Production API credentials
