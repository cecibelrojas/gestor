<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\BancoDatosDet;
use Exception;
use Illuminate\Http\Request;

class BancoDatosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objBancoDatos = new BancoDatos();
        $bancodatos = $objBancoDatos->listar();
        return view('database.index', compact('bancodatos'));
    }

    public function cabecera(Request $request)
    {
        $objBancoDatos = new BancoDatos();
        $data = $objBancoDatos->obtener(array(
            'id' => str_pad($request->id, 3, '0', STR_PAD_LEFT)
        ));

        return view('database.form', compact('data'));
    }

    public function detalle(Request $request)
    {
        $objBancoDatosDet = new BancoDatosDet();
        $data = array();
        if (!empty($request->item)) {
            $data = $objBancoDatosDet->obtener(array(
                'id' => str_pad($request->id, 3, '0', STR_PAD_LEFT),
                'item' => $request->item
            ));
        }

        $id = $request->id;
        $accion = $request->accion;

        return view('database.form2', compact('data', 'id', 'accion'));
    }

    public function listardetalles(Request $request)
    {
        $objBancoDatosDet = new BancoDatosDet();

        $detalles = $objBancoDatosDet->listar(array(
            'id' => str_pad($request->id, 3, '0', STR_PAD_LEFT)
        ));

        return $detalles;
    }

    public function listarcabeceras(Request $request)
    {
        $objBancoDatos = new BancoDatos();

        $cabeceras = $objBancoDatos->listar();

        return $cabeceras;
    }


    public function store(Request $request)
    {

        $response = array();

        try {
            $objBancoDatos = new BancoDatos();

            $params = array(
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objBancoDatos->actualizar($params, array('id' => str_pad($request->id, 3, '0', STR_PAD_LEFT)));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objBancoDatos->insertar($params);
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
            $objBancoDatos = new BancoDatos();
            $insert = $objBancoDatos->eliminar(array(
                'id' => str_pad($request->id, 3, '0', STR_PAD_LEFT)
            ));
            if (!$insert) {
                throw new Exception($insert);
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }

    public function store2(Request $request)
    {

        $response = array();

        try {
            $objBancoDatos = new BancoDatosDet();

            $params = array(
                'nombre' => $request['nombre']
            );

            $consulta = $objBancoDatos->obtener(array(
                'id' => str_pad($request->id, 3, '0', STR_PAD_LEFT),
                'item' => $request['item']
            ));

            if (!$consulta) {
                $params['item'] = $request['item'];
            }

            if ($request->accion == 'U') {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objBancoDatos->actualizar($params, array('id' => str_pad($request->id, 3, '0', STR_PAD_LEFT), 'item' => $request['item']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['id'] = str_pad($request['id'], 3, '0', STR_PAD_LEFT);
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objBancoDatos->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }

    public function delete2(Request $request)
    {

        $response = array();

        try {
            $objBancoDatos = new BancoDatosDet();
            $insert = $objBancoDatos->eliminar(array(
                'id' => str_pad($request->id, 3, '0', STR_PAD_LEFT),
                'item' => $request['item']
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
