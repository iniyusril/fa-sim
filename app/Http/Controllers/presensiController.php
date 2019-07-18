<?php

namespace App\Http\Controllers;

use App\Dashboard;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class presensiController extends Controller
{
    //
    public function index()
    {
        $jurusan = app()->call('App\Http\Controllers\jurusanController@get_jurusan');
        return view('presensi.index', compact('jurusan'));
    }
    public function get(Request $request)
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $data = Dashboard::limit(1)->first();
        $tha = $data->tha;
        $semester = $data->semester;
        $kode_jurusan = $request->kode_jurusan;
        $jenis = $request->jenis;
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