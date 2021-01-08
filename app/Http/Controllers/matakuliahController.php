<?php
namespace App\Http\Controllers;

use App\Dashboard;
use GuzzleHttp\Exception\ClientException;
use Excel;
use App\Http\Controllers\Http;

class matakuliahController extends Controller
{
    private $client;
    
    function __construct() {
        $token= app()->call('App\Http\Controllers\tokenController@index');
        $this->token = $token;
        $http = new Http($token);
        $this->client = $http->client;
    }  

    public function index()
    {
        $data = Dashboard::limit(1)->first();
        $tha = $data->tha;
        $semester = $data->semester;
        try {
            $response = $this->client->get('GetListMatakuliahByTahunAkademik', [
                'query' => [
                    'tha' => $tha,
                    'semester' => $semester,
                ]
            ]);
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            $datas = json_decode($body, true);
        } catch (ClientException $e) {
            $datas = [];
        }
        return view('matakuliah.index', compact('datas'));

    }
    public function get_matakuliah()
    {
        $data = Dashboard::limit(1)->first();
        $tha = $data->tha;
        $semester = $data->semester;
        try {
            $response = $this->client->get('GetListMatakuliahByTahunAkademik', [
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
        return $datas;
    }
    public function downloadExcel()
    {
        //$data = Item::get()->toArray();
        $x = Dashboard::limit(1)->first();
        $tha = $x->tha;
        try {
            $data = $this->get_matakuliah();
            return Excel::create('matakuliah' . $tha, function ($excel) use ($data) {
                $excel->sheet('mysheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xls');
        } catch (ClientException $e) {
            return redirect()->route('presensi')->with('alert-danger-presensi', 'Gagal Mendapatkan Data, Data yang di grab tidak ada !');
        }

    }
}
