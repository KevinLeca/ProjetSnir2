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

/* PAGES DE MESURES */
Route::get('/Mesures', 'RequestController@getMesures');
Route::get('/MesuresB', 'PagesController@getB');
Route::get('/MesuresC', 'PagesController@getC');
Route::get('/MesuresD', 'PagesController@getD');
Route::get('/MesuresF', 'PagesController@getF');
Route::get('/MesuresG', 'PagesController@getG');
/* ---------------- */

/* PAGES D'ALERTES */
Route::get('/Alertes', 'RequestController@getAlertes');
Route::post('Alertes/submit', 'RequestController@getAlertesRecherche');
Route::post('Alertes/acquitter', 'RequestController@acquitter');
/* --------------- */

/* RESSOURCES POUR GRAPH TEST */
Route::get('/dataGraph', 'RequestController@getData');
/*--------------------------*/