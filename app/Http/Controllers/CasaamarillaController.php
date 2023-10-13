<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Casa_amarilla;
use Exception;
use Illuminate\Http\Request;

class CasaamarillaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin')->except('');
    }

    public function index()
    {
        $objCasaamarilla = new Casa_amarilla();
        $lista = $objCasaamarilla->listar();

        return view('casaamarilla.home', compact('lista'));
    }
    public function banner_casamarilla(Request $request)
    {
        $objCasaamarilla = new Casa_amarilla();
        $data = $objCasaamarilla->obtener(array(
            'id' => $request['id']
        ));
        return view('casaamarilla.form', compact('data'));
    }
}
