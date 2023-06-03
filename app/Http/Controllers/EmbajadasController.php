<?php

namespace App\Http\Controllers;

use App\Models\FastEvent;
use Exception;
use App\Models\Embajadas;
use Illuminate\Http\Request;

class EmbajadasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      
        $objEmbajadas = new Embajadas();
        $lista = $objEmbajadas->listar();

        return view('embajadas.index', compact('lista'));
    }

}
