<?php

namespace App\Notifications;

use \GuzzleHttp\Client;
use App\Contracts\NotificationServicesCaller;
use App\Traits\MakePostable;

class Line implements NotificationServicesCaller {

    use MakePostable;

    protected $client;
    protected $headers;
    protected $params;
    protected $returnJSONString;

    public function __construct($returnJSONString = false)
    {
        $this->client = new Client([
            'base_uri' => 'https://sakid.co',
        ]);

        $this->params['headers'] = [
            'Accept' => 'application/json',
            'token' => config('app.sakid_api_token'),
            'secret' => config('app.sakid_api_secret'),
        ];

        $this->returnJSONString = $returnJSONString;
    }
    
    public function sendMessage($username, $text)
    {
        $this->params['form_params'] = [
            'type' => 'text',
            'username' => $username,
            'text' => $text
        ];
        return $this->makePost('/api/line-messaging');
    }

    public function sendImage($username, $originalUrl, $previewUrl)
    {
        $this->params['form_params'] = [
            'type' => 'image',
            'username' => $username,
            'original_url' => $originalUrl,
            'preview_url' => $previewUrl
        ];
        return $this->makePost('/api/line-messaging');
    }

    public function sendSticker($username, $packageId, $stickerId)
    {
        $this->params['form_params'] = [
            'type' => 'sticker',
            'username' => $username,
            'package_id' => $packageId,
            'sticker_id' => $stickerId
        ];
        return $this->makePost('/api/line-messaging');
    }

    public function sendLocation($username, $title, $address, $latitude, $longitude)
    {
        $this->params['form_params'] = [
            'type' => 'location',
            'username' => $username,
            'title' => $title,
            'address' => $address,
            'latitude' => 13.7558452,
            'longitude' => 100.4844983
        ];
        return $this->makePost('/api/line-messaging');
    }
}
?>