<?php
namespace App\Http\Controllers;

use App\Dashboard;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use App\Http\Controllers\Http;

class removeDataController extends Controller
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
        return view('remove-asisten.index');
    }
    public function remove_single(Request $request){
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
            $response = $this->client->post('DeleteAsisten', [
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
        // try{
        //     $client = new Client();
        //     $response = $client->post($base_url.'DeleteAsistens?token='.$token, [
        //         'json' => $complete
        //     ]);
        //     $body = $response->getBody()->getContents();
        //     return redirect()->route('remove')->with('alert-success', 'Berhasil Menghapus Data!');
        // }
        // catch(ClientException $e){
        //     return redirect()->route('remove')->with('alert-success', 'Gagal Menghapus Data!');
        // }
        try{
            $response = $this->client->post('DeleteAsistens', [
                'json' => $complete
            ]);
            $body = $response->getBody()->getContents();
            // return redirect()->route('input')->with('alert-success', 'Berhasil Menambah Data!');
        }
        catch(ClientException $e){
            $response = $this->client->post('SaveAsistens', [
                'json' => $complete
            ]);
            $body = $response->getBody()->getContents();
            //return redirect()->route('input')->with('alert-success', 'Gagal Menambah Data!');
        }
        finally{
            $data = json_decode($body,true);
            return redirect()->route('input')->with('alert-success', $data['Message']);
        }
    }
}