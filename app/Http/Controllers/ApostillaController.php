<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Servicios_consulares;
use Exception;
use Illuminate\Http\Request;

class ApostillaController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objServicios = new Servicios_consulares();
        $lista = $objServicios->listar();

        return view('apostilla.pago', compact('lista'));
    }
}
