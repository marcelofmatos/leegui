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

URL::forceScheme(env('APP_ENV')=='prod' ? 'https' : 'http');


Route::get('/', function () {
    return redirect('/saas/create');
});

Route::get('/home', function () {
    return redirect('/saas/create');
});


Route::resource('portainer_server','PortainerServerController');
Route::get('portainer_server/{id}/stacks','PortainerServerController@stacks');
Route::delete('portainer_server/{id}/stack/{stack_id}/delete','PortainerServerController@stackDelete');


Route::resource('domain','DomainController');

Route::resource('stack', 'StackController');

Route::resource('template', 'TemplateController');

Route::get('/saas/create', 'ProjectController@create');
Route::post('/saas/next', 'ProjectController@next');
Route::get('/saas/status/{portainer_server_id}/{stack_id}', 'ProjectController@status');
Route::get('/saas/status/{portainer_server_id}/{stack_id}/{template_id}', 'ProjectController@status');
Route::get('/saas/check/{domain}', 'ProjectController@check');

Route::get('/saas/validate', 'ProjectController@fqdnValidate');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
