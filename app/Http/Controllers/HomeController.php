<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commande;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function INSERTCOM()
    {
        $commande= new Commande();
        $commande->date_collecte="11";
        $commande->clients_id="4";
      //  dd($commande);
        $commande->save();
    }
}
