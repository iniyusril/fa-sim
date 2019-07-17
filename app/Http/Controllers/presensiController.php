<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class presensiController extends Controller
{
    //
    public function index()
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $tha = env('THA');
        $semester = 2;
        $kode_jurusan = env('KODE_JURUSAN');
        $jenis = env('JENIS');
        $client = new Client();
        $response = $client->request('GET', $base_url . 'GetListPresensiAsistenByJurusan', [
            'query' => [
                'token' => $token,
                'tha' => $tha,
                'semester' => $semester,
                'kode_jurusan' => $kode_jurusan,
                'jenis' => $jenis,
            ],
        ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $datas = json_decode($body, true);
        print_r($datas);
    }
}