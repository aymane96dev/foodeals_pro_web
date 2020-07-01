<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class NotifsController extends Controller
{

    public function getform(){
        return view('statistiques.notifications');
    }

    public function getformclts(){
        return view('statistiques.ntfsclients');
    }

    public function getinfos(Request $request){

        $request->validate([
           'titre'=>'required|min:5',
           'description'=>'required|min:5',
        ]);
         $this->send_notification_partenaires($request->input('description'),$request->input('titre'),$request->input('imgurl'),"/topics/FoodealsPro");

        return back()->with("status", "Votre notification a été envoyée avec succés");
    }

    public function getinfosclts(Request $request){

        $request->validate([
           'titre'=>'required|min:5',
           'description'=>'required|min:5',
        ]);
         $this->send_notification_clients($request->input('description'),$request->input('titre'),$request->input('imgurl'),"/topics/Foodeals");

        return back()->with("status", "Votre notification a été envoyée avec succés");
    }

    function send_notification_partenaires($msgbody,$title,$image,$target)
    {
       
        $msg = array
        (
            'body' 	=> $msgbody,
            'title'	=> $title,
            'image' => $image
        );
        $fields = array
        (
            'to'		=> $target,
            'notification'	=> $msg
        );


        $headers = array
        (
            'Authorization: key=AAAAqgMVsIU:APA91bFAOPJAwhOfnOi1fTzGqM0XxaN9tpiwqPL6dHRQO362XIhaXq4ZjH6Mm9hXG6qFUVMGXff5kSqCKc4wMg6zQGM4Y1JwhcwVTGEfvxYoLpNr-OwjH-TBs1BIsYONJhnVMX5x1kea',
            'Content-Type: application/json'
        );
#Send Reponse To FireBase Server

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        //echo $result;
        curl_close( $ch );
    }

    function send_notification_clients($msgbody,$title,$image,$target)
    {
        
        $msg = array
        (
            'body' 	=> $msgbody,
            'title'	=> $title,
            'image' => $image
        );
        $fields = array
        (
            'to'		=> $target,
            'notification'	=> $msg
        );


        $headers = array
        (
            'Authorization: key=AAAA5BTVR6g:APA91bFnO1rhuVNPj2u8kAmO6SQ9PCG2_ZmkpbZ3VqJmZyaUoYlQkxFj16BeDc3hw4eLiP4h4BiBSOP7gD9un1PnB6CJmAj-Z9FlSpBmbvjcPxu4Ds_ek_GeiYMVqb7APYi38EW3H8sm',
            'Content-Type: application/json'
        );
#Send Reponse To FireBase Server

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        echo $result;
        curl_close( $ch );
    }
}
