<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\BancoDatosDet;
use App\Models\Servicios_turismo;
use App\Models\Detalle_turismo;
use Exception;
use Illuminate\Http\Request;

class ServiciosturismoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objservicios = new Servicios_turismo();
        $lista = $objservicios->listar();
        
        $trash1 = $objservicios->listar(array(
            'papelera' => array('P')
        ));

        return view('servicios_turismo.index', compact('lista','trash1'));
    }
    public function serviciosturismo(Request $request)
    {

        $objservicios = new Servicios_turismo();
        $objBancoDatosDet = new BancoDatosDet();
        $listaTipos = $objBancoDatosDet->listar(array('id' => '006'));

        $data = $objservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios_turismo.form', compact('data','listaTipos'));
    }
    public function papelera_servicio_turismo(Request $request)
    {
        $objservicios = new Servicios_turismo();
        $params = array();

        if (isset($_GET['nombre_servicio'])) {
            $params['nombre_servicio'] = $_GET['nombre_servicio'];
        }
        
        if (isset($_GET['tipo'])) {
            $params['tipo'] = $_GET['tipo'];
        }

        $lista = $objservicios->listar($params);

        $trash = $objservicios->listar(array(
            'papelera' => array('P')
        ));

        return view('servicios_turismo.papelera_turismo', compact('lista','trash'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            
            $objservicios = new Servicios_turismo();

            $params = array(

                'nombre_servicio' => $request['nombre_servicio'],
                'nombre_servicio_ingles' => $request['nombre_servicio_ingles'],
                'tipo' => $request['tipo'],
                'estado' => $request['estado']

            );

            if ($request->hasFile('icono')) {
                $adjunto = $request->file('icono');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "iconos_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/iconoturismo'), $fileName);
                $params['icono'] = "/archivos/iconoturismo/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objservicios->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objservicios->insertar($params);
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
            $objservicios = new Servicios_turismo();
            $insert = $objservicios->eliminar(array(
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
    public function deshabilitarservicioturismo(Request $request)
    {
        $objservicios = new Servicios_turismo();
        $response = array();

        $objservicios->actualizar(array(
            'papelera' =>  'P',
            'estado' =>  'I',
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }
    public function restaurar_servicio_turismo(Request $request)
    {
        $objservicios = new Servicios_turismo();
        $response = array();

        $objservicios->actualizar(array(
            'papelera' =>  Null,
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }
    public function detalles_turismo($id = null)
    {

        $objServicios = new Servicios_turismo();
        $objSubservicios = new Detalle_turismo();

        $turismo_id = $id;

        $data = array();
        $subservicio = array();
        if ($id != null) {
            $data = $objServicios->obtener(array('id' => $id));
            $subservicio = $objSubservicios->listar(array('id' => $id));
            if (!$data) {
                return redirect('/detalle');
            }
        }

        return view('servicios_turismo.detalle', compact('data', 'subservicio','turismo_id'));
    }
    public function detalle_info_turismo(Request $request)
    {
        $objSubservicios = new Detalle_turismo();
        $turismo_id = $request['turismo_id'];
        $data = $objSubservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios_turismo.formdetalle', compact('data','turismo_id'));
    }
    public function store_imgprincipalt(Request $request)
    {

        $response = array();

        try {
            
            $objSubservicios = new Detalle_turismo();
            $params = array( 
                    'turismo_id' => $request['turismo_id'],
                    'descripcion' => $request['descripcion'],
                    'descripcion_ingles' => $request['descripcion_ingles'],
                    'sumario' => $request['sumario'],
                    'sumario_ingles' => $request['sumario_ingles']
            );


            if ($request->hasFile('imagen_principal')) {
                $adjunto = $request->file('imagen_principal');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "imagen_principalt_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/turismo_nacional'), $fileName);
                $params['imagen_principal'] = "/archivos/turismo_nacional/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objSubservicios->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objSubservicios->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
}
