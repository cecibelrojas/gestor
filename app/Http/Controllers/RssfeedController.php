<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Producto;
use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RssfeedController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objProducto = new Producto();

        $params = array();

        $lista = $objProducto->listar($params);

        return Response()->view('rss.index', [ 'lista' => $lista])->header('Content-Type','text/xml');
    }
}
