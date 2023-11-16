<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Servicios_consulares;
use App\Models\Uploads;
use Exception;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin')->except('');
    }

    public function index()
    {
        $objUploads = new Uploads();
        $lista = $objUploads->listar();
        return view('multimedia.home', compact('lista'));
    }
    public function uploads_img(Request $request)
    {
        $objUploads = new Uploads();
        $data = $objUploads->obtener(array(
            'id' => $request['id']
        ));
        return view('multimedia.form', compact('data'));
    }


}
