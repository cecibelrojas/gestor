<?php

namespace App\Http\Controllers;

use App\Models\FastEvent;
use Exception;
use App\Models\Consulados;
use Illuminate\Http\Request;

class ConsuladosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      
        $objConsulados = new Consulados();
        $lista = $objConsulados->listar();

        return view('consulados.index', compact('lista'));
    }


    
    public function select_consulado(Request $request)
    {

        $objConsulados = new Consulados();
        $data = $objConsulados->obtener(array(
            'id' => $request['id']
        ));
        return view('consulados.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
             $objConsulados = new Consulados();

            $params = array(
                'pais' => $request['pais'],
                'consul' => $request['consul'],
                'concurren' => $request['concurren'],
                'direccion' => $request['direccion'],
                'telefono' => $request['telefono'],
                'web' => $request['web'],
                'correo' => $request['correo'],
                'twitter' => $request['twitter'],
                'instagram' => $request['instagram'],
                'facebook' => $request['facebook'],
                'lat' => $request['lat'],
                'lng' => $request['lng'],
                'estado' => $request['estado']
            );

            if ($request->hasFile('imagen')) {
                $adjunto = $request->file('imagen');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "bandera_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/consulados'), $fileName);
                $params['imagen'] = "/archivos/consulados /" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objConsulados->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objConsulados->insertar($params);
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
            $objConsulados = new Consulados();
            $insert = $objConsulados->eliminar(array(
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
