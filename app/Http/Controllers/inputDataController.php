<?php
namespace App\Http\Controllers;

use App\Dashboard;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;

class inputDataController extends Controller
{
    //
    public function index()
    {
        return view('input-asisten.index');
    }
}