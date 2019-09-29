<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\NotificationServicesCaller;

class NotificationController extends Controller
{
    public function __invoke(NotificationServicesCaller $caller)
    {
        $payload = json_decode(request('payload'), true);
        
        switch ($payload['function']) {
            case 'send-message':
                return $caller->sendMessage($payload['key_value'], $payload['message']);
            case 'send-image':
                return $caller->sendImage($payload['key_value'], $payload['original_url'], $payload['preview_url']);
            case 'send-sticker':
                return $caller->sendSticker($payload['key_value'], $payload['package_id'], $payload['sticker_id']);
            case 'send-location':
                return $caller->sendLocation($payload['key_value'], $payload['title'], $payload['address'], $payload['latitude'], $payload['longitude']);
            default :
                return response('error', 400);
        }
    }
}
