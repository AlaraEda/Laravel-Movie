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
| URL'S, het systeem begint hier.
|
*/

/* 
|------------------------------------------------------------------------
|A person never wants to return a view from their route; 
|Wat you want is to create a controller than set the route to 
|go to a certain controller function & then return the view.
|
|php artisan make:controller PagesController
|-------------------------------------------------------------------------

*/


Route::get('/', 'PagesController@index');                     //De functie naam is "index" op de PagesController die 
//Route::get('/services', 'PagesController@services');

//DropDown-Pagina's
Route::resource('/overzicht','MoviesController');           //Alle Film-Namen
Route::resource('/list','MoviesController');                //Tabel-Pagina
Route::resource('/genre','MoviesController');               //Gecategoriseerd

//DropDown-Pagina
Route::get('/overzicht', 'MoviesController@overzicht');
Route::get('/list', 'MoviesController@list');

//Radomizer
Route::get('/dashboard', 'DashboardController@index');

//Watchlist
//Route::get('/watchlist', 'WatchlistController@index');
Route::resource('/watchlist', 'WatchlistController');

//Shared List
Route::get('/sharedlist','WatchlistController@shared');


Route::resource('/posts', 'PostsController');                //posts-route kan je nu alle functies van PostsController gebruiken.

Auth::routes();                                             //Automatisch gekomen bij de download (php artisan route:list)