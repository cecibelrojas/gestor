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
Route::get('/set_language/{lang}', 'Controller@set_language')->name('set_language');
Route::get('/bancodatos', 'BancoDatosController@index');
Route::get('/etiquetas', 'TagsController@index');
Route::get('/widgets', 'WidgetsController@index');
Route::get('/usuarios', 'UsuariosController@index');
Route::get('/categorias', 'CategoryController@index');
Route::get('/publicaciones', 'ProductController@index');
Route::get('/publicacion/{id?}', 'ProductController@producto');
Route::get('/libreria_digital', 'LibreriaController@index');
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
Route::get('/embajadas', 'EmbajadasController@index');
Route::get('/consulados', 'ConsuladosController@index');
Route::get('/redes', 'RedesController@index');
Route::get('/feed', 'AjustesController@index');
Route::get('/logos_institucionales', 'AjustesController@logoinstitucional');
Route::get('/organigrama', 'AjustesController@organigrama');
Route::get('/ficha', 'EmpleadosController@index');
Route::get('/curriculum_vitae/{id?}', 'EmpleadosController@curriculum');
Route::get('/papelera', 'EmpleadosController@papelera_total');
Route::get('/metodo_pago', 'ApostillaController@index');
Route::get('/footer', 'AjustesController@footer');
Route::get('/servicios', 'ServiciosController@index');
Route::get('/papelera_servicios', 'ServiciosController@papelera_servicio');
Route::get('/sub_servicios/{id?}', 'ServiciosController@subservicios');
Route::get('/detalle_subservicio/{id?}', 'ServiciosController@detalle_subservicios');
Route::get('/banner_campana', 'BannercampanaController@index');
Route::get('/servicios_biblioteca', 'Servicios_bibliotecaController@index');
Route::get('/papelera_biblioteca', 'Servicios_bibliotecaController@papelera_biblioteca');
Route::get('/sub_servicios_biblioteca/{id?}', 'Servicios_bibliotecaController@subservicios_biblioteca');
Route::get('/detalle_subservicio_biblioteca/{id?}', 'Servicios_bibliotecaController@detalles_biblioteca');
Route::post('/contenido_servicio_ba', 'Servicios_bibliotecaController@detalle_contenido_ba');


Route::get('/servicios_identidad_nacional', 'ServiciosidentidadController@index');
Route::get('/papelera_identidad_nacional', 'ServiciosidentidadController@papelera_servicio_identidad');
Route::get('/servicios_turismo', 'ServiciosturismoController@index');
Route::get('/papelera_turismo', 'ServiciosturismoController@papelera_servicio_turismo');
Route::get('/patrimonio360', 'AjustesController@panoramica');
Route::get('/proceso_final/{id?}', 'ServiciosController@detalle_final_subservicios');
Route::get('/detalles_identidad_nacional/{id?}', 'ServiciosidentidadController@detalles_identidad');
Route::get('/detalles_turismo_venezuela/{id?}', 'ServiciosturismoController@detalles_turismo');
Route::get('/campana_otros', 'CampanaotrosController@index');
Route::get('/categoria_galerias', 'Categoria_galeriasController@index');
Route::get('/fotografias', 'GaleriasController@index');
Route::get('/casa_amarilla', 'CasaamarillaController@index');
Route::get('/conare', 'ConareController@index');

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
Route::post('/eliminarimagenredes', 'ProductController@deleteimageredes');
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

Route::post('/libros', 'LibreriaController@libros');
Route::post('/guardar-libros', 'LibreriaController@store');
Route::post('/eliminar-libros', 'LibreriaController@delete');
Route::get('/libro_amarillo', 'LibreriaController@lib_libros');
Route::post('/libros_formsearch', 'LibreriaController@libros_search');
Route::get('/publicaciones_ministerio', 'LibreriaController@lib_campanas');
Route::post('/campanas_formsearch', 'LibreriaController@campana_search');
Route::post('/biblioteca_search', 'LibreriaController@biblioteca_search');
Route::get('/colecciones', 'LibreriaController@lib_biblioteca');
Route::get('/referencias', 'LibreriaController@lib_referencias');
Route::post('/tratados_formsearch', 'LibreriaController@tratados_search');
Route::get('/gaceta_oficial', 'LibreriaController@lib_tratados');



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


Route::post('/embajada', 'EmbajadasController@select_embajada');
Route::post('/guardarembajada', 'EmbajadasController@store');
Route::post('/eliminarembajada', 'EmbajadasController@delete');

Route::post('/consulado', 'ConsuladosController@select_consulado');
Route::post('/guardarconsulado', 'ConsuladosController@store');
Route::post('/eliminarconsulados', 'ConsuladosController@delete');

Route::post('/redsocial', 'RedesController@redes_sociales');
Route::post('/guardar-redsocial', 'RedesController@store');
Route::post('/eliminar-redsocial', 'RedesController@delete');

Route::post('/feed_twitter', 'AjustesController@feed');
Route::post('/guardar-feed', 'AjustesController@store');

Route::post('/logoleft', 'AjustesController@logoleft');
Route::post('/guardar-logoleft', 'AjustesController@store_left');

Route::post('/logoright', 'AjustesController@logoright');
Route::post('/guardar-logoright', 'AjustesController@store_right');

Route::post('/logoprincipal', 'AjustesController@logoprincipal');
Route::post('/guardar-logoprincipal', 'AjustesController@store_principal');

Route::post('/logofooter', 'AjustesController@logo_footer');
Route::post('/guardar-logofooter', 'AjustesController@store_footerlogo');

Route::post('/organigrama_new', 'AjustesController@organigrama_institucional');
Route::post('/guardar-organigrama', 'AjustesController@store_organigrama');

Route::post('/colorheader', 'AjustesController@colorheader');
Route::post('/guardar-colorheader', 'AjustesController@store_colorheader');
Route::post('/guardar-colortopbar', 'AjustesController@store_colortop');

Route::post('/footer_color', 'AjustesController@colorfooter');
Route::post('/guardar-colorfooter', 'AjustesController@store_colorfooter');


Route::post('/colortop', 'AjustesController@colortop');

Route::post('/panoramica_new', 'AjustesController@pano360');
Route::post('/guardar-panoramica360', 'AjustesController@store_panoramica');


Route::post('/empleado', 'EmpleadosController@empleado');
Route::post('/guardar-empleado', 'EmpleadosController@store');

Route::post('/formulario_academico', 'EmpleadosController@estudio_info');
Route::post('/eliminarestudios', 'EmpleadosController@delete_estudios');
Route::post('/guardar-estudios', 'EmpleadosController@store_estudios');

Route::post('/formulario_trabajos', 'EmpleadosController@empleo_info');
Route::post('/guardar-empleos', 'EmpleadosController@store_empleos');
Route::post('/eliminarempleos', 'EmpleadosController@delete_empleos');

Route::post('/formulario_idiomas', 'EmpleadosController@idiomas_info');
Route::post('/guardar-idioma', 'EmpleadosController@store_idioma');
Route::post('/eliminaridiomas', 'EmpleadosController@delete_idioma');


Route::post('/deshabilitarempleado', 'EmpleadosController@deshabilitarempleados');
Route::post('/restaurar-empleado', 'EmpleadosController@restaurar_empleado');
Route::post('/eliminarficha', 'EmpleadosController@delete');


Route::post('/servicioconsular', 'ServiciosController@servicios');
Route::post('/guardar-servicioconsular', 'ServiciosController@store');
Route::post('/eliminar_servicio', 'ServiciosController@delete');
Route::post('/deshabilitarservicio', 'ServiciosController@deshabilitarservicio');
Route::post('/restaurar-servicio', 'ServiciosController@restaurar_servicio');

Route::post('/banner_servicioconsular', 'ServiciosController@banner_serviconsulares');
Route::post('/guardar-bnnr_servicio', 'ServiciosController@store_bannerconsular');

Route::post('/formulario_subservicios', 'ServiciosController@subservicio_info');
Route::post('/eliminar_subservicio', 'ServiciosController@delete_subservicio');
Route::post('/guardar-subservicio', 'ServiciosController@store_subservicio');
Route::post('/guardar-subservicioconsular', 'ServiciosController@store_subservicio');

Route::post('/bannercampanas', 'BannercampanaController@bannercampanas');
Route::post('/guardarbannercampana', 'BannercampanaController@store');
Route::post('/eliminarbannercampana', 'BannercampanaController@delete');

Route::post('/serviciobiblioteca', 'Servicios_bibliotecaController@servicios_biblioteca_archivos');
Route::post('/guardar-serviciobiblioteca', 'Servicios_bibliotecaController@store');
Route::post('/eliminar_servicio_biblioteca', 'Servicios_bibliotecaController@delete');
Route::post('/deshabilitarserviciobiblioteca', 'Servicios_bibliotecaController@deshabilitarservicio');
Route::post('/restaurar-servicio-biblioteca', 'Servicios_bibliotecaController@restaurar_servicio');

Route::post('/formulario_subservicios_biblioteca', 'Servicios_bibliotecaController@subservicio_info');
Route::post('/guardar-subserviciobiblioteca', 'Servicios_bibliotecaController@store_subservicio');
Route::post('/eliminarsubserviciobiblioteca', 'Servicios_bibliotecaController@delete_subservicio');

Route::post('/banner_biblioteca', 'Servicios_bibliotecaController@banner_servibiblioteca');
Route::post('/guardar-bnnr_serviciobiblioteca', 'Servicios_bibliotecaController@store_bannerbiblioteca');

Route::post('/bnnr_subserviciosbbt', 'Servicios_bibliotecaController@subs_bannerbbt');
Route::post('/guardar-bnnr_subserviciobbt', 'Servicios_bibliotecaController@store_subbannerbbt');

Route::post('/servicioidentidad', 'ServiciosidentidadController@serviciosidentidad');
Route::post('/guardar-servicioidentidad', 'ServiciosidentidadController@store');
Route::post('/eliminar_servicio_identidad', 'ServiciosidentidadController@delete');
Route::post('/deshabilitarservicioidentidad', 'ServiciosidentidadController@deshabilitarservicioidentidad');
Route::post('/restaurar-servicio-identidad', 'ServiciosidentidadController@restaurar_servicio_identidad');

Route::post('/servicioturismo', 'ServiciosturismoController@serviciosturismo');
Route::post('/guardar-servicioturismo', 'ServiciosturismoController@store');
Route::post('/eliminar_servicio_turismo', 'ServiciosturismoController@delete');
Route::post('/deshabilitarservicioturismo', 'ServiciosturismoController@deshabilitarservicioturismo');
Route::post('/restaurar-servicio-turismo', 'ServiciosturismoController@restaurar_servicio_turismo');

Route::post('/contenido_servicio', 'ServiciosController@detalle_contenido');
Route::post('/guardar-contenidoservicio', 'ServiciosController@store_contenido');

Route::post('/bnnr_subservicios', 'ServiciosController@subs_banner');
Route::post('/guardar-bnnr_subservicio', 'ServiciosController@store_bnnr_subservicio');

Route::post('/video_subservicios', 'ServiciosController@subs_video');
Route::post('/guardar-video_subservicio', 'ServiciosController@store_videos_subservicio');
Route::post('/eliminarvideos', 'ServiciosController@delete_videos');

Route::post('/infografias_subservicios', 'ServiciosController@subs_infografias');
Route::post('/infografia-subservicio', 'ServiciosController@guardar_infogra_subservicio');
Route::post('/eliminarinfografia', 'ServiciosController@delete_infografia');

Route::post('/apostillas_subservicios', 'ServiciosController@subs_apostilla');
Route::post('/guardar-apostillas_subservicio', 'ServiciosController@store_apostillas_subservicio');

Route::post('/servicio_card_detalle', 'ServiciosController@detalle_proceso');
Route::post('/guardar-serviprocesos', 'ServiciosController@store_procesos');
Route::post('/eliminarprocesos', 'ServiciosController@delete_procesos');

Route::post('/contenido_final', 'ServiciosController@detalles_finales_sub');
Route::post('/guardar-contenido-final', 'ServiciosController@store_procesos_finales');

Route::post('/formulario_detalle_identidad', 'ServiciosidentidadController@detalle_info');
Route::post('/guardar-imgprincipal', 'ServiciosidentidadController@store_imgprincipal');

Route::post('/formulario_detalle_turismo', 'ServiciosturismoController@detalle_info_turismo');
Route::post('/guardar-imgprincipalt', 'ServiciosturismoController@store_imgprincipalt');

Route::post('/videomp4', 'CampanaotrosController@campanaspm4');
Route::post('/guardar-mp4', 'CampanaotrosController@store');
Route::post('/eliminar_vmp4', 'CampanaotrosController@delete');

Route::post('/bannercasamarilla_new', 'CasaamarillaController@banner_casamarilla');
Route::post('/contenido_principal', 'CasaamarillaController@contenido1');
Route::post('/imagen_principal', 'CasaamarillaController@imagen_casamarilla');
Route::post('/parallax_coleccion', 'CasaamarillaController@parallax1_casamarilla');
Route::post('/parallax_normas', 'CasaamarillaController@parallax2_casamarilla');
Route::post('/lista_colecciones', 'CasaamarillaController@coleccion');
Route::post('/lista_normas', 'CasaamarillaController@normas');
Route::post('/lista_items', 'CasaamarillaController@items');

Route::post('/borrador', 'ProductologController@guardar');

Route::post('/guardar-banner_principal', 'CasaamarillaController@storebanner');
Route::post('/guardar-contenido_principal', 'CasaamarillaController@guardar_conenido');
Route::post('/guardar-imagen_principal', 'CasaamarillaController@guardar_imgca');
Route::post('/guardar-parallax1', 'CasaamarillaController@guardar_parallax1');
Route::post('/guardar-parallax2', 'CasaamarillaController@guardar_parallax2');
Route::post('/guardar-coleciones', 'CasaamarillaController@guardar_coleccion');
Route::post('/guardar-normas', 'CasaamarillaController@guardar_normas');
Route::post('/guardar-items', 'CasaamarillaController@guardar_items');

Route::post('/eliminar_coleccion', 'CasaamarillaController@delete_colecciones');
Route::post('/eliminar_normas', 'CasaamarillaController@delete_normas');
Route::post('/eliminar_items', 'CasaamarillaController@delete_items');

Route::post('/bannerconare_new', 'ConareController@banner_conare');
Route::post('/contenido_conare', 'ConareController@contenido1');
Route::post('/imagen_conare', 'ConareController@imagen_conare');
Route::post('/parallax_conare', 'ConareController@parallax_conare');
Route::post('/lista_ubicaciones', 'ConareController@ubicacion_geo');


Route::post('/guardar-banner_conare', 'ConareController@storebanner');
Route::post('/guardar-contenido_conare', 'ConareController@guardar_conenido');
Route::post('/guardar-imagen_conare', 'ConareController@guardar_imgco');
Route::post('/guardar-parallax', 'ConareController@guardar_parallax');
Route::post('/guardar-ubicaciones', 'ConareController@guardar_ubigeo');

Route::post('/eliminar_ubicacion_geo', 'ConareController@delete_ubicaciones');

Route::get('/multimedia', 'MultimediaController@index');
Route::post('/medios_uploads', 'MultimediaController@uploads_img');
Route::post('/cargarmedios', 'MultimediaController@upload_medios');
Route::post('/obtenermultimediamedios', 'MultimediaController@obtenermultimediamedios');


Route::post('/listado_publicaciones', 'ProductController@listado_publicaciones');

Route::get('/rss-generator', 'RssfeedController@rss');
Route::get('/rss-feed', 'RssfeedController@index');
