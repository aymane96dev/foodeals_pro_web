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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});
//Route::post('askrecuperation','ServiceController_recuperation@askrecuperation');
Route::post('askrecuperation','Service_Controller@askrecuperation');
Route::post('ListAllProduit', 'Service_Controller@ListAllProduit');
Route::post('ListAllProduitWhereCity', 'Service_Controller@ListAllProduitWhereCity');
Route::post('ListProduit', 'Service_Controller@ListProduit');
Route::post('produit', 'Service_Controller@ListProduitSolo');
Route::post('loginRest', 'Service_Controller@loginRest');
Route::post('validRest', 'Service_Controller@Validation_Compte');
Route::post('validClient', 'Service_Controller@Validation_Client');

Route::post('ProduitApreparer', 'Service_Controller@ListProduitApreparer');
Route::post('ListCommande', 'Service_Controller@ListCommande');
Route::post('GetRestaurantsDet', 'Service_Controller@GetRestaurants');
Route::post('restaurants', 'Service_Controller@ListRestaurants');
Route::post('restaurantsCity', 'Service_Controller@ListRestaurantsWhereCity');
Route::post('restaurantsAll', 'Service_Controller@ListRestaurantsAll');
Route::post('restaurantsAllBycity', 'Service_Controller@ListRestaurantsAllbycity');
Route::post('produits_proxi', 'Service_Controller@ProdAproxi');
Route::post('produits_proxiCity', 'Service_Controller@ProdAproxiCity');
Route::post('getrestaurants', 'Service_Controller@ListRestaurantsparid');
Route::post('GetProduit', 'Service_Controller@GetProduit');
Route::post('Verify', 'Service_Controller@verifRest');
Route::post('verifClient', 'Service_Controller@verifClient');
//Route::post('newCommande', 'Service_Controller@newCommande');
Route::post('/inscriptionclient', 'Service_Controller@Inscription');
Route::post('Verifyclient', 'Service_Controller@LoginClient');
Route::post('StoreProduit', 'Service_Controller@storeProduit');
Route::post('ModProduit', 'Service_Controller@updateProduit');
Route::post('DelProduit', 'Service_Controller@bloquerProduit');
Route::post('GetHistorique', 'Service_Controller@historique');
Route::post('newCommande', 'Service_Controller@AjouterPanier');
Route::post('updateClient', 'Service_Controller@updateClient');
Route::post('updatePassClient', 'Service_Controller@updatePassClient');
Route::post('ListMyCom', 'Service_Controller@MesCommandes');
Route::post('ListMyprocom', 'Service_Controller@MesProduitCom');
Route::post('ListScan', 'Service_Controller@ListScannable');
Route::post('Signerpr', 'Service_Controller@Signerproduit');
Route::post('GetSgnproduit', 'Service_Controller@Sgnproduit');
Route::post('favoriAdd', 'Service_Controller@ajouteFavori');
Route::post('favoriList', 'Service_Controller@GetFavoris');
Route::post('favoriDel', 'Service_Controller@DeleteFavoris');
Route::post('favoriDelAll','Service_Controller@Deletefav');
Route::post('GetAllVilles','Service_Controller@GetVilles');
Route::post('GetAllVilles','Service_Controller@GetVilles');
Route::post('GetAllTypeproduct','Service_Controller@getTypeproduct');
Route::post('GetAllType','Service_Controller@getType');
Route::post('DetCom','Service_Controller@DetComma');
Route::post('bestsal','Service_Controller@bestsales');
Route::post('bestsalbycity','Service_Controller@bestsalesbycity');
Route::post('AllcityMaroc','Service_Controller@Allcitymaroc');
Route::post('cityby','Service_Controller@cityByword');






//--get
Route::get('send', 'Service_Controller@send_notificatio');

