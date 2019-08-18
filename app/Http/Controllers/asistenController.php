<?php

namespace App\Http\Controllers;

use App\Dashboard;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class asistenController extends Controller
{
    //
    public function index()
    {
        try {
            $token = app()->call('App\Http\Controllers\tokenController@index');
            $base_url = env('BASE_URL');
            $data = Dashboard::limit(1)->first();
            $tha = $data->tha;
            $semester = $data->semester;
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
        } catch (ClientException $e) {
            $datas = [];
        }
        return view('asisten.index', compact('datas'));
    }
}