<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\BancoDatosDet;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objTeam = new Team();
        $lista = $objTeam->listar();

        return view('team.index', compact('lista'));
    }

    public function equipo(Request $request)
    {

        $objTeam = new Team();
        $objBancoDatosDet = new BancoDatosDet();
        $entidades = $objBancoDatosDet->listar(array(
            'id' => '002'
        ));
        $data = $objTeam->obtener(array(
            'id' => $request['id']
        ));
        return view('team.form', compact('data', 'entidades'));
    }


    public function listar(Request $request)
    {
        $objTeam = new Team();
        $listado = $objTeam->listar();
        $tags = array();
        if (count($listado) > 0) {
            foreach ($listado as $key) {
                array_push($tags, $key['codigo']);
            }
        }
        return $tags;
    }

    public function store(Request $request)
    {

        $response = array();

        try {
            $objTeam = new Team();

            $params = array(
                'nombre' => $request['nombre'],
                'abreviatura' => $request['abreviatura'],
                'entidad' => $request['entidad'],
                'ciudad' => $request['ciudad'],
                'sede' => $request['sede']
            );

            if ($request->hasFile('logo')) {
                $adjunto = $request->file('logo');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fototeam_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/teams'), $fileName);
                $params['logo'] = "/archivos/teams/" . $fileName;
            }

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objTeam->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objTeam->insertar($params);
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
            $objTeam = new Team();
            $insert = $objTeam->eliminar(array(
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
