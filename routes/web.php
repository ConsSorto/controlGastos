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
    return view('welcome');
})->name('welcome');

Auth::routes(['verify'=>true]);
Route::get('/usuarios', 'userController@index')->name('user.index');
Route::get('/usuarios/{user}/edit', 'userController@edit')->name('user.edit');
Route::delete('/usuarios/{user}', 'userController@destroy')->name('user.destroy');
Route::get('/usuarios/{user}', 'userController@show')->name('user.show');
Route::put('/usuarios/{user}', 'userController@update')->name('user.update');
Route::resource('expense_types', 'expense_typeController');
Route::get('/expense_controls/graph/{id}', 'graphController@piechart')->name('expense_controls.graph');
Route::resource('expense_controls', 'expense_controlController');
Route::put('expense_controls/activate/{expense_control}', 'expense_controlController@activate')->name('expense_controls.activate');
Route::get('/home', 'homeController@index')->name('home');
Route::get('expense_details/create', 'expense_detailsController@create')->name('expense_details.create');
Route::post('expense_details/store', 'expense_detailsController@store')->name('expense_details.store');
