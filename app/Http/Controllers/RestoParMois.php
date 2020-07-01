<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Restaurant;
use Carbon\Carbon;
use App\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PDF;
use Date;

class RestoParMois extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {    //DB::raw('MONTH(restaurants.created_at)')
        //$year = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->year;
        //$date=Carbon::now()->month;
        //$date2=DATE::setLocale('fr');
        //dd( $date2);
        Carbon::setLocale('fr');
        $ListRestaurant = DB::table('restaurants')
                          ->join('types', 'types.id', '=', 'restaurants.types_id')
                          ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
                          ->select('restaurants.id', 'types.name as typename','localisations.latitude as localisationlatitude','localisations.longitude as localisationlongitude',DB::raw('COUNT(*) as compter'),DB::raw('MONTHNAME(restaurants.created_at) as namemonth'),'restaurants.name as name','restaurants.tele as tele','restaurants.adresse as adresse','restaurants.Logo as Logo','restaurants.gerant as gerant','restaurants.email as email','restaurants.description as description',DB::raw('YEAR(restaurants.created_at) as year'))
                          //->orderBy('restaurants.created_at')
                          ->groupBy(DB::raw('YEAR(restaurants.created_at)'),DB::raw('MONTHNAME(restaurants.created_at)'),'restaurants.id','restaurants.description','restaurants.email', 'types.name','restaurants.gerant','localisations.latitude','localisations.longitude','restaurants.name','restaurants.tele','restaurants.adresse','restaurants.Logo')
                          ->get();
                // dd($ListRestaurant);
    
       // return PDF::load_html($html,'A4','portrait')->show();
     $pdf = PDF::loadView('insaf.invoice2',["ListRestaurant"=>$ListRestaurant]);
return $pdf->stream('invoice.pdf');
  
    }
   

}

