<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $objCategoria = new Categoria();
        $lista = $objCategoria->listar();

        return view('categorias.index', compact('lista'));
    }


    public function categoria(Request $request)
    {

        $objCategoria = new Categoria();
        $data = $objCategoria->obtener(array(
            'id' => $request['id']
        ));
        return view('categorias.form', compact('data'));
    }

    public function store(Request $request)
    {

        $response = array();

        try {
            $objCategoria = new Categoria();

            $params = array(                
                'nombre' => $request['nombre'],
                'nombre_ingles' => $request['nombre_ingles'],
                'descripcion' => $request['descripcion'],
                'descripcion_ingles' => $request['descripcion_ingles']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objCategoria->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objCategoria->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }

    public function delete(Request $request)
    {

        $response = array();

        try {
            $objCategoria = new Categoria();
            $insert = $objCategoria->eliminar(array(
                'id' => $request['id']
            ));
            if (!$insert) {
                throw new Exception($insert);
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
}
