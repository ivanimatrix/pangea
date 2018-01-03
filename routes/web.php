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
Route::get('/MantenedorUsuarios/listado', 'MantenedorUsuariosController@listado');
Route::get('/MantenedorUsuarios/nuevo', 'MantenedorUsuariosController@formUsuario');
Route::get('/MantenedorUsuarios/editar/{id_usuario}', 'MantenedorUsuariosController@formUsuario');
Route::post('/MantenedorUsuarios/guardar', 'MantenedorUsuariosController@guardarUsuario');
Route::post('/MantenedorUsuario/cargarUsuario', 'MantenedorUsuariosController@cargarPerfilUsuario');
Route::post('/MantenedorUsuario/cerrarPerfilUsuario', 'MantenedorUsuariosController@cerrarPerfilUsuario');

/** PROYECTOS */
Route::get('/Proyectos/nuevo', 'ProyectosController@formProyecto');
Route::post('/Proyectos/guardar', 'ProyectosController@guardarProyecto');
Route::get('/Proyectos/index', 'ProyectosController@index');
Route::get('/Proyectos/listado', 'ProyectosController@listadoProyectos');
Route::get('/Proyectos/editar/{id}', 'ProyectosController@formProyecto');
Route::get('/ProyectosLider/misProyectos', 'ProyectosLiderController@misProyectos');
Route::get('/Proyectos/detalle/{id}', 'ProyectosController@detalleProyecto');

/** PROYECTOS LIDER */
Route::get('/ProyectosLider/listado', 'ProyectosLiderController@listadoMisProyectos');
Route::get('/ProyectosLider/nuevoRol/{id}', 'ProyectosLiderController@formRolProyecto');
Route::get('/ProyectosLider/editarRol/{id}/{id_rol}', 'ProyectosLiderController@formRolProyecto');
Route::post('/ProyectosLider/guardarRolProyecto', 'ProyectosLiderController@guardarRolProyecto');
Route::get('/RolesProyecto/listado/{id_proyecto}', 'RolesProyectoController@getRolesProyecto');
Route::post('/RolesProyecto/eliminarRol', 'RolesProyectoController@eliminarRol');