<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/organization/{id}','OrganizationController@getOrganizationDetail');
    Route::get('/create-organization',function () {
        return view('organization.organization-create');
    });
    Route::post('create-organization');
    Route::get('/organization/create-pic');
    Route::post('/organization/create-pic');
    Route::get('/organization/edit/{id}');
    Route::post('/organization/edit/{id}');
    Route::post('/organization/assign-manager');
    Route::post('/organization/delete');
    Route::post('/organization/delete-pic');
});

