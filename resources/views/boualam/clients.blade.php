
@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
  
<div class="col-md-10"> 
<div class="row">

@foreach($list as $lClients)
<div class="col-md-3 col-xs-3">
<div class="card mb-2" style="width: 14rem;">
  <img src="{{ asset('storage/userLogo.png') }}" class="mx-auto d-block mt-4"  width="50%"  alt="User Photo">
  <div class="card-body">
  
          
          
    <h5 class="card-title text-center"> {{$lClients->name}}</h5>
    <input type="hidden" id="id1" value="{{$lClients->id}}"/>
    <p class="card-text text-center">{{$lClients->tel}}</p>
    <p class="card-text text-center">{{$lClients->sexe}}</p>
    <p class="card-text text-center">{{$lClients->email}}</p>
    <div class="form-group">
      <div class="col">
    <a class="btn btn-info form-control mb-2" href="/commadeClients/{{$lClients->id}}">Commande</a>
    </div>
    <div class="col text-center">
    <button type="button " class="btn btn-warning form-control mb-2" id="details" onclick="afficherFavoris({{$lClients->id}});">Favoris</button>

    </div> 
    </div>
    </div>
  </div>
</div>
@endforeach

</div>
  
  
</div>
</div>

</div>




<!--model-->
<div class="modal" tabindex="-1" role="dialog" id="modalfavoris"></div>
  </div>
@endsection
@section('javascript')

<script>

  function afficherFavoris(id){

 
 axios.get('afficherfav/'+id) .then(response => ($('#modalfavoris').html(response.data)))
 
  $('#modalfavoris').modal();
} 




</script>
@endsection
