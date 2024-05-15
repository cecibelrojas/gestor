<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Banner_campana;
use Exception;
use Illuminate\Http\Request;

class BannercampanaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objBannercampanas = new Banner_campana();
        $lista = $objBannercampanas->listar();

        return view('banner_campana.index', compact('lista'));
    }

    public function bannercampanas(Request $request)
    {

        $objBannercampanas = new Banner_campana();
        $data = $objBannercampanas->obtener(array(
            'id' => $request['id']
        ));
        return view('banner_campana.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            $objBannercampanas = new Banner_campana();

            $params = array(
                'url' => $request['url'],
                'estado' => $request['estado']
            );

            if ($request->hasFile('imagen_banner')) {
                $adjunto = $request->file('imagen_banner');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "bannercampana_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/bannercampana'), $fileName);
                $params['imagen_banner'] = "/archivos/bannercampana/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objBannercampanas->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objBannercampanas->insertar($params);
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
            $objBannercampanas = new Banner_campana();
            $insert = $objBannercampanas->eliminar(array(
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
