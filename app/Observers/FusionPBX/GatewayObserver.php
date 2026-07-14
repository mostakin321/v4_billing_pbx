<?php
namespace App\Observers\FusionPBX;

use App\Models\FusionPBX\Gateway;
use App\Services\Freeswitch\EslClient;
use Illuminate\Support\Facades\Log;

class GatewayObserver
{
    private string $sipProfilesDir = '/etc/freeswitch/sip_profiles';
    private string $fusionCacheDir = '/var/cache/fusionpbx';

    public function __construct(private EslClient $esl) {}

    public function saved(Gateway $gateway): void
    {
        try {
            $this->writeGatewayXml($gateway);
            $this->clearFusionSofiaCache();
            sleep(1);
            $this->esl->reloadGateway($gateway->gateway);
            Log::info('ESL: Gateway reloaded', ['gateway' => $gateway->gateway]);
        } catch (\Throwable $e) {
            Log::warning('ESL: Gateway reload failed', ['error' => $e->getMessage()]);
        }
    }

    public function deleted(Gateway $gateway): void
    {
        try {
            $this->deleteGatewayXml($gateway);
            $this->clearFusionSofiaCache();
            $this->esl->killGateway($gateway->gateway_uuid ?? $gateway->gateway);
            Log::info('ESL: Gateway killed', ['gateway' => $gateway->gateway]);
        } catch (\Throwable $e) {
            Log::warning('ESL: Gateway kill failed', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Writes the static gateway XML file the same way FusionPBX's
     * resources/switch.php::save_gateway_xml() does, so mod_sofia's
     * profile rescan actually picks up gateways created via Laravel.
     */
    private function writeGatewayXml(Gateway $gateway): void
    {
        if (empty($gateway->enabled) || $gateway->enabled === 'false') {
            $this->deleteGatewayXml($gateway);
            return;
        }

        $profile = $gateway->profile ?: 'external';
        $uuid    = strtolower($gateway->gateway_uuid);
        $path    = "{$this->sipProfilesDir}/{$profile}/v_{$uuid}.xml";

        $xml  = "<include>\n";
        $xml .= "    <gateway name=\"{$uuid}\">\n";

        $params = [
            'username'             => $gateway->username,
            'distinct-to'          => $gateway->distinct_to,
            'auth-username'        => $gateway->auth_username,
            'password'             => $gateway->password,
            'realm'                => $gateway->realm,
            'from-user'            => $gateway->from_user,
            'from-domain'          => $gateway->from_domain,
            'proxy'                => $gateway->proxy,
            'register-proxy'       => $gateway->register_proxy,
            'outbound-proxy'       => $gateway->outbound_proxy,
            'expire-seconds'       => $gateway->expire_seconds,
            'register'             => $gateway->register,
            'register-transport'   => $gateway->register_transport,
            'contact-params'       => $gateway->contact_params,
            'retry-seconds'        => $gateway->retry_seconds,
            'extension'            => $gateway->extension,
            'ping'                 => $gateway->ping,
            'context'              => $gateway->context,
            'caller-id-in-from'    => $gateway->caller_id_in_from,
            'supress-cng'          => $gateway->supress_cng,
            'sip_cid_type'         => $gateway->sip_cid_type,
            'extension-in-contact' => $gateway->extension_in_contact,
        ];

        foreach ($params as $name => $value) {
            if ($value === null || $value === '' || $value === false) continue;
            $safe = htmlspecialchars((string) $value, ENT_QUOTES);
            $xml .= "      <param name=\"{$name}\" value=\"{$safe}\"/>\n";
        }

        $xml .= "    </gateway>\n";
        $xml .= "</include>";

        if (!is_dir(dirname($path))) {
            Log::warning('Gateway XML dir missing', ['path' => dirname($path)]);
            return;
        }

        file_put_contents($path, $xml);
    }

    private function deleteGatewayXml(Gateway $gateway): void
    {
        $profile = $gateway->profile ?: 'external';
        $uuid    = strtolower($gateway->gateway_uuid);
        $path    = "{$this->sipProfilesDir}/{$profile}/v_{$uuid}.xml";
        if (file_exists($path)) {
            @unlink($path);
        }
    }

    /**
     * Clears FusionPBX's own file-based sofia.conf cache (dynamically computed
     * using gethostname(), matching resources/classes/cache.php exactly),
     * so mod_xml_curl / mod_fusion re-reads live v_gateways data on next rescan.
     */
    private function clearFusionSofiaCache(): void
    {
        $key     = gethostname() . ":configuration:sofia.conf";
        $fileKey = str_replace(':', '.', $key);

        foreach (glob("{$this->fusionCacheDir}/{$fileKey}*") as $file) {
            @unlink($file);
        }
    }
}
