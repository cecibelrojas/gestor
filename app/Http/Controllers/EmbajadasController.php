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


    
    public function select_embajada(Request $request)
    {

        $objEmbajadas = new Embajadas();
        $data = $objEmbajadas->obtener(array(
            'id' => $request['id']
        ));
        return view('embajadas.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
             $objEmbajadas = new Embajadas();

            $params = array(
                'pais' => $request['pais'],
                'embajador' => $request['embajador'],
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
                $adjunto->move(base_path('archivos/embajadas'), $fileName);
                $params['imagen'] = "/archivos/embajadas/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objEmbajadas->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objEmbajadas->insertar($params);
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
            $objEmbajadas = new Embajadas();
            $insert = $objEmbajadas->eliminar(array(
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
