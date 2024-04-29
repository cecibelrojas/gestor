<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\BancoDatosDet;
use App\Models\Servicios;
use App\Models\Subservicios;
use App\Models\Detalle_subservicio;
use App\Models\Detalle_infovideos;
use App\Models\Detalle_infografias;
use App\Models\Detalle_subprocesos;
use App\Models\Detalle_apostilla;
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
    public function banner_serviconsulares(Request $request)
    {

        $objservicios = new Servicios();
        $objBancoDatosDet = new BancoDatosDet();
        $listaTipos = $objBancoDatosDet->listar(array('id' => '003'));

        $data = $objservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios.formbannerconsular', compact('data','listaTipos'));
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
    public function store_bannerconsular(Request $request)
    {

        $response = array();

        try {
            
            $objservicios = new Servicios();

            if ($request->hasFile('banner')) {
                $adjuntobc = $request->file('banner');
                $extensionbc = $adjuntobc->getClientOriginalExtension();
                $fileNamebc = "bnnr_" . date('ymdhis') . "." . $extensionbc;
                $adjuntobc->move(base_path('archivos/banner_consulares'), $fileNamebc);
                $params['banner'] = "/archivos/banner_consulares/" . $fileNamebc;
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
        $objDetalleVideos = new Detalle_infovideos();
        $objDetalleInfografia = new Detalle_infografias();
        $objDetalleApostilla = new Detalle_apostilla();
        $objDetalleprocesos = new Detalle_subprocesos();

        $subservicio_id = $id;
        $servicio_id = $id;
       
        $data = array();
        $detalle_subservicio = array();
        $detalle_procesos = array();
        $detalle_videos = array();
        $detalle_infografia = array();
        $detalle_apostilla = array();
        if ($id != null) {
            $data = $objSubservicios->obtener(array('id' => $id));
            $detalle_subservicio = $objDetalleSubservicios->listar(array('id' => $id));
            $detalle_procesos = $objDetalleprocesos->listar(array('id' => $id));
            $detalle_videos = $objDetalleVideos->listar(array('id' => $id));
            $detalle_infografia = $objDetalleInfografia->listar(array('id' => $id));
            $detalle_apostilla = $objDetalleApostilla->listar(array('id' => $id));
            if (!$data) {
                return redirect('/detalle_subservicio');
            }
        }
      //  dd($detalle_subservicio);
        return view('servicios.detalle_subservicio', compact('data', 'detalle_subservicio','subservicio_id', 'servicio_id','detalle_procesos','detalle_videos','detalle_infografia','detalle_apostilla'));
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
    public function subs_banner(Request $request)
    {
        $objDetalleSubservicios = new Detalle_subservicio();
        $subservicio_id = $request['subservicio_id'];
        $data = $objDetalleSubservicios->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios.formbanner', compact('data','subservicio_id'));
    }
    public function subs_video(Request $request)
    {
        $objDetalleVideos = new Detalle_infovideos();
        $objBancoDatosDet = new BancoDatosDet();
        $listaTipos = $objBancoDatosDet->listar(array('id' => '011'));

        $subservicio_id = $request['subservicio_id'];
        
        $data = $objDetalleVideos->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios.formvideo', compact('data','subservicio_id','listaTipos'));
    }
    public function subs_infografias(Request $request)
    {
        $objDetalleInfografia = new Detalle_infografias();
        $subservicio_id = $request['subservicio_id'];
        $data = $objDetalleInfografia->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios.forminfografia', compact('data','subservicio_id'));
    }
    public function subs_apostilla(Request $request)
    {
        $objDetalleApostilla = new Detalle_apostilla();
        $subservicio_id = $request['subservicio_id'];
        $data = $objDetalleApostilla->obtener(array(
            'id' => $request['id']
        ));
        return view('servicios.formapostilla', compact('data','subservicio_id'));
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
    public function store_bnnr_subservicio(Request $request)
    {

        $response = array();

        try {
            
            $objDetalleSubservicios = new Detalle_subservicio();
            $params = array( 
                    'subservicio_id' => $request['subservicio_id']
            );

            if ($request->hasFile('banner')) {
                $adjuntob = $request->file('banner');
                $extensionb = $adjuntob->getClientOriginalExtension();
                $fileNameb = "bnnr_" . date('ymdhis') . "." . $extensionb;
                $adjuntob->move(base_path('archivos/banner_detalleservicio'), $fileNameb);
                $params['banner'] = "/archivos/banner_detalleservicio/" . $fileNameb;
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
    public function store_videos_subservicio(Request $request)
    {

        $response = array();

        try {
            
            $objDetalleVideos = new Detalle_infovideos();

            $params = array( 
                'subservicio_id' => $request['subservicio_id'],
                'titulo' => $request['titulo'],
                'descripcion' => $request['descripcion'],
                'titulo_ingles' => $request['titulo_ingles'],
                'descripcion_ingles' => $request['descripcion_ingles'],
                'link' => $request['link'],
                'tipo' => $request['tipo'],
                'estado' => $request['estado']
            );

            if ($request->hasFile('tapa')) {
                $adjuntotp = $request->file('tapa');
                $extensiontp = $adjuntotp->getClientOriginalExtension();
                $fileNametp = "tapa_" . date('ymdhis') . "." . $extensiontp;
                $adjuntotp->move(base_path('archivos/video_detalleservicio'), $fileNametp);
                $params['tapa'] = "/archivos/video_detalleservicio/" . $fileNametp;
            }

            if ($request->hasFile('video')) {
                $adjuntov = $request->file('video');
                $extensionv = $adjuntov->getClientOriginalExtension();
                $fileNamev = "mp4consol_" . date('ymdhis') . "." . $extensionv;
                $adjuntov->move(base_path('archivos/video_detalleservicio'), $fileNamev);
                $params['video'] = "/archivos/video_detalleservicio/" . $fileNamev;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objDetalleVideos->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objDetalleVideos->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function store_apostillas_subservicio(Request $request)
    {

        $response = array();

        try {
            
            $objDetalleApostilla = new Detalle_apostilla();

            $params = array( 
                'subservicio_id' => $request['subservicio_id'],
                'titulo1' => $request['titulo1'],
                'titulo2' => $request['titulo2'],
                'titulo1_ingles' => $request['titulo1_ingles'],
                'titulo2_ingles' => $request['titulo2_ingles'],
                'descripcion1' => $request['descripcion1'],
                'descripcion2' => $request['descripcion2'],
                'descripcion1_ingles' => $request['descripcion1_ingles'],
                'descripcion2_ingles' => $request['descripcion2_ingles'],
                'titulo_infografia' => $request['titulo_infografia'],
                'titulo_infografia_ingles' => $request['titulo_infografia_ingles'],
                'titulo_parallax' => $request['titulo_parallax'],
                'titulo_parallax_ingles' => $request['titulo_parallax_ingles'],
                'des_parallax' => $request['des_parallax'],
                'des_parallax_ingles' => $request['des_parallax_ingles'],
                'link' => $request['link']
            );

            if ($request->hasFile('parallax')) {
                $adjuntopx = $request->file('parallax');
                $extensionpx = $adjuntopx->getClientOriginalExtension();
                $fileNamepx = "prllx_" . date('ymdhis') . "." . $extensionpx;
                $adjuntopx->move(base_path('archivos/apostilla_subservicios'), $fileNamepx);
                $params['parallax'] = "/archivos/apostilla_subservicios/" . $fileNamepx;
            }

            if ($request->hasFile('infografia')) {
                $adjuntoinf = $request->file('infografia');
                $extensioninf = $adjuntoinf->getClientOriginalExtension();
                $fileNameinf = "infografia_" . date('ymdhis') . "." . $extensioninf;
                $adjuntoinf->move(base_path('archivos/apostilla_subservicios'), $fileNameinf);
                $params['infografia'] = "/archivos/apostilla_subservicios/" . $fileNameinf;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objDetalleApostilla->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objDetalleApostilla->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }


    public function guardar_infogra_subservicio(Request $request)
    {

        $response = array();

        try {
            
            $objDetalleInfografia = new Detalle_infografias();

            $params = array( 
                'subservicio_id' => $request['subservicio_id'],
                'titulo' => $request['titulo'],
                'titulo_ingles' => $request['titulo_ingles'],
                'orden' => $request['orden'],
                'estado' => $request['estado']
            );

            if ($request->hasFile('infografia')) {
                $adjuntoin = $request->file('infografia');
                $extensionin = $adjuntoin->getClientOriginalExtension();
                $fileNamein = "infografia_" . date('ymdhis') . "." . $extensionin;
                $adjuntoin->move(base_path('archivos/infografia_detalleservicio'), $fileNamein);
                $params['infografia'] = "/archivos/infografia_detalleservicio/" . $fileNamein;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objDetalleInfografia->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objDetalleInfografia->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function delete_videos(Request $request)
    {
        $response = array();

        try {
            $objDetalleVideos = new Detalle_infovideos();
            $insert = $objDetalleVideos->eliminar(array(
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
    public function delete_infografia(Request $request)
    {
        $response = array();

        try {
            $objDetalleInfografia = new Detalle_infografias();
            $insert = $objDetalleInfografia->eliminar(array(
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
                    'contenido_ingles' => $request['contenido_ingles'],
                    'estado_info' => $request['estado_info']
            );

            if ($request->hasFile('infografia')) {
                $adjuntofin = $request->file('infografia');
                $extensionfin = $adjuntofin->getClientOriginalExtension();
                $fileNamefin = "infografia_" . date('ymdhis') . "." . $extensionfin;
                $adjuntofin->move(base_path('archivos/infografia_detalleservicio'), $fileNamefin);
                $params['infografia'] = "/archivos/infografia_detalleservicio/" . $fileNamefin;
            }

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
