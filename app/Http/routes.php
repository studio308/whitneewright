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

Route::get('/', function () {
    return view('home');
});

Route::auth();

Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');

$categories = Categories::all();

foreach($categories as $category)
{
    Route::get($category->alias, ['as' => 'categories.'.$category->alias, 'uses' => 'CategoriesController@showByAlias']);
}

Route::get('/works', 'WorksController@index');
Route::get('/works/{id}', 'WorksController@show');
Route::get('/works/{workAlias}', ['as' => 'works.show', 'uses' => 'WorksController@show']);