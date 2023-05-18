<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Waika;
use Exception;
use Illuminate\Http\Request;

class WaikaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objWaika = new Waika();
        $lista = $objWaika->listar();

        return view('waika.index', compact('lista'));
    }

    public function waika(Request $request)
    {

        $objWaika = new Waika();
        $data = $objWaika->obtener(array(
            'id' => $request['id']
        ));
        return view('waika.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            $objWaika = new Waika();

            $params = array(
                'imagen_waika' => $request['imagen_waika']
            );

            if ($request->hasFile('imagen_waika')) {
                $adjunto = $request->file('imagen_waika');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotowaika_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/waika'), $fileName);
                $params['imagen_waika'] = "/archivos/waika/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objWaika->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objWaika->insertar($params);
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
            $objWaika = new Waika();
            $insert = $objWaika->eliminar(array(
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
