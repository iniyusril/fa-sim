<?php

namespace App\Http\Controllers;

use App\Dashboard;
use Excel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class presensiController extends Controller
{
    //
    public function destroy($id)
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $data = array(
            "id" => $id,
        );
        try {
            $client = new Client();
            $response = $client->post($base_url . 'DeleteTanggalPresensi?token=' . $token, [
                'json' => $data,
            ]);
            $body = $response->getBody()->getContents();
        } catch (ClientException $e) {
            return [];
        }

        return redirect()->route('presensi')->with('alert-success', 'Berhasil Menghapus data!');
    }
    public function edit($id,$tanggal_mulai,$tanggal_selesai,$is_aktif){
        return view('presensi.form-update',compact('id','tanggal_mulai','tanggal_selesai','is_aktif'));
    }
    public function store(Request $request)
    {

        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $data = array(
            "thn_ajaran" => $request->thn_ajaran,
            "semester" => (int) $request->semester,
            "jenis" => $request->jenis,
            "tanggal_mulai" => $request->tgl_awal,
            "tanggal_selesai" => $request->tgl_selesai,
            "is_aktif" => (int) $request->is_aktif,
        );
        try {
            $client = new Client();
            $response = $client->post($base_url . 'SaveTanggalPresensi?token=' . $token, [
                'json' => $data,
            ]);
            $body = $response->getBody()->getContents();
        } catch (ClientException $e) {
            echo $e;
            return redirect()->route('presensi')->with('alert-danger', 'Gagal Menambah Data!');

        }

        return redirect()->route('presensi')->with('alert-success', 'Berhasil Menambah Data!');
    }
    public function update(Request $request)
    {

        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $data = array(
            "id" => $request->id,
            "tanggal_mulai" => $request->tgl_awal,
            "tanggal_selesai" => $request->tgl_selesai,
            "is_aktif" => (int) $request->is_aktif,
        );
        try {
            $client = new Client();
            $response = $client->post($base_url . 'UpdateTanggalPresensi?token=' . $token, [
                'json' => $data,
            ]);
            $body = $response->getBody()->getContents();
        } catch (ClientException $e) {
            echo $e;
            return redirect()->route('presensi')->with('alert-danger', 'Gagal Menambah Data!');

        }

        return redirect()->route('presensi')->with('alert-success', 'Berhasil Merubah Data!');
    }
    public function index()
    {
        $jurusan = app()->call('App\Http\Controllers\jurusanController@get_jurusan');
        $tanggal = $this->get_tanggal_presensi();
        return view('presensi.index', compact('jurusan', 'tanggal'));
    }
    public function update($id, $tgl_mulai, $tgl_selesai, $is_aktif)
    {
        return view('presensi.update', compact('id', 'tgl_mulai', 'tgl_selesai', 'is_aktif'));
    }
    public function create()
    {
        return view('presensi.form-insert');
    }
    public function get_tanggal_presensi()
    {
        $x = Dashboard::limit(1)->first();
        $tha = $x->tha;
        $semester = $x->semester;
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $data = Dashboard::limit(1)->first();
        $tha = $data->tha;
        $semester = $data->semester;
        try {
            $client = new Client();
            $response = $client->request('GET', $base_url . 'GetListTanggalPresensi', [
                'query' => [
                    'token' => $token,
                    'tha' => $tha,
                    'semester' => $semester,
                ],
                'http_errors' => false,
            ]);
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 400) {
                return [];
            } else {
                $body = $response->getBody()->getContents();
                $datas = json_decode($body, true);
                return $datas;
            }
        } catch (ClientException $e) {
            return redirect()->route('presensi')->with('alert-danger-presensi', 'Gagal Mendapatkan Data, Data yang di grab tidak ada !');
        }
    }
    public function downloadExcel($kode_jurusan, $jenis)
    {
        //$data = Item::get()->toArray();
        try {
            $data = $this->get_presensi($kode_jurusan, $jenis);
            unset($data['kode_jurusan']);
            return Excel::create($kode_jurusan, function ($excel) use ($data) {
                $excel->sheet('mysheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xls');
        } catch (ClientException $e) {
            return redirect()->route('presensi')->with('alert-danger-presensi', 'Gagal Mendapatkan Data, Data yang di grab tidak ada !');
        }

    }

    public function get_presensi($kode_jurusan, $jenis)
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $data = Dashboard::limit(1)->first();
        $tha = $data->tha;
        $semester = $data->semester;
        $kode_jurusan = $kode_jurusan;
        $_jenis = $jenis;
        $client = new Client();
        $response = $client->request('GET', $base_url . 'GetListPresensiAsistenByJurusan', [
            'query' => [
                'token' => $token,
                'tha' => $tha,
                'semester' => $semester,
                'kode_jurusan' => $kode_jurusan,
                'jenis' => $_jenis,
            ],
        ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        $datas = json_decode($body, true);
        return $datas;
    }
}
