<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Galerias;
use App\Models\Categoria_galerias;
use Exception;
use Illuminate\Http\Request;

class GaleriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objGalerias = new Galerias();
        
        $params = array();

        if (isset($_GET['nombre'])) {
            $params['nombre'] = $_GET['nombre'];
        }

        $lista = $objGalerias->listar();

        return view('galerias.fotografias', compact('lista'));
    }

    public function fotografia(Request $request)
    {

        $objCategoriaccs = new Categoria_galerias();

        $objGalerias = new Galerias();
        $data = $objGalerias->obtener(array(
            'id' => $request['id']
        ));

        $categorias = $objCategoriaccs->listar();
        
        return view('galerias.form_fotografia', compact('data','categorias'));
    }
   
    public function store(Request $request)
    {

        $response = array();

        try {
            $objGalerias = new Galerias();

            $params = array(
                'titulo' => $request['titulo'],
                'titulo_ingles' => $request['titulo_ingles'],
                'categoria' => $request['categoria'],
                'autor' => $request['autor'],
                'descripcion' => $request['descripcion'],
                'descripcion_ingles' => $request['descripcion_ingles']
            );

            if ($request->hasFile('foto')) {
                $adjunto = $request->file('foto');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotogaleria_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/fotogaleria'), $fileName);
                $params['foto'] = "/archivos/fotogaleria/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objGalerias->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objGalerias->insertar($params);
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
            $objGalerias = new Galerias();
            $insert = $objGalerias->eliminar(array(
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
