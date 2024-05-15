<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\BancoDatosDet;
use App\Models\Servicios_biblioteca;
use App\Models\Subservicios_biblioteca;
use App\Models\Detalle_biblioteca;
use Exception;
use Illuminate\Http\Request;

class Servicios_bibliotecaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin')->except('');
    }

    public function index()
    {
        $objservicios = new Servicios_biblioteca();
        $lista = $objservicios->listar();
        
        $trash1 = $objservicios->listar(array(
            'papelera' => array('P')
        ));

        return view('servicios_biblioteca.index', compact('lista','trash1'));
    }
    public function servicios_biblioteca_archivos(Request $request)
    {

        $objservicios = new Servicios_biblioteca();
        $objBancoDatosDet = new BancoDatosDet();
        $listaTipos = $objBancoDatosDet->listar(array('id' => '004'));

        $data = $objservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios_biblioteca.form', compact('data','listaTipos'));
    }
    public function banner_servibiblioteca(Request $request)
    {

        $objservicios = new Servicios_biblioteca();
        $objBancoDatosDet = new BancoDatosDet();
        $listaTipos = $objBancoDatosDet->listar(array('id' => '004'));

        $data = $objservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios_biblioteca.formbannerbbt', compact('data','listaTipos'));
    }

    public function papelera_biblioteca(Request $request)
    {
        $objservicios = new Servicios_biblioteca();
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

        return view('servicios_biblioteca.papelera_biblioteca', compact('lista','trash'));
    }
    public function store(Request $request)
    {

        $response = array();

        try {
            
            $objservicios = new Servicios_biblioteca();

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
                $adjunto->move(base_path('archivos/iconosbiblioteca'), $fileName);
                $params['icono'] = "/archivos/iconosbiblioteca/" . $fileName;
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
    public function store_bannerbiblioteca(Request $request)
    {

        $response = array();

        try {
            
            $objservicios = new Servicios_biblioteca();

            if ($request->hasFile('banner')) {
                $adjuntobc = $request->file('banner');
                $extensionbc = $adjuntobc->getClientOriginalExtension();
                $fileNamebc = "bnnr_" . date('ymdhis') . "." . $extensionbc;
                $adjuntobc->move(base_path('archivos/banner_biblioteca'), $fileNamebc);
                $params['banner'] = "/archivos/banner_biblioteca/" . $fileNamebc;
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
            $objservicios = new Servicios_biblioteca();
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
        $objservicios = new Servicios_biblioteca();
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
        $objservicios = new Servicios_biblioteca();
        $response = array();

        $objservicios->actualizar(array(
            'papelera' =>  Null,
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }
    public function subservicios_biblioteca($id = null)
    {

        $objServicios = new Servicios_biblioteca();
        $objSubservicios = new Subservicios_biblioteca();

        $servicio_id = $id;

        $data = array();
        $subservicio = array();
        if ($id != null) {
            $data = $objServicios->obtener(array('id' => $id));
            $subservicio = $objSubservicios->listar(array('id' => $id));
            if (!$data) {
                return redirect('/subservicio_biblioteca');
            }
        }

        return view('servicios_biblioteca.subservicio_biblioteca', compact('data', 'subservicio','servicio_id'));
    }
    public function detalle_subservicios($id = null)
    {

        $objSubservicios = new Subservicios();
        $objDetalleSubservicios = new Detalle_subservicio();

        $subservicio_id = $id;

        $data = array();
        $detalle_subservicio = array();
        if ($id != null) {
            $data = $objSubservicios->obtener(array('id' => $id));
            $detalle_subservicio = $objDetalleSubservicios->listar(array('id' => $id));
            if (!$data) {
                return redirect('/detalle_subservicio');
            }
        }
        return view('servicios.detalle_subservicio', compact('data', 'detalle_subservicio','subservicio_id'));
    }

    public function subservicio_info(Request $request)
    {
        $objSubservicios = new Subservicios_biblioteca();
        $servicio_id = $request['servicio_id'];
        $data = $objSubservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios_biblioteca.formsubservicio', compact('data','servicio_id'));
    }
    public function store_subservicio(Request $request)
    {

        $response = array();

        try {
            $objSubservicios = new Subservicios_biblioteca();

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
                $adjunto->move(base_path('archivos/iconosubiblioteca'), $fileName);
                $params['icono'] = "/archivos/iconosubiblioteca/" . $fileName;
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
            $objSubservicios = new Subservicios_biblioteca();
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
    public function detalles_biblioteca( $id = null)
    {
        $objSubservicios = new Subservicios_biblioteca();
        $objDetalleSubservicios = new Detalle_biblioteca();

        $subservicio_id = $id;
        $servicio_id = $id;
       
        $data = array();
        $detalle_subservicio = array();
        if ($id != null) {
            $data = $objSubservicios->obtener(array('id' => $id));
            $detalle_subservicio = $objDetalleSubservicios->listar(array('id' => $id));
            if (!$data) {
                return redirect('/detalle');
            }
        }
      //  dd($detalle_subservicio);
        return view('servicios_biblioteca.detalle', compact('data', 'detalle_subservicio','subservicio_id', 'servicio_id'));
    }
    public function subs_bannerbbt(Request $request)
    {
        $objDetalleSubservicios = new Detalle_biblioteca();
        $subservicio_id = $request['subservicio_id'];
        $data = $objDetalleSubservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios_biblioteca.formbannersub', compact('data','subservicio_id'));
    }
    public function detalle_contenido_ba(Request $request)
    {
        $objDetalleSubservicios = new Detalle_biblioteca();
        $subservicio_id = $request['subservicio_id'];
        $data = $objDetalleSubservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios_biblioteca.formdetalle', compact('data','subservicio_id'));
    } 
    public function store_subbannerbbt(Request $request)
    {

        $response = array();

        try {
            
            $objDetalleSubservicios = new Detalle_biblioteca();
            $params = array( 
                    'subservicio_id' => $request['subservicio_id']
            );

            if ($request->hasFile('banner')) {
                $adjuntob = $request->file('banner');
                $extensionb = $adjuntob->getClientOriginalExtension();
                $fileNameb = "bnnr_" . date('ymdhis') . "." . $extensionb;
                $adjuntob->move(base_path('archivos/banner_biblioteca'), $fileNameb);
                $params['banner'] = "/archivos/banner_biblioteca/" . $fileNameb;
            }

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
       
}
