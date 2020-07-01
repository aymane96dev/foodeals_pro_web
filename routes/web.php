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

Route::get('/foo', function () {
Artisan::call('storage:link');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('listeUsers', 'UserController@index');
Route::post('/userStore', 'UserController@store');
Route::post('/userUpdate', 'UserController@update');

Route::get('/activerUser/{id}', 'UserController@activer');
Route::get('/bloquerUser/{id}', 'UserController@bloquer');

Route::get('/listeClients', 'ClientController@index');
Route::get('/commadeClients/{id}', 'ClientController@details');
Route::get('/detailsCommande/{id}', 'ClientController@detailCommande');

Route::get('restaurant','RestaurantController@index');
Route::post('nouveauResto','RestaurantController@store');
Route::post('ModifierResto','RestaurantController@update');
Route::get('activerRestaurant/{id}','RestaurantController@activerRestaurant');
Route::get('bloquerRestaurant/{id}','RestaurantController@bloquerRestaurant');

Auth::routes();

Route::get('/home', 'RestaurantController@index')->name('home');
Route::get('client','ClientController@index');

Route::get('afficherfav/{id}','ClientController@affichefav');

Route::get('pdf','GenererPDF@index1');
Route::get('pdf1','GenererPDF@index');



Route::get('pdf2','GenererPDF@impression');
Route::get('pdf3','GenererPDF@impression1');

Route::post('findrest','RestaurantController@find');

Route::post('askrecuperation','RestaurantController@askrecuperation');
Route::get('resprecuperation/{tcode}','RestaurantController@resprecuperation');


// mail

// Web services

Route::get('loginClient/{token}/{email}/{password}', 'Service_Controller@login');
Route::get('restaurants', 'Service_Controller@ListRestaurants');

Route::post('produits', 'Service_Controller@ListProduit');
Route::post('favoris', 'Service_Controller@ListFavoris');

// End Web services


// ------------------ start youssef Ed-dyb ------------------
//List of routes for  type restaurant
Route::get('/typeRestaurant', 'TyperestaurantController@acceuil');
Route::get('listRestaurant', 'TyperestaurantController@index');
Route::post('/typeStore', 'TyperestaurantController@store');
Route::post('/edittype/{id}', 'TyperestaurantController@update');
Route::post('/deletetype/{id}', 'TyperestaurantController@destroy');
//end routes

//List of routes for  type produit

Route::get('/typeProduit', 'TypeProduitController@acceuil');
Route::get('listTypeProduit', 'TypeProduitController@index');
Route::post('/AddTypeProduit', 'TypeProduitController@store');
Route::post('/editTypeProduit/{id}', 'TypeProduitController@update');
Route::post('/deleteTypeProduit/{id}', 'TypeProduitController@destroy');
//end routes

///end youssef Ed-dyb


Route::get('askrecuperation', 'ServiceController_recuperation@askrecuperation');

Route::get('getyperesto/{id}', 'RestaurantController@typesresto');



// Statistiques Routes

Route::get('/getpartenaires','CommandController@getcities');
Route::post('/getpartenaires2','CommandController@getcities');
Route::get('/gettable','CommandController@gettable');
Route::get('/gettableasync','CommandController@gettableasync');
Route::get('/gettotcat','CommandController@getcat');
Route::get('/getpar/{id}','CommandController@getpar');
Route::get('/getproduits/{id}/{i}','CommandController@getproduits');
Route::get('/getpltspartsfiltre/{id}/{i}','CommandController@getpltsparts');
Route::get('/getrevsrest/{id}/{i}','CommandController@getrevsrest');
Route::get('/getinfos','CommandController@getinfos');
Route::get('/getprdsbyday/{id}','CommandController@getprdsbyday');
Route::get('/getpltspartsperday/{id}','CommandController@getpltspartsperday');
Route::get('/getrevsrestperday/{id}','CommandController@getrevsrestperday');
Route::get('/getcatfirst','DashBoard2Controller@getcatfirst');
Route::get('/getcatproduits/{id}/{i}','DashBoard2Controller@getcatproduits');
Route::get('/getcatproduitsperday/{id}','DashBoard2Controller@getcatproduitsperday');
Route::get('/gettotalcommandes/{id}/{i}','DashBoard2Controller@gettotalcommandes');
Route::get('/getdashboard2','DashBoard2Controller@getplat');
Route::post('/getdashboard2post','DashBoard2Controller@getplat');
Route::get('/getcmmdsperday/{id}','DashBoard2Controller@getcmmdsperday');
Route::get('/getcltscmmdsfirst','DashBoard2Controller@getcltscmmdsfirst');
Route::get('/getcltscmmds/{id}/{i}','DashBoard2Controller@getcltscmmds');
Route::get('/getcltscmmdsperday/{id}','DashBoard2Controller@getcltscmmdsperday');
Route::get('/getclientscommandes/{id}/{i}','DashBoard2Controller@getclientscommandes');
Route::get('/getclientscommandesperday/{id}','DashBoard2Controller@getclientscommandesperday');
Route::get('/getsommemens/{id}/{i}','DashBoard2Controller@getsommemens');
Route::get('/getsommemensperday/{id}','DashBoard2Controller@getsommemensperday');
Route::get('/getcmmdsmonthfirst','DashBoard2Controller@getcmmdsmonthfirst');
Route::get('/getsommemensfirst','DashBoard2Controller@getsommemensfirst');
Route::get('/getintprixfirst','DashBoard3Controller@getintprixfirst');
Route::get('/getintprix/{id}/{i}','DashBoard3Controller@getintprix');
Route::get('/getintprixperday/{id}','DashBoard3Controller@getintprixperday');
Route::get('/getdashboard3','DashBoard3Controller@getview');
Route::post('/getdashboard3post','DashBoard3Controller@getview');
Route::get('/getmodalitefirst','DashBoard3Controller@getmodalitefirst');
Route::get('/getmodalite/{id}/{i}','DashBoard3Controller@getmodalite');
Route::get('/getmodaliteperday/{id}','DashBoard3Controller@getmodaliteperday');
Route::get('/getformnotifsparts','NotifsController@getform');
Route::post('/getinfosnotifsparts','NotifsController@getinfos');
Route::get('/getnotifsclients','NotifsController@getformclts');
Route::post('/postnotifsclients','NotifsController@getinfosclts');