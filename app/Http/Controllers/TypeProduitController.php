<?php

namespace App\Http\Controllers;

use App\Typeproduit;
use Illuminate\Http\Request;

class TypeProduitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function acceuil()
    {
        return view('ilyasse.index');
    }
    public function index()
    {
        $lists = Typeproduit::all();

        return $lists;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'obs' => 'required',
        ]);
        $name = $request->get('name');
        $obs = $request->get('obs');
        $typeproduits = new Typeproduit();
        $typeproduits->name = $name;
        $typeproduits->obs = $obs;
        $typeproduits->save();

        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'obs' => 'required',
        ]);
        $typeproduit = Typeproduit::find($id);

        $typeproduit->name = $request->get('name');
        $typeproduit->obs = $request->get('obs');
        $typeproduit->save();

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Typeproduit::find($id);
        $type->delete();
    }
}
