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
    /* SOLUTIONS POUR PASSER DES VARIABLES */
    /* 1 */
    // return view('welcome', [
    //     'name' => 'Laravel project 1'
    //     /* on passe des variables */
    // ]);

    /* 2 */
    return view('welcome')->with('name', 'Laravel project 1' /* ... */);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
