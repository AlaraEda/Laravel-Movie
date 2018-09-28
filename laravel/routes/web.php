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
});

/*Dynamic paramaters Route
Als je "http://movie.work/users/Alara" intypt krijg je "This is user Alara te lezen" */
Route::get('/users/{id}', function ($id) {
    return 'This is user '.$id;        
});

/* A person never wants to return a view from their route; 
Wat you want is to create a controller than set the route to 
got to a certain controller function & then return the view.

php artisan make:controller PagesController*/

//Door dit te doen ga je naar view van pages
// Route::get('/about', function () {
//     return view('pages/about');         //Je kan ook pages.about typen
// });

//De functie naam is "index" op de PagesController. Door dit te doen is het geconnecteerd met de Controller's Method
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

//We want to map posts to a controller;
//Doing this creates all the routes we need for the controller
//Alle functies van de PostsController hebben nu een route
Route::resource('posts', 'PostsController'); 