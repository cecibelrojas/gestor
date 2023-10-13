<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\BancoDatosDet;
use App\Models\Servicios_identidad;
use App\Models\Detalle_identidad;
use Exception;
use Illuminate\Http\Request;

class ServiciosidentidadController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objservicios = new Servicios_identidad();
        $lista = $objservicios->listar();
        
        $trash1 = $objservicios->listar(array(
            'papelera' => array('P')
        ));

        return view('servicios_identidad.index', compact('lista','trash1'));
    }
    public function serviciosidentidad(Request $request)
    {

        $objservicios = new Servicios_identidad();
        $objBancoDatosDet = new BancoDatosDet();
        $listaTipos = $objBancoDatosDet->listar(array('id' => '005'));

        $data = $objservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios_identidad.form', compact('data','listaTipos'));
    }
    public function papelera_servicio_identidad(Request $request)
    {
        $objservicios = new Servicios_identidad();
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

        return view('servicios_identidad.papelera_identidad', compact('lista','trash'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            
            $objservicios = new Servicios_identidad();

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
                $adjunto->move(base_path('archivos/iconoidentidad'), $fileName);
                $params['icono'] = "/archivos/iconoidentidad/" . $fileName;
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
            $objservicios = new Servicios_identidad();
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
    public function deshabilitarservicioidentidad(Request $request)
    {
        $objservicios = new Servicios_identidad();
        $response = array();

        $objservicios->actualizar(array(
            'papelera' =>  'P',
            'estado' =>  'I',
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }
    public function restaurar_servicio_identidad(Request $request)
    {
        $objservicios = new Servicios_identidad();
        $response = array();

        $objservicios->actualizar(array(
            'papelera' =>  Null,
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }
    
    public function detalles_identidad($id = null)
    {

        $objServicios = new Servicios_identidad();
        $objSubservicios = new Detalle_identidad();

        $identidad_id = $id;

        $data = array();
        $subservicio = array();
        if ($id != null) {
            $data = $objServicios->obtener(array('id' => $id));
            $subservicio = $objSubservicios->listar(array('id' => $id));
            if (!$data) {
                return redirect('/detalle');
            }
        }

        return view('servicios_identidad.detalle', compact('data', 'subservicio','identidad_id'));
    }

    public function detalle_info(Request $request)
    {
        $objSubservicios = new Detalle_identidad();
        $identidad_id = $request['identidad_id'];
        $data = $objSubservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios_identidad.formdetalle', compact('data','identidad_id'));
    }
    public function store_imgprincipal(Request $request)
    {

        $response = array();

        try {
            
            $objSubservicios = new Detalle_identidad();
            $params = array( 
                    'identidad_id' => $request['identidad_id'],
                    'descripcion' => $request['descripcion'],
                    'descripcion_ingles' => $request['descripcion_ingles'],
                    'sumario' => $request['sumario'],
                    'sumario_ingles' => $request['sumario_ingles']
            );


            if ($request->hasFile('imagen_principal')) {
                $adjunto = $request->file('imagen_principal');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "imagen_principal_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/identidad_nacional'), $fileName);
                $params['imagen_principal'] = "/archivos/identidad_nacional/" . $fileName;
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
