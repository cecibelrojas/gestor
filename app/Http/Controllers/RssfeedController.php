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
    public function rss()
    {
        $objCategoria = new Categoria();
        
        $params = array();

        $cat = $objCategoria->listar($params);

        return view('rss.home', [ 'cat' => $cat]);
    }

    public function index()
    {
        $objProducto = new Producto();

        $params = array();

        $lista = $objProducto->listar($params);

        return Response()->view('rss.index', [ 'lista' => $lista])->header('Content-Type','text/xml');
    }
    
    public function listado_rss($id)
    {
        $objProducto = new Producto();
        $objCategoria = new Categoria();

        $categoria = $objCategoria->obtener(array(
            'id' => $id
        ));
        $destacadas = $objProducto->listar(array(
            'estdestacado' => 'S',
            'limite' => 5
        ));
        $lista = $objProducto->listar(array(
            'categoria' => $id,
            'simplePaginate' => 15,
           // 'multiestado' => array('A','P')
            'multiestado' => array('A')
        ));
        return Response()->view('rss.listado', [ 'lista' => $lista,'categoria' => $categoria,'destacadas' => $destacadas])->header('Content-Type','text/xml');
        return view('rss.listado', compact('lista', 'categoria','destacadas'));
    }

}
