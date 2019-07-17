<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\User;
class jurusanController extends Controller
{
    //
    public function index(){
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $client = new Client();
    	$response = $client->request('GET', $base_url.'GetListJurusan',[
            'query' =>[
                'token' => $token
            ]
        ]);
    	$statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $datas = json_decode($body,TRUE);
        return view('jurusan.index',compact('datas'));
    }
}
