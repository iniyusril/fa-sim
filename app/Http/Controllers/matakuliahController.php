<?php
namespace App\Http\Controllers;

use App\Dashboard;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Excel;
class matakuliahController extends Controller
{
    //
    public function index()
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $data = Dashboard::limit(1)->first();
        $tha = $data->tha;
        $semester = $data->semester;
        try {
            $client = new Client();
            $response = $client->request('GET', $base_url . 'GetListMatakuliahByTahunAkademik', [
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
        return view('matakuliah.index', compact('datas'));

    }
    public function get_matakuliah()
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $data = Dashboard::limit(1)->first();
        $tha = $data->tha;
        $semester = $data->semester;
        try {
            $client = new Client();
            $response = $client->request('GET', $base_url . 'GetListMatakuliahByTahunAkademik', [
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
