<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Etten;
use Exception;
use Illuminate\Http\Request;

class EttenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objEtten = new Etten();
        $lista = $objEtten->listar();

        return view('etten.index', compact('lista'));
    }

    public function etten(Request $request)
    {

        $objEtten = new Etten();
        $data = $objEtten->obtener(array(
            'id' => $request['id']
        ));
        return view('etten.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            $objEtten = new Etten();

            $params = array(
                'imagen_etten' => $request['imagen_etten']
            );

            if ($request->hasFile('imagen_etten')) {
                $adjunto = $request->file('imagen_etten');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotoetten_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/etten'), $fileName);
                $params['imagen_etten'] = "/archivos/etten/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objEtten->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objEtten->insertar($params);
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
            $objEtten = new Etten();
            $insert = $objEtten->eliminar(array(
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
