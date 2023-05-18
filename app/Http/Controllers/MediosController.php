<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Medios;
use Exception;
use Illuminate\Http\Request;

class MediosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objMedios = new Medios();
        $lista = $objMedios->listar();

        return view('medios.index', compact('lista'));
    }

    public function etiqueta(Request $request)
    {

        $objMedios = new Medios();
        $data = $objMedios->obtener(array(
            'id' => $request['id']
        ));
        return view('medios.form', compact('data'));
    }


    public function listar(Request $request)
    {
        $objMedios = new Medios();
        $listado = $objMedios->listar();        
        $medios = array();
        if (count($listado) > 0) {
            foreach ($listado as $key) {
                array_push($medios, $key['codigo']);
            }
        }
        return $medios;
    }

    public function store(Request $request)
    {

        $response = array();

        try {
            $objMedios = new Medios();

            $params = array(
                'codigo' => $request['codigo'],
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objMedios->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objMedios->insertar($params);
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
            $objMedios = new Medios();
            $insert = $objMedios->eliminar(array(
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
