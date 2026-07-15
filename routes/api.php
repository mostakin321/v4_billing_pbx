<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\FusionPBX\GatewaySyncController;

require __DIR__.'/api_fusionpbx.php';

Route::prefix('v1/fusion-pbx/gateways')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::post('resync', [GatewaySyncController::class, 'triggerGatewayResync']);

        Route::get('status', [GatewaySyncController::class, 'queryLiveRegistrationStatus']);

    });
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// FreeSWITCH XML Curl
Route::post('/freeswitch/xml', [\App\Http\Controllers\Api\XmlCurlController::class, 'handle']);
Route::post('/freeswitch/cdr', [\App\Http\Controllers\Api\CdrWebhookController::class, 'handle']);


Route::post('/v1/login', function(\Illuminate\Http\Request $request) {
    $request->validate(['email'=>'required|email','password'=>'required']);
    $user = \App\Models\User::where('email', $request->email)->first();
    if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        return response()->json(['error'=>'Invalid credentials'], 401);
    }
    $token = $user->createToken('dialer-api')->plainTextToken;
    return response()->json(['token'=>$token, 'email'=>$user->email]);
});

Route::post('/v1/login', function(\Illuminate\Http\Request $request) {
    $request->validate(['email'=>'required|email','password'=>'required']);
    $user = \App\Models\User::where('email', $request->email)->first();
    if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        return response()->json(['error'=>'Invalid credentials'], 401);
    }
    $token = $user->createToken('dialer-api')->plainTextToken;
    return response()->json(['token'=>$token, 'email'=>$user->email]);
});
Route::post("/v1/traffic/record-hangup", [\App\Http\Controllers\Api\V1\UnifiedPlatformGatewayController::class, "processHangupWebhook"]);
Route::post("/v1/fusion-pbx/tariff/sync", [\App\Http\Controllers\Api\FusionPBX\TariffManagementController::class, "syncTariffProfile"]);

Route::prefix('v1/fusion-pbx/routes')->group(function () {
    Route::get('lookup', [\App\Http\Controllers\Api\FusionPBX\RouteGroupController::class, 'lookupActiveRoute']);
    Route::post('store', [\App\Http\Controllers\Api\FusionPBX\RouteGroupController::class, 'storeRouteEntry']);
});

Route::prefix('v1/fusion-pbx/inbound')->group(function () {
    Route::post('route', [\App\Http\Controllers\Api\FusionPBX\InboundDidController::class, 'routeIncomingCall']);
});

Route::prefix('v1/fusion-pbx/broadcast')->group(function () {
    Route::post('create', [\App\Http\Controllers\Api\FusionPBX\BroadcastCampaignController::class, 'createCampaign']);
    Route::post('{id}/start', [\App\Http\Controllers\Api\FusionPBX\BroadcastCampaignController::class, 'startCampaign']);
});

Route::post('/v1/fusion-pbx/ai-agent/interact', [\App\Http\Controllers\Api\FusionPBX\AiTelephonyGatewayController::class, 'interact']);

