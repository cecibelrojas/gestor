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
            'rol' => 'A',
            'create_at' => date('d')
        )
        );


        $users = User::select("*")
                        ->whereNotNull('last_seen')
                        ->orderBy('last_seen', 'DESC')
                        ->paginate(5);

         return view('dashboard.index', compact('lista','listadmin','listprensa','users','listredactores','listcorrectores','trabajador'));
    }

}
