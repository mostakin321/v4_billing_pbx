<?php
namespace App\Filament\Resources\Astpp\GatewayResource\Pages;
use App\Filament\Resources\Astpp\GatewayResource\GatewayResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditGateway extends EditRecord
{
    protected static string $resource = GatewayResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $gd = json_decode($data['gateway_data'] ?? '{}', true) ?: [];
        $data['sip_username']              = $gd['username']              ?? '';
        $data['sip_password']              = $gd['password']              ?? '';
        $data['sip_proxy']                 = $gd['proxy']                 ?? '';
        $data['sip_outbound_proxy']        = $gd['outbound-proxy']        ?? '';
        $data['sip_from_domain']           = $gd['from-domain']           ?? '';
        $data['sip_from_user']             = $gd['from-user']             ?? '';
        $data['sip_realm']                 = $gd['realm']                 ?? '';
        $data['sip_register']              = ($gd['register'] ?? 'false') === 'true' ? 1 : 0;
        $data['sip_caller_id_in_from']     = ($gd['caller-id-in-from'] ?? 'true') === 'true' ? 1 : 0;
        $data['sip_extension_in_contact']  = ($gd['extension-in-contact'] ?? 'false') === 'true' ? 1 : 0;
        $data['sip_extension']             = $gd['extension']             ?? '';
        $data['sip_expire_seconds']        = $gd['expire-seconds']        ?? 800;
        $data['sip_transport']             = $gd['register-transport']    ?? 'udp';
        $data['sip_contact_params']        = $gd['contact-params']        ?? '';
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $gd = [];
        if (!empty($data['sip_username']))      $gd['username']           = $data['sip_username'];
        if (!empty($data['sip_password']))      $gd['password']           = $data['sip_password'];
        if (!empty($data['sip_proxy']))         $gd['proxy']              = $data['sip_proxy'];
        if (!empty($data['sip_outbound_proxy'])) $gd['outbound-proxy']   = $data['sip_outbound_proxy'];
        if (!empty($data['sip_from_domain']))   $gd['from-domain']        = $data['sip_from_domain'];
        if (!empty($data['sip_from_user']))     $gd['from-user']          = $data['sip_from_user'];
        if (!empty($data['sip_realm']))         $gd['realm']              = $data['sip_realm'];
        if (!empty($data['sip_extension']))     $gd['extension']          = $data['sip_extension'];
        if (!empty($data['sip_contact_params'])) $gd['contact-params']   = $data['sip_contact_params'];
        $gd['register']             = ($data['sip_register'] ?? 0) ? 'true' : 'false';
        $gd['caller-id-in-from']    = ($data['sip_caller_id_in_from'] ?? 1) ? 'true' : 'false';
        $gd['extension-in-contact'] = ($data['sip_extension_in_contact'] ?? 0) ? 'true' : 'false';
        $gd['register-transport']   = $data['sip_transport'] ?? 'udp';
        $gd['expire-seconds']       = $data['sip_expire_seconds'] ?? 800;
        $data['gateway_data'] = json_encode($gd);
        $data['last_modified_date'] = now();
        unset($data['sip_username'],$data['sip_password'],$data['sip_proxy'],$data['sip_outbound_proxy'],$data['sip_from_domain'],$data['sip_from_user'],$data['sip_realm'],$data['sip_register'],$data['sip_caller_id_in_from'],$data['sip_extension_in_contact'],$data['sip_extension'],$data['sip_expire_seconds'],$data['sip_transport'],$data['sip_contact_params']);
        return $data;
    }
}
