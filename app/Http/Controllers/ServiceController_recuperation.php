<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Recuperation;
use App\Client;
use App\Restaurant;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Illuminate\Database\QueryException;
use App\GererErreur;
use Illuminate\Support\Facades\Hash;

class ServiceController_recuperation extends Controller
{
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
$to_email = 'ismail2010elalaoui@gmail.com';
$subject = 'Foodeals';
$message = '<html><body>
	<div style="text-align: center; ;border-style: solid;
	border-width: medium;
	border-radius: 10px;
	border-color:#46cda7; ">
		<h2>Bienvenue à Foodeals</h2>
<br/>

<a href="http://127.0.0.1:8000/resprecuperation/"'.$rec->code.'>
    <img src="http://pro.foodeals.ma/storage/logo.png"/><br>
    <button type="submit" style="background-color: #46cda7; outline: none; width: 240px;height: 50px; color: #fff"> Récupérer votre mot de pass</button>
</a>
<br>
Si vous avez des questions n\'hésitez pas !!<br> à nous contacter au 08.08.51.68.90 ou par email: info@fooeals.ma
<br/>
A bientôt,<br/>
Votre équipe Foodeals. 
	</div></body>
</html>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers = 'From: contact@foodeals.ma';
return 'ok : '.mail($to_email,$subject,$message,$headers);
            //$email=$req->emailrec;
           // Mail::to("ismail2010elalaoui@gmail.com")->send(new SendMailable($rec->code));
        
 //mail($to_email,$subject,$message,$headers);
         //   return  response()->json(["Error"=>"300"]);
            }
            else{
                return  response()->json(["Error"=>"304"]);
            }
        } catch(QueryException $ex){ 
            Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
            return  response()->json(["Error"=>"303"]);
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
