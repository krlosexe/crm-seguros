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

Route::get('company', function () {
    return view('clients.company.gestion');
});

Route::get('consortium', function () {
    return view('clients.consortium.gestion');
});

Route::get('insurers', function () {
    return view('configuracion.insurers.gestion');
});


Route::get('branch', function () {
    return view('configuracion.branch.gestion');
});


Route::get('policies', function () {
    return view('policies.individual.gestion');
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



Route::get('tasks', function () {
    return view('tasks.gestion');
});


Route::get('sinister', function () {
    return view('policies.sinister.gestion');
});




///////




















