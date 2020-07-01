@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
  @if( $listDetailCommande[0] != null)
    <h2> Liste des Produits pour {{$listDetailCommande[0]->name}} </h2>
  @else
  <h2 class="text-danger font-weight-bold">Pas de Produit</h2>
  @endif
<div class="col-md-10"> 
<div class="row">
@foreach($listDetailCommande as $ldetailsCom)
<div class="col-md-3 col-xs-3">
<div class="card mb-2" style="width: 14rem;">
  <img src="{{ asset('storage/userLogo.png') }}" class="mx-auto d-block mt-4"  width="50%"  alt="User Photo">
  <div class="card-body">
    <input type="hidden" id="id1" value="{{$ldetailsCom->name}}"/>
    <p class="card-text text-center">commande : {{$ldetailsCom->commandes_id}}</p>
    <p class="card-text text-center">Produit :{{$ldetailsCom->produits_id}}</p>
    <p class="card-text text-center">Qte : {{$ldetailsCom->qte}}</p>
    <div class="form-group">
      <div class="col">
    </div>
    </div>
    </div>
  </div>
</div>
@endforeach
</div>
  <div class="d-flex justify-content-center mt-5">
    {{$listDetailCommande->links()}}
  </div>
</div>
</div>

</div>


</div>

@endsection('content')
@section('style')
<style> </style>
@endsection('style')


@section('javascript')

<script>
 
</script>

@endsection('javascript')

