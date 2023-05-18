<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Categoria_galerias;
use Exception;
use Illuminate\Http\Request;

class Categoria_galeriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objCategoriaccs = new Categoria_galerias();
        $lista = $objCategoriaccs->listar();

        return view('galerias.index', compact('lista'));
    }

    public function categoria_ccs(Request $request)
    {

        $objCategoriaccs = new Categoria_galerias();
        $data = $objCategoriaccs->obtener(array(
            'id' => $request['id']
        ));
        return view('galerias.form', compact('data'));
    }

    public function store(Request $request)
    {

        $response = array();

        try {
            $objCategoriaccs = new Categoria_galerias();

            $params = array(                
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objCategoriaccs->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objCategoriaccs->insertar($params);
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
            $objCategoriaccs = new Categoria_galerias();
            $insert = $objCategoriaccs->eliminar(array(
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
