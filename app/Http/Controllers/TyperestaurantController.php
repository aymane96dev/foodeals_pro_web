<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TyperestaurantController extends Controller
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
        return view('youssef.index');
    }
    public function index()
    {
        $lists = Type::all();

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
        $typeres = new Type();
        $typeres->name = $name;
        $typeres->obs = $obs;
        $typeres->save();

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
        $type = Type::find($id);

        $type->name = $request->get('name');
        $type->obs = $request->get('obs');
        $type->save();

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
        $type = Type::find($id);
        $type->delete();
    }
}
