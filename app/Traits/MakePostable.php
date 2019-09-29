<?php

namespace App\Traits;

trait MakePostable
{
    protected function makePost($serviceUrl)
    {
        try {
            $response = $this->client->post($serviceUrl, $this->params);
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }

        if ($response->getStatusCode() != 200 || getType(json_decode($response->getBody(),true)) !== 'array') 
            return response('error', $response->getStatusCode());

        return $this->returnJSONString ? $response->getBody() : json_decode($response->getBody(), true);
    }
}