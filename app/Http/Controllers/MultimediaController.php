<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Servicios_consulares;
use App\Models\Producto;
use App\Models\ProductoMultimedia;
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
        $objProducto = new Producto();
        $lista = $objProducto->listar();
        return view('multimedia.home', compact('lista'));
    }
}
