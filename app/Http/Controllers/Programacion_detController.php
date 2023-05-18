<?php

namespace App\Http\Controllers;

use App\Models\BancoDatosDet;
use App\Models\Programacion;
use App\Models\ProgramacionDet;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

class Programacion_detController extends Controller
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

        if (count($programaciones) > 0) {
            foreach ($programaciones as $index => $key) {

                $detalles = $objProgramacionDet->listar(array(
                    'id' => $key['id']
                ));

                $programaciones[$index]['detalles'] = $detalles;
            }
        }

        return view('resultados.index', compact('programaciones'));
    }

        public function updatescoreresult(Request $request)
    {
        $objProgramacionDet = new ProgramacionDet();
        $objProgramacionDet->actualizar(array(
            $request->field => $request->valor
        ), array('id' => $request->id,
                 'item' => $request->item,  
                    ));
    }
}
