<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Redes;
use Exception;
use Illuminate\Http\Request;

class RedesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objRedes = new Redes();
        $lista = $objRedes->listar();

        return view('redes.index', compact('lista'));
    }

    public function redes_sociales(Request $request)
    {

        $objRedes = new Redes();
        $data = $objRedes->obtener(array(
            'id' => $request['id']
        ));
        return view('redes.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
             $objRedes = new Redes();

            $params = array(
                'nombre' => $request['nombre'],
                'url' => $request['url'],
                'icono' => $request['icono'],
                'estado' => $request['estado']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objRedes->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objRedes->insertar($params);
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
            $objRedes = new Redes();
            $insert = $objRedes->eliminar(array(
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
