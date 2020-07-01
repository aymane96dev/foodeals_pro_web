<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pays;
use Session;
use Illuminate\Database\QueryException;
use App\GererErreur;
use App\Http\Requests\PaysAddRequest;
use App\Http\Requests\PaysModifyRequest;


class PaysAddController extends Controller
{
    public function indexPays()
    { 
        $ListPays= DB::table('pays')
        ->select('pays.id','pays.nom','pays.continent')
        ->orderBy('pays.nom')
        ->paginate(5);
        $ListPaysVilles = array($ListPays);                
        return view("ilyasse.PaysAdd",["ListPV" => $ListPaysVilles]);    
    }
    public function AddPays(Request $req ){
        // dd($req->input());     
        try{    
         $pays=new Pays();
         $pays->nom=$req->input('name');
         $pays->continent=$req->input('continent');
         $pays->save();
         Session::forget('warning');
         Session::flash('success','pays ajouté');
         return redirect("pays");
  }catch(QueryException $ex){ 
         Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
         return redirect("pays");
       }
     }
     public function ModifyPays(Request $req){
        // dd($req->input());     
        try{

         $pays = Pays::find($req->input('idinput'));    
         $pays->nom=$req->input('name1');
         $pays->continent=$req->input('continent1');
         $pays->save();
         Session::forget('warning');
         Session::flash('success','pays ajouté');
         return redirect("pays");
  }catch(QueryException $ex){ 
         Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
         return redirect("pays");
       }
 

} 
public function DeletePays(Request $req)
{ 
    try{
        //dd($req->input('idinput'));
        $pays= Pays::find($req->input('idinput'));
        $pays->delete();        
      Session::flash('success','pays supprimé');
      return redirect("pays"); 
}catch(QueryException $ex){ 
    Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
    return redirect("pays");
  }

}



}
