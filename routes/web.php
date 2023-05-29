<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//GET
Route::get('/', 'HomeController@index');
Route::get('/bancodatos', 'BancoDatosController@index');
Route::get('/etiquetas', 'TagsController@index');
Route::get('/widgets', 'WidgetsController@index');
Route::get('/usuarios', 'UsuariosController@index');
Route::get('/categorias', 'CategoryController@index');
Route::get('/publicaciones', 'ProductController@index');
Route::get('/publicacion/{id?}', 'ProductController@producto');
Route::get('/impresos', 'ImpresosController@index');
Route::get('/libros', 'ImpresosController@libros');
Route::get('/videos', 'VideosController@index');
Route::get('/waika', 'WaikaController@index');
Route::get('/campanas', 'CampanasController@index');
Route::get('/campanasvideos', 'CampanasVideosController@index');
Route::get('/medios', 'MediosController@index');
Route::get('/categoria_galerias', 'Categoria_galeriasController@index');
Route::get('/fotografias', 'GaleriasController@index');
Route::get('/avisos', 'AvisosController@index');
Route::get('/papelera_publicaciones', 'ProductController@papelera_total');
Route::get('/usuario-contrasena_individual/{id?}', 'UsuariosController@usuario_contrasena_extrerna');
Route::get('/obituarios', 'ObituariosController@index');

//POST
Route::post('/cabecera', 'BancoDatosController@cabecera');
Route::post('/detalle', 'BancoDatosController@detalle');
Route::post('/etiqueta', 'TagsController@etiqueta');
Route::post('/guardar-etiqueta', 'TagsController@store');
Route::post('/eliminar-etiqueta', 'TagsController@delete');
Route::get('/listar-tags', 'TagsController@listar');

Route::post('/usuario', 'UsuariosController@usuario');
Route::post('/guardar-usuario', 'UsuariosController@store');
Route::post('/eliminar-usuario', 'UsuariosController@delete');
Route::post('/usuario-contrasena', 'UsuariosController@usuario_contrasena');
Route::post('/guardar-contrasena', 'UsuariosController@store_contrasena');

Route::post('/categoria', 'CategoryController@categoria');
Route::post('/guardarcategoria', 'CategoryController@store');
Route::post('/eliminarcategoria', 'CategoryController@delete');

Route::post('/guardarproducto', 'ProductController@create');
Route::post('/eliminarproducto', 'ProductController@delete');
Route::post('/eliminarimagen', 'ProductController@deleteimage');
Route::post('/eliminarvideo', 'ProductController@deletevideo');
Route::post('/cargararchivo', 'ProductController@upload');
Route::post('/cargararchivomasivos', 'ProductController@cargararchivomasivos');
Route::post('/eliminarmultimedia', 'ProductController@deletefile');
Route::post('/actualizarmultimedia', 'ProductController@updatefile');
Route::post('/obtenervideo', 'ProductController@obtenervideo');
Route::post('/obtenermultimedia', 'ProductController@obtenermultimedia');
Route::post('/cambiarestado', 'ProductController@cambiarestado');
Route::post('/uploadblob', 'ProductController@uploadblob');
Route::post('/desocupar', 'ProductController@desocupar');
Route::post('/ocupar', 'ProductController@ocupar');
Route::post('/verificar-ocupacion', 'ProductController@verificarocupacion');
Route::post('/deshabilitar', 'ProductController@deshabilitar');
Route::post('/restaurar-pub', 'ProductController@restaurar');

Route::post('/impreso', 'ImpresosController@impreso');
Route::post('/guardar-impreso', 'ImpresosController@store');
Route::post('/eliminar-impreso', 'ImpresosController@delete');
Route::post('/impreso_cuentos', 'ImpresosController@impreso_cuentos');
Route::post('/impreso_especulador', 'ImpresosController@impreso_especulador');
Route::post('/impreso_especiales', 'ImpresosController@impreso_especiales');

Route::post('/video', 'VideosController@video');
Route::post('/guardar-video', 'VideosController@store');
Route::post('/eliminar-video', 'VideosController@delete');

Route::post('/waika_feminista', 'WaikaController@waika');
Route::post('/guardar-waika', 'WaikaController@store');
Route::post('/eliminar-waika', 'WaikaController@delete');

Route::post('/mancheta_etten', 'EttenController@etten');
Route::post('/guardar-etten', 'EttenController@store');
Route::post('/eliminar-etten', 'EttenController@delete');

/**
 * Rutas para Eventos Rápidos
 */

Route::post('/bancodatos-cabeceras', 'BancoDatosController@listarcabeceras');
Route::post('/bancodatos-detalles', 'BancoDatosController@listardetalles');
Route::post('/bancodatos-cabecera', 'BancoDatosController@cabecera');
Route::post('/guardar-cabecera', 'BancoDatosController@store');
Route::post('/eliminar-cabecera', 'BancoDatosController@delete');
Route::post('/bancodatos-detalle', 'BancoDatosController@detalle');
Route::post('/guardar-detalle', 'BancoDatosController@store2');
Route::post('/eliminar-detalle', 'BancoDatosController@delete2');

Route::post('/widgets-cabeceras', 'WidgetsController@listarcabeceras');
Route::post('/widgets-detalles', 'WidgetsController@listardetalles');
Route::post('/widgets-cabecera', 'WidgetsController@cabecera');
Route::post('/guardar-widget', 'WidgetsController@store');
Route::post('/eliminar-widget', 'WidgetsController@delete');
Route::post('/widgets-detalle', 'WidgetsController@detalle');
Route::post('/guardar-widget-publicacion', 'WidgetsController@store2');
Route::post('/eliminar-widget-publicacion', 'WidgetsController@delete2');


Route::post('/categoria_galeria', 'Categoria_galeriasController@categoria_ccs');
Route::post('/guardarcategoriagaleria', 'Categoria_galeriasController@store');
Route::post('/eliminarcategoriagaleria', 'Categoria_galeriasController@delete');


Route::post('/medio', 'MediosController@medios');
Route::post('/guardar-medio', 'MediosController@store');
Route::post('/eliminar-medio', 'MediosController@delete');
Route::get('/listar-medio', 'MediosController@listar');

Route::post('/fotografia', 'GaleriasController@fotografia');
Route::post('/guardarfotogaleria', 'GaleriasController@store');
Route::post('/eliminarfotogaleria', 'GaleriasController@delete');

Route::post('/aviso', 'AvisosController@aviso');
Route::post('/guardaraviso', 'AvisosController@store');
Route::post('/eliminaraviso', 'AvisosController@delete');

Route::post('/trabajando_ocupar', 'ProductController@trabajando_cambiado');
Route::post('/guardar-trabajando', 'ProductController@store_trabajando');

Route::post('/obituario', 'ObituariosController@obituario');
Route::post('/guardarobituario', 'ObituariosController@store');
Route::post('/eliminarobituario', 'ObituariosController@delete');

Route::post('/campanasvideos', 'CampanasVideosController@campanasvideos');
Route::post('/guardarcvideos', 'CampanasVideosController@store');
Route::post('/eliminarcvideos', 'CampanasVideosController@delete');

Route::post('/campanas', 'CampanasController@campanas');
Route::post('/guardarcampana', 'CampanasController@store');
Route::post('/eliminarcampana', 'CampanasController@delete');
