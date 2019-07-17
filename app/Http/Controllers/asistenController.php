<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class asistenController extends Controller
{
    //
    public function index()
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $tha = env('THA');
        $semester = 1;
        $client = new Client();
        $response = $client->request('GET', $base_url . 'GetListAsisten', [
            'query' => [
                'token' => $token,
                'tha' => $tha,
                'semester' => $semester,
            ],
        ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $datas = json_decode($body, true);
        return view('asisten.index', compact('datas'));
    }
}