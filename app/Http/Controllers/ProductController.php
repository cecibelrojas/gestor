<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Parroquias;
use App\Models\Producto;
use App\Models\ProductoMultimedia;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //   $this->middleware('admin')->except('');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $objProducto = new Producto();

        $params = array();

        if (isset($_GET['nombre'])) {
            $params['nombre'] = $_GET['nombre'];
        }

        $lista = $objProducto->listar($params);

        $trash = $objProducto->listar(array(
            'papelera' => array('P')
        ));

        return view('product.index', compact('lista','trash'));
    }

    public function papelera_total(Request $request)
    {

        $objProducto = new Producto();

        $params = array();

        if (isset($_GET['nombre'])) {
            $params['nombre'] = $_GET['nombre'];
        }
        
        $lista = $objProducto->listar($params);

        $trash = $objProducto->listar(array(
            'papelera' => array('P')
        ));

        return view('product.papelera_publicaciones', compact('lista','trash'));
    }

    public function producto($id = null)
    {
        $objCategorias = new Categoria();
        $objProducto = new Producto();
        $objProductoMultimedia = new ProductoMultimedia();
        $objTags = new Tags();
        $objParroquias = new Parroquias();

        /* Ocupacion del producto */
        if ($id != null) {
            //Quita al usuario de todos los productos que tenga ocupado
            $objProducto->actualizar(array('trabajando' => null), array('trabajando' => auth()->user()->id));

            //Pregunto si el producto esta ocupado
            $ocupacion = $objProducto->obtener(array('id' => $id));

            //Ocupa este producto con el usuario
            if (empty($ocupacion['trabajando'])) {
                $objProducto->actualizar(array('trabajando' => auth()->user()->id), array('id' => $id));
            } else {
                return redirect('publicaciones')->with(array('mensaje' => 'La publicación esta siendo editada por el usuario ' . $ocupacion['escritor']));
            }
        }

        if ($id != null) {
            //Quita al usuario de todos los productos que tenga ocupado
            $objProducto->actualizar(array('trabajando' => null), array('trabajando' => auth()->user()->id));

            //Pregunto si el producto esta ocupado
            $ocupacion = $objProducto->obtener(array('id' => $id));

            //Ocupa este producto con el usuario
            if (empty($ocupacion['trabajando'])) {
                $objProducto->actualizar(array('trabajando' => auth()->user()->id), array('id' => $id));
            } else {
                return redirect('publicaciones')->with(array('mensaje' => 'La publicación esta siendo editada por el usuario ' . $ocupacion['escritor']));
            }
        }


        $data = array();
        $imagenes = array();
        $videos = array();
        $documentos = array();

        if ($id != null) {
            $data = $objProducto->obtener(array('id' => $id));
            $imagenes = $objProductoMultimedia->listar(array('id' => $id, 'tipo' => 'I'));
            $videos = $objProductoMultimedia->listar(array('id' => $id, 'tipo' => 'V'));
            $documentos = $objProductoMultimedia->listar(array('id' => $id, 'tipo' => 'F'));
            if (!$data) {
                return redirect('/publicacion');
            }
        }


        $etiquetas = $objTags->listar();
        $categorias = $objCategorias->listar();
        $parroquias = $objParroquias->listar(array(
            'id_municipio' => 462
        ));

        return view('product.producto', compact('data', 'id', 'categorias', 'imagenes', 'videos', 'documentos', 'etiquetas', 'parroquias'));
    }
    public function desocupar()
    {
        $objProducto = new Producto();
        $objProducto->actualizar(array('trabajando' => null), array('trabajando' => auth()->user()->id));
    }

    public function verificarocupacion(Request $request)
    {
        $objProducto = new Producto();
        $response = 'S';

        $producto = $objProducto->obtener(array(
            'id' => $request->id
        ));

        if ($producto->trabajando != auth()->user()->id) {
            $response = 'N';
        }

        return $response;
    }

    public function ocupar(Request $request)
    {
        $objProducto = new Producto();
        $response = array();

        $objProducto->actualizar(array(
            'trabajando' =>  auth()->user()->id,
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }

    public function obtenermultimedia(Request $request)
    {

        $objProductoMultimedia = new ProductoMultimedia();
        $id = $request->producto;
        $data = $objProductoMultimedia->listar(array('id' => $id, 'tipo' => $request->tipo));

        switch ($request->tipo) {
            case 'I':
                $partial = 'product._partial.imagenes';
                break;
            case 'V':
                $partial = 'product._partial.videos';
                break;
            case 'F':
                $partial = 'product._partial.documentos';
                break;
        }


        return view($partial, compact('data', 'id'));
    }

    public function create(Request $request)
    {
        $objProducto = new Producto();

        if (!empty($request->estdestacado)) {
            $request->merge(['estdestacado' => 'S']);
        } else {
            $request->merge(['estdestacado' => 'N']);
        }

        if (!empty($request->fotovisible)) {
            $request->merge(['fotovisible' => 'S']);
        } else {
            $request->merge(['fotovisible' => 'N']);
        }



        if ($request->hasFile('destacado')) {
            $adjunto = $request->file('destacado');
            $extension = $adjunto->getClientOriginalExtension();
            $fileName = "productodestacado" . date('ymdhis') . "." . $extension;
            $adjunto->move(base_path('archivos/imagenes'), $fileName);
            $adjuntoFileName = $fileName;
            $request->request->add(array('imgdestacado' => $adjuntoFileName));
        }

        if ($request->hasFile('docpreview')) {
            $adjunto2 = $request->file('docpreview');
            $extension2 = $adjunto2->getClientOriginalExtension();
            $fileName2 = "preview" . date('ymdhis') . "." . $extension2;
            $adjunto2->move(base_path('archivos/imagenes'), $fileName2);
            $adjuntoFileName2 = $fileName2;
            $request->request->add(array('preview' => $adjuntoFileName2));
        }

        if ($request->hasFile('doctrailer')) {
            $adjunto3 = $request->file('doctrailer');
            $extension3 = $adjunto3->getClientOriginalExtension();
            $fileName3 = "trailer" . date('ymdhis') . "." . $extension3;
            $adjunto3->move(base_path('archivos/videos'), $fileName3);
            $adjuntoFileName3 = $fileName3;
            $request->request->add(array('trailer' => $adjuntoFileName3));
        }

        if (isset($request->id) && !empty($request->id)) {
            $id = $request->id;
            $request->request->add(array('usumod' => auth()->user()->id));
            $request->request->remove('id');
            $request->request->remove('_token');
            $request = $request->all();
            unset($request['destacado']);
            unset($request['docpreview']);
            unset($request['doctrailer']);
            $objProducto->actualizar($request, array('id' => $id));
            return redirect()->back();
        } else {
            $request->request->add(array('usureg' => auth()->user()->id));
            //dd($request->all());      
            $id = $objProducto->insertar($request->all());
            return redirect('/publicacion/' . $id);
        }
    }


    public function uploadblob(Request $request)
    {
        $response = array();

        if ($request->hasFile('archivo')) {
            $adjunto = $request->file('archivo');
            $extension = $adjunto->getClientOriginalExtension();
            $fileName = "fileblob" . date('ymdhis') . "." . $extension;
            $move = (isset($request->id) && !empty($request->id)) ? base_path('archivos/imagenes/' . $request->id) : base_path('archivos/imagenes/blobs');
            $adjunto->move($move, $fileName);
            $response['ruta'] = (isset($request->id) && !empty($request->id))  ? asset('/archivos/imagenes/' . $request->id . '/' . $fileName) : asset('/archivos/imagenes/blobs/' . $fileName);
        }

        return $response;
    }

    public function delete(Request $request)
    {
        $objProducto = new Producto();
        $response = array(
            'status' => 'N',
        );

        $delete = $objProducto->eliminar(array('id' => $request->id));

        if ($delete) {
            $response['status'] = 'S';
        }

        return $response;
    }


    public function deshabilitar(Request $request)
    {
        $objProducto = new Producto();
        $response = array();

        $objProducto->actualizar(array(
            'papelera' =>  'P',
            'estado' =>  'I',
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }
    
    public function restaurar(Request $request)
    {
        $objProducto = new Producto();
        $response = array();

        $objProducto->actualizar(array(
            'papelera' =>  Null,
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }


    public function deleteimage(Request $request)
    {
        $objProducto = new Producto();
        $response = array(
            'status' => 'S',
        );

        $objProducto->actualizar(array('imgdestacado' => null), array('id' => $request->id));

        return $response;
    }

    public function deletevideo(Request $request)
    {
        $objProducto = new Producto();
        $response = array(
            'status' => 'S',
        );

        $objProducto->actualizar(array('trailer' => null, 'preview' => null), array('id' => $request->id));

        return $response;
    }

    public function cambiarestado(Request $request)
    {
        $objProducto = new Producto();
        $response = array(
            'status' => 'S',
        );

        $objProducto->actualizar(array(
            'estado' => $request['estado'],
            'usumod' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ), array('id' => $request->id));

        return $response;
    }




    public function deletefile(Request $request)
    {
        $objProductoMultimedia = new ProductoMultimedia();
        $response = array(
            'status' => 'N',
        );

        $delete = $objProductoMultimedia->eliminar(array('id' => $request->id));

        if ($delete) {
            $response['status'] = 'S';
        }


        switch ($request->tipo) {
            case 'I':
                $response['data'] = $objProductoMultimedia->listar(array('id' => $request->id, 'tipo' => 'I'));
                break;
            case 'V':
                $response['data'] = $objProductoMultimedia->listar(array('id' => $request->id, 'tipo' => 'V'));
                break;
            case 'F':
                $response['data'] = $objProductoMultimedia->listar(array('id' => $request->id, 'tipo' => 'F'));
                break;
        }


        return $response;
    }

    public function updatefile(Request $request)
    {
        $objProductoMultimedia = new ProductoMultimedia();

        $params = array();

        if (isset($request->exclusivo)) {
            $params['exclusivo'] = $request->exclusivo;
        }

        if ($request->hasFile('adjunto')) {
            $adjunto = $request->file('adjunto');
            $extension = $adjunto->getClientOriginalExtension();
            $fileName = "archivoproducto" . date('ymdhis') . "." . $extension;
            $adjunto->move(base_path('archivos/videos/' . $request->producto_id), $fileName);
            $adjuntoFileName = $fileName;
            $params['preview'] = $adjuntoFileName;
            $params['extension'] = $extension;
        }

        $update = $objProductoMultimedia->actualizar($params, array('id' => $request->id));

        return $update;
    }

    public function upload(Request $request)
    {
        $objProductoMultimedia = new ProductoMultimedia();

        $response = array(
            'status' => 'N'
        );

        $params = array(
            'producto_id' => $request->id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'orden' => $request->orden,
            'tipo' => $request->tipo,
            'estado' => $request->estado,
            'exclusivo' => $request->exclusivo,
            'usureg' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        );

        switch ($request->tipo) {
            case 'I':
                $direction = 'imagenes';
                break;
            case 'V':
                $direction = 'videos';
                break;
            case 'F':
                $direction = 'documentos';
                break;
        }

        if ($direction != '') {
            if ($request->hasFile('adjunto')) {
                $adjunto = $request->file('adjunto');
                $extension = $adjunto->getClientOriginalExtension();
                $fileName = "archivoproducto" . date('ymdhis') . "." . $extension;
                $adjunto->move(base_path('archivos/' . $direction . '/' . $request->id), $fileName);
                $adjuntoFileName = $fileName;
                $params['archivo'] = $adjuntoFileName;
                $params['extension'] = $extension;
                $params['originalname'] = $adjunto->getClientOriginalName();
            }
        }

        if (!isset($request->uid) || empty($request->uid)) {
            $id = $objProductoMultimedia->insertar($params);
        } else {
            $id = $objProductoMultimedia->actualizar($params, array('id' => $request->uid, 'producto_id' => $request->id));
        }

        if ($id) {
            $response['id'] = $id;
            $response['status'] = 'S';
        }

        switch ($request->tipo) {
            case 'I':
                $response['data'] = $objProductoMultimedia->listar(array('id' => $request->id, 'tipo' => 'I'));
                break;
            case 'V':
                $response['data'] = $objProductoMultimedia->listar(array('id' => $request->id, 'tipo' => 'V'));
                break;
            case 'F':
                $response['data'] = $objProductoMultimedia->listar(array('id' => $request->id, 'tipo' => 'F'));
                break;
        }

        return $response;
    }


    public function cargararchivomasivos(Request $request)
    {

        $response = array(
            'status' => 'S'
        );

        $direction = 'imagenes';

        if ($direction != '') {
            if ($request->imagenes) {
                $adjunto = $request->file('imagenes');
                foreach ($adjunto as $index => $file) {

                    $objProductoMultimedia = new ProductoMultimedia();
                    $objProductoMultimedia->producto_id = $request->id;
                    $objProductoMultimedia->tipo = 'I';
                    $objProductoMultimedia->estado = 'A';
                    $objProductoMultimedia->exclusivo = 'N';
                    $objProductoMultimedia->usureg = auth()->user()->id;
                    $objProductoMultimedia->created_at = date('Y-m-d H:i:s');

                    $extension = $file->getClientOriginalExtension();
                    $fileName = "archivoproducto" . $index . "_" . date('ymdhis') . "." . $extension;
                    $file->move(base_path('archivos/' . $direction . '/' . $request->id), $fileName);
                    $adjuntoFileName = $fileName;
                    $objProductoMultimedia->titulo = "Imagen " . ($index + 1);
                    $objProductoMultimedia->archivo = $adjuntoFileName;
                    $objProductoMultimedia->extension = $extension;
                    $objProductoMultimedia->originalname = $file->getClientOriginalName();

                    $objProductoMultimedia->save();
                }
            }
        }

        return $response;
    }


    public function obtenervideo(Request $request)
    {
        $objProductoMultimedia = new ProductoMultimedia();

        $video = $objProductoMultimedia->obtener(array('id' => $request->id));

        return view('product.video', compact('video'));
    }
}
