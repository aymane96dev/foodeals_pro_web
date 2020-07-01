<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VilleAddRequest;
use App\Http\Requests\VilleModifyRequest;
use App\Pays;
use App\Ville;
use Session;
use Illuminate\Database\QueryException;
use App\GererErreur;


class VilleAddController extends Controller
{
    public function indexVille()
    { 
        $ListVille= DB::table('villes')
        ->select('villes.id','villes.nom','villes.zip')
        ->orderBy('villes.nom')
        ->paginate(5);
        $ListPays= DB::table('pays')
        ->select('pays.id','pays.nom')
        ->orderBy('pays.nom')
        ->get();
        $ListPaysVilles = array($ListVille,$ListPays);                
        return view("ilyasse.VilleAdd",["ListPV" => $ListPaysVilles]);    
    }
    public function AddVille(Request $req ){
        // dd($req->input());     
        try{    
         $ville=new Ville();
         $ville->nom=$req->input('name');
         $ville->zip=$req->input('ZIP');
         $ville->pays_id=$req->input('type1');
         $ville->save();
         Session::forget('warning');
         Session::flash('success','ville ajoutée');
         return redirect("ville");
  }catch(QueryException $ex){ 
         Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
         return redirect("ville");
       }
     }
     public function ModifyVille(Request $req){
        // dd($req->input());     
        try{

         $ville = Ville::find($req->input('idinput'));
         //dd($req->input('idinput'));    
         $ville->nom=$req->input('name');
         $ville->zip=$req->input('ZIP1');
         $ville->pays_id=$req->input('type1');
         $ville->save();
         Session::forget('warning');
         Session::flash('success','Ville modifiée');
         return redirect("ville");
  }catch(QueryException $ex){ 
         Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
         return redirect("ville");
       }
 

} 
public function DeleteVille(Request $req)
{ 
    try{
        //dd($req->input('idinput'));
        $ville= Ville::find($req->input('idinput'));
        $ville->delete();        
      Session::flash('success','ville supprimée');
      return redirect("ville"); 
}catch(QueryException $ex){ 
    Session::flash('warning', GererErreur::verifier($ex->errorInfo[1])); 
    return redirect("ville");
  }

}

}

