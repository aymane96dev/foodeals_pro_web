<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RestaurantRequest;
use App\Http\Requests\RestaurantRequestModify;
use App\Restaurant;
use App\Type;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use App\GererErreur;


class RecPassword extends Controller
{

    public function __construct()
    {
   
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
   

}
