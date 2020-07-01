<?php

namespace App\Http\Controllers;

use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Commande;

class CommandController extends Controller
{
    public function gettable() {

        $infos = DB::table('commandes')
        ->join('detailcommandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
        ->join('produits', 'produits.id', '=', 'detailcommandes.produits_id')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->select('detailcommandes.date_collecte','commandes.checked_at','commandes.id','produits.name','restaurants.tele','restaurants.name as res_nom')
        ->orderby('commandes.created_at','desc')->paginate(10);
    	return view('statistiques.TableComplet',['infos' => $infos]);
    }

    public function gettableasync() {

        $infos = DB::table('commandes')
        ->join('detailcommandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
        ->join('produits', 'produits.id', '=', 'detailcommandes.produits_id')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->select('detailcommandes.date_collecte','commandes.checked_at','commandes.id','produits.name','restaurants.tele','restaurants.name as res_nom')
        ->orderby('commandes.created_at','desc')
        ->paginate(10);
    	return view('statistiques.tableview',['infos' => $infos]);
    }

    public function getcat()
    {
        $infos = DB::table('produits')
        ->select('produits.name','produits.qte')->get();
         return $infos;
    }

    public function getpar($id)
    {
        $infos = DB::table('restaurants')
        ->select(DB::raw('count(*) as numberof'))
        ->where('restaurants.villes_id',$id)
        ->get();
         return $infos;
    }

    public function getproduits($id,$i)
    {
        $nbrprds = DB::table('produits')
        ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
        ->select(DB::raw('count(*) as products'))
        ->where(DB::raw('EXTRACT(MONTH FROM produits.created_at)'),[$id])
        ->where('restaurants.villes_id','=',$i)
        ->get();
         return $nbrprds;        
    }

    public function getpltsparts($id,$i)
    {

        $platspars = DB::table('produits')
            ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
            ->select(DB::raw('sum(produits.qte) as products'),'restaurants.name')
            ->where(DB::raw('EXTRACT(MONTH FROM produits.created_at)'),[$id])
            ->where('restaurants.villes_id','=',$i)
            ->orderby('products','desc')
            ->groupby('restaurants.name')
            ->take(10)
            ->get();

        return $platspars;
    }

    public function getrevsrest($id,$i){


        $montant = DB::table('detailcommandes')
            ->join('commandes','commandes.id','=','detailcommandes.commandes_id')
            ->join('produits','produits.id','=','detailcommandes.produits_id')
            ->join('restaurants','restaurants.id','=','produits.restaurants_id')
            ->select('restaurants.name',DB::raw(" sum(detailcommandes.qte*produits.prix) as somme"))
            ->where(DB::raw('EXTRACT(MONTH FROM commandes.created_at)'),[$id])
            ->where('restaurants.villes_id',$i)
            ->orderby('somme','desc')
            ->groupby('restaurants.name')
            ->take(10)
            ->get();

        return $montant;
    }


    public function getinfos(){

        $infos = DB::table('commandes')
            ->join('detailcommandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
            ->join('produits', 'produits.id', '=', 'detailcommandes.produits_id')
            ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
            ->select('detailcommandes.date_collecte','commandes.checked_at','commandes.id','produits.name','restaurants.tele','restaurants.name as res_nom')
            ->orderby('commandes.created_at','desc')->take(10)->get();

        return view('statistiques.tab',['infos'=>$infos]);
    }

   public function getprdsbyday($id){

       $today = Date('Y-m-d');

       $prds = DB::table('produits')->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
           ->select(DB::raw('count(*) as prods '))->where('restaurants.villes_id',$id)
           ->whereDate('produits.created_at',$today)->get();

       return $prds;
   }

    public function getpltspartsperday($id){

        $today = Date('Y-m-d');

        $platspars = DB::table('produits')
            ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
            ->select(DB::raw('sum(produits.qte) as products'),'restaurants.name')
            ->whereDate('produits.created_at',$today)
            ->where('restaurants.villes_id','=',$id)
            ->orderby('products','desc')
            ->groupby('restaurants.name')
            ->take(10)
            ->get();

        return $platspars;

    }

    public function getrevsrestperday($id){

        $today = Date('Y-m-d');

        $montant = DB::table('detailcommandes')
            ->join('commandes','commandes.id','=','detailcommandes.commandes_id')
            ->join('produits','produits.id','=','detailcommandes.produits_id')
            ->join('restaurants','restaurants.id','=','produits.restaurants_id')
            ->select('restaurants.name',DB::raw(" sum(detailcommandes.qte*produits.prix) as somme"))
            ->whereDate('commandes.created_at',$today)
            ->where('restaurants.villes_id',$id)
            ->orderby('somme','desc')
            ->groupby('restaurants.name')
            ->take(10)
            ->get();

        return $montant;

    }

    public function getcities(Request $request)
    {
        $idcity = $request->input('cityid');
        $idmonth = $request->input('monthid');

        $cities = DB::table('villes')
        ->select('*')->get();

        $id = DB::table('villes')->first()->id;
        $partenaires = DB::table('restaurants')->select(DB::raw('count(*) as partenaires'))->where('restaurants.villes_id',$id)->get();

        $mns = DB::table('commandes')
            ->select(DB::raw(" EXTRACT(MONTH FROM commandes.created_at) as month"))
            ->whereNotNull("commandes.created_at")
            ->groupby('month')
            ->get();
        $months = json_decode($mns, true);

        $infos = DB::table('commandes')
            ->join('detailcommandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
            ->join('produits', 'produits.id', '=', 'detailcommandes.produits_id')
            ->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
            ->select('detailcommandes.date_collecte','commandes.checked_at','commandes.id','produits.name','restaurants.tele','restaurants.name as res_nom')
            ->orderby('commandes.created_at','desc')->take(10)->get();


        $prds = DB::table('produits')->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
            ->select(DB::raw('count(*) as prods '))->where('restaurants.villes_id',$id)
            ->where(DB::raw('EXTRACT(MONTH FROM produits.created_at)'),[$mns[0]->month])->get();

        $today = Date('Y-m-d');

        $prds_today = DB::table('produits')->join('restaurants', 'restaurants.id', '=', 'produits.restaurants_id')
            ->select(DB::raw('count(*) as prods '))->where('restaurants.villes_id',$id)
            ->whereDate('produits.created_at',$today)->get();

       //$plts = $this->getpltsparts();

        return view('statistiques.partenaires',['cities'=> $cities,'infos'=>$infos,
        'partenaires'=>$partenaires,'months'=>$months,'prds'=>$prds,'prds_today'=>$prds_today,"ville" => $idcity,"mois" => $idmonth]);

    }

}
