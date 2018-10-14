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

Route::get('/bla', function () {
    return view('welcome');
});


Route::get('/users/{id}', function ($id) {                  //Dynamic paramaters Route
    return 'This is user '.$id;                             //Als je "http://movie.work/users/Alara" intypt krijg je 
                                                            //"This is user Alara te lezen"      
});


Route::get('/about', function () {                          //Door dit te doen ga je naar view van about-page
      return view('pages/about');                           //Je kan ook pages.about typen
});

*/

Route::get('/', 'PagesController@index');                     //De functie naam is "index" op de PagesController die 
//Route::get('/list', 'PagesController@list');                //functie word opgeroepen.
Route::get('/services', 'PagesController@services');

//Dashboard lijst
Route::get('/dashboard', 'DashboardController@index');

Route::resource('/posts', 'PostsController');               //posts-route kan je nu alle functies van PostsController gebruiken.

//Already watched movies
route::resource('/list', 'MoviesController');                //Geconnecteerd met alle functies van de moviescontroller.

Auth::routes();                                             //Automatisch gekomen bij de download (php artisan route:list)