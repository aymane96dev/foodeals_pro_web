@extends('layouts.app')

@section('content')





<div class="container">
<form method="POST" class="form-inline my-2 my-lg-0 float-center" action="{{url('findrest')}}" >
@csrf

<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="find">
<button class="btn btn-outline-success my-2 my-sm-0" type="submit center block" >Search</button>
</form>


{{-- rec email --}}
{{-- <form action="askrecuperation" method="POST">
    @csrf
    <div>
      <label for="">Mot de pass oublier : saissier l'email</label>
      <input type="text" name="emailrec" />
      <button type="submit"> rec</button>
    </div>
  </form> --}}
{{-- end --}}
  <div class="row">
    <div class="col-md-10">
       <div class="row">
@php $cnt=1;  @endphp 
@foreach($list as $ls)
           <div class="col-md-4 mt-3">
            <input type="hidden" id="id{{$cnt}}" value="{{$ls->id}}">
            <input type="hidden" id="name{{$cnt}}" value="{{$ls->name}}">
            <input type="hidden" id="email{{$cnt}}" value="{{$ls->email}}">
            <input type="hidden" id="tele{{$cnt}}" value="{{$ls->tele}}">
            {{-- <input type="hidden" id="type{{$cnt}}" value="{{$ls->types_id}}"> --}}
            <input type="hidden" id="description{{$cnt}}" value="{{$ls->description}}">
            <input type="hidden" id="adresse{{$cnt}}" value="{{$ls->adresse}}">
            <input type="hidden" id="gerant{{$cnt}}" value="{{$ls->gerant}}">
            <input type="hidden" id="ville{{$cnt}}" value="{{$ls->villes_id}}">
             <input type="hidden" id="longitude{{$cnt}}" value="{{$ls->longitude}}">
            <input type="hidden" id="latitude{{$cnt}}" value="{{$ls->latitude}}">


                    <div class="card" style="width: 18rem;">
                    @if($ls->etat=="")
            <input type="checkbox"  data-width="100%" checked data-toggle="toggle"  id="idcheck{{$cnt}}" onchange='bloquer({{$cnt}})' data-on="Actif" data-off="Bloquer" data-onstyle="success" data-offstyle="danger">
               @else
            <input type="checkbox"  data-width="100%" data-toggle="toggle" id="idcheck{{$cnt}}" onchange='bloquer({{$cnt}})' data-on="Actif" data-off="Bloquer" data-onstyle="success" data-offstyle="danger">
               @endif
           <br><div><img src="storage/{{$ls->logo}}" class="rounded-circle mx-auto d-block " width="200px" height="200px"  alt="logo res"></div>
                        <div class="card-body">
                            <h5 class="card-title text-center"><b>{{$ls->name}}</b></h5>
                            {{-- <p class="card-text"><b>Type: </b> {{$ls->typename}}</p> --}}
                            <p class="card-text"><b>Nom gérant: </b>{{$ls->gerant}}</p>
                            <p class="card-text"><b>Email: </b>{{$ls->email}}</p>
                            <p class="card-text"><b>Télephone: </b> {{$ls->tele}}</p>
                            <p class="card-text"><b>Adresse: </b>{{$ls->adresse}}</p>
                            <p class="card-text"><b>Description: </b>{{$ls->description}}</p>
                            <div class="form-group">
                                <div class="col text-center">
<button type="button" class="btn btn-info" id="modifier{{$cnt}}" onclick='Afficher({{$cnt}})' >Modifier</button>
                                </div>
                            </div> 
                        </div>
                    </div>
           </div>
@php $cnt++;@endphp
@endforeach
       </div>
       <div class="d-flex justify-content-center mt-3">
            {{ $list->links() }}
      </div>
    </div>
    <div class="col-md-2">
    <button type="button" class="btn btn-success mb-2 mx-auto btn-lg btn-block btn-circle btn-xl" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">+</button>
    </div>
  </div>
</div>

<!-- Modalmodifer -->
<div class="modal fade" id="modifermodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier vos informations</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('ModifierResto')}}" id="f1" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
           
            <input type="hidden" class="form-control" id="idinput" name="id" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label" >Nom:</label>
            <input type="text" class="form-control @if($errors->get('nom1')) is-invalid @endif" id="nominput"  value="{{old('nom1')}}" name="nom1" required >
            @foreach ($errors->get('nom1') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>
          {{-- <div class="form-group">
            <label for="recipient-name" class="col-form-label" >Type Restaurant:</label>
          <select class="custom-select @if($errors->get('type1')) is-invalid @endif" id="type"  name="type1" required >
  <option >Choose ...</option>
  @foreach($inf[0] as $lt)
  <option value="{{$lt->id}}">{{$lt->name}}</option>
  @endforeach
</select>
@foreach ($errors->get('type1') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
</div> --}}

Type Restaurant:

<div class="row">
  <div class="col-4" id="typesrestaut">
     
</div>
</div>
<div class="form-group">
            <label for="recipient-name" class="col-form-label" >Nom gérant:</label>
            <input type="text" class="form-control @if($errors->get('gerant1')) is-invalid @endif" id="gerantinput"  value="{{old('gerant1')}}" name="gerant1" required >
            @foreach ($errors->get('gerant1') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>
<div class="form-group">
            <label for="recipient-name" class="col-form-label" >Télephone:</label>
            <input type="text" class="form-control @if($errors->get('tele1')) is-invalid @endif" id="teleinput"  value="{{old('tele1')}}" name="tele1" required >
            @foreach ($errors->get('tele1') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="email" class="form-control @if($errors->get('email')) is-invalid @endif" id="emailinput"  name="email1" value="{{old('email1')}}" required>
            @foreach ($errors->get('email1') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>
            <div class="form-group"> 
                <label for="recipient-name" class="col-form-label">Logo:</label>
                
  <div class="custom-file">
    <input type="file" class="custom-file-input " id="validatedCustomFile"   name="logo1" value="{{old('logo1')}}" >
    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
    <div class="invalid-feedback">Example invalid custom file feedback</div>
    
  </div>
</div>
<div class="form-group">
<div class="form-group">
            <label for="message-text" class="col-form-label">Adresse:</label>
            <textarea class="form-control @if($errors->get('adresse1')) is-invalid @endif" id="adresseinput" name="adresse1" required >{{old('adresse1')}}</textarea>
            @foreach ($errors->get('adresse1') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>
            <label for="recipient-name" class="col-form-label" >Mot de passe:</label>
            <input type="password" class="form-control" id="recipient-nm"  name="password" value="{{old('password')}}" >
          </div>
       
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control @if($errors->get('description1')) is-invalid @endif" id="descriptioninput"  name="description1" required >{{old('description1')}}</textarea>
            @foreach ($errors->get('description1') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label" >Ville:</label>
          <select class="custom-select @if($errors->get('ville1')) is-invalid @endif" id="ville"  name="ville1" required>
          
  <option>choix ...</option>
  @foreach($inf[1] as $ltV)
  <option  value="{{$ltV->id}}" >{{$ltV->nom}}</option>
  @endforeach
</select>
@foreach ($errors->get('ville1') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
</div>
          <div class="form-group">
            <div> <label for="latitude-text" class="col-form-label">Latitude :</label>
            <input type="number" step=0.0000000001 class="form-control  @if($errors->get('latitude')) is-invalid @endif" id="latitude-text"   name="Latitude" required value="{{old('latitude')}}">
            @foreach ($errors->get('latitude') as $error)
            <div class="invalid-feedback">
            {{ $error }}
          </div>
          @endforeach
        </div>
          <div>
              <div> <label for="latitude-text" class="col-form-label">Longitude :</label>
              <input type="number" step=0.0000000001 class="form-control  @if($errors->get('longitude')) is-invalid @endif" id="longitude-text"   name="Longitude" required value="{{old('longitude')}}">
              @foreach ($errors->get('longitude') as $error)
              <div class="invalid-feedback">
              {{ $error }}
            </div>
            @endforeach
        </div>
      </div>   
          </div>
         
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ignorer</button>
        <button type="submit" class="btn btn-primary" form="f1">Sauvgarder</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal ajouter -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter un restaurant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('nouveauResto')}}" id="f2" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label" >Nom:</label>
            <input type="text" class="form-control @if($errors->get('nom')) is-invalid @endif" id="recipient-name" value="{{old('nom')}}"   name="nom" required>
            @foreach ($errors->get('nom') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>
          {{-- <div class="form-group">
            <label for="recipient-name" class="col-form-label" >Type Restaurant:</label>
          <select class="custom-select @if($errors->get('type')) is-invalid @endif" id="recipient-type"  name="type" required>
          
  <option selected>Choose ...</option>
  @foreach($inf[0] as $lt)
  <option  value="{{$lt->id}}" @if(old('type')==$lt->id) selected @endif >{{$lt->name}}</option>
  @endforeach
</select>
@foreach ($errors->get('type') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
</div> --}}
Type Restaurant:

<div class="row">
  <div class="col-4">
      @php $cntype=0;  @endphp 
      @foreach($inf[0] as $lt)
  <div>
    <input type="checkbox" id="ty{{$cntype}}" class="@if($errors->get('type{{$cntype}}')) is-invalid @endif"  name="type{{$cntype}}" value="{{$lt->id}}" >
    <label for="restaurant">{{$lt->name}}</label>
    @foreach ($errors->get('type{{$cntype}}') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
            @endforeach
  </div>
  @php $cntype++;@endphp
@endforeach
@php
 echo '<input type="hidden" name="countype" value="'.$cntype.'">';
@endphp 
</div>
</div>

<div class="form-group">
            <label for="recipient-name" class="col-form-label">Nom gérant:</label>
            <input type="text" class="form-control @if($errors->get('gerant')) is-invalid @endif" id="recipient-tele"   name="gerant" value="{{old('gerant')}}" required>
            @foreach ($errors->get('gerant') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
            @endforeach
          </div>
  
<div class="form-group">
            <label for="recipient-name" class="col-form-label">Télephone:</label>
            <input type="text" class="form-control @if($errors->get('tele')) is-invalid @endif" id="recipient-tele"   name="tele" value="{{old('tele')}}" required>
            @foreach ($errors->get('tele') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="email" class="form-control @if($errors->get('email')) is-invalid @endif" id="recipient-email"   name="email" value="{{old('email')}}" required>
            @foreach ($errors->get('email') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>
            <div class="form-group"> 
                <label for="recipient-name" class="col-form-label">Logo:</label>
                
  <div class="custom-file">
    <input type="file" class="custom-file-input @if($errors->get('logo')) is-invalid @endif" id="validatedCustomFile"   name="logo" value="{{old('logo')}}" required>
    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
    <div class="invalid-feedback">Example invalid custom file feedback</div>
  </div>
  @foreach ($errors->get('logo') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
</div>
<div class="form-group">
            <label for="message-text" class="col-form-label">Adresse:</label>
            <textarea class="form-control @if($errors->get('adresse')) is-invalid @endif" id="message-text"   name="adresse" required >{{old('adresse')}}</textarea>
            @foreach ($errors->get('adresse') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>

<div class="form-group">
            <label for="recipient-name" class="col-form-label" >Mot de passe:</label>
            <input type="password" class="form-control  @if($errors->get('password')) is-invalid @endif" id="recipient-nm"  name="password"value="{{old('password')}}" required>
            @foreach ($errors->get('password') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control  @if($errors->get('description')) is-invalid @endif" id="message-text"   name="description" required>{{old('description')}}</textarea>
            @foreach ($errors->get('description') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
          </div>


          <div class="form-group">
            <label for="recipient-name" class="col-form-label" >Ville:</label>
          <select class="custom-select @if($errors->get('ville')) is-invalid @endif" id="recipient-ville"  name="ville" required>
          
  <option selected>choix ...</option>
  @foreach($inf[1] as $ltV)
  <option  value="{{$ltV->id}}" @if(old('ville')==$ltV->id) selected @endif >{{$ltV->nom}}</option>
  @endforeach
</select>
@foreach ($errors->get('ville') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
</div>


          <div class="form-group">
            <div> <label for="latitude-text" class="col-form-label">Latitude :</label>
            <input type="number" step=0.0000000001 class="form-control  @if($errors->get('latitude')) is-invalid @endif" id="latitude-text"   name="Latitude" required value="{{old('latitude')}}">
            @foreach ($errors->get('latitude') as $error)
            <div class="invalid-feedback">
            {{ $error }}
          </div>
          @endforeach
        </div>
          <div>
              <div> <label for="latitude-text" class="col-form-label">Longitude :</label>
              <input type="number" step=0.0000000001 class="form-control  @if($errors->get('longitude')) is-invalid @endif" id="longitude-text"   name="Longitude" required value="{{old('longitude')}}">
              @foreach ($errors->get('longitude') as $error)
              <div class="invalid-feedback">
              {{ $error }}
            </div>
            @endforeach
        </div>
      </div>   
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary" form="f2">Inscrivez</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('style')
<style>
.btn-circle.btn-xl {
  width: 70px;
  height: 70px;
  padding: 10px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
}
</style>
@endsection('style')

@section('javascript')

<script>

function Afficher(id){ 
var name=$('#name'+id).val();
var idr=$('#id'+id).val();
var email=$('#email'+id).val();
var type=$('#type'+id).val();
var description=$('#description'+id).val();
var adresse=$('#adresse'+id).val();
var tele=$('#tele'+id).val();
var gerant=$('#gerant'+id).val();
var longitude=$('#longitude'+id).val();
var latitude=$('#latitude'+id).val();
var ville=$('#ville'+id).val();



$('#idinput').val(idr);
$('#nominput').val(name);
$('#type').val(type);
$('#teleinput').val(tele);
$('#emailinput').val(email);
$('#descriptioninput').val(description);
$('#adresseinput').val(adresse);
$('#gerantinput').val(gerant);
$('#longitude-text').val(longitude);
$('#latitude-text').val(latitude);
$('#ville').val(ville);
axios.get('getyperesto/'+idr).then(response =>  ($('#typesrestaut').html(response.data)))


$('#modifermodal1').modal();
}

function bloquer(cnt){
var id =$('#id'+cnt).val();
  if($('#idcheck'+cnt).is(":checked"))
  axios.get('activerRestaurant/'+id) .then(response => (toastr.success(response.data)))//(alert(response.data) ))
      else
      axios.get('bloquerRestaurant/'+id).then(response =>  (toastr.error(response.data)))
} 
//$(document).ready(function(){
 // $('#modifier1').click(function(){
 // var name=$('#name1').val();
//var email=$('#email1').val();
//var type=$('#type1').val();
//var description=$('#description1').val();

//alert(type);
//$('#nominput').val(name);
//$('#typeinput').val(type);
//$('#emailinput').val(email);
//$('#descriptioninput').val(description);

//$('#modifermodal1').modal();
//});
//});
</script>

@endsection
