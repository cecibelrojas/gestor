<?php

namespace App\Http\Controllers;

use App\Models\BancoDatos;
use App\Models\Ajustes;
use App\Models\Productolog;
use Exception;
use Illuminate\Http\Request;

class ProductologController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin')->except('');
    }

    public function guardar(Request $request)
    {
        $response = array();
        $objLog = new Productolog();

        try {
            $params = array(
                'producto'=>$request['producto'],
                'usuario_id'=>auth()->user()->id,
                'fecha'=>date('Y-m-d H:i:s'),
                'nombre'=>$request['nombre'],
                'nombre_ingles'=>$request['nombre_ingles'],
                'descripcion'=>$request['descripcion'],
                'descripcion_ingles'=>$request['descripcion_ingles'],
                'estado'=>$request['estado'],
                'precio'=>$request['precio'],
                'categoria'=>$request['categoria'],
                'usureg'=>$request['usureg'],
                'usumod'=>$request['usumod'],
                'precio_ant'=>$request['precio_ant'],
                'extra'=>$request['extra'],
                'extradesc'=>$request['extradesc'],
                'moneda'=>$request['moneda'],
                'imgdestacado'=>$request['imgdestacado'],
                'imageredes'=>$request['imageredes'],
                'trailer'=>$request['trailer'],
                'preview'=>$request['preview'],
                'stock'=>$request['stock'],
                'encargado'=>$request['encargado'],
                'duracion'=>$request['duracion'],
                'certificado'=>$request['certificado'],
                'nivel'=>$request['nivel'],
                'widget'=>$request['widget'],
                'sumario'=>$request['sumario'],
                'sumario_ingles'=>$request['sumario_ingles'],
                'id_parroquia'=>$request['id_parroquia'],
                'etiquetas'=>$request['etiquetas'],
                'fecini'=>$request['fecini'],
                'fecfin'=>$request['fecfin'],
                'fotovisible'=>$request['fotovisible'],
                'orden'=>$request['orden'],
                'trabajando'=>$request['trabajando'],
                'papelera'=>$request['papelera'],
                'nombre_autor'=>$request['nombre_autor'],
                'fecha_destacado'=>$request['fecha_destacado'],
                'programable'=>$request['programable']

            );    

            //consultar el numero de registros en log del producto maximo 5
            $listado = $objLog->listar(array(
                'producto'=>$request['producto'],
                'usuario_id'=>auth()->user()->id
             ));   
            if(count($listado) <= 5){
                $objLog->insertar($params);
            }else{
                throw new Exception("Ha alcanzado el número de intentos");
            }
            
            
        } catch (Exception $e) {
            $response['error_log'] = $e->getMessage();
        }
        

       return $response;
    }
}
