<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
     /* Api untuk menyimpan data ke database */
Route::post('/generate-save-articles-antara-news', 'XpathArticlesController@generate_save_xpath_antara_news');
Route::post('/generate-save-articles-tribunnews', 'XpathArticlesController@generate_save_xpath_tribunnews');
     /* Api untuk menyimpan data ke database metode crawling */
Route::post('/generate-save-articles-antara-news-crawling', 'XpathArticlesController@generate_save_xpath_antara_news_crawling');
Route::post('/generate-save-articles-tribunnews-crawling', 'XpathArticlesController@generate_save_xpath_tribunnews_crawling');
Route::post('/delete-article/{id}', 'XpathArticlesController@delete');
