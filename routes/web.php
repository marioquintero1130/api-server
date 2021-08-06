<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1'], function () use ($router) {

   // Auth
   $router->post('usuarios', ['as' => 'users.store', 'uses' => 'UsuarioController@store']);
   $router->post('login/email', ['as' => 'signinWithEmail', 'uses' => 'UsuarioController@signInWithEmail']);
   $router->post('login/username', ['as' => 'signinWithUsername', 'uses' => 'UsuarioController@signInWithUsername']);
   $router->post('logout', ['as' => 'logout', 'uses' => 'UsuarioController@logout']);

   //Posts
   $router->get('publicaciones', ['as' => 'publicaciones', 'uses' => 'PublicacionController@index']);

   //Solicitud
   $router->get('solicitudes', ['as' => 'solicitudes', 'uses' => 'SolicitudController@index']);
   $router->post('solicitudes', ['as' => 'solicitudes.store', 'uses' => 'SolicitudController@store']);
   $router->get('solicitudes/{id}', ['as' => 'solcitudes.show', 'uses' => 'SolitudController@show']);
   $router->put('solicitudes/{id}', ['as' => 'solicitudes.update', 'uses' => 'SolicitudController@update']);
   $router->delete('solicitudes/{id}', ['as' => 'solicitudes.delete', 'uses' => 'SolicitudController@delete']);

   //Beneficiario
   $router->get('beneficiarios', ['as' => 'beneficiarios', 'uses' => 'BeneficiarioController@index']);
   $router->post('beneficiarios', ['as' => 'beneficiarios.store', 'uses' => 'BeneficiarioController@store']);
   $router->get('beneficiarios/{id}', ['as' => 'beneficiarios.show', 'uses' => 'BeneficiarioController@show']);
   $router->put('beneficiarios/{id}', ['as' => 'beneficiarios.update', 'uses' => 'BeneficiarioController@update']);
   $router->delete('beneficiarios/{id}', ['as' => 'beneficiarios.delete', 'uses' => 'BeneficiarioController@delete']);

   //Reacion
   $router->get('reaciones', ['as' => 'reaciones', 'uses' => 'ReacionController@index']);
   $router->get('reaciones/{id}', ['as' => 'reaciones.show', 'uses' => 'ReacionController@show']);
   $router->post('reaciones', ['as' => 'reaciones.store', 'uses' => 'ReacionController@store']);
   $router->put('reaciones/{id}', ['as' => 'reaciones.update', 'uses' => 'ReacionController@update']);
   $router->delete('reaciones/{id}', ['as' => 'reaciones.delete', 'uses' => 'ReacionController@delete']);

   //Triage
   $router->get('triages', ['as' => 'triages', 'uses' => 'TriageController@index']);
   $router->get('triages/{id}', ['as' => 'triages.show', 'uses' => 'TriageController@show']);
   $router->post('triages', ['as' => 'triages.store', 'uses' => 'TriageController@store']);
   $router->put('triages/{id}', ['as' => 'triages.update', 'uses' => 'TriageController@update']);
   $router->delete('triages/{id}', ['as' => 'triages.delete', 'uses' => 'TriageController@delete']);

   

   


});

/*


$router->group(['middleware' => 'auth'], function () use ($router) {

   $router->get('directorios', ['as' => 'directorios', 'uses' => 'DirectorioController@index']);
   $router->get('directorios/{id}', ['as' => 'directorios.show', 'uses' => 'DirectorioController@show']);
   $router->post('directorios', ['as' => 'directorios.store', 'uses' => 'DirectorioController@store']);
   $router->put('directorios/{id}', ['as' => 'directorios.update', 'uses' => 'DirectorioController@update']);
   $router->delete('directorios/{id}', ['as' => 'directorios.delete', 'uses' => 'DirectorioController@delete']);

   

   $router->get('user', function () use ($router) {
       return auth()->user();
   });
});*/
