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
Route::post('insurers/sub/company', 'InsurersController@StoreSubCompany');
Route::get('insurers/sub/company/{id_insurers}', 'InsurersController@GetSubCompany');
Route::put('insurers/sub/company/{id_insurers}', 'InsurersController@updateSubCompany');
Route::get('insurers/sub/company/status/{id_insurers}/{status}', 'InsurersController@statusSubCompany');

Route::post('insurers/oficce/', 'InsurersController@StoreOficce');
Route::get('insurers/oficce/{id_insurers}', 'InsurersController@getOficce');
Route::put('insurers/oficce/{id_insurers}', 'InsurersController@StoreOficce');
Route::get('insurers/oficce/status/{id_insurers}/{status}', 'InsurersController@statusOficce');

Route::resource('branchs', 'BranchsController');
Route::get('status-branchs/{id}/{status}', 'BranchsController@status');


Route::resource('sub/company', 'TypeSubCompanyController');
Route::get('status/sub/company/{id}/{status}', 'TypeSubCompanyController@status');




Route::resource('policies', 'PoliciesController');
Route::get('status-policies/{id}/{status}', 'PoliciesController@status');
Route::post('policies/simulation/pay', 'PoliciesController@SimulationPay');

Route::get('policies-binds/{id}', 'PoliciesController@Binds');
Route::post('policies-binds', 'PoliciesController@StoreBinds');

Route::put('policies-binds/{id}', 'PoliciesController@UpdateBinds');

Route::post('policies/annexes', 'PoliciesController@StoreAnnexes');
Route::get('policies/annexes/{id}', 'PoliciesController@GetAnnexes');
Route::put('policies/annexes/{id}', 'PoliciesController@UpdateAnnexes');
Route::get('policies/annexes/status/{id}/{status}', 'PoliciesController@StatusAnnexes');

Route::get('status-policies-bind/{id}/{status}', 'PoliciesController@StatusBinds');



Route::resource('policies-grouped', 'PoliciesGroupedController');
Route::get('status-policies-grouped/{id}/{status}', 'PoliciesGroupedController@status');
Route::post('policies-childs', 'PoliciesGroupedController@StoreChilds');
Route::get('policies-childs/{id}', 'PoliciesGroupedController@Childs');

Route::post('policies/grouped/annexes', 'PoliciesGroupedController@StoreAnnexes');



Route::get('policies/simulation/pay/{id}', 'PoliciesController@GetPays');




Route::resource('sinister', 'SinistersController');
Route::get('status-sinister/{id}/{status}', 'SinistersController@status');

Route::get('payment', 'PaymentController@get');
Route::post('payment', 'PaymentController@GetByPolicie');
Route::post('payment/fee/pending', 'PaymentController@FeePending');
Route::post('payment/fee', 'PaymentController@PaymentFee');

Route::get('payments/receivable', 'PaymentController@paymentsReceivable');
Route::get('payments/beaten', 'PaymentController@paymentsBeaten');

Route::get('payments/collected', 'PaymentController@paymentsCollected');

