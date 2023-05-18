<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Avisos;
use Exception;
use Illuminate\Http\Request;

class AvisosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objAvisos = new Avisos();
        $lista = $objAvisos->listar();

        return view('comercializacion.index', compact('lista'));
    }

    public function aviso(Request $request)
    {

        $objAvisos = new Avisos();
        $data = $objAvisos->obtener(array(
            'id' => $request['id']
        ));
        return view('comercializacion.form', compact('data'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            $objAvisos = new Avisos();

            $params = array(
                'titulo' => $request['titulo'],
                'solicitante' => $request['solicitante'],
                'departamento' => $request['departamento'],
                'tipo' => $request['tipo'],
                'fecha' => $request['fecha'],
                'estado' => $request['estado']
            );

            if ($request->hasFile('foto_aviso')) {
                $adjunto = $request->file('foto_aviso');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotoaviso_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/avisos'), $fileName);
                $params['foto_aviso'] = "/archivos/avisos/" . $fileName;
            }
            if ($request->hasFile('url')) {
                $adjunto2 = $request->file('url');
                $extension2 = $adjunto2->getClientOriginalExtension();
                $fileName2 = "avisos_" . date('ymdhis') . "." . $extension2;
                $adjunto2->move(base_path('archivos/pdfavisos'), $fileName2);
                $params['url'] = "/archivos/pdfavisos/" . $fileName2;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objAvisos->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objAvisos->insertar($params);
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
            $objAvisos = new Avisos();
            $insert = $objAvisos->eliminar(array(
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
