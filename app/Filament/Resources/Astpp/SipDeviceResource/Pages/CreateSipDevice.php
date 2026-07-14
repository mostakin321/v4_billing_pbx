<?php
namespace App\Filament\Resources\Astpp\SipDeviceResource\Pages;
use App\Filament\Resources\Astpp\SipDeviceResource\SipDeviceResource;
use Filament\Resources\Pages\CreateRecord;
class CreateSipDevice extends CreateRecord
{
    protected static string $resource = SipDeviceResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $params = [];
        if (!empty($data['sip_password'])) $params['password'] = $data['sip_password'];
        $params['vm-enabled']   = $data['vm_enabled'] ?? 'true';
        $params['vm-password']  = $data['vm_password'] ?? '';
        $params['vm-mailto']    = $data['vm_mailto'] ?? '';
        $params['vm-attach-file'] = 'true';
        $params['vm-keep-local-after-email'] = 'true';
        $params['vm-email-all-messages'] = 'true';
        $data['dir_params'] = json_encode($params);

        $vars = [];
        if (!empty($data['effective_caller_id_name']))   $vars['effective_caller_id_name']   = $data['effective_caller_id_name'];
        if (!empty($data['effective_caller_id_number'])) $vars['effective_caller_id_number'] = $data['effective_caller_id_number'];
        $data['dir_vars'] = json_encode($vars);

        unset($data['sip_password'],$data['vm_password'],$data['vm_mailto'],$data['vm_enabled'],$data['effective_caller_id_name'],$data['effective_caller_id_number']);
        $data['creation_date'] = now();
        $data['last_modified_date'] = now();
        return $data;
    }
}
