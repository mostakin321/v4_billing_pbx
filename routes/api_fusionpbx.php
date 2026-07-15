<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FusionPBX\AccessControlController;
use App\Http\Controllers\Api\FusionPBX\AccessControlNodeController;
use App\Http\Controllers\Api\FusionPBX\BridgeController;
use App\Http\Controllers\Api\FusionPBX\CallBlockController;
use App\Http\Controllers\Api\FusionPBX\CallBroadcastController;
use App\Http\Controllers\Api\FusionPBX\CallCenterAgentController;
use App\Http\Controllers\Api\FusionPBX\CallCenterQueueController;
use App\Http\Controllers\Api\FusionPBX\CallCenterTierController;
use App\Http\Controllers\Api\FusionPBX\CallFlowController;
use App\Http\Controllers\Api\FusionPBX\ClipController;
use App\Http\Controllers\Api\FusionPBX\ConferenceController;
use App\Http\Controllers\Api\FusionPBX\ConferenceCenterController;
use App\Http\Controllers\Api\FusionPBX\ConferenceControlController;
use App\Http\Controllers\Api\FusionPBX\ConferenceControlDetailController;
use App\Http\Controllers\Api\FusionPBX\ConferenceProfileController;
use App\Http\Controllers\Api\FusionPBX\ConferenceProfileParamController;
use App\Http\Controllers\Api\FusionPBX\ConferenceRoomController;
use App\Http\Controllers\Api\FusionPBX\ConferenceRoomUserController;
use App\Http\Controllers\Api\FusionPBX\ConferenceSessionController;
use App\Http\Controllers\Api\FusionPBX\ConferenceSessionDetailController;
use App\Http\Controllers\Api\FusionPBX\ConferenceUserController;
use App\Http\Controllers\Api\FusionPBX\ContactController;
use App\Http\Controllers\Api\FusionPBX\ContactAddressController;
use App\Http\Controllers\Api\FusionPBX\ContactAttachmentController;
use App\Http\Controllers\Api\FusionPBX\ContactEmailController;
use App\Http\Controllers\Api\FusionPBX\ContactGroupController;
use App\Http\Controllers\Api\FusionPBX\ContactNoteController;
use App\Http\Controllers\Api\FusionPBX\ContactPhoneController;
use App\Http\Controllers\Api\FusionPBX\ContactRelationController;
use App\Http\Controllers\Api\FusionPBX\ContactSettingController;
use App\Http\Controllers\Api\FusionPBX\ContactTimeController;
use App\Http\Controllers\Api\FusionPBX\ContactUrlController;
use App\Http\Controllers\Api\FusionPBX\ContactUserController;
use App\Http\Controllers\Api\FusionPBX\CountryController;
use App\Http\Controllers\Api\FusionPBX\DashboardController;
use App\Http\Controllers\Api\FusionPBX\DashboardGroupController;
use App\Http\Controllers\Api\FusionPBX\DatabasController;
use App\Http\Controllers\Api\FusionPBX\DatabaseTransactionController;
use App\Http\Controllers\Api\FusionPBX\DefaultSettingController;
use App\Http\Controllers\Api\FusionPBX\DestinationController;
use App\Http\Controllers\Api\FusionPBX\DeviceController;
use App\Http\Controllers\Api\FusionPBX\DeviceKeyController;
use App\Http\Controllers\Api\FusionPBX\DeviceLineController;
use App\Http\Controllers\Api\FusionPBX\DeviceLogController;
use App\Http\Controllers\Api\FusionPBX\DeviceProfileController;
use App\Http\Controllers\Api\FusionPBX\DeviceProfileKeyController;
use App\Http\Controllers\Api\FusionPBX\DeviceProfileSettingController;
use App\Http\Controllers\Api\FusionPBX\DeviceSettingController;
use App\Http\Controllers\Api\FusionPBX\DeviceVendorController;
use App\Http\Controllers\Api\FusionPBX\DeviceVendorFunctionController;
use App\Http\Controllers\Api\FusionPBX\DeviceVendorFunctionGroupController;
use App\Http\Controllers\Api\FusionPBX\DialplanController;
use App\Http\Controllers\Api\FusionPBX\DialplanDetailController;
use App\Http\Controllers\Api\FusionPBX\DialplanToolController;
use App\Http\Controllers\Api\FusionPBX\DomainController;
use App\Http\Controllers\Api\FusionPBX\DomainSettingController;
use App\Http\Controllers\Api\FusionPBX\EmailQueueController;
use App\Http\Controllers\Api\FusionPBX\EmailQueueAttachmentController;
use App\Http\Controllers\Api\FusionPBX\EmailTemplateController;
use App\Http\Controllers\Api\FusionPBX\EmergencyLogController;
use App\Http\Controllers\Api\FusionPBX\EventGuardLogController;
use App\Http\Controllers\Api\FusionPBX\ExtensionController;
use App\Http\Controllers\Api\FusionPBX\ExtensionSettingController;
use App\Http\Controllers\Api\FusionPBX\ExtensionUserController;
use App\Http\Controllers\Api\FusionPBX\FaxController;
use App\Http\Controllers\Api\FusionPBX\FaxFileController;
use App\Http\Controllers\Api\FusionPBX\FaxLogController;
use App\Http\Controllers\Api\FusionPBX\FaxQueueController;
use App\Http\Controllers\Api\FusionPBX\FaxUserController;
use App\Http\Controllers\Api\FusionPBX\FifoController;
use App\Http\Controllers\Api\FusionPBX\FifoMemberController;
use App\Http\Controllers\Api\FusionPBX\FollowMeController;
use App\Http\Controllers\Api\FusionPBX\FollowMeDestinationController;
use App\Http\Controllers\Api\FusionPBX\GatewayController;
use App\Http\Controllers\Api\FusionPBX\GroupController;
use App\Http\Controllers\Api\FusionPBX\GroupPermissionController;
use App\Http\Controllers\Api\FusionPBX\IvrMenuController;
use App\Http\Controllers\Api\FusionPBX\IvrMenuOptionController;
use App\Http\Controllers\Api\FusionPBX\LanguageController;
use App\Http\Controllers\Api\FusionPBX\MenuController;
use App\Http\Controllers\Api\FusionPBX\MenuItemController;
use App\Http\Controllers\Api\FusionPBX\MenuItemGroupController;
use App\Http\Controllers\Api\FusionPBX\MenuLanguageController;
use App\Http\Controllers\Api\FusionPBX\ModuleController;
use App\Http\Controllers\Api\FusionPBX\MusicOnHoldController;
use App\Http\Controllers\Api\FusionPBX\NotificationController;
use App\Http\Controllers\Api\FusionPBX\NumberTranslationController;
use App\Http\Controllers\Api\FusionPBX\NumberTranslationDetailController;
use App\Http\Controllers\Api\FusionPBX\PermissionController;
use App\Http\Controllers\Api\FusionPBX\PhrasController;
use App\Http\Controllers\Api\FusionPBX\PhraseDetailController;
use App\Http\Controllers\Api\FusionPBX\PinNumberController;
use App\Http\Controllers\Api\FusionPBX\RecordingController;
use App\Http\Controllers\Api\FusionPBX\RingGroupController;
use App\Http\Controllers\Api\FusionPBX\RingGroupDestinationController;
use App\Http\Controllers\Api\FusionPBX\RingGroupUserController;
use App\Http\Controllers\Api\FusionPBX\SipProfileController;
use App\Http\Controllers\Api\FusionPBX\SipProfileDomainController;
use App\Http\Controllers\Api\FusionPBX\SipProfileSettingController;
use App\Http\Controllers\Api\FusionPBX\SofiaGlobalSettingController;
use App\Http\Controllers\Api\FusionPBX\SoftwareController;
use App\Http\Controllers\Api\FusionPBX\StreamController;
use App\Http\Controllers\Api\FusionPBX\UserController;
use App\Http\Controllers\Api\FusionPBX\UserGroupController;
use App\Http\Controllers\Api\FusionPBX\UserLogController;
use App\Http\Controllers\Api\FusionPBX\UserSettingController;
use App\Http\Controllers\Api\FusionPBX\VarController;
use App\Http\Controllers\Api\FusionPBX\VoicemailController;
use App\Http\Controllers\Api\FusionPBX\VoicemailDestinationController;
use App\Http\Controllers\Api\FusionPBX\VoicemailGreetingController;
use App\Http\Controllers\Api\FusionPBX\VoicemailMessageController;
use App\Http\Controllers\Api\FusionPBX\VoicemailOptionController;
use App\Http\Controllers\Api\FusionPBX\XmlCdrController;
use App\Http\Controllers\Api\FusionPBX\XmlCdrExtensionController;
use App\Http\Controllers\Api\FusionPBX\XmlCdrFlowController;
use App\Http\Controllers\Api\FusionPBX\XmlCdrJsonController;
use App\Http\Controllers\Api\FusionPBX\XmlCdrLogController;

/*
|--------------------------------------------------------------------------
| FusionPBX REST API  —  /api/fusionpbx/*
|--------------------------------------------------------------------------
| All 117 endpoints protected by Sanctum token auth.
|
| Standard REST per resource:
|   GET    /api/fusionpbx/{resource}           index   (paginated)
|   POST   /api/fusionpbx/{resource}           store
|   GET    /api/fusionpbx/{resource}/{uuid}    show
|   PUT    /api/fusionpbx/{resource}/{uuid}    update
|   DELETE /api/fusionpbx/{resource}/{uuid}    destroy
*/
Route::prefix('fusionpbx')
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::apiResources([
            'access-controls'               => AccessControlController::class,
            'access-control-nodes'          => AccessControlNodeController::class,
            'bridges'                       => BridgeController::class,
            'call-blocks'                   => CallBlockController::class,
            'call-broadcasts'               => CallBroadcastController::class,
            'call-center-agents'            => CallCenterAgentController::class,
            'call-center-queues'            => CallCenterQueueController::class,
            'call-center-tiers'             => CallCenterTierController::class,
            'call-flows'                    => CallFlowController::class,
            'clips'                         => ClipController::class,
            'conferences'                   => ConferenceController::class,
            'conference-centers'            => ConferenceCenterController::class,
            'conference-controls'           => ConferenceControlController::class,
            'conference-control-details'    => ConferenceControlDetailController::class,
            'conference-profiles'           => ConferenceProfileController::class,
            'conference-profile-params'     => ConferenceProfileParamController::class,
            'conference-rooms'              => ConferenceRoomController::class,
            'conference-room-users'         => ConferenceRoomUserController::class,
            'conference-sessions'           => ConferenceSessionController::class,
            'conference-session-details'    => ConferenceSessionDetailController::class,
            'conference-users'              => ConferenceUserController::class,
            'contacts'                      => ContactController::class,
            'contact-addresses'             => ContactAddressController::class,
            'contact-attachments'           => ContactAttachmentController::class,
            'contact-emails'                => ContactEmailController::class,
            'contact-groups'                => ContactGroupController::class,
            'contact-notes'                 => ContactNoteController::class,
            'contact-phones'                => ContactPhoneController::class,
            'contact-relations'             => ContactRelationController::class,
            'contact-settings'              => ContactSettingController::class,
            'contact-times'                 => ContactTimeController::class,
            'contact-urls'                  => ContactUrlController::class,
            'contact-users'                 => ContactUserController::class,
            'countries'                     => CountryController::class,
            'dashboards'                    => DashboardController::class,
            'dashboard-groups'              => DashboardGroupController::class,
            'databases'                     => DatabasController::class,
            'database-transactions'         => DatabaseTransactionController::class,
            'default-settings'              => DefaultSettingController::class,
            'destinations'                  => DestinationController::class,
            'devices'                       => DeviceController::class,
            'device-keys'                   => DeviceKeyController::class,
            'device-lines'                  => DeviceLineController::class,
            'device-logs'                   => DeviceLogController::class,
            'device-profiles'               => DeviceProfileController::class,
            'device-profile-keys'           => DeviceProfileKeyController::class,
            'device-profile-settings'       => DeviceProfileSettingController::class,
            'device-settings'               => DeviceSettingController::class,
            'device-vendors'                => DeviceVendorController::class,
            'device-vendor-functions'       => DeviceVendorFunctionController::class,
            'device-vendor-function-groups' => DeviceVendorFunctionGroupController::class,
            'dialplans'                     => DialplanController::class,
            'dialplan-details'              => DialplanDetailController::class,
            'dialplan-tools'                => DialplanToolController::class,
            'domains'                       => DomainController::class,
            'domain-settings'               => DomainSettingController::class,
            'email-queues'                  => EmailQueueController::class,
            'email-queue-attachments'       => EmailQueueAttachmentController::class,
            'email-templates'               => EmailTemplateController::class,
            'emergency-logs'                => EmergencyLogController::class,
            'event-guard-logs'              => EventGuardLogController::class,
            'extensions'                    => ExtensionController::class,
            'extension-settings'            => ExtensionSettingController::class,
            'extension-users'               => ExtensionUserController::class,
            'faxes'                         => FaxController::class,
            'fax-files'                     => FaxFileController::class,
            'fax-logs'                      => FaxLogController::class,
            'fax-queues'                    => FaxQueueController::class,
            'fax-users'                     => FaxUserController::class,
            'fifos'                         => FifoController::class,
            'fifo-members'                  => FifoMemberController::class,
            'follow-mes'                    => FollowMeController::class,
            'follow-me-destinations'        => FollowMeDestinationController::class,
            'gateways'                      => GatewayController::class,
            'groups'                        => GroupController::class,
            'group-permissions'             => GroupPermissionController::class,
            'ivr-menus'                     => IvrMenuController::class,
            'ivr-menu-options'              => IvrMenuOptionController::class,
            'languages'                     => LanguageController::class,
            'menus'                         => MenuController::class,
            'menu-items'                    => MenuItemController::class,
            'menu-item-groups'              => MenuItemGroupController::class,
            'menu-languages'                => MenuLanguageController::class,
            'modules'                       => ModuleController::class,
            'music-on-holds'                => MusicOnHoldController::class,
            'notifications'                 => NotificationController::class,
            'number-translations'           => NumberTranslationController::class,
            'number-translation-details'    => NumberTranslationDetailController::class,
            'permissions'                   => PermissionController::class,
            'phrases'                       => PhrasController::class,
            'phrase-details'                => PhraseDetailController::class,
            'pin-numbers'                   => PinNumberController::class,
            'recordings'                    => RecordingController::class,
            'ring-groups'                   => RingGroupController::class,
            'ring-group-destinations'       => RingGroupDestinationController::class,
            'ring-group-users'              => RingGroupUserController::class,
            'sip-profiles'                  => SipProfileController::class,
            'sip-profile-domains'           => SipProfileDomainController::class,
            'sip-profile-settings'          => SipProfileSettingController::class,
            'sofia-global-settings'         => SofiaGlobalSettingController::class,
            'softwares'                     => SoftwareController::class,
            'streams'                       => StreamController::class,
            'fusionpbx-users'               => UserController::class,
            'user-groups'                   => UserGroupController::class,
            'user-logs'                     => UserLogController::class,
            'user-settings'                 => UserSettingController::class,
            'vars'                          => VarController::class,
            'voicemails'                    => VoicemailController::class,
            'voicemail-destinations'        => VoicemailDestinationController::class,
            'voicemail-greetings'           => VoicemailGreetingController::class,
            'voicemail-messages'            => VoicemailMessageController::class,
            'voicemail-options'             => VoicemailOptionController::class,
            'xml-cdrs'                      => XmlCdrController::class,
            'xml-cdr-extensions'            => XmlCdrExtensionController::class,
            'xml-cdr-flows'                 => XmlCdrFlowController::class,
            'xml-cdr-jsons'                 => XmlCdrJsonController::class,
            'xml-cdr-logs'                  => XmlCdrLogController::class,
        ]);
    });
