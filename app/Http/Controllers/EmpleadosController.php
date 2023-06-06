<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Empleado;
use Exception;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objempleados = new Empleado();
        $lista = $objempleados->listar();
       
       $trash1 = $objempleados->listar(array(
            'papelera' => array('P')
        ));


        return view('empleados.index', compact('lista','trash1'));
    }

    public function empleado(Request $request)
    {

        $objempleados = new Empleado();
        $data = $objempleados->obtener(array(
            'id' => $request['id']
        ));
        return view('empleados.form', compact('data'));
    }
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
}
