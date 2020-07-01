<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Session;

class UserController extends Controller
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
    public function index()
    {
        $ListeUsers = DB::table('users')->orderBy('created_at','desc')->paginate(8);
       // dd($ListeUsers);
        return  view('boualam.index',['list' => $ListeUsers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->input());
       $user=new user();
       $user->name=$request->name;
       $user->tele=$request->phone;
       $user->email=$request->email;
       $user->password=Hash::make($request->password);
       $user->save();
       Session::flash('success','User Register');
       return redirect('listeUsers');
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
      //  dd($request->input());
        $user=User::find($request->id);
        $user->name=$request->name;
        $user->tele=$request->phone;
        $user->email=$request->email;
        if($request->input('password')!=null)
        $user->password=Hash::make($request->password);
        $user->save();
        Session::flash('success','User Modifier');
        return redirect('listeUsers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    



    public function bloquer($id)
    {
       // echo('activer '.$id);
        $user=User::find($id);
        $user->etat=Carbon::now();
        $user->save();
        return ('User Bloqued');
    }
    public function activer($id)
    {
      //  echo('bloquer '.$id);
        $user=User::find($id);
        $user->etat=null;
        $user->save();
        return ('User Activate');
    }
}
