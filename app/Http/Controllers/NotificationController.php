<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        return $this->middleware('notificationGuard');
    }

    public function __invoke()
    {
        $payload = json_decode(request('payload'), true);
        
        $notify = new \App\Notifications\Line();
        
        switch ($payload['function']) {
            case 'send-message':
                return $notify->sendMessage($payload['key_value'], $payload['text']);
            case 'send-image':
                return $notify->sendImage($payload['key_value'], $payload['original_url'], $payload['preview_url']);
            case 'send-sticker':
                return $notify->sendSticker($payload['key_value'], $payload['package_id'], $payload['sticker_id']);
            case 'send-location':
                return $notify->sendLocation($payload['key_value'], $payload['title'], $payload['address'], $payload['latitude'], $payload['longitude']);
            default :
                return response('error', 400);
        }
    }
}
