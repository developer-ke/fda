<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApollosSmsService;

class SmsController extends Controller
{

    protected $smsService;

    public function __construct(ApollosSmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'messages' => 'required|array',
            'messages.*.message' => 'required|string',
            'messages.*.phoneNumber' => 'nullable|string',
            'messages.*.phoneNumbers' => 'nullable|array',
        ]);

        $response = $this->smsService->sendSms($request->input('messages'));

        return response()->json($response);
    }
}