<?php
namespace App\Http\Controllers;
use GuzzleHttp\Client;

class Http {
    public $client;
    function __construct($token) {
        $base_url = env('BASE_URL').'api/ServiceFA/';
        $this->client = new Client([
            'base_uri' => $base_url,
            'headers' => [
                'Authorization' => 'Bearer '.$token
            ]
        ]);   
     }
}