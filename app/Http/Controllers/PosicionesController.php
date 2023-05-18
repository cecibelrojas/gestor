<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Posiciones;
use Exception;
use Illuminate\Http\Request;

class PosicionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objPosiciones = new Posiciones();
        $objTeam = new Team();

        $lista = $objPosiciones->listar(array(
            'periodo' => date('Y')
        ));

        $lista1 = $objTeam->listar();

        return view('posiciones.index', compact('lista','lista1'));
    }

    public function updatescore(Request $request)
    {
        $objPosiciones = new Posiciones();
        $objPosiciones->actualizar(array(
            $request->field => $request->valor
        ), array('id' => $request->id));
    }
}
