<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Casa_amarilla;
use App\Models\Colecciones;
use App\Models\Normas;
use App\Models\Items_casamarilla;
use Exception;
use Illuminate\Http\Request;

class CasaamarillaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin')->except('');
    }

    public function index()
    {
        $objCasaamarilla = new Casa_amarilla();
        $objColeccion = new Colecciones();
        $objNormas = new Normas();
        $objItems = new Items_casamarilla();

        $lista = $objCasaamarilla->listar();
        $contenido = $objCasaamarilla->listar();
        $imagen1 = $objCasaamarilla->listar();
        $parallax = $objCasaamarilla->listar();

        $coleccion = $objColeccion->listar();
        $normas = $objNormas->listar();
        $items = $objItems->listar();

        return view('casaamarilla.home', compact('lista','contenido','imagen1','parallax','coleccion','normas','items'));
    }
    public function banner_casamarilla(Request $request)
    {
        $objCasaamarilla = new Casa_amarilla();
        $data = $objCasaamarilla->obtener(array(
            'id' => $request['id']
        ));
        return view('casaamarilla.form', compact('data'));
    }
    public function contenido1(Request $request)
    {
        $objCasaamarilla = new Casa_amarilla();
        $data = $objCasaamarilla->obtener(array(
            'id' => $request['id']
        ));
        return view('casaamarilla.form1', compact('data'));
    }
    public function imagen_casamarilla(Request $request)
    {
        $objCasaamarilla = new Casa_amarilla();
        $data = $objCasaamarilla->obtener(array(
            'id' => $request['id']
        ));
        return view('casaamarilla.form2', compact('data'));
    }

    public function parallax1_casamarilla(Request $request)
    {
        $objCasaamarilla = new Casa_amarilla();
        $data = $objCasaamarilla->obtener(array(
            'id' => $request['id']
        ));
        return view('casaamarilla.form3', compact('data'));
    }
    public function parallax2_casamarilla(Request $request)
    {
        $objCasaamarilla = new Casa_amarilla();
        $data = $objCasaamarilla->obtener(array(
            'id' => $request['id']
        ));
        return view('casaamarilla.form4', compact('data'));
    }
    public function coleccion(Request $request)
    {
        $objColeccion = new Colecciones();
        $data = $objColeccion->obtener(array(
            'id' => $request['id']
        ));
        return view('casaamarilla.form5', compact('data'));
    }
    public function normas(Request $request)
    {
        $objNormas = new Normas();
        $data = $objNormas->obtener(array(
            'id' => $request['id']
        ));
        return view('casaamarilla.form6', compact('data'));
    }
    public function items(Request $request)
    {
        $objItems = new Items_casamarilla();
        $data = $objItems->obtener(array(
            'id' => $request['id']
        ));
        return view('casaamarilla.form7', compact('data'));
    }


    public function storebanner(Request $request)
    {

        $response = array();

        try {
            
            $objCasaamarilla = new Casa_amarilla();

            if ($request->hasFile('banner_principal')) {
                $adjunto = $request->file('banner_principal');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "bannercasamarilla_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/casa_amarilla'), $fileName);
                $params['banner_principal'] = "/archivos/casa_amarilla/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objCasaamarilla->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objCasaamarilla->insertar($params);
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
            
            $objCasaamarilla = new Casa_amarilla();

            $params = array(
                'titulo' => $request['titulo'],
                'titulo_ingles' => $request['titulo_ingles'],
                'titulo2' => $request['titulo2'],
                'titulo2_ingles' => $request['titulo2_ingles'],
                'contenido1' => $request['contenido1'],
                'contenido1_ingles' => $request['contenido1_ingles'],
                'titulo3' => $request['titulo3'],
                'contenido2' => $request['contenido2'],
                'titulo3_ingles' => $request['titulo3_ingles'],
                'contenido2_ingles' => $request['contenido2_ingles'],
                'titulo4' => $request['titulo4'],
                'titulo4_ingles' => $request['titulo4_ingles'],
                'contenido3' => $request['contenido3'],
                'contenido3_ingles' => $request['contenido3_ingles'],
                'item1' => $request['item1'],
                'item2' => $request['item2'],
                'item3' => $request['item3'],
                'item4' => $request['item4'],
                'item5' => $request['item5'],
                'item6' => $request['item6'],
                'item1_ingles' => $request['item1_ingles'],
                'item2_ingles' => $request['item2_ingles'],
                'item3_ingles' => $request['item3_ingles'],
                'item4_ingles' => $request['item4_ingles'],
                'item5_ingles' => $request['item5_ingles'],
                'item6_ingles' => $request['item6_ingles'],
                'estado' => $request['estado'],
                'direccion' => $request['direccion'],
                'direccion_ingles' => $request['direccion_ingles'],
                'correo1' => $request['correo1'],
                'correo2' => $request['correo2'],
                'correo3' => $request['correo3'],
                'horario' => $request['horario'],
                'horario_ingles' => $request['horario_ingles']

            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objCasaamarilla->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objCasaamarilla->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function guardar_imgca(Request $request)
    {

        $response = array();

        try {
            
            $objCasaamarilla = new Casa_amarilla();

            if ($request->hasFile('img1')) {
                $adjunto = $request->file('img1');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "imgcasamarilla_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/casa_amarilla'), $fileName);
                $params['img1'] = "/archivos/casa_amarilla/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objCasaamarilla->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objCasaamarilla->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function guardar_parallax1(Request $request)
    {

        $response = array();

        try {
            
            $objCasaamarilla = new Casa_amarilla();

            $params = array(
                'titulo_pllx1' => $request['titulo_pllx1'],
                'titulo_pllx1_ingles' => $request['titulo_pllx1_ingles']

            );


            if ($request->hasFile('parallax1')) {
                $adjunto = $request->file('parallax1');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "parallax1casamarilla_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/casa_amarilla'), $fileName);
                $params['parallax1'] = "/archivos/casa_amarilla/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objCasaamarilla->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objCasaamarilla->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function guardar_parallax2(Request $request)
    {

        $response = array();

        try {
            
            $objCasaamarilla = new Casa_amarilla();

            $params = array(
                'titulo_pllx2' => $request['titulo_pllx2'],
                'titulo_pllx2_ingles' => $request['titulo_pllx2_ingles'],
                'contenido_pllx2' => $request['contenido_pllx2'],
                'contenido_pllx2_ingles' => $request['contenido_pllx2_ingles']

            );


            if ($request->hasFile('parallax2')) {
                $adjunto = $request->file('parallax2');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "parallax2casamarilla_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/casa_amarilla'), $fileName);
                $params['parallax2'] = "/archivos/casa_amarilla/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objCasaamarilla->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objCasaamarilla->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function guardar_coleccion(Request $request)
    {

        $response = array();

        try {
            
            $objColeccion = new Colecciones();

            $params = array(
                'titulo' => $request['titulo'],
                'titulo_ingles' => $request['titulo_ingles'],
                'descripcion' => $request['descripcion'],
                'descripcion_ingles' => $request['descripcion_ingles'],
                'estado' => $request['estado']

            );

            if ($request->hasFile('imagen')) {
                $adjunto = $request->file('imagen');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "coleccion_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/colecciones'), $fileName);
                $params['imagen'] = "/archivos/colecciones/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objColeccion->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objColeccion->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function guardar_normas(Request $request)
    {

        $response = array();

        try {
            
            $objNormas = new Normas();

            $params = array(
                'items' => $request['items'],
                'items_ingles' => $request['items_ingles'],
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objNormas->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objNormas->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function guardar_items(Request $request)
    {

        $response = array();

        try {
            
            $objItems = new Items_casamarilla();

            $params = array(
                'titulo' => $request['titulo'],
                'titulo_ingles' => $request['titulo_ingles'],
                'estado' => $request['estado']

            );

            if ($request->hasFile('imagen_items')) {
                $adjunto = $request->file('imagen_items');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "itemscasamarilla_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/itemsca'), $fileName);
                $params['imagen_items'] = "/archivos/itemsca/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objItems->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objItems->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }



    public function delete_colecciones(Request $request)
    {

        $response = array();

        try {
            $objColeccion = new Colecciones();
            $insert = $objColeccion->eliminar(array(
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
    public function delete_normas(Request $request)
    {

        $response = array();

        try {
            
            $objNormas = new Normas();
            $insert = $objNormas->eliminar(array(
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
    public function delete_items(Request $request)
    {

        $response = array();

        try {
            
            $objItems = new Items_casamarilla();
            $insert = $objItems->eliminar(array(
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
