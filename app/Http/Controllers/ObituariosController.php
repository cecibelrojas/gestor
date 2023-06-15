<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Obituarios;
use Exception;
use Illuminate\Http\Request;

class ObituariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objObituarios = new Obituarios();
        $lista = $objObituarios->listar();

        return view('obituarios.index', compact('lista'));
    }

    public function obituario(Request $request)
    {
         $objObituarios = new Obituarios();
        $data = $objObituarios->obtener(array(
            'id' => $request['id']
        ));
        return view('obituarios.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
           $objObituarios = new Obituarios();

            $params = array(
                'titulo' => $request['titulo'],
                'fecha' => $request['fecha'],
                'estado' => $request['estado']
            );

            if ($request->hasFile('foto_aviso')) {
                $adjunto = $request->file('foto_aviso');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotobituario_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/obituario'), $fileName);
                $params['foto_aviso'] = "/archivos/obituario/" . $fileName;
            }
            
            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objObituarios->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objObituarios->insertar($params);
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
            $objObituarios = new Obituarios();
            $insert = $objObituarios->eliminar(array(
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
