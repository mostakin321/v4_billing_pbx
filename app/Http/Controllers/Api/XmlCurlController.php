<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class XmlCurlController extends Controller
{
    public function handle(Request $request): Response
    {
        $section  = $request->input('section', '');
        $keyName  = $request->input('key_name', '');
        $keyValue = $request->input('key_value', '');

        $xml = match (true) {
            $section === 'configuration' && $keyValue === 'sofia.conf'
                => $this->sofiaConf(),
            $section === 'directory'
                => $this->directory($request),
            default
                => $this->notFound(),
        };

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }

    // ── sofia.conf with all enabled gateways ─────────────────────────────

    private function sofiaConf(): string
    {
        $gateways = DB::connection('fusionpbx')
            ->table('v_gateways')
            ->where('enabled', 'true')
            ->get();

        $gatewayXml = '';
        foreach ($gateways as $gw) {
            $name     = htmlspecialchars($gw->gateway     ?? '');
            $username = htmlspecialchars($gw->username    ?? '');
            $password = htmlspecialchars($gw->password    ?? '');
            $proxy    = htmlspecialchars($gw->proxy       ?? $gw->hostname ?? '');
            $realm    = htmlspecialchars($gw->realm       ?? $gw->proxy ?? $gw->hostname ?? '');
            $from     = htmlspecialchars($gw->from_user   ?? $username);
            $fromD    = htmlspecialchars($gw->from_domain ?? $proxy);
            $expire   = (int)($gw->expire_seconds ?? 3600);
            $retry    = (int)($gw->retry_seconds  ?? 30);
            $register = ($gw->register ?? 'true') === 'true' ? 'true' : 'false';
            $caller   = htmlspecialchars($gw->caller_id_in_from ?? 'false');

            if (empty($name) || empty($proxy)) continue;

            $gatewayXml .= <<<XML

                <gateway name="{$name}">
                  <param name="username"        value="{$username}"/>
                  <param name="password"        value="{$password}"/>
                  <param name="proxy"           value="{$proxy}"/>
                  <param name="realm"           value="{$realm}"/>
                  <param name="from-user"       value="{$from}"/>
                  <param name="from-domain"     value="{$fromD}"/>
                  <param name="expire-seconds"  value="{$expire}"/>
                  <param name="retry-seconds"   value="{$retry}"/>
                  <param name="register"        value="{$register}"/>
                  <param name="caller-id-in-from" value="{$caller}"/>
                </gateway>
XML;
        }

        return <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<document type="freeswitch/xml">
  <section name="configuration">
    <configuration name="sofia.conf" description="Sofia SIP">
      <profiles>
        <profile name="external">
          <gateways>
{$gatewayXml}
          </gateways>
        </profile>
      </profiles>
    </configuration>
  </section>
</document>
XML;
    }

    // ── directory (SIP registration auth) ────────────────────────────────

    private function directory(Request $request): string
    {
        $domain   = $request->input('domain',   $request->input('key_value', ''));
        $user     = $request->input('user',     '');
        $purpose  = $request->input('purpose',  '');

        if (empty($user)) return $this->notFound();

        $ext = DB::connection('fusionpbx')
            ->table('v_extensions')
            ->where('extension', $user)
            ->where('enabled', 'true')
            ->first();

        if (!$ext) return $this->notFound();

        $password = htmlspecialchars($ext->password ?? '');
        $vmPass   = htmlspecialchars($ext->voicemail_password ?? $ext->password ?? '');
        $domain   = htmlspecialchars($ext->user_context ?? $domain);
        $extNum   = htmlspecialchars($ext->extension);

        return <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<document type="freeswitch/xml">
  <section name="directory">
    <domain name="{$domain}">
      <user id="{$extNum}">
        <params>
          <param name="password"          value="{$password}"/>
          <param name="vm-password"       value="{$vmPass}"/>
        </params>
        <variables>
          <variable name="toll_allow"     value="domestic,international,local"/>
          <variable name="accountcode"    value="{$extNum}"/>
          <variable name="user_context"   value="{$domain}"/>
          <variable name="effective_caller_id_name"   value="{$extNum}"/>
          <variable name="effective_caller_id_number" value="{$extNum}"/>
        </variables>
      </user>
    </domain>
  </section>
</document>
XML;
    }

    // ── fallback ──────────────────────────────────────────────────────────

    private function notFound(): string
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<document type="freeswitch/xml">
  <section name="result">
    <result status="not found"/>
  </section>
</document>';
    }
}
