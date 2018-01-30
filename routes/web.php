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

//This is the landing page where we will show the repository list with  pagination
Route::get('/', 'GithubController@index');

//This is the landing page where we will show the repository list with  pagination
Route::get('repo/{id}', 'GithubController@repo');

//Page for pulling data from repo and save in local DB table
Route::get('/fetch', 'GithubController@fetch');

