<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Empleado;
use App\Models\Empleos;
use Exception;
use Illuminate\Http\Request;

class TrabajosController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objempleados = new Empleado();
        $lista = $objempleados->listar();
       
        return view('empleados.trabajos', compact('lista'));
    }



}
