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
            'base_uri' => 'https://172.9.20.103',
        ]);

        $this->returnJSONString = $returnJSONString;
    }

    public function authenticate($orgId, $password)
    {
        $this->params['form_params'] = [
            'function' => 'authenticate',
            'org_id'   => $orgId,
            'password' => $password
        ];
        return $this->makePost('/smuggle/accio');    
    }

    public function getAdmission($an)
    {
        $this->params['form_params'] = [
            'function' => 'admission',
            'an' => $an
        ];
        return $this->makePost('/smuggle/accio');
    }

    public function getPatient($hn)
    {
        $this->params['form_params'] = [
            'function' => 'patient',
            'hn' => $hn,
        ];
        return $this->makePost('/smuggle/accio');
    }

    public function getPatientRecentlyAdmit($hn)
    {
        $this->params['form_params'] = [
            'function' => 'recently-admit',
            'hn' => $hn,
        ];
        return $this->makePost('/smuggle/accio');
    }

    public function getUser($orgId)
    {
        $this->params['form_params'] = [
            'function' => 'user',
            'org_id' => $orgId,
        ];
        return $this->makePost('/smuggle/accio');
    }
}

?>