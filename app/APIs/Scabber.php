<?php

namespace App\APIs;

use \GuzzleHttp\Client;
use App\Contracts\SiITServicesCaller;
use App\Traits\MakePostable;

class Scabber implements SiITServicesCaller {
    
    use MakePostable;
    
    protected $client;
    protected $headers;
    protected $params;
    protected $returnJSONString;

    public function __construct($returnJSONString = false)
    {
        $this->client = new Client([
            'base_uri' => 'https://172.20.9.103',
            'verify' => false
        ]);

        $this->returnJSONString = $returnJSONString;
    }

    public function authenticate($orgId, $password)
    {
        $this->params['form_params'] = [
            'token'   => config('app.scabber_token'),
            'org_id' => $orgId,
            'password' => $password
        ];
        return $this->makePost('accio/authenticate');    
    }

    public function getAdmission($an)
    {
        $this->params['form_params'] = [
            'token'   => config('app.scabber_token'),
            'an' => $an
        ];
        return $this->makePost('accio/admission');
    }

    public function getPatient($hn)
    {
        $this->params['form_params'] = [
            'token'   => config('app.scabber_token'),
            'hn' => $hn,
        ];
        return $this->makePost('accio/patient');
    }

    public function getUser($orgId)
    {
        $this->params['form_params'] = [
            'org_id' => $orgId,
        ];
        return $this->makePost('/smuggle/user');
    }
}

?>