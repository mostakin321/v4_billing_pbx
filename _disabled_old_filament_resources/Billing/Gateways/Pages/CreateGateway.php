<?php

namespace App\Filament\Resources\Billing\Gateways\Pages;

use App\Filament\Resources\Billing\Gateways\GatewayResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGateway extends CreateRecord
{
    protected static string $resource = GatewayResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->buildGatewayData($data);
    }

    protected function buildGatewayData(array $data): array
    {
        $gd = [
            'username' => $data['sip_username'] ?? '',
            'password' => $data['sip_password'] ?? '',
            'proxy' => $data['sip_proxy'] ?? '',
            'outbound-proxy' => $data['sip_outbound_proxy'] ?? '',
            'from-domain' => $data['sip_from_domain'] ?? '',
            'from-user' => $data['sip_from_user'] ?? '',
            'realm' => $data['sip_realm'] ?? '',
            'extension' => $data['sip_extension'] ?? '',
            'contact-params' => $data['sip_contact_params'] ?? '',
            'register' => !empty($data['sip_register']) ? 'true' : 'false',
            'caller-id-in-from' => !empty($data['sip_caller_id_in_from']) ? 'true' : 'false',
            'extension-in-contact' => !empty($data['sip_extension_in_contact']) ? 'true' : 'false',
            'register-transport' => $data['sip_transport'] ?? 'udp',
            'expire-seconds' => $data['sip_expire_seconds'] ?? 800,
        ];

        $data['gateway_data'] = json_encode($gd);

        foreach (array_keys($data) as $key) {
            if (str_starts_with($key, 'sip_')) {
                unset($data[$key]);
            }
        }

        $data['accountid'] = $data['accountid'] ?? 0;
        $data['sip_profile_id'] = $data['sip_profile_id'] ?? 0;
        $data['status'] = $data['status'] ?? 0;
        $data['dialplan_variable'] = $data['dialplan_variable'] ?? '';

        return $data;
    }
}
