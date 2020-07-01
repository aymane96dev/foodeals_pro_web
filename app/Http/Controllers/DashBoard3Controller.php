<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoard3Controller extends Controller
{
    //
    public function getview(Request $request){

        $idcity = $request->input('cityid');
        $idmonth = $request->input('monthid');

        $mons = DB::table('commandes')
        ->join('clients','clients.id','=','commandes.clients_id')
        ->whereNotNull('commandes.created_at')
        ->select(DB::raw(" EXTRACT(MONTH FROM commandes.created_at) as month"))
        ->groupby('month')
        ->get();


        $plats = DB::table('produits')
            ->join('typeproduits', 'typeproduits.id', '=', 'produits.typeproduits_id')
            ->select(DB::raw('sum(produits.qte) as product'),'typeproduits.name')
            ->groupby('typeproduits.name')
            ->get();

        $pls = json_decode($plats,true);

        $max = max(array_column($pls, 'product'));

        foreach($pls as $pl){
            if($pl['product'] == $max){
                $type = $pl['name'];
            }
        }

        $cities = DB::table('villes')->select('*')->get();

        return view("statistiques.kpi2",['mons'=>$mons,'type'=>$type,'cities'=>$cities
        ,'ville'=>$idcity,'mois'=>$idmonth]);
    }

    public function getintprix($id,$i)
    {

        $intprix = DB::table('produits')
            ->join('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
            ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
            ->select(DB::raw('sum(detailcommandes.qte) as products'),'produits.prix')
            ->where(DB::raw('EXTRACT(MONTH FROM commandes.created_at)'),$id)
            ->where('commandes.villes_id',$i)
            ->orderby('products','desc')
            ->groupby('produits.prix')
            ->take(10)
            ->get();

        return $intprix;
    }

    public function getintprixperday($id)
    {
        $today = Date('Y-m-d');

        $intprix = DB::table('produits')
            ->join('detailcommandes', 'detailcommandes.produits_id', '=', 'produits.id')
            ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
            ->select(DB::raw('sum(detailcommandes.qte) as products'),'produits.prix')
            ->whereDate('commandes.created_at',$today)
            ->where('commandes.villes_id',$id)
            ->orderby('products','desc')
            ->groupby('produits.prix')
            ->take(10)
            ->get();

        return $intprix;
    }


    public function getmodalite($id,$i){


        $modalites_place = DB::table('detailcommandes')
            ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
            ->select(DB::raw(" count('detailcommandes.place') as surplace"))
            ->where(DB::raw('EXTRACT(MONTH FROM commandes.created_at)'),$id)
            ->where('commandes.villes_id',$i)
            ->where('detailcommandes.place',1)
            ->where('detailcommandes.emporter',0)
            ->where('detailcommandes.livraison',0)
            ->get();

        $modalites_emporter = DB::table('detailcommandes')
            ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
            ->select(DB::raw(" count('detailcommandes.emporter') as emporter"))
            ->where(DB::raw('EXTRACT(MONTH FROM commandes.created_at)'),$id)
            ->where('commandes.villes_id',$i)
            ->where('detailcommandes.place',0)
            ->where('detailcommandes.emporter',1)
            ->where('detailcommandes.livraison',0)
            ->get();

        $modalites_livraison = DB::table('detailcommandes')
            ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
            ->select(DB::raw(" count('detailcommandes.livraison') as livrées"))
            ->where(DB::raw('EXTRACT(MONTH FROM commandes.created_at)'),$id)
            ->where('commandes.villes_id',$i)
            ->where('detailcommandes.place',0)
            ->where('detailcommandes.emporter',0)
            ->where('detailcommandes.livraison',1)
            ->get();

        $modalites = [$modalites_place,$modalites_emporter,$modalites_livraison];

        return $modalites;
    }

    public function getmodaliteperday($id){

        $today = Date('Y-m-d');

        $modalites_place = DB::table('detailcommandes')
            ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
            ->select(DB::raw(" count('detailcommandes.place') as surplace"))
            ->whereDate('commandes.created_at',$today)
            ->where('commandes.villes_id',$id)
            ->where('detailcommandes.place',1)
            ->where('detailcommandes.emporter',0)
            ->where('detailcommandes.livraison',0)
            ->get();

        $modalites_emporter = DB::table('detailcommandes')
            ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
            ->select(DB::raw(" count('detailcommandes.emporter') as emporter"))
            ->whereDate('commandes.created_at',$today)
            ->where('commandes.villes_id',$id)
            ->where('detailcommandes.place',0)
            ->where('detailcommandes.emporter',1)
            ->where('detailcommandes.livraison',0)
            ->get();

        $modalites_livraison = DB::table('detailcommandes')
            ->join('commandes', 'commandes.id', '=', 'detailcommandes.commandes_id')
            ->select(DB::raw(" count('detailcommandes.livraison') as livrées"))
            ->whereDate('commandes.created_at',$today)
            ->where('commandes.villes_id',$id)
            ->where('detailcommandes.place',0)
            ->where('detailcommandes.emporter',0)
            ->where('detailcommandes.livraison',1)
            ->get();

        $modalites = [$modalites_place,$modalites_emporter,$modalites_livraison];

        return $modalites;
    }

}
