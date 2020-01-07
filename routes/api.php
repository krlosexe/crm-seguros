<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!!!!!!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::post('verify-token', 'Login@VerifyToken');

Route::resource('user', 'UsuariosController');
Route::post('status-user/{id}/{status}', 'UsuariosController@statusUser');
Route::get('get-asesoras', 'UsuariosController@GetAsesoras');

Route::resource('modulos', 'ModulosController');
Route::post('status-modulo/{id}/{status}', 'ModulosController@status');


Route::resource('funciones', 'FuncionesController');
Route::post('status-funciones/{id}/{status}', 'FuncionesController@status');


Route::get('list-funciones', 'FuncionesController@listFunciones');

Route::get('verify-permiso', 'Login@VerifyPermiso');

Route::resource('roles', 'RolesController');
Route::post('status-rol/{id}/{status}', 'RolesController@status');



Route::resource('people', 'ClientsPeopleController');
Route::get('status-people/{id}/{status}', 'ClientsPeopleController@status');



Route::resource('company', 'ClientsCompanyController');
Route::get('status-company/{id}/{status}', 'ClientsCompanyController@status');

Route::resource('consortium', 'ClientsConsortiumController');
Route::get('status-consortium/{id}/{status}', 'ClientsConsortiumController@status');

Route::get('clients', 'ClientsController@GetClients');



Route::resource('insurers', 'InsurersController');
Route::get('status-insurers/{id}/{status}', 'InsurersController@status');



Route::resource('branchs', 'BranchsController');
Route::get('status-branchs/{id}/{status}', 'BranchsController@status');



Route::resource('policies', 'PoliciesController');
Route::get('status-policies/{id}/{status}', 'PoliciesController@status');
Route::post('policies/simulation/pay', 'PoliciesController@SimulationPay');

Route::get('policies-binds/{id}', 'PoliciesController@Binds');
Route::post('policies-binds', 'PoliciesController@StoreBinds');

Route::put('policies-binds/{id}', 'PoliciesController@UpdateBinds');


Route::get('status-policies-bind/{id}/{status}', 'PoliciesController@StatusBinds');



Route::resource('policies-grouped', 'PoliciesGroupedController');
Route::get('status-policies-grouped/{id}/{status}', 'PoliciesGroupedController@status');
Route::post('policies-childs', 'PoliciesGroupedController@StoreChilds');
Route::get('policies-childs/{id}', 'PoliciesGroupedController@Childs');
Route::get('policies/simulation/pay/{id}', 'PoliciesController@GetPays');




Route::resource('sinister', 'SinistersController');
Route::get('status-sinister/{id}/{status}', 'SinistersController@status');