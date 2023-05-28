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
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objCampanasvideos = new Campanasvideos();
        $lista = $objCampanasvideos->listar();

        return view('campanas_videos.index', compact('lista'));
    }

    public function campanas_videos(Request $request)
    {

        $objCampanasvideos = new Campanasvideos();
        $data = $objCampanasvideos->obtener(array(
            'id' => $request['id']
        ));
        return view('campanas_videos.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            $objCampanasvideos = new Campanasvideos();

            $params = array(
                'titulo' => $request['titulo'],
                'url_video' => $request['url_video']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objCampanasvideos->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objCampanasvideos->insertar($params);
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
            $objCampanasvideos = new Campanasvideos();
            $insert = $objCampanasvideos->eliminar(array(
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
