<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Servicios_consulares;
use App\Models\Uploads;
use Exception;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin')->except('');
    }
    public function index()
    {
        $objUploads = new Uploads();
        $lista = $objUploads->listar();
        return view('multimedia.home', compact('lista'));
    }
    public function uploads_img(Request $request)
    {
        $objUploads = new Uploads();

        $imagenes = array();
        $videos = array();
        $documentos = array();

        $data = $objUploads->obtener(array('id' => $request['id']));

        return view('multimedia.form', compact('data','imagenes', 'videos', 'documentos'));
    }

    public function obtenermultimediamedios(Request $request)
    {

        $objUploads = new Uploads();
        $data = $objUploads->listar(array('tipo' => $request->tipo));

        switch ($request->tipo) {
            case 'I':
                $partial = 'product._partial.imagenes';
                break;
            case 'V':
                $partial = 'product._partial.videos';
                break;
            case 'F':
                $partial = 'product._partial.documentos';
                break;
        }


        return view($partial, compact('data'));
    }
    public function upload_medios(Request $request)
    {
        $objUploads = new Uploads();

        $response = array(
            'status' => 'N'
        );

        $params = array(
            'titulo' => $request->titulo,
            'orden' => $request->orden,
            'tipo' => $request->tipo,
            'estado' => $request->estado,
            'exclusivo' => $request->exclusivo,
            'usureg' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        );

        switch ($request->tipo) {
            case 'I':
                $direction = 'imagenes';
                break;
            case 'V':
                $direction = 'videos';
                break;
            case 'F':
                $direction = 'documentos';
                break;
        }

        if ($direction != '') {
            if ($request->hasFile('adjunto')) {
                $adjunto = $request->file('adjunto');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "archivomedios" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/' . $direction . '/' . $request->id), $fileName);
                $adjuntoFileName = $fileName;
                $params['archivo'] = $adjuntoFileName;
                $params['extension'] = $extension;
                $params['originalname'] = $adjunto->getClientOriginalName();
            }
        }

        if (!isset($request->uid) || empty($request->uid)) {
            $id = $objUploads->insertar($params);
        } else {
            $id = $objUploads->actualizar($params, array('id' => $request->uid));
        }

        if ($id) {
            $response['id'] = $id;
            $response['status'] = 'S';
        }
        switch ($request->tipo) {
            case 'I':
                $response['data'] = $objUploads->listar(array('id' => $request->id, 'tipo' => 'I'));
                break;
            case 'V':
                $response['data'] = $objUploads->listar(array('id' => $request->id, 'tipo' => 'V'));
                break;
            case 'F':
                $response['data'] = $objUploads->listar(array('id' => $request->id, 'tipo' => 'F'));
                break;
        }

        return $response;
    }

}
