<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CdrWebhookController extends Controller
{
    public function handle(Request $request)
    {
        return response()->json(['status' => 'ok']);
    }
}
