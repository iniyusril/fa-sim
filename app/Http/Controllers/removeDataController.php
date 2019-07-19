<?php
namespace App\Http\Controllers;

use App\Dashboard;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;

class removeDataController extends Controller
{
    //
    public function index()
    {
        return view('remove-asisten.index');
    }
    public function remove_single(Request $request){
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');
        $data = Dashboard::limit(1)->first();
        $tha = $data->tha;
        $semester = $data->semester;
        $data = array(
            "thn_ajaran"=>$tha,
            "semester"=>$semester,
            "npm"=>$request->npm,
            "kode_mkl"=>$request->kode_matakuliah
        );
        try{
            $client = new Client();
            $response = $client->post($base_url.'DeleteAsisten?token='.$token, [
                'json' => $data
            ]);
            $body = $response->getBody()->getContents();
            return redirect()->route('remove')->with('alert-success', 'Berhasil Menghapus Data!');
        }
        catch(ClientException $e){
            return redirect()->route('remove')->with('alert-success', 'Gagal Menghapus Data!');
        }
    }
    public function csvfileupload(Request $request)
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $base_url = env('BASE_URL');    
        $file = $request->file('file');
        $data = Dashboard::limit(1)->first();
        $tha = $data->tha;
        $semester = $data->semester;
        if (($handle = fopen($file, 'r')) === false) {
            die('Error opening file');
        }
        
        $headers = fgetcsv($handle, 1024, ',');
        array_push($headers,'thn_ajaran','semester');
        $complete = array();
        
        while ($row = fgetcsv($handle, 1024, ',')) {
            array_push($row,$tha,$semester);
            $complete[] = array_combine($headers, $row);      
        }
        
        fclose($handle);
        try{
            $client = new Client();
            $response = $client->post($base_url.'DeleteAsistens?token='.$token, [
                'json' => $complete
            ]);
            $body = $response->getBody()->getContents();
            return redirect()->route('remove')->with('alert-success', 'Berhasil Menghapus Data!');
        }
        catch(ClientException $e){
            return redirect()->route('remove')->with('alert-success', 'Gagal Menghapus Data!');
        }
    }
}