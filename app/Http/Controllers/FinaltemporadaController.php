<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Posiciones;
use App\Models\Posiciones_final;
use Exception;
use Illuminate\Http\Request;

class FinaltemporadaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objPosiciones_final = new Posiciones_final();
        $objTeam = new Team();

        $lista = $objPosiciones_final->listar(array(
            'estado' => 'C',
            'periodo' => date('Y')
        ));

        $lista1 = $objTeam->listar();

        return view('posicion_final.index', compact('lista','lista1'));
    }

    public function updatescore(Request $request)
    {
        $objPosiciones_final = new Posiciones_final();
        $objPosiciones_final->actualizar(array(
            $request->field => $request->valor
        ), array('id' => $request->id));
    }
}
