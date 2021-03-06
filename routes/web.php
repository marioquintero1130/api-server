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
    return response()->json([
        'name' => env('APP_NAME'),
        'version' => env('APP_VERSION'),
        'build' => env('APP_BUILD'),
        'router' => $router->app->version()
    ]);
});

$router->group(['prefix' => 'v1'], function () use ($router) {

   // Auth
   $router->post('usuarios', 'UsuarioController@store');                    // [OK]
   $router->put('usuarios/{id}', 'UsuarioController@update');               // [OK]
   $router->post('login/email', 'UsuarioController@signInWithEmail');
   $router->post('login/username', 'UsuarioController@signInWithUsername'); // [OK]
   $router->post('login/token', 'UsuarioController@signInWithToken');
   $router->post('logout', 'UsuarioController@logout');

   //Firebase
   $router->post('firebase/token/{id}', 'FirebaseController@sendByToken');
   $router->post('firebase/topic/{id}', 'FirebaseController@sendByTopic');

   //Personas
   $router->get('personas', 'PersonaController@index');
   $router->get('personas/{id}', 'PersonaController@show');
   $router->post('personas', 'PersonaController@store');
   $router->put('personas/{id}','PersonaController@update');
   $router->delete('personas/{id}', 'PersonaController@delete');

   //Publicaciones
   $router->get('publicaciones', 'PublicacionController@index');
   $router->get('publicaciones/{id}', 'PublicacionController@show');
   $router->post('publicaciones', 'PublicacionController@store');
   $router->put('publicaciones/{id}','PublicacionController@update');
   $router->delete('publicaciones/{id}', 'PublicacionController@delete');

   //Solicitudes
   $router->get('solicitudes', 'SolicitudController@index');                // [OK]
   $router->post('solicitudes', 'SolicitudController@store');               // [OK] 
   $router->get('solicitudes/{id}', 'SolicitudController@show');
   $router->put('solicitudes/{id}', 'SolicitudController@update');
   $router->delete('solicitudes/{id}', 'SolicitudController@delete');

   //Beneficiario
   $router->get('beneficiarios',  'BeneficiarioController@index');
   $router->post('beneficiarios', 'BeneficiarioController@store');
   $router->get('beneficiarios/{id}', 'BeneficiarioController@show');
   $router->put('beneficiarios/{id}', 'BeneficiarioController@update');
   $router->delete('beneficiarios/{id}', 'BeneficiarioController@delete');

   //Reacion
   $router->post('reaciones/votar', 'ReacionController@votar');

   //Triage
   $router->get('triages', 'TriageController@index');
   $router->get('triages/{id}', 'TriageController@show');
   $router->post('triages','TriageController@store');
   $router->put('triages/{id}', 'TriageController@update');
   $router->delete('triages/{id}', 'TriageController@delete');
   
});
