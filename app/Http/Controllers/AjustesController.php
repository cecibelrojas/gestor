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

    public function feed(Request $request)
    {

         $objFeed = new Ajustes();
        $data = $objFeed->obtener(array(
            'id' => $request['id']
        ));
        return view('ajustes.formfeed', compact('data'));
    }

    public function store(Request $request)
    {

        $response = array();

        try {
            
            $objFeed = new Ajustes();

            $params = array(
                'feed' => $request['feed'],
                'ubicacion' => $request['ubicacion']
            );

            if ($request->hasFile('img1')) {
                $adjunto = $request->file('img1');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "institucionalleft_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/institucional'), $fileName);
                $params['img1'] = "/archivos/institucional/" . $fileName;
            }

            if ($request->hasFile('img2')) {
                $adjunto2 = $request->file('img2');
                $extension2 = $adjunto2->getClientOriginalExtension();
                $fileName2 = "institucionalright_" . date('ymdhis') . "." . $extension2;
                $adjunto2->move(base_path('archivos/institucional1'), $fileName2);
                $params['img2'] = "/archivos/institucional1/" . $fileName2;
            }
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
}
