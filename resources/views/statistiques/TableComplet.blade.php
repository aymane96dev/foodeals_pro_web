@extends('layouts.app')

@section('content')
   
     <div class="container" id="table">
        
    </div>

    <script>
        setInterval(function () {
            $.get('gettableasync',function(donne)
            {
                $("#table").html(donne);
            });
        },2000);
    </script>       
@stop
