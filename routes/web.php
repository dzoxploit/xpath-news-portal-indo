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
 /* untuk menampilkan data antara news berbasis html */
Route::get('/articles-antara', 'XpathArticlesController@index_antara_news');

 /* untuk menampilkan detail article dari data antara news berbasis html */
Route::get('/detail-antara-news','XpathArticlesController@detail_antara_news');

 /* digunakan untuk menampilkan data tribunnews dari rss xml */
 Route::get('/articles-tribunnews', 'XpathArticlesController@index_xpath');

 /* digunakan untuk menampilkan data antara news dari rss xml */
Route::get('/articles-antara-rss-path', 'XpathArticlesController@index_xpath_antara_news');

         /* digunakan untuk menampilkan article yang telah tersimpan di database */
Route::get('/article', 'XpathArticlesController@index_article');

  /* digunakan untuk menampilkan detail article yang telah tersimpan di database */
Route::get('/detail-article/{id}','XpathArticlesController@detail_article');

     /* digunakan untuk menghapus article yang telah tersimpan di database */
Route::post('/delete-article/{id}', 'XpathArticlesController@delete');

Route::get('/articles-liputan6', 'Liputan6comController@index_liputan6');
