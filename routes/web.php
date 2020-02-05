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

Route::get('/', function () {
    return view('login');
});

Route::get('/compare', function () {
    return view('compare');
});

Route::post('auth', 'Login@Auth');
Route::get('logout/{id}', 'Login@Logout');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/users', function () {
    return view('perfiles.Users.gestion');
});

Route::get('rol', function () {
    return view('perfiles.Roles.gestion');
});


Route::get('modules', function () {
    return view('perfiles.Modulos.gestion');
});

Route::get('funciones', function () {
    return view('perfiles.Funciones.gestion');
});

Route::get('people', function () {
    return view('clients.people.gestion');
});

Route::get('clients/people/files/{id_client}/{management}', function ($id_client, $management) {
    return view('clients.people.files.gestion', ["id_client" => $id_client, "management" => $management]);
});

Route::get('clients/company/files/{id_client}/{management}', function ($id_client, $management) {
    return view('clients.company.files.gestion', ["id_client" => $id_client, "management" => $management]);
});

Route::get('clients/consortium/files/{id_client}/{management}', function ($id_client, $management) {
    return view('clients.consortium.files.gestion', ["id_client" => $id_client, "management" => $management]);
});


Route::get('policies/files/{id_client}/{management}', function ($id_client, $management) {
    return view('policies.individual.files.gestion', ["id_client" => $id_client, "management" => $management]);
});


Route::get('policies/wallet/{id_policie}/{management}', function ($id_policie, $management) {
    return view('policies.individual.wallet.gestion', ["id_policie" => $id_policie, "management" => $management]);
});

Route::get('policies/grouped/files/{id_client}/{management}', function ($id_client, $management) {
    return view('policies.grouped.files.gestion', ["id_client" => $id_client, "management" => $management]);
});


Route::get('policies/grouped/childs/files/{id_client}/{management}', function ($id_client, $management) {
    return view('policies.grouped.childs.files.gestion', ["id_client" => $id_client, "management" => $management]);
});



Route::get('policies/sinister/files/{id_client}/{management}', function ($id_client, $management) {
    return view('policies.sinister.files.gestion', ["id_client" => $id_client, "management" => $management]);
});



Route::get('people/{id_client}', function ($id_client) {
    return view('clients.show.gestion', ["id_client" => $id_client]);
});



Route::get('company', function () {
    return view('clients.company.gestion');
});

Route::get('consortium', function () {
    return view('clients.consortium.gestion');
});

Route::get('insurers', function () {
    return view('configuracion.insurers.gestion');
});


Route::get('sub-company', function () {
    return view('configuracion.sub_company.gestion');
});

Route::get('sub-company/{id_surgerie}/{management}',function ($id_surgerie, $management) {
    return view('configuracion.insurers.sub_companies.gestion', ["id_surgerie" => $id_surgerie, "management" => $management]);
});


Route::get('insurers/oficce/{id_surgerie}/{management}',function ($id_surgerie, $management) {
    return view('configuracion.insurers.oficce.gestion', ["id_surgerie" => $id_surgerie, "management" => $management]);
});


Route::get('branch', function () {
    return view('configuracion.branch.gestion');
});




Route::get('policies', function () {
    return view('policies.individual.gestion');
});

Route::get('policies/{number_policie}', function ($number_policie) {
    return view('policies.show.gestion', ["number_policie" => $number_policie]);
});


Route::get('policies/annexes/{id_policies}/{management}', function ($id_policies, $management) {
    return view('policies.individual.annexes.gestion', ["id_policies" => $id_policies, "management" => $management]);
});


Route::get('binds/{id_policies}/{management}', function ($id_policies, $management) {
    return view('policies.individual.binds.gestion', ["id_policies" => $id_policies, "management" => $management]);
});


Route::get('policies-childs/{id_policies}/{management}', function ($id_policies, $management) {
    return view('policies.grouped.childs.gestion', ["id_policies" => $id_policies, "management" => $management]);
});



Route::get('policies-grouped', function () {
    return view('policies.grouped.gestion');
});


Route::get('policies/grouped/annexes/{id_policies}/{management}', function ($id_policies, $management) {
    return view('policies.grouped.annexes.gestion', ["id_policies" => $id_policies, "management" => $management]);
});



Route::get('tasks', function () {
    return view('tasks.gestion');
});


Route::get('sinister', function () {
    return view('policies.sinister.gestion');
});


Route::get('payment', function () {
    return view('administracion.payment.gestion');
});



Route::get('payments-receivable', function () {
    return view('administracion.payment-receivable.gestion');
});

Route::get('payments-beaten', function () {
    return view('administracion.payments-beaten.gestion');
});


Route::get('payments-collected', function () {
    return view('administracion.payments-collected.gestion');
});
///////





Route::get('policies/wallet/files/{id_charge}/{management}', function ($id_charge, $management) {
    return view('policies.individual.wallet.files.gestion', ["id_charge" => $id_charge, "management" => $management]);
});


Route::get('import', 'ImportController@import');





Route::get('Company', function () {
    return view('configuracion.Company.gestion');
});







