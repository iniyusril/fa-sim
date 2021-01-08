<?php
namespace App\Http\Controllers;

use App\Dashboard;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use App\Http\Controllers\Http;
class inputDataController extends Controller
{
    public $client;
    
    function __construct() {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $http = new Http($token);
        $this->client = $http->client;
    }    //
    public function index()
    {
        return view('input-asisten.index');
    }
    public function input_single(Request $request){
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
            $response = $this->client->post('SaveAsisten', [
                'json' => $data
            ]);
            $body = $response->getBody()->getContents();
            return redirect()->route('input')->with('alert-success', 'Berhasil Menambah Data!');
        }
        catch(ClientException $e){
            return redirect()->route('input')->with('alert-success', 'Gagal Menambah Data!');
        }
    }
    public function csvfileupload(Request $request)
    {
        $token = app()->call('App\Http\Controllers\tokenController@index');
        $file = $request->file('file');
        $data = Dashboard::limit(1)->first();
        $tha = $data->tha;
        $semester = $data->semester;
        if (($handle = fopen($file, 'r')) === false) {
            die('Error opening file');
        }
		//dd($data);
        
        $headers = fgetcsv($handle, 1024, ',');
        array_push($headers,'thn_ajaran','semester');
        $complete = array();
        
        while ($row = fgetcsv($handle, 1024, ',')) {
            array_push($row,$tha,$semester);
            $complete[] = array_combine($headers, $row);      
        }
        
        fclose($handle);
        try{
            $response = $this->client->post('SaveAsistens', [
                'json' => $complete
            ]);
            $body = $response->getBody()->getContents();
            // return redirect()->route('input')->with('alert-success', 'Berhasil Menambah Data!');
        }
        catch(ClientException $e){
            $response = $this->client->post('DeleteAsistens', [
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