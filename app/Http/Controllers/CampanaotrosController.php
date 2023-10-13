<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Campana_otros;
use Exception;
use Illuminate\Http\Request;

class CampanaotrosController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objCampanas = new Campana_otros();
        $lista = $objCampanas->listar();

        return view('camp_otros.index', compact('lista'));
    }

    public function campanaspm4(Request $request)
    {

        $objCampanas = new Campana_otros();
        $data = $objCampanas->obtener(array(
            'id' => $request['id']
        ));
        return view('camp_otros.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            $objCampanas = new Campana_otros();

            $params = array(
                'titulo' => $request['titulo'],
                'estado' => $request['estado']
            );

            if ($request->hasFile('img_video')) {
                $adjunto = $request->file('img_video');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotocampanavideo_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/campanavideo'), $fileName);
                $params['img_video'] = "/archivos/campanavideo/" . $fileName;
            }

            if ($request->hasFile('video')) {
                $adjunto1 = $request->file('video');
                $extension1 = $adjunto1->getClientOriginalExtension();
                $fileName1 = "fotocampanavideotros_" . date('ymdhis') . "." . $extension1;
                $adjunto1->move(base_path('archivos/campana_otros'), $fileName1);
                $params['video'] = "/archivos/campana_otros/" . $fileName1;
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
            $objCampanas = new Campana_otros();
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
