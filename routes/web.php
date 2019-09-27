<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/smuggle', function() {
    $client = new \GuzzleHttp\Client([
        'base_uri' => 'https://sakid.co'
    ]);
    $response = $client->post('/smuggle/accio', [
        'headers' => [
            'Accept' => 'application/json',
            'token' => env('smuggle_api_token'),
            'secret' => env('smuggle_api_secret'),
        ],
        'form_params' => [
            'function' => 'recently-admit',
            'hn' => 46009966,
        ]
    ]);

    if($response->getStatusCode() !== 200)
    {
        return 'Error!';
    }
    return json_decode($response->getBody(), true);
    
});

Route::get('/scabber', function() {
    $client = new \GuzzleHttp\Client([
        'base_uri' => 'https://172.20.9.103',
        'verify' => 'false'
    ]);
    $response = $client->post('/accio/admission', [
        'headers' => [],
        'form_params' => [
            'token' => env('scabbers_token'),
            'an' => 46009966
        ]
    ]);

    if($response->getStatusCode() !== 200)
    {
        return 'Error!';
    }
    return json_decode($response->getBody(), true);
});

Route::get('/orawan', function() {
    $client = new \GuzzleHttp\Client([
        'base_uri' => 'https://devsiwebapi.mahidol.ac.th',
    ]);
    $response = $client->post('checkuser/api/User', [
        'headers' => [],
        'json' => [
            'user' => '',
            'pass' => ''
        ]
    ]);

    if($response->getStatusCode() !== 200)
    {
        return 'Error!';
    }
    return json_decode($response->getBody(), true)[0];
});