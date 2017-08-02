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

//Role management
Route::get('/role', 'RoleController@index');
Route::get('/roles-view', 'RoleController@view');
Route::get('/role/edit/{id}', 'RoleController@edit');
Route::post('/role/save', 'RoleController@save');
Route::get('/role/delete/{id}', 'RoleController@delete');

//User management
Route::get('/user', 'UserController@index');
Route::get('/users-view', 'UserController@view');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/save', 'UserController@save');
Route::get('/user/delete/{id}', 'UserController@delete');

//Category management
Route::get('/cat', 'CategoryController@index');
Route::get('/cat/edit/{id}', 'CategoryController@edit');
Route::post('/cat/save', 'CategoryController@save');
Route::get('/cat/delete/{id}', 'CategoryController@delete');

//Task Objective management
Route::get('/taskobj', 'TaskObjectiveController@index');
Route::get('/taskobj/edit/{id}', 'TaskObjectiveController@edit');
Route::post('/taskobj/save', 'TaskObjectiveController@save');
Route::get('/taskobj/delete/{id}', 'TaskObjectiveController@delete');

//Group management
Route::get('/group', 'GroupController@index');
Route::get('/group/edit/{id}', 'GroupController@edit');
Route::post('/group/save', 'GroupController@save');
Route::get('/group/delete/{id}', 'GroupController@delete');

//Client management
Route::get('/client', 'ClientController@index');
Route::get('/client/create', 'ClientController@create');
Route::get('/client/edit/{id}', 'ClientController@edit');
Route::post('/client/save', 'ClientController@save');
Route::get('/client/delete/{id}', 'ClientController@delete');
Route::get('/client/del-att/{id}', 'ClientController@delete_att');

//Task management
Route::get('/task', 'TaskController@index');
Route::get('/task/edit/{id}', 'TaskController@edit');
Route::post('/task/save', 'TaskController@save');
Route::get('/task/delete/{id}', 'TaskController@delete');

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('att/{path?}', 'HomeController@file')->where('path', '(.*)');
