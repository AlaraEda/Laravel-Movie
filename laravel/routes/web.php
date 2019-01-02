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
|
|Get       = URL ophalen
|Post      = Data versturen
|Resource  = Alle Functies in de controler gebruiken
|-------------------------------------------------------------------------
*/

Route::get('/', 'PagesController@index');                               //De functie "index" van de PagesController 

//Overzicht
Route::resource('/overzicht','MoviesController');                       //Alle Film-Namen
Route::get('/overzicht', 'MoviesController@overzicht');
Route::post('/overzicht/search', 'MoviesController@search');                      //search
Route::post('/overzicht/{id}', ['uses' => 'MoviesController@flip']);    //flip-functie
Route::post('/filter', 'MoviesController@overzicht');                   //filter


//Route::resource('/genre','MoviesController');                         //Gecategoriseerd

//Watchlist-Page
Route::resource('/watchlist', 'WatchlistController');                   //Watchlist-page
Route::get('/watchlist', 'WatchlistController@watchlist');
Route::post('/watchlist/search', 'WatchlistController@search');                    //search
Route::post('/watchlist/{id}', ['uses' => 'WatchlistController@flip']); //flip-functie


//Shared List
Route::get('/sharedlist','WatchlistController@shared');

//Admin-page
Route::group(['middleware'=> ['auth','admin']], function(){             //Achter je route zit een middleware achter. 
    Route::resource('information','InformationController');               //Informatie-Pagina --> Tabel-Pagina
    
    
    Route::get('/information/{id}', ['uses' => 'InformationController@show']);

    Route::get('/information/{id}/search', 'InformationController@Search');
    //Route::post('/information/{id}/search', 'InformationController@Search');

    Route::post('/information/search', 'InformationController@indexSearch');  
});

Auth::routes();                                                         //Automatisch gekomen bij de download (php artisan route:list)