<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Categories;
use App\Work;

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::auth();

Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');

$categories = Categories::all();

foreach($categories as $category)
{
    Route::get('/'.$category->name, ['as' => 'categories.'.$category->alias, 'uses' => 'CategoriesController@showByAlias']);
}


Route::get('/works', 'WorksController@index');
Route::get('/works/{id}', 'WorksController@show');
Route::get('/works/{workAlias}', ['as' => 'works.show', 'uses' => 'WorksController@show']);

Route::get('/events', [
    'as' => 'events.index',
    'uses' =>  'EventsController@index'
]);
Route::get('/events/{eventAlias}', ['as' => 'events.show', 'uses' => 'EventsController@show']);

Route::get('/admin', [
    'as' => 'admin.index',
    'uses' => 'Admin\AdminController@index'
]);
Route::get('/admin/categories', [
    'as' => 'admin.categories',
    'uses' => 'Admin\AdminController@categories'
]);
Route::get('/admin/works', [
    'as' => 'admin.works',
    'uses' => 'Admin\AdminController@addWorks'
]);
Route::get('/admin/events', [
    'as' => 'admin.events',
    'uses' => 'Admin\AdminController@events'
]);

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers'], function ($api) {
    $api->post('/admin/categories/store', [
        'as' => 'categories.store',
        'uses' => 'Api\CategoriesApiController@store'
    ]);
    $api->post('/admin/categories/delete', [
        'as' => 'categories.delete',
        'uses' => 'Api\CategoriesApiController@delete'
    ]);

    $api->post('/admin/works/store', [
        'as' => 'works.store',
        'uses' => 'Api\WorksApiController@store'
    ]);
    $api->post('/admin/works/update/{id}', [
        'as' => 'works.update',
        'uses' => 'Api\WorksApiController@update'
    ]);
    $api->post('/admin/works/delete/{id}', [
        'as' => 'works.delete',
        'uses' => 'Api\WorksApiController@delete'
    ]);
    $api->post('/admin/works/store-image', [
        'as' => 'works.storeImage',
        'uses' => 'Api\WorksApiController@storeImage'
    ]);
    $api->post('/admin/works/delete-image', [
        'as' => 'works.deleteImage',
        'uses' => 'Api\WorksApiController@deleteImage'
    ]);

    $api->post('/admin/events/store', [
        'as' => 'events.store',
        'uses' => 'Api\EventsApiController@store'
    ]);
});