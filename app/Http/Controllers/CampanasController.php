<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Campanas;
use Exception;
use Illuminate\Http\Request;

class CampanasController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objCampanas = new Campanas();
        $lista = $objCampanas->listar();

        return view('campanas.index', compact('lista'));
    }

    public function campanas(Request $request)
    {

        $objCampanas = new Campanas();
        $data = $objCampanas->obtener(array(
            'id' => $request['id']
        ));
        return view('campanas.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            $objCampanas = new Campanas();

            $params = array(
                'titulo' => $request['titulo'],
                'imagen_campana' => $request['imagen_campana']
            );

            if ($request->hasFile('imagen_campana')) {
                $adjunto = $request->file('imagen_campana');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotocampana_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/campana'), $fileName);
                $params['imagen_campana'] = "/archivos/campana/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objCampanas->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objCampanas->insertar($params);
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
            $objCampanas = new Campanas();
            $insert = $objCampanas->eliminar(array(
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
