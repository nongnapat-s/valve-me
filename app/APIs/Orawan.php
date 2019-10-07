<?php
namespace App\APIs;

use \GuzzleHttp\Client;
use App\Contracts\SiITServicesCaller;
use App\Traits\MakePostable;

class Orawan implements SiITServicesCaller
{
    use MakePostable;

    protected $client;
    protected $params;
    protected $returnJSONString;

    public function __construct($returnJSONString = false)
    {
        $this->client = new Client([
            'base_uri' => 'https://devsiwebapi.mahidol.ac.th',
        ]);

        $this->returnJSONString = $returnJSONString;
    }
    
    public function authenticate($orgId, $password)
    {
        $this->params['json'] = [
            'user' => $orgId,
            'pass' => $password
        ];
        return $this->makePost('/checkuser/api/User')[0]; 
    }

    public function getAdmission($an)
    {
        return ['return_code' => 0, 'reply_text' => 'Test Orawan'];
    }

    public function getPatient($hn)
    {
        return ['return_code' => 0, 'reply_text' => 'Test Orawan'];

    }

    public function getPatientRecentlyAdmit($hn)
    {
        return ['return_code' => 0, 'reply_text' => 'Test Orawan'];
    }

    public function getUser($orgId)
    {
        return ['return_code' => 0, 'reply_text' => 'Test Orawan'];
    }
}
?>