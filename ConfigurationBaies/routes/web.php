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

/*Page d'accueil*/
Route::get('/', function () {
    return view('accueil');
});


/*Pages de configuration des seuils des baies*/
//Route::get('/', 'BaieController@getB');
Route::get('/baieB', 'BaieController@getB');
Route::get('/baieC', 'BaieController@getC');
Route::get('/baieD', 'BaieController@getD');
Route::get('/baieF', 'BaieController@getF');
Route::get('/baieG', 'BaieController@getG');

Route::post('submitBaie','BaieController@majSeuilsBaies');


/*Page configuration des seuils des équipements*/
Route::get('/equipementB', 'EquipementController@getB');
Route::get('/equipementC', 'EquipementController@getC');
Route::get('/equipementD', 'EquipementController@getD');
Route::get('/equipementF', 'EquipementController@getF');
Route::get('/equipementG', 'EquipementController@getG');

Route::post('/submitEquipement','EquipementController@majSeuilsEquipements');


/*Page liste des équipements*/
Route::get('/listeEquipements', 'ListeEquipementsController@getListeEquipements');

Route::post('/submitListeEquipements','ListeEquipementsController@majListeEquipements');


/*Page contacts*/
Route::get('/contacts', 'ContactsController@getContacts');

Route::post('/addContact','ContactsController@addContact');
Route::post('/submitContact','ContactsController@majContact');
Route::post('/reloadContact','ContactsController@reloadContact');
Route::post('/deleteContact','ContactsController@deleteContact');

