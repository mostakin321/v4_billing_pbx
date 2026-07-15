<?php

namespace App\Filament\Pages;

use App\Filament\Resources\FusionPBX\CallCenterQueues\CallCenterQueueResource;
use App\Filament\Resources\FusionPBX\Destinations\DestinationResource;
use App\Filament\Resources\FusionPBX\Dialplans\DialplanResource;
use App\Filament\Resources\FusionPBX\Extensions\ExtensionResource;
use App\Filament\Resources\FusionPBX\Gateways\GatewayResource;
use App\Filament\Resources\FusionPBX\IvrMenus\IvrMenuResource;
use App\Filament\Resources\FusionPBX\RingGroups\RingGroupResource;
use App\Filament\Resources\FusionPBX\Voicemails\VoicemailResource;
use App\Filament\Widgets\PbxStatsOverview;
use App\Models\FusionPBX\CallCenterQueue;
use App\Models\FusionPBX\Destination;
use App\Models\FusionPBX\Dialplan;
use App\Models\FusionPBX\Extension;
use App\Models\FusionPBX\Gateway;
use App\Models\FusionPBX\IvrMenu;
use App\Models\FusionPBX\RingGroup;
use App\Models\FusionPBX\Voicemail;
use App\Models\FusionPBX\XmlCdr;
use Carbon\Carbon;
use Filament\Pages\Page;

class PbxDashboard extends Page
{
    protected static ?string $navigationLabel = 'PBX Dashboard';
    protected static ?int $navigationSort = -3;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static string $routePath = 'pbx';

    public function getView(): string
    {
        return 'filament.pages.pbx-dashboard';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PbxStatsOverview::class,
        ];
    }

    protected function getViewData(): array
    {
        $today = Carbon::today();

        return [
            'links' => [
                [
                    'label' => 'Extensions',
                    'description' => 'SIP extensions & settings',
                    'url' => ExtensionResource::getUrl('index'),
                    'group' => 'Accounts',
                ],
                [
                    'label' => 'Dialplans',
                    'description' => 'Routes, conditions, actions',
                    'url' => DialplanResource::getUrl('index'),
                    'group' => 'Dialplan',
                ],
                [
                    'label' => 'Destinations',
                    'description' => 'Where calls can be sent',
                    'url' => DestinationResource::getUrl('index'),
                    'group' => 'Dialplan',
                ],
                [
                    'label' => 'IVR Menus',
                    'description' => 'Interactive voice response',
                    'url' => IvrMenuResource::getUrl('index'),
                    'group' => 'Applications',
                ],
                [
                    'label' => 'Ring Groups',
                    'description' => 'Ring multiple extensions',
                    'url' => RingGroupResource::getUrl('index'),
                    'group' => 'Applications',
                ],
                [
                    'label' => 'Voicemail',
                    'description' => 'Voicemail boxes & options',
                    'url' => VoicemailResource::getUrl('index'),
                    'group' => 'Applications',
                ],
                [
                    'label' => 'Call Center Queues',
                    'description' => 'Queues & tiers',
                    'url' => CallCenterQueueResource::getUrl('index'),
                    'group' => 'Call Center',
                ],
                [
                    'label' => 'Gateways',
                    'description' => 'SIP trunks / gateways',
                    'url' => GatewayResource::getUrl('index'),
                    'group' => 'SIP & Gateways',
                ],
            ],
        ];
    }
}
