<?php

namespace App\Http\Controllers;

use App\Dashboard;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Excel;
use App\Http\Controllers\Http;

class asistenController extends Controller
{
    //
    public $client;
    
    function __construct() {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $http = new Http($token);
        $this->client = $http->client;
    }
    public function index()
    {
        try {
            $data = Dashboard::limit(1)->first();
            $tha = $data->tha;
            $semester = $data->semester;
            $response = $this->client->get('GetListAsisten', [
                'query' => [
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
        // $count = count($datas);
        // dd($count);
        return view('asisten.index', compact('datas'));
    }
    public function get_asisten()
    {
        try {
            $data = Dashboard::limit(1)->first();
            $tha = $data->tha;
            $semester = $data->semester;
            $response = $this->client->get('GetListAsisten', [
                'query' => [
                    'tha' => $tha,
                    'semester' => $semester,
                ],
            ]);
            $body = $response->getBody()->getContents();
            $datas = json_decode($body, true);
        } catch (ClientException $e) {
            $datas = [];
        }
        return $datas;
    }
    public function downloadExcel()
    {
        //$data = Item::get()->toArray();
        $x = Dashboard::limit(1)->first();
        $tha = $x->tha;
        try {
            $data = $this->get_asisten();
            return Excel::create('asisten' . $tha, function ($excel) use ($data) {
                $excel->sheet('mysheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xls');
        } catch (ClientException $e) {
            return redirect()->route('presensi')->with('alert-danger-presensi', 'Gagal Mendapatkan Data, Data yang di grab tidak ada !');
        }
    }
}
