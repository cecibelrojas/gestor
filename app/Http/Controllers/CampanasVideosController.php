<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Campanasvideos;
use Exception;
use Illuminate\Http\Request;

class CampanasVideosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objCampanas = new Campanasvideos();
        $lista = $objCampanas->listar();

        return view('camp_videos.index', compact('lista'));
    }

    public function campanasvideos(Request $request)
    {

        $objCampanas = new Campanasvideos();
        $data = $objCampanas->obtener(array(
            'id' => $request['id']
        ));
        return view('camp_videos.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            $objCampanas = new Campanasvideos();

            $params = array(
                'titulo' => $request['titulo'],
                'url_video' => $request['url_video'],
                'estado' => $request['estado']
            );

            if ($request->hasFile('img_video')) {
                $adjunto = $request->file('img_video');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotocampanavideo_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/campanavideo'), $fileName);
                $params['img_video'] = "/archivos/campanavideo/" . $fileName;
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
            $objCampanas = new Campanasvideos();
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
