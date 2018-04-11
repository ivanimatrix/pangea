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

/** LOGIN */
Route::get('/', 'LoginController@index');
Route::post('/Login/validarLogin', 'LoginController@loginUsuario');
Route::get('/Login/logout', 'LoginController@logoutUsuario');

/** HOME */
Route::get('/Home/dashboard', 'HomeController@dashboard');
Route::get('/Home/cargarPerfil', 'HomeController@cargarPerfil');

/** USUARIO */
Route::get('/Usuario/solicitarPassword', 'UsuarioController@solicitarPassword');
Route::post('/Usuario/generarPassword', 'UsuarioController@generarPassword');
Route::get('/Usuario/actualizarMiPassword', 'UsuarioController@actualizarMiPassword');
Route::post('/Usuario/actualizarPassword', 'UsuarioController@actualizarPassword');
Route::get('/Usuario/miPerfil', 'UsuarioController@miPerfil');
Route::get('/Usuario/actualizarMisDatos', 'UsuarioController@actualizarMisDatos');
Route::post('/Usuario/actualizarDatos', 'UsuarioController@guardarMisDatos');
Route::get('/Usuario/avatar', 'UsuarioController@editarAvatar');
Route::post('/Usuario/cambiarAvatar', 'UsuarioController@actualizarAvatar');
Route::post('/Usuario/cargarPerfilActivo', 'UsuarioController@cargarPerfilActivo');

/** MANTENEDORES - USUARIOS */
Route::get('/MantenedorUsuarios/index', 'MantenedorUsuariosController@index');
Route::get('/MantenedorUsuarios/listado/{id_perfil?}', 'MantenedorUsuariosController@listado');
Route::get('/MantenedorUsuarios/nuevo', 'MantenedorUsuariosController@formUsuario');
Route::get('/MantenedorUsuarios/editar/{id_usuario}', 'MantenedorUsuariosController@formUsuario');
Route::post('/MantenedorUsuarios/guardar', 'MantenedorUsuariosController@guardarUsuario');
Route::post('/MantenedorUsuario/cargarUsuario', 'MantenedorUsuariosController@cargarPerfilUsuario');
Route::post('/MantenedorUsuario/cerrarPerfilUsuario', 'MantenedorUsuariosController@cerrarPerfilUsuario');
Route::post('/MantenedorUsuario/desactivar', 'MantenedorUsuariosController@desactivarUsuario');
Route::post('/MantenedorUsuario/activar', 'MantenedorUsuariosController@activarUsuario');

/** PROYECTOS */
Route::get('/Proyectos/nuevo', 'ProyectosController@formProyecto');
Route::post('/Proyectos/guardar', 'ProyectosController@guardarProyecto');
Route::get('/Proyectos/index', 'ProyectosController@index');
Route::get('/Proyectos/listado', 'ProyectosController@listadoProyectos');
Route::get('/Proyectos/editar/{id}', 'ProyectosController@formProyecto');
Route::get('/ProyectosLider/misProyectos', 'ProyectosLiderController@misProyectos');
Route::get('/Proyectos/detalle/{id}', 'ProyectosController@detalleProyecto');
Route::get('/Proyectos/reportePdf/{id}', 'ProyectosController@reportePdf');
Route::post('/Proyectos/finalizar', 'ProyectosController@finalizarProyecto');

/** PROYECTOS LIDER */
Route::get('/ProyectosLider/listado', 'ProyectosLiderController@listadoMisProyectos');
Route::get('/ProyectosLider/nuevoRol/{id}', 'ProyectosLiderController@formRolProyecto');
Route::get('/ProyectosLider/editarRol/{id}/{id_rol}', 'ProyectosLiderController@formRolProyecto');
Route::post('/ProyectosLider/guardarRolProyecto', 'ProyectosLiderController@guardarRolProyecto');
Route::get('/ProyectosLider/cerrar/{id_proyecto}', 'ProyectosLiderController@formCerrarProyecto');
Route::post('/ProyectosLider/cerrarProyecto', 'ProyectosLiderController@cerrarProyecto');
Route::get('/RolesProyecto/listado/{id_proyecto}', 'RolesProyectoController@getRolesProyecto');
Route::post('/RolesProyecto/eliminarRol', 'RolesProyectoController@eliminarRol');
Route::get('/UsuariosProyecto/nuevoUsuario/{id_proyecto}', 'UsuariosProyectoController@formUsuarioProyecto');
Route::get('/UsuariosProyecto/editarUsuario/{id_proyecto}/{id_usuario}', 'UsuariosProyectoController@formUsuarioProyecto');
Route::post('/UsuariosProyecto/guardar', 'UsuariosProyectoController@guardarUsuario');
Route::get('/UsuariosProyecto/listado/{id_proyecto}', 'UsuariosProyectoController@listadoIntegrantes');
Route::get('/HitosProyecto/listado/{id_proyecto}', 'HitosProyectoController@listadoHitos');
Route::get('/HitosProyecto/nuevo/{id_proyecto}', 'HitosProyectoController@formHito');
Route::post('/HitosProyecto/guardar', 'HitosProyectoController@guardarHito');
Route::get('/HitosProyecto/editar/{id_proyecto}/{id_hito}', 'HitosProyectoController@formHito');
Route::get('/HitosProyecto/tareas/{id_hito}', 'HitosProyectoController@tareasHito');

Route::get('/TareasProyecto/nuevo/{id_proyecto}/{tipo_padre}/{id_padre}', 'TareasProyecto@formTarea');
Route::get('/TareasProyecto/editar/{id_proyecto}/{tipo_padre}/{id_padre}/{id_tarea}', 'TareasProyecto@formTarea');
Route::post('/TareasProyecto/guardar', 'TareasProyecto@guardarTarea');
Route::post('/TareasProyecto/listadoTareas', 'TareasProyecto@listadoTareas');
Route::post('/TareasProyecto/borrarTarea', 'TareasProyecto@borrarTareaProyecto');

Route::get('/ComentariosProyecto/listado/{id_proyecto}', 'ComentariosProyectoController@listado');
Route::post('/ComentariosProyecto/registrarComentario', 'ComentariosProyectoController@registrarComentario');

/** TAREAS */
Route::get('/Tareas/misTareas', 'TareasController@misTareas');
Route::post('/Tareas/listarMisTareas', 'TareasController@listarMisTareas');
Route::get('/Tareas/desarrollarTarea/{id_tarea}', 'TareasController@formTarea');
Route::post('/Tareas/trazabilidad', 'TareasController@trazabilidadTarea');
Route::post('/Tareas/registrarAvance', 'TareasController@registrarAvance');
Route::post('/Tareas/cerrarTarea', 'TareasController@cerrarTarea');
Route::get('/Tareas/verTarea/{id_tarea}', 'TareasController@verTarea');
Route::post('/Tareas/aprobar', 'TareasController@aprobarTarea');
Route::post('/Tareas/rechazar', 'TareasController@rechazarTarea');
Route::get('/Tareas/comentarioRechazo/{id_tarea}', 'TareasController@comentarioRechazoTarea');