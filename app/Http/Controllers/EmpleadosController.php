<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Empleado;
use App\Models\Estudios;
use App\Models\Empleos;
use App\Models\Idiomas;
use Exception;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }
    // vista general
    public function index()
    {
        $objempleados = new Empleado();
        $lista = $objempleados->listar();
       
       $trash1 = $objempleados->listar(array(
            'papelera' => array('P')
        ));

        return view('empleados.index', compact('lista','trash1'));
    }
    // vista vista empleados formulario
    public function empleado(Request $request)
    {

        $objempleados = new Empleado();
        $data = $objempleados->obtener(array(
            'id' => $request['id']
        ));
        return view('empleados.form', compact('data'));
    }
    // vista vista empleados deshabilitados
    public function papelera_total(Request $request)
    {
        $objempleados = new Empleado();
        $params = array();

        if (isset($_GET['nombres'])) {
            $params['nombres'] = $_GET['nombres'];
        }
        
        if (isset($_GET['apellidos'])) {
            $params['apellidos'] = $_GET['apellidos'];
        }

        $lista = $objempleados->listar($params);

        $trash = $objempleados->listar(array(
            'papelera' => array('P')
        ));

        return view('empleados.papelera', compact('lista','trash'));
    }
   
    // tabs de estudios, empleos, idiomas
    public function curriculum($id = null)
    {

        $objempleados = new Empleado();
        $objEstudios = new Estudios();
        $objEmpleos = new Empleos();
        $objIdiomas = new Idiomas();
        
        $canciller_id = $id;

        $data = array();
        $educacion = array();
        $trabajo = array();
        $idiomas = array();
        if ($id != null) {
            $data = $objempleados->obtener(array('id' => $id));
            $educacion = $objEstudios->listar(array('id' => $id));
            $trabajo = $objEmpleos->listar(array('id' => $id));
            $idiomas = $objIdiomas->listar(array('id' => $id));
            if (!$data) {
                return redirect('/curriculum');
            }
        }

        return view('empleados.curriculum', compact('data', 'educacion','canciller_id','trabajo','idiomas'));
    }
    
    // data formulario estudios
    public function estudio_info(Request $request)
    {
        $objEstudios = new Estudios();
        $canciller_id = $request['canciller_id'];
        $data = $objEstudios->obtener(array(
            'id' => $request['id']
        ));
        return view('empleados.formestudios', compact('data','canciller_id'));
    }
    // data formulario empleos
    public function empleo_info(Request $request)
    {
        $objEmpleos = new Empleos();
        $canciller_id = $request['canciller_id'];
        $data = $objEmpleos->obtener(array(
            'id' => $request['id']
        ));
        return view('empleados.formempleos', compact('data','canciller_id'));
    }
    // data formulario idiomas
    public function idiomas_info(Request $request)
    {
        $objIdiomas = new Idiomas();
        $canciller_id = $request['canciller_id'];
        $data = $objIdiomas->obtener(array(
            'id' => $request['id']
        ));
        return view('empleados.formidiomas', compact('data','canciller_id'));
    }
    // crear y actualizar estudios del empleado
    public function store_estudios(Request $request)
    {

        $response = array();

        try {
            $objEstudios = new Estudios();

            $params = array( 
                    'canciller_id' => $request['canciller_id'],               
                    'nombre_institucion' => $request['nombre_institucion'],
                    'titulo' => $request['titulo'],
                    'lugar' => $request['lugar'],
                    'ano_inicio' => $request['ano_inicio'],
                    'ano_fin' => $request['ano_fin']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objEstudios->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
               
            } else {
              $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objEstudios->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
               
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }

    // crear y actualizar tabla de empleado
    public function store(Request $request)
    {

        $response = array();

        try {
            
            $objempleados = new Empleado();

            $params = array(
                'nombres' => $request['nombres'],
                'apellidos' => $request['apellidos'],
                'sexo' => $request['sexo'],
                'cargo' => $request['cargo'],
                'tipo' => $request['tipo'],
                'resumen' => $request['resumen'],
                'estado' => $request['estado']
            );

            if ($request->hasFile('foto')) {
                $adjunto = $request->file('foto');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotoempleado_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/empleado'), $fileName);
                $params['foto'] = "/archivos/empleado/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objempleados->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objempleados->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }

    // crear y actualizar empleos del canciller y vicecanciller
    public function store_empleos(Request $request)
    {

        $response = array();

        try {
            $objEmpleos = new Empleos();

            $params = array( 
                    'canciller_id' => $request['canciller_id'],               
                    'empresa' => $request['empresa'],
                    'detalle' => $request['detalle'],
                    'cargo' => $request['cargo'],
                    'lugar' => $request['lugar'],
                    'fecha_inicio' => $request['fecha_inicio'],
                    'fecha_fin' => $request['fecha_fin']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objEmpleos->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
               
            } else {
              $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objEmpleos->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
               
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    // crear y actualizar idioma del canciller y vicecanciller
    public function store_idioma(Request $request)
    {

        $response = array();

        try {
            $objIdiomas = new Idiomas();

            $params = array( 
                    'canciller_id' => $request['canciller_id'],               
                    'idioma' => $request['idioma'],

            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objIdiomas->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
               
            } else {
              $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objIdiomas->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
               
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    // deshabilitar empleado
    public function deshabilitarempleados(Request $request)
    {
        $objempleados = new Empleado();
        $response = array();

        $objempleados->actualizar(array(
            'papelera' =>  'P',
            'estado' =>  'I',
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }
    // restaurar empleado
    public function restaurar_empleado(Request $request)
    {
        $objempleados = new Empleado();
        $response = array();

        $objempleados->actualizar(array(
            'papelera' =>  Null,
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }

    // eliminar permanente el empleado, sin carga curricular
    public function delete(Request $request)
    {
        $response = array();

        try {
            $objempleados = new Empleado();
            $insert = $objempleados->eliminar(array(
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
    // eliminar estudios del empleado
    public function delete_estudios(Request $request)
    {
        $response = array();

        try {
            $objEstudios = new Estudios();
            $insert = $objEstudios->eliminar(array(
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
    // eliminar empleos
    public function delete_empleos(Request $request)
    {
        $response = array();

        try {
            $objEmpleos = new Empleos();
            $insert = $objEmpleos->eliminar(array(
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

    public function delete_idioma(Request $request)
    {
        $response = array();

        try {
            $objIdiomas = new Idiomas();
            $insert = $objIdiomas->eliminar(array(
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
