<?php

namespace App\Http\Controllers;

use App\Dashboard;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class tokenController extends Controller
{
    public function index()
    {
        $data = Dashboard::limit(1)->first();
        $nim = $data->npm;
        $pass = md5($data->password);
        $base_url = env('BASE_URL');
        $client = new Client();
        $response = $client->request('GET', $base_url . 'api/auth?npm=' . $nim . '&password=' . $pass);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $result = json_decode($body);
        return $result->token;
    }
}