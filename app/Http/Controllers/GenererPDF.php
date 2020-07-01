<?php

namespace App\Http\Controllers;
use session;
use App\Type;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;
use Date;
use Carbon\Carbon;



class GenererPDF extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function convert()
    {
        $mois= Carbon::now()->month;
        switch($mois)
        {
            case 1: return "Janvier";
            break;
            case 2: return "Février";
            break;
            case 3: return "Mars";
            break;
            case 4: return "Avril";
            break;
            case 5: return "Mai";
            break;
            case 6: return "Juin";
            break;
            case 7: return "Juiller";
            break;
            case 8: return "Aout";
            break;
            case 9: return "Septembre";
            break;
            case 10: return "Octobre";
            break;
            case 11: return "Novembre";
            break;
            case 12: return "Décembre";
            
        }
    }
    
        public function impression()
        {
        //xDate::setLocale('fr');   
        $mois= Carbon::now()->month;
        $converstion=$this->convert();
        $Restaurantfavoris = DB::table('restaurants')                          
                          ->select('restaurants.*','types.name as typename','localisations.latitude as localisationlatitude','localisations.longitude as localisationlongitude')
                          ->join('types', 'types.id', '=', 'restaurants.types_id')
                          ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
                          ->whereMonth('restaurants.created_at',$mois)
                          ->orderBy('created_at','desc')
                          ->get();
                          //dd($Restaurantfavoris);
                          //dd($Restaurantfavoris);
        $pdf=PDF::loadView('insaf.afficherCeMoisPDF',["lst" => $Restaurantfavoris],["conv"=>$converstion]);
                          return $pdf->stream('pdf.pdf');                     
    }
    
    public function index1()
    {
        
       
        $ListRestaurant = DB::table('restaurants')
                          ->join('types', 'types.id', '=', 'restaurants.types_id')
                          ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
                          ->select('restaurants.*', 'types.name as typename','localisations.latitude as localisationlatitude','localisations.longitude as localisationlongitude')
                          ->orderBy('created_at','desc')
                          ->get();
                   //  dd($ListRestaurant);
    
       // return PDF::load_html($html,'A4','portrait')->show();
     $pdf = PDF::loadView('insaf.invoice',["ListRestaurant"=>$ListRestaurant]);
return $pdf->stream('invoice.pdf');
  
    }

    public function impression1()
    {
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();
        //dd($start." ".$end);
        //xDate::setLocale('fr');   
                      $Restaurantfavoris = DB::table('restaurants')                          
                      ->select('restaurants.*','types.name as typename' ,'localisations.latitude as localisationlatitude','localisations.longitude as localisationlongitude')
                      ->join('types', 'types.id', '=', 'restaurants.types_id')
                      ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
                      ->whereBetween('restaurants.created_at',[$start,$end])
                      ->orderBy('created_at','desc')
                      ->get();
                      //dd($Restaurantfavoris);
                      
                      $info = array($start,$end);
                      $pdf=PDF::loadView('insaf.afficherParSemainePDF',["lst" => $Restaurantfavoris],["inf" => $info]);
                      return $pdf->stream('pdfweek.pdf');                     
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
                      ->select('restaurants.id','restaurants.logo', 'types.name as typename','localisations.latitude as localisationlatitude','localisations.longitude as localisationlongitude',DB::raw('COUNT(*) as compter'),DB::raw('MONTHNAME(restaurants.created_at) as namemonth'),'restaurants.name as name','restaurants.tele as tele','restaurants.adresse as adresse','restaurants.Logo as Logo','restaurants.gerant as gerant','restaurants.email as email','restaurants.description as description',DB::raw('YEAR(restaurants.created_at) as year'))
                      //->orderBy('restaurants.created_at')
                      ->groupBy(DB::raw('YEAR(restaurants.created_at)'),DB::raw('MONTHNAME(restaurants.created_at)'),'restaurants.id','restaurants.description','restaurants.email', 'types.name','restaurants.gerant','localisations.latitude','localisations.longitude','restaurants.name','restaurants.tele','restaurants.adresse','restaurants.Logo')
                      ->get();
            // dd($ListRestaurant);

   // return PDF::load_html($html,'A4','portrait')->show();
 $pdf = PDF::loadView('insaf.invoice2',["ListRestaurant"=>$ListRestaurant]);
return $pdf->stream('invoice.pdf');

}

}








