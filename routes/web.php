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
    return redirect('home');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/organization/{id}', 'OrganizationController@getOrganizationDetail');
    Route::get('/create-organization', 'OrganizationController@getCreateOrganization')->middleware('admin-auth');
    Route::post('create-organization', 'OrganizationController@postCreateOrganization')->middleware('admin-auth');

    Route::prefix('organization')->group(function () {
        Route::get('/edit/{organization_id}', 'OrganizationController@getEditOrganization');
        Route::post('/edit', 'OrganizationController@postEditOrganization');
        Route::post('/delete', 'OrganizationController@postDeleteOrganization')->middleware('admin-auth');
        Route::post('/assign-manager', 'OrganizationController@postAssignManager')->middleware('admin-auth');
        Route::get('/create-pic/{organization_id}', 'OrganizationController@getCreatePIC');
        Route::post('/create-pic', 'OrganizationController@postCreatePIC');
        Route::get('/edit-pic/{organization_id}/{pic_id}', 'OrganizationController@getEditPIC');
        Route::post('/edit-pic', 'OrganizationController@postEditPIC');
        Route::post('/delete-pic', 'OrganizationController@postDeletePIC');
    });
});

