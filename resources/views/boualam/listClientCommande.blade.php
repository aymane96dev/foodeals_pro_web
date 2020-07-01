@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
    <h2>Liste des Commandes</h2>
<div class="col-md-10"> 
<div class="row">
@foreach($listClientCommande as $lclientsCom)
<div class="col-md-3 col-xs-3">
<div class="card mb-2" style="width: 14rem;">
  <img src="{{ asset('storage/userLogo.png') }}" class="mx-auto d-block mt-4"  width="50%"  alt="User Photo">
  <div class="card-body">
    <p class="card-text text-center">Date collecte : {{$lclientsCom->Date_collecte}}</p>
    <p class="card-text text-center">Date prévue: {{$lclientsCom->updated_at_s}}</p>
    @if($lclientsCom->etat==1)
    <p class="card-text text-center text-success font-weight-bold">commande livrée </p>
    @else
    <p class="card-text text-center text-danger font-weight-bold ">Pas encore</p>
    @endif
    <div class="form-group">
      <div class="col">
          <a class="btn btn-info form-control mb-2" href="/detailsCommande/{{$lclientsCom->id}}">Details</a>
        </div>
    </div>
    </div>
  </div>
</div>
@endforeach
</div>
  <div class="d-flex justify-content-center mt-5">
    {{$listClientCommande->links()}}
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

