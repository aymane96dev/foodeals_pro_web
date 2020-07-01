<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Client;
use App\Favoris;
use Session;
use App\Commande;
use App\Signature;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\DetailCommande;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $ListClient = DB::table('clients')
                          ->orderBy('created_at','desc')
                          ->paginate(8);             
        return view("boualam.clients",["list" => $ListClient]);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
    public function details($id)
    {
        $ListClientCommande = DB::table('commandes')
        ->join('clients','commandes.clients_id','=','clients.id')
        ->join('detailcommandes','detailcommandes.commandes_id','=','commandes.id')
        ->join('signatures','detailcommandes.signatures_id','=','signatures.id')
        ->select('commandes.*','signatures.id as id_s','detailcommandes.date_collecte as Date_collecte','signatures.updated_at as updated_at_s','signatures.etat')
        ->where('clients_id',$id)
        ->paginate(8); 
       // dd($ListClientCommande);
        return view("boualam.listClientCommande",["listClientCommande" => $ListClientCommande ]);
    }
    public function detailCommande($id)
    {
        $ListDetailCommande = DB::table('detailcommandes')
        ->join('commandes','detailcommandes.commandes_id','=','commandes.id')
        ->join('clients','commandes.clients_id','=','clients.id')
        ->select('detailcommandes.*','commandes.*','clients.*')
        ->where('commandes_id',$id)
        ->paginate(8); 
        //dd($ListDetailCommande);
        return view("boualam.listDetailCommande",["listDetailCommande" => $ListDetailCommande ]);
    }


    public function affichefav($id){
       
        $ListFavoris = DB::table('favoris')
                    ->join('clients','clients.id', '=', 'favoris.clients_id')
                    ->join('restaurants','restaurants.id','=','favoris.restaurants_id')
                    ->select('restaurants.*')
                    ->where('clients.id', '=',$id)       
                     ->orderBy('created_at','desc')
                     ->get();
                     
                    
                    echo '
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Favoris</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">';
                        foreach($ListFavoris as $lst) 
                        { echo'<label><b>Restaurant name:</b> '.$lst->name.'</label><br/>';
                        }
                  

               //   echo '
                   //     </div>
                    //    <div class="modal-footer">
                   //       <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                          
                    //    </div>
                    //  </div>
                    //</div>
                 //';

    }
}

