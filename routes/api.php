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
Route::get('peoples/paginate', 'ClientsPeopleController@GetPaginate');

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
Route::post('uploads/deleteCaratulaBinds', 'PoliciesController@deleteCaratulaBinds');

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

Route::get('exports/policies/{id_user}/{state}/{insurance}/{branch}/{date_init}/{date_finish}/{cedula}/{placa}', 'PoliciesController@Excel');



Route::resource('sinister', 'SinistersController');
Route::get('sinister/client/{id_client}', 'SinistersController@GetByClient');
Route::get('status-sinister/{id}/{status}', 'SinistersController@status');


Route::get('get/sinister/{companie}/{sinister}/{branch}/{rol}', 'SinistersController@index');
Route::get('sinister/get/comments/{state}/{id}', 'SinistersController@getComments');
Route::post('sinister/store/comments', 'SinistersController@storeComments');

Route::get('sinister/get/files/{state}/{id}', 'SinistersController@getFiles');
Route::post('sinister/store/files', 'SinistersController@storeFiles');

Route::get('sinister/get/states/{id}', 'SinistersController@getStates');


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

// se busca por numero de documento (cliente || Empresa && vinculado)
Route::get('clients/policies/{number_document}', 'PoliciesController@PoliciesByClients');
// Route::get('clients/policies_bind/{id_policies_bind}', 'PoliciesController@PoliciesByBind');


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


Route::get('vehicles/asyncPlacaVehiculos', 'VehicleController@asyncPlacaVehiculos');

Route::get('vehicles/{placa}', 'VehicleController@show');

Route::resource('vehicle', 'VehicleController');

Route::post('vehicle/paginate', 'VehicleController@paginate');

Route::post('cotizaciones/paginate', 'CotizacionesController@paginate');
Route::put('cotizaciones/{id}', 'CotizacionesController@update');

Route::post('cotizaciones/updateStatus', 'CotizacionesController@updateStatus');
Route::get('cotizaciones/status/{id}/{status}', 'CotizacionesController@status');

Route::post('cotizaciones_hogar/paginate', 'CotizacionesHogarController@paginate');
Route::get('cotizaciones_hogar/status/{id}/{status}', 'CotizacionesHogarController@status');



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

Route::get('stadist/policies/next/vigentes','Estadists@PoliciesVigentes');
Route::get('stadist/policies/next/expired','Estadists@PoliciesExpired');
Route::get('stadist/policies/next/vencidas','Estadists@PoliciesVencidas');

Route::get('stadist/charge/account/pending', 'Estadists@ChargeAccounPending');

Route::get('my/companie/files', 'MyCompanyController@Files');
Route::post('my/companie/files', 'MyCompanyController@StoreFiles');

Route::get('citas/{number_document}', 'PoliciesController@getCitasSalud');

Route::get('select2polizas', 'PoliciesController@select2polizas');

Route::get('RememberPolicies', 'NotificacionesController@remember');


Route::get('notifications/get', 'NotificacionesController@Get');
Route::get('notifications', 'NotificacionesController@GetAll');


Route::get('user/last/connection/{id_user}', 'UsuariosController@LastConnection');




Route::get('policies/by/branch/{branch}/{id_client}', 'PoliciesController@PoliciesByBranch');


Route::get('policies/of/vehicule/{id_client}', 'PoliciesController@PoliciesByVehicule');



Route::post('report/sinister', 'SinistersController@ReportSinister');
Route::get('get-coordenadas/{lat}/{long}','HospitalesController@ObtenerCoordenadas');
Route::get('policies/accidentes/personales/{id_cliente}', 'PoliciesController@getPolicieAccidentes');

Route::get('get/report/sinister', 'SinistersController@GetReports');



Route::post('saveNewReporte','PoliciesController@saveNewReporte');

Route::post('register/client/people','OrderPolicieController@RegisterClientPeople');
Route::post('create/order/pdf','OrderPolicieController@CreatePdf');
Route::get('download/order/pdf/{id_order}','OrderPolicieController@DownloadPdf');

Route::post('comment/cotizacion/vehiculo','CotizacionesController@CommentCotizacion');
Route::get('comment/cotizacion/vehiculo/{id_cotizacion}','CotizacionesController@GetCommentCotizacion');



Route::post('emailCotizador','CotizacionesController@EmailCotizador');


Route::get('get/offert/{id_client}','PoliciesController@GetOffert');
Route::get('update/offert/{id_client}','ClientsController@UpdateOffert');

Route::get('pdf/liberty/{id_coti}/{plan}','LibertyController@PdfPlan');


// // Endpoints que se utilizan desde el cotizador
// Route::prefix('apisura')->group(function(){
// 	Route::get('getNodosMaestros/{method}', 'CotizadorController@getSuraNodosMaestros');
// 	Route::get('getPlaca/{placa}', 'CotizadorController@getPlacaSura');
// 	Route::get('getPlanesFiltrados/{codigoclasevehiculo}/{tiposservicio}', 'CotizadorController@getPlanesFiltrados');
// 	Route::get('getFasecoldaMarcas/{codigoclasevehiculo}/{modelovehiculo}', 'CotizadorController@getFasecoldaMarcas');
// 	Route::get('getFasecoldaLineas/{params}', 'CotizadorController@getFasecoldaLineas');
// 	Route::get('getFasecoldaModelo/{params}', 'CotizadorController@getFasecoldaModelo');
// 	Route::get('getCoberturas/{params}', 'CotizadorController@getCoberturas');
// 	Route::post('inspeccion', 'CotizadorController@inspeccion');
// 	Route::post('sarlaft', 'CotizadorController@sarlaft');
// 	Route::post('cotizarPlanes', 'CotizadorController@cotizarPlanes');
// 	Route::post('cotizarPlan', 'CotizadorController@cotizarPlan');
// 	Route::post('test', 'CotizadorController@test');
// });
