<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Posiciones;
use App\Models\Posiciones_rr;
use Exception;
use Illuminate\Http\Request;

class Round_robinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objPosiciones_rr = new Posiciones_rr();
        $objTeam = new Team();

        $lista = $objPosiciones_rr->listar(array(
            'estado' => 'C',
            'periodo' => date('Y')
        ));

        $lista1 = $objTeam->listar();

        return view('roundrobin.index', compact('lista','lista1'));
    }

    public function updatescore(Request $request)
    {
        $objPosiciones_rr = new Posiciones_rr();
        $objPosiciones_rr->actualizar(array(
            $request->field => $request->valor
        ), array('id' => $request->id));
    }
}
