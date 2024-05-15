<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Uploads;
use Exception;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $objUploads = new Uploads();
        $lista = $objUploads->listar();

        $imagenes = array();
        $videos = array();
        $documentos = array();

        return view('multimedia.home', compact('lista', 'imagenes', 'videos', 'documentos'));
    }
    public function uploads_img(Request $request)
    {
        $objUploads = new Uploads();


        $data = $objUploads->obtener(array(
            'id' => $request['id']
        ));

        $imagenes = $objUploads->listar(array('tipo' => 'I', 'id' => $request['id']));
        $videos = $objUploads->listar(array('tipo' => 'V', 'id' => $request['id']));
        $documentos = $objUploads->listar(array('tipo' => 'F', 'id' => $request['id']));

        return view('multimedia.form', compact('data', 'imagenes', 'videos', 'documentos'));
    }
    public function nuevo_img(Request $request)
    {
        $objUploads = new Uploads();
        $imagenes = array();
        $videos = array();
        $documentos = array();
        $data = $objUploads->obtener(array('id' => $request['id']));

        return view('multimedia.form1', compact('data', 'imagenes', 'videos', 'documentos'));
    }
    public function obtenermultimediamedios(Request $request)
    {

        $objUploads = new Uploads();
        $data = $objUploads->listar(array('tipo' => $request->tipo));

        switch ($request->tipo) {
            case 'I':
                $partial = 'multimedia._partial.imagenes';
                break;
            case 'V':
                $partial = 'multimedia._partial.videos';
                break;
            case 'F':
                $partial = 'multimedia._partial.documentos';
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
                $direction = 'imagenes_medios';
                break;
            case 'V':
                $direction = 'videos_medios';
                break;
            case 'F':
                $direction = 'documentos_medios';
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
    public function cargararchivomasivosmedios(Request $request)
    {

        $response = array(
            'status' => 'S'
        );

        $direction = 'imagenes_medios';

        if ($direction != '') {
            if ($request->imagenes) {
                $adjunto = $request->file('imagenes');
                foreach ($adjunto as $index => $file) {

                    $objUploads = new Uploads();
                    $objUploads->tipo = 'I';
                    $objUploads->estado = 'A';
                    $objUploads->exclusivo = 'N';
                    $objUploads->usureg = auth()->user()->id;
                    $objUploads->created_at = date('Y-m-d H:i:s');

                    $extension = $file->getClientOriginalExtension();
                    $fileName = "archivomedios" . $index . "_" . date('ymdhis') . "." . $extension;
                    $file->move(base_path('archivos/' . $direction . '/' . $request->id), $fileName);
                    $adjuntoFileName = $fileName;
                    $objUploads->titulo = "Imagen " . ($index + 1);
                    $objUploads->archivo = $adjuntoFileName;
                    $objUploads->extension = $extension;
                    $objUploads->originalname = $file->getClientOriginalName();

                    $objUploads->save();
                }
            }
        }

        return $response;
    }


    public function updatefilemedios(Request $request)
    {
        $objUploads = new Uploads();

        $params = array();

        if (isset($request->exclusivo)) {
            $params['exclusivo'] = $request->exclusivo;
        }

        if ($request->hasFile('adjunto')) {
            $adjunto = $request->file('adjunto');
            $extension = $adjunto->getClientOriginalExtension();
            $fileName = "archivomedios" . date('ymdhis') . "." . $extension;
            $adjunto->move(base_path('archivos/videosmedios/'), $fileName);
            $adjuntoFileName = $fileName;
            $params['preview'] = $adjuntoFileName;
            $params['extension'] = $extension;
        }

        $update = $objUploads->actualizar($params, array('id' => $request->id));

        return $update;
    }
    public function deletefilemedios(Request $request)
    {
        $objUploads = new Uploads();
        $response = array(
            'status' => 'N',
        );

        $delete = $objUploads->eliminar(array('id' => $request->id));

        if ($delete) {
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
    public function obtenervideomedios(Request $request)
    {
        $objUploads = new Uploads();

        $video = $objUploads->obtener(array('id' => $request->id));

        return view('multimedia.video', compact('video'));
    }
}
