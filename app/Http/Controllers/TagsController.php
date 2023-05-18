<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Tags;
use Exception;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objTags = new Tags();
        $lista = $objTags->listar();

        return view('tags.index', compact('lista'));
    }

    public function etiqueta(Request $request)
    {

        $objTags = new Tags();
        $data = $objTags->obtener(array(
            'id' => $request['id']
        ));
        return view('tags.form', compact('data'));
    }


    public function listar(Request $request)
    {
        $objTags = new Tags();
        $listado = $objTags->listar();        
        $tags = array();
        if (count($listado) > 0) {
            foreach ($listado as $key) {
                array_push($tags, $key['codigo']);
            }
        }
        return $tags;
    }

    public function store(Request $request)
    {

        $response = array();

        try {
            $objTags = new Tags();

            $params = array(
                'codigo' => $request['codigo'],
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objTags->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objTags->insertar($params);
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
            $objTags = new Tags();
            $insert = $objTags->eliminar(array(
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
