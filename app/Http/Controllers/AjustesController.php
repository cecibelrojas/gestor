<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Ajustes;
use Exception;
use Illuminate\Http\Request;

class AjustesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('admin')->except('');
    }

    public function index()
    {
        $objFeed = new Ajustes();
        $lista = $objFeed->listar_feed();

        return view('ajustes.feed', compact('lista'));
    }
    public function panoramica()
    {
        $objPanoramica = new Ajustes();
        $lista = $objPanoramica->listar_feed();

        return view('ajustes.patrimonio360', compact('lista'));
    }
    public function logoinstitucional()
    {
        $objFeed = new Ajustes();
        $lista1 = $objFeed->listar_feed();
        $lista2 = $objFeed->listar();
        return view('ajustes.logos', compact('lista1','lista2'));
    }

    public function footer()
    {
        $objFeed = new Ajustes();
        $lista = $objFeed->listar();
        $lista2 = $objFeed->listar();
        return view('ajustes.footer', compact('lista','lista2'));
    }
    public function logo_footer(Request $request)
    {

         $objFeed = new Ajustes();
        $data = $objFeed->obtener(array(
            'id' => $request['id']
        ));
        return view('ajustes.formfooter', compact('data'));
    }
    public function feed(Request $request)
    {

         $objFeed = new Ajustes();
        $data = $objFeed->obtener(array(
            'id' => $request['id']
        ));
        return view('ajustes.formfeed', compact('data'));
    }
    public function pano360(Request $request)
    {

        $objPanoramica = new Ajustes();
        $data = $objPanoramica->obtener(array(
            'id' => $request['id']
        ));
        return view('ajustes.formpanoramica', compact('data'));
    }

    public function logoleft(Request $request)
    {

        $objFeed = new Ajustes();
        $data = $objFeed->obtener(array(
            'id' => $request['id']
        ));
        return view('ajustes.formleft', compact('data'));
    }

    public function logoright(Request $request)
    {

        $objFeed = new Ajustes();
        $data = $objFeed->obtener(array(
            'id' => $request['id']
        ));
        return view('ajustes.formright', compact('data'));
    }
    public function logoprincipal(Request $request)
    {

        $objFeed = new Ajustes();
        $data = $objFeed->obtener(array(
            'id' => $request['id']
        ));
        return view('ajustes.formlogo', compact('data'));
    }

    public function organigrama(Request $request)
    {

        $objFeed = new Ajustes();
        $lista2 = $objFeed->listar_feed();

        return view('organigrama.home', compact('lista2'));
    }



    public function colorheader(Request $request)
    {

        $objFeed = new Ajustes();
        $data = $objFeed->obtener(array(
            'id' => $request['id']
        ));
        return view('ajustes.formheader', compact('data'));
    }

    public function colortop(Request $request)
    {

        $objFeed = new Ajustes();
        $data = $objFeed->obtener(array(
            'id' => $request['id']
        ));
        return view('ajustes.formtopbar', compact('data'));
    }
    public function colorfooter(Request $request)
    {

        $objFeed = new Ajustes();
        $data = $objFeed->obtener(array(
            'id' => $request['id']
        ));
        return view('ajustes.formfootercolor', compact('data'));
    }
    public function organigrama_institucional(Request $request)
    {

        $objFeed = new Ajustes();
        $data = $objFeed->obtener(array(
            'id' => $request['id']
        ));
        return view('organigrama.form', compact('data'));
    }

    public function store(Request $request)
    {

        $response = array();

        try {
            
            $objFeed = new Ajustes();

            $params = array(
                'feed' => $request['feed'],
                'feed_ingles' => $request['feed_ingles'],
                'ubicacion' => $request['ubicacion']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objFeed->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objFeed->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }

    public function store_left(Request $request)
    {

        $response = array();

        try {
            
            $objFeed = new Ajustes();

            $params = array(

                'estado' => $request['estado']

            );

            if ($request->hasFile('img1')) {
                $adjunto = $request->file('img1');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "institucionalleft_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/institucional'), $fileName);
                $params['img1'] = "/archivos/institucional/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objFeed->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objFeed->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function store_right(Request $request)
    {

        $response = array();

        try {
            
            $objFeed = new Ajustes();
            $params = array(

                'estado1' => $request['estado1']

            );

            if ($request->hasFile('img2')) {
                $adjunto2 = $request->file('img2');
                $extension2 = $adjunto2->getClientOriginalExtension();
                $fileName2 = "institucionalright_" . date('ymdhis') . "." . $extension2;
                $adjunto2->move(base_path('archivos/institucional1'), $fileName2);
                $params['img2'] = "/archivos/institucional1/" . $fileName2;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objFeed->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objFeed->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }

    public function store_principal(Request $request)
    {

        $response = array();

        try {
            
            $objFeed = new Ajustes();
            $params = array(

                'estado2' => $request['estado2'],
                'url' => $request['url']

            );

            if ($request->hasFile('img3')) {
                $adjunto3 = $request->file('img3');
                $extension3 = $adjunto3->getClientOriginalExtension();
                $fileName3 = "logo_" . date('ymdhis') . "." . $extension3;
                $adjunto3->move(base_path('archivos/logo'), $fileName3);
                $params['img3'] = "/archivos/logo/" . $fileName3;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objFeed->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objFeed->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }

        public function store_organigrama(Request $request)
    {

        $response = array();

        try {
            
            $objFeed = new Ajustes();


            if ($request->hasFile('organigrama')) {
                $adjunto4 = $request->file('organigrama');
                $extension4 = $adjunto4->getClientOriginalExtension();
                $fileName4 = "organigrama_" . date('ymdhis') . "." . $extension4;
                $adjunto4->move(base_path('archivos/organigrama'), $fileName4);
                $params['organigrama'] = "/archivos/organigrama/" . $fileName4;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objFeed->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objFeed->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function store_colorheader(Request $request)
    {

        $response = array();

        try {
            
            $objFeed = new Ajustes();

            $params = array(
                'colorh' => $request['colorh']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objFeed->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objFeed->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function store_colortop(Request $request)
    {

        $response = array();

        try {
            
            $objFeed = new Ajustes();

            $params = array(
                'colort' => $request['colort']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objFeed->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objFeed->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function store_footerlogo(Request $request)
    {

        $response = array();

        try {
            
            $objFeed = new Ajustes();
            $params = array(

                'estado3' => $request['estado3']

            );

            if ($request->hasFile('img4')) {
                $adjunto5 = $request->file('img4');
                $extension5 = $adjunto5->getClientOriginalExtension();
                $fileName5 = "footerlogo_" . date('ymdhis') . "." . $extension5;
                $adjunto5->move(base_path('archivos/footer'), $fileName5);
                $params['img4'] = "/archivos/footer/" . $fileName5;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objFeed->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objFeed->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function store_colorfooter(Request $request)
    {

        $response = array();

        try {
            
            $objFeed = new Ajustes();

            $params = array(
                'colorf' => $request['colorf']
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objFeed->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objFeed->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }
            }
        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }

    public function store_panoramica(Request $request)
    {

        $response = array();

        try {
            
            $objPanoramica = new Ajustes();


            if ($request->hasFile('panoramica')) {
                $adjunto6 = $request->file('panoramica');
                $extension6 = $adjunto6->getClientOriginalExtension();
                $fileName6 = "panoramica_" . date('ymdhis') . "." . $extension6;
                $adjunto6->move(base_path('archivos/panoramica'), $fileName6);
                $params['panoramica'] = "/archivos/panoramica/" . $fileName6;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objPanoramica->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objPanoramica->insertar($params);
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
