<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Conare;
use App\Models\Ubicacion_geoestrategica;
use Exception;
use Illuminate\Http\Request;

class ConareController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin')->except('');
    }

    public function index()
    {
    	$objConare = new Conare();
    	$objUbicacion = new Ubicacion_geoestrategica();

    	$lista = $objConare->listar();
    	$contenido = $objConare->listar();
    	$imagen1 = $objConare->listar();
    	$parallax = $objConare->listar();

    	$ubicacion = $objUbicacion->listar();

        return view('conare.home', compact('lista','contenido','imagen1','parallax','ubicacion'));
    }
    public function banner_conare(Request $request)
    {
        $objConare = new Conare();
        $data = $objConare->obtener(array(
            'id' => $request['id']
        ));
        return view('conare.form', compact('data'));
    }
    public function contenido1(Request $request)
    {
        $objConare = new Conare();
        $data = $objConare->obtener(array(
            'id' => $request['id']
        ));
        return view('conare.form1', compact('data'));
    }
    public function imagen_conare(Request $request)
    {
        $objConare = new Conare();
        $data = $objConare->obtener(array(
            'id' => $request['id']
        ));
        return view('conare.form2', compact('data'));
    }
    public function parallax_conare(Request $request)
    {
        $objConare = new Conare();
        $data = $objConare->obtener(array(
            'id' => $request['id']
        ));
        return view('conare.form3', compact('data'));
    }
    public function ubicacion_geo(Request $request)
    {
        $objUbicacion = new Ubicacion_geoestrategica();
        $data = $objUbicacion->obtener(array(
            'id' => $request['id']
        ));
        return view('conare.form4', compact('data'));
    }
    public function storebanner(Request $request)
    {

        $response = array();

        try {
            
            $objConare = new Conare();

            $params = array(
                'titulo_principal' => $request['titulo_principal'],
                'titulo_principal_ingles' => $request['titulo_principal_ingles']
            );


            if ($request->hasFile('banner_principal')) {
                $adjunto = $request->file('banner_principal');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "bannerconare_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/conare'), $fileName);
                $params['banner_principal'] = "/archivos/conare/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objConare->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objConare->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function guardar_conenido(Request $request)
    {

        $response = array();

        try {
            
            $objConare = new Conare();

            $params = array(
                'subtitulo' => $request['subtitulo'],
                'subtitulo_ingles' => $request['subtitulo_ingles'],
                'descripcion' => $request['descripcion'],
                'descripcion_ingles' => $request['descripcion_ingles'],
                'titulo_des' => $request['titulo_des'],
                'titulo_des_ingles' => $request['titulo_des_ingles'],
                'descripcion_ubicacion' => $request['descripcion_ubicacion'],
                'descripcion_ubicacion_ingles' => $request['descripcion_ubicacion_ingles']

            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objConare->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objConare->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function guardar_imgco(Request $request)
    {

        $response = array();

        try {
            
            $objConare = new Conare();

            if ($request->hasFile('imagen')) {
                $adjunto = $request->file('imagen');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "imgconare_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/conare'), $fileName);
                $params['imagen'] = "/archivos/conare/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objConare->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objConare->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function guardar_parallax(Request $request)
    {

        $response = array();

        try {
            
            $objConare = new Conare();

            $params = array(
                'titulo_pllx' => $request['titulo_pllx'],
                'titulo_pllx_ingles' => $request['titulo_pllx_ingles'],
                'des_pllx' => $request['des_pllx'],
                'des_pllx_ingles' => $request['des_pllx_ingles']
            );


            if ($request->hasFile('parallax')) {
                $adjunto = $request->file('parallax');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "parallaxconare_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/conare'), $fileName);
                $params['parallax'] = "/archivos/conare/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objConare->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objConare->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function guardar_ubigeo(Request $request)
    {

        $response = array();

        try {
            
            $objUbicacion = new Ubicacion_geoestrategica();

            $params = array(
                'titulo' => $request['titulo'],
                'titulo_ingles' => $request['titulo_ingles'],
                'direccion' => $request['direccion'],
                'direccion_ingles' => $request['direccion_ingles'],
                'jurisdiccion' => $request['jurisdiccion'],
                'jurisdiccion_ingles' => $request['jurisdiccion_ingles'],
                'horario' => $request['horario'],
                'telefono' => $request['telefono'],
                'estado' => $request['estado']

            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objUbicacion->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objUbicacion->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function delete_ubicaciones(Request $request)
    {

        $response = array();

        try {
            $objUbicacion = new Ubicacion_geoestrategica();
            $insert = $objUbicacion->eliminar(array(
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