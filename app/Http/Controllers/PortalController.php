<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\SiITServicesCaller;

class PortalController extends Controller
{
    public function __construct()
    {
        return $this->middleware('portalGuard');
    }
    
    public function __invoke(SiITServicesCaller $caller)
    {
        $payload = json_decode(request('payload'), true);
        
        switch ($payload['function']) {
            case 'authenticate':
                return $caller->authenticate($payload['key_value'], $payload['password']);
            case 'admission':
                return $caller->getAdmission($payload['key_value']);
            case 'patient':
                return $caller->getPatient($payload['key_value']);
            case 'recently-admit':
                return $caller->getPatientRecentlyAdmit($payload['key_value']);
            case 'user':
                return $caller->getUser($payload['key_value']);
            default :
                return response('error', 400);
        }
    }
}
