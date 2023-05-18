<?php

namespace App\Http\Controllers;

use App\Models\BancoDatosDet;
use App\Models\Programacion;
use App\Models\ProgramacionDet;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

class ProgramacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $objProgramacion = new Programacion();
        $objProgramacionDet = new ProgramacionDet();

        $programaciones = $objProgramacion->listar(array(
            'entidad' => 'BEI'
        ));

        foreach ($programaciones as $index => $key) {
            $local = $objProgramacionDet->obtener(array(
                'id' => $key['id'],
                'casa' => 'S'
            ));
            $visitor = $objProgramacionDet->obtener(array(
                'id' => $key['id'],
                'casa' => 'N'
            ));

            $programaciones[$index]['titulo2'] = $local['abreviatura'] . " - " . $visitor['abreviatura'];
        }

        return view('programacion.index', compact('programaciones'));
    }

    public function evento(Request $request)
    {
        $objBancoDatosDet = new BancoDatosDet();
        $objProgramacion = new Programacion();
        $objProgramacionDet = new ProgramacionDet();

        $data = null;

        if (isset($request->id) && !empty($request->id)) {
            $data = $objProgramacion->obtener(array('id' => $request->id));
            $local = $objProgramacionDet->obtener(array(
                'id' => $request->id,
                'casa' => 'S'
            ));
            $visitor = $objProgramacionDet->obtener(array(
                'id' => $request->id,
                'casa' => 'N'
            ));
            $data['local'] = $local;
            $data['visitor'] = $visitor;
        }

        $entidades = $objBancoDatosDet->listar(array(
            'id' => '002'
        ));

        $id = $request->id;
        $fecha = $request->fecha;
        $entidad = $request->entidad;

        return view('programacion.evento', compact('data', 'entidades', 'fecha', 'entidad', 'id'));
    }

    public function teams(Request $request)
    {
        $objteam = new Team();
        $teams = $objteam->listar(array(
            'entidad' => $request->entidad
        ));

        return view('programacion.teams', compact('teams'));
    }

    public function store(Request $request)
    {
        $objProgramacion = new Programacion();

        $id = $objProgramacion->insertar(array(
            'titulo' => $request->titulo,
            'entidad' => $request->entidad,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'lugar' => $request->lugar,
            'sede' => $request->sede,
            'estado' => 'A',
            'usureg' => auth()->user()->id
        ));

        $teams = json_decode($request->teams);
        if (count($teams) > 0) {
            foreach ($teams as $key) {
                $objProgramacionDet = new ProgramacionDet();
                $objProgramacionDet->insertar(array(
                    'id' => $id,
                    'item' => $objProgramacionDet->obtenerItem($id),
                    'team' => $key->team,
                    'casa' => $key->casa,
                    'usureg' => auth()->user()->id
                ));
            }
        }
    }

    public function delete(Request $request)
    {

        $response = array();

        try {
            $objProgramacion = new Programacion();
            $insert = $objProgramacion->eliminar(array(
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
