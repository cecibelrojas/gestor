<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Videos;
use Exception;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objVideos = new Videos();
        $lista = $objVideos->listar();

        return view('videos.index', compact('lista'));
    }
    public function video(Request $request)
    {
        $objVideos = new Videos();
        $data = $objVideos->obtener(array(
            'id' => $request['id']
        ));
        return view('videos.form', compact('data'));
    }
        public function store(Request $request)
    {

        $response = array();

        try {
            $objVideos = new Videos();

            $params = array(
                'titulo' => $request['titulo'],
                'link' => $request['link']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objVideos->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objVideos->insertar($params);
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
            $objVideos = new Videos();
            $insert = $objVideos->eliminar(array(
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
