<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
class matakuliahController extends Controller
{
    //
    public function index(){
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $tha = env('THA');
        $semester = 2;
        $client = new Client();
    	$response = $client->request('GET', $base_url.'GetListMatakuliahByTahunAkademik',[
            'query' =>[
                'token' => $token,
                'tha' => $tha,
                'semester' => $semester,
            ]
        ]);
    	$statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $datas = json_decode($body,TRUE);
        return view('matakuliah.index',compact('datas'));
    }
}
