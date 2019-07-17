<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class tokenController extends Controller
{
    public function index(){
        $nim = env('NIM');
        $pass = md5(env('PASS'));
        $base_url = env('BASE_URL');
        $client = new Client();
    	$response = $client->request('GET', $base_url.'GetToken?npm='.$nim.'&password='.$pass);
    	$statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $result = json_decode($body);
        return $result->Token;
    }
}
