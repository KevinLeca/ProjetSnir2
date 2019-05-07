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

/* PAGE D'ACCUEIL */

Route::get('/', 'PagesController@getHome');

/* ---------------*/ 

/* PAGES DE MESURES */

// Routes batiment B
Route::get('/MesuresB', 'PagesController@getB');
Route::post('MesuresB/submit', 'PagesController@getBRecherche');
// Routes batiment C
Route::get('/MesuresC', 'PagesController@getC');
Route::post('MesuresC/submit', 'PagesController@getCRecherche');
// Routes batiment D
Route::get('/MesuresD', 'PagesController@getD');
Route::post('MesuresD/submit', 'PagesController@getDRecherche');
// Routes batiment F
Route::get('/MesuresF', 'PagesController@getF');
Route::post('MesuresF/submit', 'PagesController@getFRecherche');
// Routes batiment G
Route::get('/MesuresG', 'PagesController@getG');
Route::post('MesuresG/submit', 'PagesController@getGRecherche');

/* ---------------- */

/* PAGES D'ALERTES */

Route::get('/Alertes', 'RequestController@getAlertes');
Route::post('Alertes/submit', 'RequestController@getAlertesRecherche');
Route::post('Alertes/acquitter', 'RequestController@acquitter');

/* --------------- */