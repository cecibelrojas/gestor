<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Impresos;
use Exception;
use Illuminate\Http\Request;

class LibreriaController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except(''); 
    }

    public function index()
    {
        $objImpresos = new Impresos();
        $lista = $objImpresos->listar();

        return view('libreria.index', compact('lista'));
    }

    public function lib_campanas()
    {
        $objCampanas = new Impresos();
        $listar_campanas = $objCampanas->listar_campanas();

        return view('libreria.campanas', compact('listar_campanas'));
    }

    public function lib_libros()
    {
        $objCampanas = new Impresos();
        $listar_libros = $objCampanas->listar_libros();

        return view('libreria.libros', compact('listar_libros'));
    }

    public function lib_biblioteca()
    {
        $objBiblioteca = new Impresos();
        $listar_biblioteca = $objBiblioteca->listar_biblioteca();

        return view('libreria.biblioteca', compact('listar_biblioteca'));
    }

    public function libros(Request $request)
    {

        $objImpresos = new Impresos();
        $data = $objImpresos->obtener(array(
            'id' => $request['id']
        ));
        return view('libreria.form', compact('data'));
    }

    public function libros_search(Request $request)
    {

        $objImpresoslibro = new Impresos();
        $data = $objImpresoslibro->obtener(array(
            'id' => $request['id']
        ));
        return view('libreria.form_libros', compact('data'));
    }
    public function campana_search(Request $request)
    {

        $objImpresoscampana = new Impresos();
        $data = $objImpresoscampana->obtener(array(
            'id' => $request['id']
        ));
        return view('libreria.form_campanas', compact('data'));
    }
    public function biblioteca_search(Request $request)
    {

        $objImpresosbiblioteca = new Impresos();
        $data = $objImpresosbiblioteca->obtener(array(
            'id' => $request['id']
        ));
        return view('libreria.form_biblioteca', compact('data'));
    }


    public function store(Request $request)
    {

        $response = array();

        try {
            $objImpresos = new Impresos();

            $params = array(
                'titulo' => $request['titulo'],
                'descripcion_especulador' => $request['descripcion_especulador'],
                'tipo' => $request['tipo'],
                'estado' => $request['estado']
            );

            if ($request->hasFile('foto_impreso')) {
                $adjunto = $request->file('foto_impreso');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotoimpreso_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/impresos'), $fileName);
                $params['foto_impreso'] = "/archivos/impresos/" . $fileName;
            }
            if ($request->hasFile('url')) {
                $adjunto2 = $request->file('url');
                $extension2 = $adjunto2->getClientOriginalExtension();
                $fileName2 = "impreso_" . date('ymdhis') . "." . $extension2;
                $adjunto2->move(base_path('archivos/pdf'), $fileName2);
                $params['url'] = "/archivos/pdf/" . $fileName2;
            }
            if ($request->hasFile('foto_portada_libro')) {
                $adjunto3 = $request->file('foto_portada_libro');
                $extension3 = $adjunto3->getClientOriginalExtension();
                $fileName3 = "impreso_" . date('ymdhis') . "." . $extension3;
                $adjunto3->move(base_path('archivos/impresolibro'), $fileName3);
                $params['foto_portada_libro'] = "/archivos/impresolibro/" . $fileName3;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objImpresos->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objImpresos->insertar($params);
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
            $objImpresos = new Impresos();
            $insert = $objImpresos->eliminar(array(
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
