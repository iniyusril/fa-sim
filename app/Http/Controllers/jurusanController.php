<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Dashboard;
use App\Http\Controllers\Http;

class jurusanController extends Controller
{
    public $client;
    
    function __construct() {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $http = new Http($token);
        $this->client = $http->client;
    }   
    public function downloadExcel()
    {
        //$data = Item::get()->toArray();
        $x = Dashboard::limit(1)->first();
        $tha = $x->tha;
        try {
            $data = $this->get_jurusan();
            return Excel::create('jurusan' . $tha, function ($excel) use ($data) {
                $excel->sheet('mysheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xls');
        } catch (ClientException $e) {
            return redirect()->route('presensi')->with('alert-danger-presensi', 'Gagal Mendapatkan Data, Data yang di grab tidak ada !');
        }

    }
    public function index()
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $response = $this->client->get('GetListJurusan');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $datas = json_decode($body, true);
        return view('jurusan.index', compact('datas'));
    }
    public function get_jurusan()
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $response = $this->client->get('GetListJurusan');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $datas = json_decode($body, true);
        return $datas;
    }
}