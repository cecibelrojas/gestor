<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Producto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $objUsers = new User();
        $objProducto = new Producto();
        $listredactores = $objUsers->listar_redactores();
        $lista = $objUsers->listar_inactivos();
        $listadmin = $objUsers->listar_admin();
        $listprensa = $objUsers->listar_jprensa();
        $listcorrectores = $objUsers->listar_correctores();
        
        $trabajador = $objProducto->listar_trabajador(array(
            'rol' => 'C',
            'create_at' => date('d')
        )
        );

        $todos = $objProducto->listarpub();
        $mes = $objProducto->listarpubsemana();
        $week = "";
        $grafo = "";
        foreach ($todos as $tdo) {
            $grafo.="['".$tdo->year."', ".$tdo->data."],"; 
                    }            
                 
        $resultado = $grafo;
        foreach ($mes as $ms) {
            $week.="['".$ms->month."', ".$ms->data."],"; 
                    }
        $resultado1 = $week;            
        //dd($resultado1);          
        $users = User::select("*")
                        ->whereNotNull('last_seen')
                        ->orderBy('last_seen', 'DESC')
                        ->simplePaginate(5);

         return view('dashboard.index', compact('lista','listadmin','listprensa','users','listredactores','listcorrectores','trabajador','resultado','resultado1'));
    }

}
