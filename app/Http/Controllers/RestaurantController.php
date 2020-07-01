<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RestaurantRequest;
use App\Http\Requests\RestaurantRequestModify;
use App\Restaurant;
use App\Localisation;
use App\Recuperation;
use App\Client;
use App\Type;
use App\Typerestaurant;
use App\Ville;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use App\GererErreur;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
// use Mail;

class RestaurantController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      
        $ListRestaurant = DB::table('restaurants')
                          ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
                        //   ->select('restaurants.*', 'types.name as typename','localisations.longitude','localisations.latitude')
                          ->select('restaurants.*','localisations.longitude','localisations.latitude')
                          ->orderBy('created_at','desc')
                          ->paginate(6);
                          $ListType =  Type::all();                
                          $Listv =  Ville::all(); 
                          $inf=array($ListType,$Listv);
    //   dd($ListRestaurant);
        return view("insaf.Restaurant",
                ["list" => $ListRestaurant],
                ["inf" => $inf]);
    }

 public function typesresto($id){
     $cntype=0;  
     $ListType =  DB::table('types')
    ->select('types.name as typen','types.id as idtype')

    ->get();
     $ListRestaurant = DB::table('restaurants')
     ->join('localisations', 'localisations.id', '=', 'restaurants.localisations_id')
     ->join('typerestaurants', 'typerestaurants.restaurants_id', '=', 'restaurants.id')
     ->join('types', 'types.id', '=', 'typerestaurants.types_id')
    ->select('typerestaurants.id as idtypre','types.id as idtype','types.name as typen','localisations.id as locid')
    ->where('restaurants.id',$id)
    ->get();

 //dd($ListType);
 $idloca=1;
    foreach($ListType as $lt){
        echo '<div>';
        $found=0;
        
        foreach($ListRestaurant as $rstype){
            $idloca=$rstype->locid;
            if($lt->idtype == $rstype->idtype){
                
                $found=1;
            }
  
        }
        if($found==1){
          echo '<input type="checkbox" id="ty'.$cntype.'" name="typem'.$cntype.'" value="'.$lt->idtype.'" checked>';
        }
        else{
          echo '<input type="checkbox" id="ty'.$cntype.'" name="typem'.$cntype.'" value="'.$lt->idtype.'" >';
        }
  echo '<label for="restaurant">'.$lt->typen.'</label></div>';
 $cntype++;
 }

echo '<input type="hidden" name="countypem" value="'.$cntype.'">';
echo '<input type="hidden" name="locid" value="'.$idloca.'">';
 }


    public function store(RestaurantRequest $req){
        //dd($req->input());
    try{
        $lct = new Localisation();
        $lct->latitude=$req->Latitude;
        $lct->longitude=$req->Longitude;
        $lct->save();


        $restaurant = new Restaurant();
        $restaurant->name=$req->input('nom');
        // $restaurant->types_id=$req->input('type');
        $restaurant->villes_id=$req->input('ville');
        $restaurant->localisations_id=$lct->id;
        if($req->hasFile('logo')){
           // dd(5);
             $restaurant->logo=$req->logo->store('images','public');
            }
        $restaurant->description=$req->description;
        // $restaurant->localisations_id=1;
        $restaurant->password=Hash::make($req->password);
        $restaurant->email=$req->email;
        $restaurant->gerant=$req->gerant;
        $restaurant->adresse=$req->adresse;
        $restaurant->tele=$req->tele;
        $restaurant->save();

        
        
        for($i=0;$i<$req->countype;$i++)
        {
            if($req->has('type'.$i))
            {
             $typeres= new Typerestaurant();
             $typeres->restaurants_id=$restaurant->id;
             $typeres->types_id=$req->input('type'.$i);
             $typeres->save();
            }
        }
      
     
        Session::forget('warning');
        Session::flash('success','Bien enregistrer');
        return redirect('restaurant');
 }catch(QueryException $ex){ 
        Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
        return redirect('restaurant');
      }


    }

    public function update(RestaurantRequestModify $req){
          // dd($req->input());
try{
        $lct =  Localisation::find($req->locid);
        $lct->latitude=$req->Latitude;
        $lct->longitude=$req->Longitude;
        $lct->save();
         $restaurant = Restaurant::find($req->input('id'));
        //dd($restaurant);
      
           $restaurant->name=$req->input('nom1');
        //  $restaurant->types_id=$req->input('type1');
         $restaurant->villes_id=$req->input('ville1');
         if($req->hasFile('logo1')){
             //dd(5);
             $restaurant->logo=$req->logo1->store('images','public');
             }
        
         $restaurant->description=$req->description1;
        //  $restaurant->localisations_id= 1;
         //$restaurant->localisations_id=$lct->id;

         if($req->password != null)
         {
         $restaurant->password=Hash::make($req->password);
         $restaurant->verified_at=null;
         }
         $restaurant->email=$req->email1;
         $restaurant->tele=$req->tele1;
         $restaurant->gerant=$req->gerant1;
         $restaurant->adresse=$req->input('adresse1');
         $restaurant->save();

         $typeres = DB::table('restaurants')
         ->join('typerestaurants', 'typerestaurants.restaurants_id', '=', 'restaurants.id')
        ->select('typerestaurants.*')
        ->where('restaurants.id',$restaurant->id)
        ->get();

        foreach($typeres as $ty)
        {
            $typ = Typerestaurant::find($ty->id);
            $typ->delete();
        }
        
         
        for($i=0;$i<$req->countypem;$i++)
        {
            if($req->has('typem'.$i))
            {
             $typeres= new Typerestaurant();
             $typeres->restaurants_id=$restaurant->id;
             $typeres->types_id=$req->input('typem'.$i);
             $typeres->save();
            }
        }

         Session::forget('warning');
         Session::flash('success','Bien modifier');
         return redirect('restaurant');
        }catch(QueryException $ex){ 
            Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
            return redirect('restaurant');
          }
    
     }

    public function activerRestaurant($id){

     $restaurant = Restaurant::find($id);
        $restaurant->etat=null;
        $restaurant->save();
        return "Bien activer";
    }

    public function bloquerRestaurant($id){

        $restaurant = Restaurant::find($id);
        $restaurant->etat= Carbon::now();
        $restaurant->save();
        
        return "Bien bloquer";
        
    }

    public function orderPdf($id)
 {
     $order= ORDER::findOrFail($id);
     $pdf = PDF::loadView('order_pdf', compact('order'));
     $name = "commandeNo-".$order->id.".pdf";
     return $pdf->download($name);
 }

 public function find(Request $req)
{
   // dd($req->input());
                      $Restaurantfavoris = DB::table('restaurants')                          
                    //   ->join('types', 'types.id', '=', 'restaurants.types_id')
                    //   ->select('restaurants.*', 'types.name as typename')
                    ->select('restaurants.*')
                      ->where('restaurants.name','Like', '%'.$req->input('find').'%')
                      ->orderBy('created_at','desc')
                      ->paginate(8);
                      //dd($Restaurantfavoris);
                      $ListType =  Type::all();
                      $Listv =  Ville::all(); 
                      $inf=array($ListType,$Listv);
                      return view("insaf.Restaurant" ,
                      ["list" => $Restaurantfavoris],
                      ["inf" => $inf]); 
                      $validated = $req->validated();                
}

public function askrecuperation(Request $req){  
    try {
        $cl = DB::table('clients')
        ->select('clients.id')
        ->where('clients.email','Like',$req->emailrec)
        ->get();
        if(sizeof($cl)>0)
        {
         $cl1= explode(":",$cl);
         $id= explode("}",$cl1[1]);
    
        $rec = new Recuperation();
        $rec->client_id=$id[0];
        $rec->code=md5(microtime());
        $rec->clicked=0;
        $rec->save();
    
        $email=$req->emailrec;
        Mail::to($email)->send(new SendMailable($rec->code));
        }
        else{
            return "introuvable";
        }
    } catch(QueryException $ex){ 
        Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
        return "Email n'existe pas !";
      }
    
   }

public function resprecuperation($tcode){
   $ftc=DB::table('recuperations')
   ->join('clients', 'clients.id', '=', 'recuperations.client_id')
   ->select('recuperations.id','recuperations.client_id',
   'recuperations.clicked',
   'recuperations.created_at','clients.email')
   ->where('recuperations.code','Like',$tcode)
   ->get();
//    dd($ftc[0]->email);
    
   $rclick = Recuperation::find($ftc[0]->id);
   $rclick->clicked+=1;
   $rclick->save();

   if($ftc!=null)
   {    //600 = 10 min & 60 = 1 min
    if( $ftc[0]->clicked < 1 ) 
        {
            if((strtotime(Carbon::now())-strtotime($ftc[0]->created_at))<600)
            {
                $recl = Client::find($ftc[0]->client_id);
                $pass = substr(md5(microtime()),0,10);
                $recl->password=Hash::make($pass);
                $recl->email_verified_at=null;
                $recl->save();
             
               

                // Mail::to($ftc[0]->email)->send(new SendMailable($pass));
               
                //  return "votre nouveau mot de passe est : ".$pass." <br/> assurez vous de ne pas actualiser cette page |`ce lien va expirer";
             return '<div style="text-align: center; ;border-style: solid;
             border-width: medium;
             border-radius: 10px;
             border-color:#46cda7; ">
                 <h2>Bienvenue à Foodeals</h2>
         <br/>
             <img src="http://pro.foodeals.ma/storage/logo.png"/>
             <br>
             <p> votre nouveau mot de pass est :</p>
             <div style="
             border-color:#46cda7; 
             border-style: solid;
             border-width: medium;
             border-radius: 10px;
             width: 100px;
             text-align: center;
             background-color:#46cda7;
             margin: auto; "> 
             <p>'.$pass.'</p>
         </div>
         <p>Assurez vous de ne pas actualiser cette page |`ce lien va expirer</p>
         
         <br>
         Si vous avez des questions n\'hésitez pas !!<br> à de nous contacter au 08.08.51.68.90 ou par email: info@fooeals.ma
         <br/>
         A bientôt,<br/>
         Votre équipe Foodeals. 
             </div>
         ';
               
                //return "message was send";
            }
            else
            {
                return view("insaf.erreur");
            }
        }
        else
            {
                return view("insaf.erreur");
            }
   }
   else
   {
    return view("insaf.erreur");
}
}
}
