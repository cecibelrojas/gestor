<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\BancoDatosDet;
use App\Models\Servicios;
use App\Models\Subservicios;
use App\Models\Detalle_subservicio;
use App\Models\Detalle_subprocesos;
use App\Models\Detalle_final_subservicio;
use Exception;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objservicios = new Servicios();
        $lista = $objservicios->listar();
        
        $trash1 = $objservicios->listar(array(
            'papelera' => array('P')
        ));

        return view('servicios.index', compact('lista','trash1'));
    }
    public function servicios(Request $request)
    {

        $objservicios = new Servicios();
        $objBancoDatosDet = new BancoDatosDet();
        $listaTipos = $objBancoDatosDet->listar(array('id' => '003'));

        $data = $objservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios.form', compact('data','listaTipos'));
    }
    public function papelera_servicio(Request $request)
    {
        $objservicios = new Servicios();
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

        return view('servicios.papelera_servicios', compact('lista','trash'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            
            $objservicios = new Servicios();

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
                $adjunto->move(base_path('archivos/iconosconsulares'), $fileName);
                $params['icono'] = "/archivos/iconosconsulares/" . $fileName;
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
            $objservicios = new Servicios();
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
    public function deshabilitarservicio(Request $request)
    {
        $objservicios = new Servicios();
        $response = array();

        $objservicios->actualizar(array(
            'papelera' =>  'P',
            'estado' =>  'I',
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }
    public function restaurar_servicio(Request $request)
    {
        $objservicios = new Servicios();
        $response = array();

        $objservicios->actualizar(array(
            'papelera' =>  Null,
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }
    public function subservicios($id = null)
    {

        $objServicios = new Servicios();
        $objSubservicios = new Subservicios();

        $servicio_id = $id;

        $data = array();
        $subservicio = array();
        if ($id != null) {
            $data = $objServicios->obtener(array('id' => $id));
            $subservicio = $objSubservicios->listar(array('id' => $id));
            if (!$data) {
                return redirect('/subservicio');
            }
        }

        return view('servicios.subservicio', compact('data', 'subservicio','servicio_id'));
    }

    public function subservicio_info(Request $request)
    {
        $objSubservicios = new Subservicios();
        $servicio_id = $request['servicio_id'];
        $data = $objSubservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios.formsubservicio', compact('data','servicio_id'));
    }
    public function store_subservicio(Request $request)
    {

        $response = array();

        try {
            $objSubservicios = new Subservicios();

            $params = array( 
                    'servicio_id' => $request['servicio_id'],               
                    'nombre_subservicio' => $request['nombre_subservicio'],
                    'nombre_subservicio_ingles' => $request['nombre_subservicio_ingles'],
                    'estado' => $request['estado']
            );
            if ($request->hasFile('icono')) {
                $adjunto = $request->file('icono');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "iconos_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/iconosubconsulares'), $fileName);
                $params['icono'] = "/archivos/iconosubconsulares/" . $fileName;
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

        public function delete_subservicio(Request $request)
    {
        $response = array();

        try {
            $objSubservicios = new Subservicios();
            $insert = $objSubservicios->eliminar(array(
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

/********************** Detalles *************************/
    public function detalle_subservicios( $id = null)
    {
        $objSubservicios = new Subservicios();
        $objDetalleSubservicios = new Detalle_subservicio();
        $objDetalleprocesos = new Detalle_subprocesos();

        $subservicio_id = $id;
        $servicio_id = $id;
       
        $data = array();
        $detalle_subservicio = array();
        $detalle_procesos = array();
        if ($id != null) {
            $data = $objSubservicios->obtener(array('id' => $id));
            $detalle_subservicio = $objDetalleSubservicios->listar(array('id' => $id));
            $detalle_procesos = $objDetalleprocesos->listar(array('id' => $id));
            if (!$data) {
                return redirect('/detalle_subservicio');
            }
        }
      //  dd($detalle_subservicio);
        return view('servicios.detalle_subservicio', compact('data', 'detalle_subservicio','subservicio_id', 'servicio_id','detalle_procesos'));
    }

    
    public function detalle_contenido(Request $request)
    {
        $objDetalleSubservicios = new Detalle_subservicio();
        $subservicio_id = $request['subservicio_id'];
        $data = $objDetalleSubservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios.formdetalle', compact('data','subservicio_id'));
    }  

    public function detalle_proceso(Request $request)
    {
        $objDetalleprocesos = new Detalle_subprocesos();
        $subservicio_id = $request['subservicio_id'];
        $data = $objDetalleprocesos->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios.formproceso', compact('data','subservicio_id'));
    } 



    public function store_contenido(Request $request)
    {

        $response = array();

        try {
            $objDetalleSubservicios = new Detalle_subservicio();

            $params = array( 
                    'subservicio_id' => $request['subservicio_id'],               
                    'titulo_principal' => $request['titulo_principal'],
                    'titulo_principal_ingles' => $request['titulo_principal_ingles'],
                    'descripcion_servicio' => $request['descripcion_servicio'],
                    'descripcion_servicio_ingles' => $request['descripcion_servicio_ingles'],
                    'estado' => $request['estado']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objDetalleSubservicios->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
               
            } else {
              $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objDetalleSubservicios->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
               
            }

        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function store_procesos(Request $request)
    {

        $response = array();

        try {
            $objDetalleprocesos = new Detalle_subprocesos();

            $params = array( 
                    'subservicio_id' => $request['subservicio_id'],               
                    'titulo_principal' => $request['titulo_principal'],
                    'titulo_principal_ingles' => $request['titulo_principal_ingles'],
                    'estado' => $request['estado']
            );
            if ($request->hasFile('icono')) {
                $adjunto = $request->file('icono');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "iconos_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/iconoprocesos'), $fileName);
                $params['icono'] = "/archivos/iconoprocesos/" . $fileName;
            }
            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objDetalleprocesos->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
               
            } else {
              $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objDetalleprocesos->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
               
            }

        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function delete_procesos(Request $request)
    {
        $response = array();

        try {
            $objDetalleprocesos = new Detalle_subprocesos();
            $insert = $objDetalleprocesos->eliminar(array(
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

/********************** Detalles finales modal *************************/
    public function detalle_final_subservicios( $id = null)
    {
        $objDetalleprocesos = new Detalle_subprocesos();
        $objDetalleprocesosfinal = new Detalle_final_subservicio();

        $subservicio_id = $id;
        $subserviciofinal_id = $id;
       
        $data = array();
        $detalle_final = array();
        if ($id != null) {
            $data = $objDetalleprocesos->obtener(array('id' => $id));
            $detalle_final = $objDetalleprocesosfinal->listar(array('id' => $id));
            if (!$data) {
                return redirect('/proceso_final');
            }
        }
      //  dd($detalle_subservicio);
        return view('servicios.proceso_final', compact('data', 'detalle_final','subservicio_id','subserviciofinal_id'));
    }
    public function detalles_finales_sub(Request $request)
    {
        $objDetalleprocesosfinal = new Detalle_final_subservicio();
        $subserviciofinal_id = $request['subserviciofinal_id'];
        $data = $objDetalleprocesosfinal->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios.formprocesofinal', compact('data','subserviciofinal_id'));
    } 
    public function store_procesos_finales(Request $request)
    {

        $response = array();

        try {
            $objDetalleprocesosfinal = new Detalle_final_subservicio();

            $params = array( 
                    'subserviciofinal_id' => $request['subserviciofinal_id'],               
                    'contenido' => $request['contenido'],
                    'contenido_ingles' => $request['contenido_ingles']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objDetalleprocesosfinal->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
               
            } else {
              $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objDetalleprocesosfinal->insertar($params);
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
