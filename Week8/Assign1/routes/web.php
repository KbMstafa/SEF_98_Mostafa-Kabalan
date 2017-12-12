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

Route::get('/articles', "ArticleController@all");

Route::get('/', function() {
    return redirect("/articles");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get("/article/{id}", "ArticleController@onId");

Route::get('/home/{id}', "HomeController@userArticles")->name('homeId');

Route::get('/create', 'ArticleController@createArticle');

Route::post('/create', 'ArticleController@postArticle');

/*Route::post('/create/{title}/{text}', 'ArticleController@postArticle')->name('cr');*/