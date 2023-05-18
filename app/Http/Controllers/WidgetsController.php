<?php

namespace App\Http\Controllers;

use App\Models\BancoDatosDet;
use App\Models\Producto;
use App\Models\Widgets;
use App\Models\WidgetsDet;
use Exception;
use Illuminate\Http\Request;

class WidgetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objWidgets = new Widgets();
        $widgets = $objWidgets->listar();
        return view('widgets.index', compact('widgets'));
    }

    public function cabecera(Request $request)
    {
        $objWidgets = new Widgets();
        $objBancoDatosDet = new BancoDatosDet();
        $data = $objWidgets->obtener(array(
            'id' => $request->id
        ));

        $tipos = $objBancoDatosDet->listar(array('id' => '001'));

        return view('widgets.form', compact('data', 'tipos'));
    }

    public function detalle(Request $request)
    {
        $objWidgetsDet = new WidgetsDet();
        $objWidgets = new Widgets();
        $objProducto = new Producto();

        $widget = $objWidgets->obtener(array(
            'id' => $request->id
        ));

        $data = $objProducto->listar();

        $id = $request->id;
        $accion = $request->accion;

        return view('widgets.form2', compact('data', 'id', 'accion', 'widget'));
    }

    public function listardetalles(Request $request)
    {
        $objWidgetsDet = new WidgetsDet();

        $detalles = $objWidgetsDet->listar(array(
            'id' => $request->id
        ));

        return $detalles;
    }

    public function listarcabeceras(Request $request)
    {
        $objWidgets = new Widgets();

        $cabeceras = $objWidgets->listar();

        return $cabeceras;
    }


    public function store(Request $request)
    {

        $response = array();

        try {
            $objWidgets = new Widgets();

            $params = array(
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion'],
                'tipo' => $request['tipo'],
                'orden' => $request['orden']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objWidgets->actualizar($params, array('id' => $request->id));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objWidgets->insertar($params);
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
            $objWidgets = new Widgets();
            $insert = $objWidgets->eliminar(array(
                'id' => $request->id
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
            $objWidgets = new WidgetsDet();

            $params = array(
                'nombre' => $request['nombre']
            );

            $consulta = $objWidgets->obtener(array(
                'id' => $request->id,
                'item' => $request['item']
            ));

            if (!$consulta) {
                $params['item'] = $request['item'];
            }

            if ($request->accion == 'U') {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objWidgets->actualizar($params, array('id' => $request->id, 'item' => $request['item']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['id'] = str_pad($request['id'], 3, '0', STR_PAD_LEFT);
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objWidgets->insertar($params);
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
            $objWidgets = new WidgetsDet();
            $insert = $objWidgets->eliminar(array(
                'id' => $request->id,
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
