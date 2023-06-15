<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Impresos;
use Exception;
use Illuminate\Http\Request;

class ImpresosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objImpresos = new Impresos();
        $lista = $objImpresos->listar();

        return view('impresos.index', compact('lista'));
    }
    public function cuentos()
    {
        $objCuentos = new Impresos();
        $listar_cuentos = $objCuentos->listar_cuentos();

        return view('impresos.cuentos', compact('listar_cuentos'));
    }
    public function especulador()
    {
        $objEsp = new Impresos();
        $listar_especulador = $objEsp->listar_especulador();

        return view('impresos.especulador', compact('listar_especulador'));
    }
    public function especiales()
    {
        $objEspeciales = new Impresos();
        $listar_especiales = $objEspeciales->listar_especiales();

        return view('impresos.especiales', compact('listar_especiales'));
    }

    public function libros()
    {
        $objLibros = new Impresos();
        $listar_libros = $objLibros->listar_libros();

        return view('impresos.libros', compact('listar_libros'));
    }

    public function impreso_cuentos(Request $request)
    {

        $objImpresosCuentos = new Impresos();
        $data = $objImpresosCuentos->obtener(array(
            'id' => $request['id']
        ));
        return view('impresos.form_cuentos', compact('data'));
    }
    public function impreso_especulador(Request $request)
    {

        $objImpresosEspeculador = new Impresos();
        $data = $objImpresosEspeculador->obtener(array(
            'id' => $request['id']
        ));
        return view('impresos.form_especulador', compact('data'));
    }
    public function impreso_especiales(Request $request)
    {

        $objImpresosEspeciales = new Impresos();
        $data = $objImpresosEspeciales->obtener(array(
            'id' => $request['id']
        ));
        return view('impresos.form_especiales', compact('data'));
    }
    public function impreso_libros(Request $request)
    {

        $objImpresosLibros = new Impresos();
        $data = $objImpresosLibros->obtener(array(
            'id' => $request['id']
        ));
        return view('impresos.form_libros', compact('data'));
    }

    public function impreso(Request $request)
    {

        $objImpresos = new Impresos();
        $data = $objImpresos->obtener(array(
            'id' => $request['id']
        ));
        return view('impresos.form', compact('data'));
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
                'estado' => 'A'
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
