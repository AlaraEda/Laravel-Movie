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

Route::get('/', 'PagesController@index');                               //De functie "index" van de PagesController 

//DropDown-Pagina's
Route::resource('/overzicht','MoviesController');                       //Alle Film-Namen
Route::post('/overzicht/{id}', ['uses' => 'MoviesController@flip']);    //flip-functie
Route::resource('/list','MoviesController');                            //Tabel-Pagina
//Route::resource('/genre','MoviesController');                         //Gecategoriseerd

//Watchlist-Page
Route::resource('/watchlist', 'WatchlistController');                   //Watchlist-page
Route::get('/watchlist', 'WatchlistController@watchlist');
Route::post('/watchlist/{id}', ['uses' => 'WatchlistController@flip']); //flip-functie

//DropDown-Pagina
Route::get('/overzicht', 'MoviesController@overzicht');
Route::post('/overzicht', 'MoviesController@overzicht');
Route::get('/list', 'MoviesController@list');
Route::post('/list/search', 'MoviesController@search');

//Shared List
Route::get('/sharedlist','WatchlistController@shared');

Auth::routes();                                                         //Automatisch gekomen bij de download (php artisan route:list)