<?php

namespace App\Http\Middleware;

use Closure;

class NotificationGuard
{
    protected $functions = [
        'send-message',
        'send-image',
        'send-sticker',
        'send-location',
    ];

    protected $tokens = [
        'no-land-man'
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!request()->has('payload')) return response('incomplete request', 400);

        $payload = json_decode(request('payload'), true);
        if (
            // payload not json
            !is_array($payload) ||
            // token is required
            !isset($payload['token']) ||
            // function is required
            !isset($payload['function']) ||
            //username is required
            !isset($payload['key_value']) ||
            // validate function
            !in_array($payload['function'], $this->functions) ||
            // text is required if request send-message
            ($payload['function'] == 'send-message' && !isset($payload['text'])) ||
            // originale_url and preview_url are required if request send-image
            ($payload['function'] == 'send-image' && (!isset($payload['original_url']) || !isset($payload['preview_url']))) ||
            // package_id and sticker_id are required if request send-sticker
            ($payload['function'] == 'send-sticker' && (!isset($payload['package_id']) || !isset($payload['sticker_id']))) ||
            // title, address, latitue, and longitude are required if request send-location
            ($payload['function'] == 'send-location' && (!isset($payload['title']) || !isset($payload['address']) || !isset($payload['latitude']) || !isset($payload['longitude'])))

        ) {
            return response('incomplete request', 400);
        }

        if (!in_array($payload['token'], $this->tokens)) {
            return response('not allowed', 401);
        }

        return $next($request);
    }
}
