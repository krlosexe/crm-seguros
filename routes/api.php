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

Route::post('auth', 'Login@Auth');
Route::post('authApp', 'Login@authApp');

Route::post('verify-token', 'Login@VerifyToken');

Route::resource('user', 'UsuariosController');
Route::get('status-user/{id}/{status}', 'UsuariosController@statusUser');
Route::get('get-asesoras', 'UsuariosController@GetAsesoras');

Route::resource('modulos', 'ModulosController');
Route::get('status-modulo/{id}/{status}', 'ModulosController@status');


Route::resource('funciones', 'FuncionesController');
Route::get('status-funciones/{id}/{status}', 'FuncionesController@status');


Route::get('list-funciones', 'FuncionesController@listFunciones');

Route::get('verify-permiso', 'Login@VerifyPermiso');

Route::resource('roles', 'RolesController');
Route::get('status-rol/{id}/{status}', 'RolesController@status');


Route::resource('people', 'ClientsPeopleController');
Route::get('status-people/{id}/{status}', 'ClientsPeopleController@status');

Route::get('files/{tabla}/{id_client}', 'FilesController@GetFiles');
Route::post('files', 'FilesController@store');
Route::put('files/{id_file}', 'FilesController@update');
Route::get('files/status/{id}/{status}', 'FilesController@status');

Route::post('filesCustom', 'FilesController@storeCustom');
Route::put('filesCustom/{id_file}', 'FilesController@updateCustom');


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
Route::get('policiesAll', 'PoliciesController@policiesLight');
Route::post('policies/paginate', 'PoliciesController@paginate');
Route::get('status-policies/{id}/{status}', 'PoliciesController@status');
Route::post('policies/simulation/pay', 'PoliciesController@SimulationPay');

Route::get('policies-binds/{id}', 'PoliciesController@Binds');
Route::post('policies-binds', 'PoliciesController@StoreBinds');

Route::put('policies-binds/{id}', 'PoliciesController@UpdateBinds');

Route::post('policies/annexes', 'PoliciesController@StoreAnnexes');
Route::get('policies/annexes/{id}', 'PoliciesController@GetAnnexes');
Route::put('policies/annexes/{id}', 'PoliciesController@UpdateAnnexes');
Route::get('policies/annexes/status/{id}/{status}', 'PoliciesController@StatusAnnexes');

Route::get('annexes/{id}', 'PoliciesController@GetAnnexesById');


Route::get('status-policies-bind/{id}/{status}', 'PoliciesController@StatusBinds');


Route::resource('policies-grouped', 'PoliciesGroupedController');
Route::get('status-policies-grouped/{id}/{status}', 'PoliciesGroupedController@status');
Route::post('policies-childs', 'PoliciesGroupedController@StoreChilds');
Route::get('policies-childs/{id}', 'PoliciesGroupedController@Childs');

Route::post('policies/grouped/annexes', 'PoliciesGroupedController@StoreAnnexes');
Route::get('policies/grouped/annexes/{id}', 'PoliciesGroupedController@GetAnnexes');
Route::put('policies/grouped/annexes/{id}', 'PoliciesGroupedController@UpdateAnnexes');
Route::get('policies/grouped/annexes/status/{id}/{status}', 'PoliciesGroupedController@StatusAnnexes');
Route::get('policies/simulation/pay/{id}', 'PoliciesController@GetPays');


Route::resource('sinister', 'SinistersController');
Route::get('sinister/client/{id_client}', 'SinistersController@GetByClient');
Route::get('status-sinister/{id}/{status}', 'SinistersController@status');

Route::get('payment', 'PaymentController@get');
Route::get('payment/{id}', 'PaymentController@getId');

Route::post('payment', 'PaymentController@GetByPolicie');
Route::post('payment/fee/pending', 'PaymentController@FeePending');
Route::post('payment/fee', 'PaymentController@PaymentFee');
Route::get('payment/expired', 'ChargeAccountController@Expired');

Route::get('payments/receivable', 'PaymentController@paymentsReceivable');
Route::get('payments/beaten', 'PaymentController@paymentsBeaten');

Route::get('payments/collected', 'PaymentController@paymentsCollected');

Route::resource('tasks', 'TasksController');
Route::post('tasks/update/{id}', 'TasksController@update');
Route::post('tasks/status/{id}/{status}', 'TasksController@status');
Route::get('tasks-today', 'CalendarController@Today');
Route::get('tasks/delete/{id}', 'TasksController@destroy');

Route::resource('charge/account', 'ChargeAccountController');
Route::post('charge/account/multiple', 'ChargeAccountController@storeMultiple');
Route::post('charge/account/multiple/{id}', 'ChargeAccountController@updateMultiple');

Route::get('charge/account/{id_policie}', 'ChargeAccountController@index');
Route::get('charge/account/status/{id}/{status}', 'ChargeAccountController@status');
Route::get('charge/account/statusChangeAccount/{id}/{status}', 'ChargeAccountController@statusChangeAccount');

Route::post('wallet/collections', 'CollectionsController@store');
Route::get('wallet/collections/{id}', 'CollectionsController@get');
Route::put('wallet/collections/{id}', 'CollectionsController@update');
Route::get('wallet/collections/status/{id}/{status}', 'CollectionsController@status');


Route::get('wallet/{id}', 'ChargeAccountController@get');


Route::get('wallet/collection/{id}', 'ChargeAccountController@getCollection');


Route::resource('my/company', 'MyCompanyController');


Route::resource('footers', 'FootersController');



Route::post('footers/update', 'FootersController@updateFooter');
Route::post('footers/delete', 'FootersController@Delete');

Route::get('calendar/tasks/', 'CalendarController@getTask');


Route::get('clients/people/policies/{id_client}/{type_cliente}', 'ClientsPeopleController@Policies');

Route::get('clients/policies/{id_client}/{type_cliente}', 'PoliciesController@PoliciesByClients');


Route::get('client/policies/annexes/{id_client}/{type_cliente}', 'ClientsPeopleController@Annexes');


Route::get('client/charge/account/{id_client}/{type_cliente}', 'ClientsPeopleController@Wallet');

Route::get('fasecolda/typevehicule', 'FasecoldaController@typeVehicule');
Route::get('fasecolda/typevehicule/trademark/', 'FasecoldaController@typeVehiculeTrademark');
Route::get('fasecolda/typevehicule/trademark/line', 'FasecoldaController@typeVehiculeTrademarkLine');
Route::get('fasecolda/typevehicule/trademark/line/refer2', 'FasecoldaController@typeVehiculeTrademarkRefer2');
Route::get('fasecolda/typevehicule/trademark/line/refer2/refer3', 'FasecoldaController@typeVehiculeTrademarkRefer2Refer3');

Route::get('fasecolda/get/by/clase/marca/refer1/refer2/refer3', 'FasecoldaController@getByClaseMarcaRefer1Refer2Refer3');

Route::get('fasecolda/value', 'FasecoldaController@value');

Route::get('fasecolda/get/{codigo}', 'FasecoldaController@Get');


Route::get('vehicles/{placa}', 'VehicleController@show');

Route::resource('vehicle', 'VehicleController');

Route::post('vehicle/paginate', 'VehicleController@paginate');

Route::get('cotizaciones/paginate', 'CotizacionesController@index');
Route::put('cotizaciones', 'CotizacionesController@update');
Route::post('cotizaciones/updateStatus', 'CotizacionesController@updateStatus');
Route::get('cotizaciones/status/{id}/{status}', 'CotizacionesController@status');

Route::get('vehicle/status/{id}/{status}', 'VehicleController@status');


Route::get('client/update/location', 'ClientsPeopleController@UpdateLocation');
Route::get('policie/vehicule/{placa}', 'PoliciesController@GetVehicule');
Route::get('client/policie/soat/{cedula}', 'PoliciesController@GetCLientSoat');

Route::get('users/task', 'UsuariosController@GetUsersTasks');

Route::get('task/comment/delete', 'CalendarController@DeleteComment');
Route::get('departamentos', 'DepartamentosController@get');
Route::get('departamentos/municipios/{id}', 'DepartamentosController@getMunicipios');

Route::post('tasks/note/create', 'TasksController@CreateNote');
Route::get('tasks/note/list/{id_user}', 'TasksController@ListNote');

Route::post('tasks/note/update/{id}', 'TasksController@UpdateNote');

Route::post('tasks/note/delete/{id}', 'TasksController@DeleteNote');

Route::get('stadist/client', 'Estadists@Clients');
Route::get('stadist/ganancias', 'Estadists@Ganancias');

Route::get('stadist/policies', 'Estadists@Policies');


Route::get('stadist/policies/next/expired', 'Estadists@PoliciesExpired');

Route::get('stadist/charge/account/pending', 'Estadists@ChargeAccounPending');

Route::get('my/companie/files', 'MyCompanyController@Files');
Route::post('my/companie/files', 'MyCompanyController@StoreFiles');

Route::get('citas/{number_document}', 'PoliciesController@getCitasSalud');

Route::get('select2polizas', 'PoliciesController@select2polizas');


// Endpoints que se utilizan desde el cotizador

Route::prefix('apisura')->group(function(){

	Route::get('getNodosMaestros/{method}', 'CotizadorController@getSuraNodosMaestros');
	Route::get('getPlaca/{placa}', 'CotizadorController@getPlacaSura');
	Route::get('getPlanesFiltrados/{codigoclasevehiculo}/{tiposservicio}', 'CotizadorController@getPlanesFiltrados');
	Route::get('getFasecoldaMarcas/{codigoclasevehiculo}/{modelovehiculo}', 'CotizadorController@getFasecoldaMarcas');

	Route::get('getFasecoldaLineas/{params}', 'CotizadorController@getFasecoldaLineas');
	Route::get('getFasecoldaModelo/{params}', 'CotizadorController@getFasecoldaModelo');
	
	Route::get('getCoberturas/{params}', 'CotizadorController@getCoberturas');
	Route::post('inspeccion', 'CotizadorController@inspeccion');
	Route::post('sarlaft', 'CotizadorController@sarlaft');

	Route::post('cotizarPlanes', 'CotizadorController@cotizarPlanes');
	Route::post('cotizarPlan', 'CotizadorController@cotizarPlan');

	Route::post('test', 'CotizadorController@test');

});
