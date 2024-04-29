<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BancoDatos;
use App\User;
use Mail;
use App\Mail\Usuarios;
use Illuminate\Support\Facades\Hash;
use Exception;


class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
      
    }
    public function index()
    {
        $objUsers = new User();
        $lista = $objUsers->listar();

        return view('usuarios.index', compact('lista'));
    }

    public function usuario(Request $request)
    {

        $objUsers = new User();
        $data = array();
        if (isset($request['id']) && !empty($request['id'])) {
            $data = $objUsers->obtener(array(
                'id' => $request['id']
            ));
        }

        return view('usuarios.form', compact('data'));
    }

    public function usuario_contrasena(Request $request)
    {

        $objUsers = new User();
        $data = $objUsers->obtener(array(
            'id' => $request['id']
        ));
        return view('usuarios.form_contrasena', compact('data'));
    }
    public function usuario_contrasena_extrerna(Request $request)
    {

        $objUsers = new User();
        $data = $objUsers->obtener(array(
            'id' => $request['id']
        ));
        return view('usuarios.cambio_contrasena', compact('data'));
    }

    public function store(Request $request)
    {
        $response = array();

        try {
            $objUsers = new User();

            $params = array(
                'name' => $request['name'],
                'email' => $request['email'],
                'telefono' => $request['telefono'],                
                'rol' => $request['rol'],
                'estado' => $request['estado'],
                'password' => bcrypt($request->password),
            );
            if ($request->hasFile('foto')) {
                $adjunto = $request->file('foto');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "fotoperfil_" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/perfil'), $fileName);
                $params['foto'] = "/archivos/perfil/" . $fileName;
            }            
            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                unset($params['password']);
                $update = $objUsers->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $insert = $objUsers->insertar($params);
                if (!is_numeric($insert)) {
                    throw new Exception($insert);
                }



            }
        Mail::send('emails.usuarios', array('key' => 'value'), function($message)
        {
            $message->to('rojascecibel@gmail.com', 'Sender Name')->subject('Welcome!');
        });

        } catch (\Exception $e) {
            $response['errorMessage'] = $e->getMessage();
        }

        return $response;
    }
    public function store_contrasena(Request $request)
    {
        $response = array();

        try {
            $objUsers = new User();

            $params = array(
                'password' => (bcrypt($request['password']))
            );

            if (isset($request['id']) && !empty($request['id'])) {
                $params['usumod'] = auth()->user()->id;
                $params['updated_at'] = date('Y-m-d H:i:s');
                $update = $objUsers->actualizar($params, array('id' => $request['id']));
                if (!is_numeric($update)) {
                    throw new Exception($update);
                }
            } else {
                $params['usureg'] = auth()->user()->id;
                $params['created_at'] = date('Y-m-d H:i:s');
                $insert = $objUsers->insertar($params);
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
            $objUsers = new User();
            $insert = $objUsers->eliminar(array(
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
