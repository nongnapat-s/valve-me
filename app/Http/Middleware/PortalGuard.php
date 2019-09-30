<?php

namespace App\Http\Middleware;

use Closure;

class PortalGuard
{
    protected $functions = [
        'user',
        'patient',
        'admission',
        'authenticate',
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
            // validate function
            !in_array($payload['function'], $this->functions) ||
            // password is required if request authenticate
            ($payload['function'] == 'authenticate' && !isset($payload['password'])) ||
            // key_value is required
            !isset($payload['key_value'])
        ) {
            return response('incomplete request', 400);
        }

        if (!in_array($payload['token'], $this->tokens)) {
            return response('not allowed', 401);
        }

        return $next($request);
    }
}
