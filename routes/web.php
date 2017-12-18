<?php

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

/** USUARIO */
Route::get('/Usuario/solicitarPassword', 'UsuarioController@solicitarPassword');
Route::post('/Usuario/generarPassword', 'UsuarioController@generarPassword');
Route::get('/Usuario/actualizarMiPassword', 'UsuarioController@actualizarMiPassword');
Route::post('/Usuario/actualizarPassword', 'UsuarioController@actualizarPassword');
Route::get('/Usuario/miPerfil', 'UsuarioController@miPerfil');
Route::get('/Usuario/actualizarMisDatos', 'UsuarioController@actualizarMisDatos');

/** MANTENEDORES - USUARIOS */
Route::get('/MantenedorUsuarios/index', 'MantenedorUsuariosController@index');
Route::get('/MantenedorUsuarios/listado', 'MantenedorUsuariosController@listado');
Route::get('/MantenedorUsuarios/nuevo', 'MantenedorUsuariosController@formUsuario');
Route::get('/MantenedorUsuarios/editar/{id_usuario}', 'MantenedorUsuariosController@formUsuario');
Route::post('/MantenedorUsuarios/guardar', 'MantenedorUsuariosController@guardarUsuario');
Route::post('/MantenedorUsuario/cargarUsuario', 'MantenedorUsuariosController@cargarPerfilUsuario');
Route::post('/MantenedorUsuario/cerrarPerfilUsuario', 'MantenedorUsuariosController@cerrarPerfilUsuario');