@extends('layouts.app')
@section('content')
<div class="container">
  {{-- <form action="" method="POST">
    @csrf
    <div>
      <label for="">Mot de pass oublier : saissier l'email</label>
      <input type="text" name="emailrec" />
      <button type="submit"></button>
    </div>
  </form> --}}
<div class="row">
  
<div class="col-md-10"> 
<div class="row">
@php $count =1 @endphp
@foreach($list as $lUsers)
<div class="col-md-3 col-xs-3">
<div class="card mb-2" style="width: 14rem;">
  <img src="{{ asset('storage/userLogo.png') }}" class="mx-auto d-block mt-4"  width="50%"  alt="User Photo">
  <div class="card-body">
    <h5 class="card-title text-center"> {{$lUsers->name}}</h5>
    <input type="hidden" id="id1{{$count}}" value="{{$lUsers->id}}"/>
    <input type="hidden" id="name1{{$count}}" value="{{$lUsers->name}}"/>
    <input type="hidden"  id="phone1{{$count}}" value="{{$lUsers->tele}}"/>
    <input type="hidden" id="email1{{$count}}" value="{{$lUsers->email}}"/>
    <p class="card-text text-center">{{$lUsers->tele}}</p>
    <p class="card-text text-center">{{$lUsers->email}}</p>
    <div class="form-group">
      <div class="col">
    <button type="button" class="btn btn-info form-control mb-2" id="modifierUser({{$count}})" onclick="modifierUser({{$count}});">Modifier</button>
    </div>  
    <div class="col">
    @if($lUsers->etat == null)
       <input type="checkbox" data-width="100%" name="check" id="check{{$count}}" onchange="bloquer({{$count}})" checked data-toggle="toggle" data-on="Activer" data-off="Bloquer" data-onstyle="success" data-offstyle="danger">
     @else
     <input type="checkbox" data-width="100%" name="check" id="check{{$count}}" onchange="bloquer({{$count}})"  data-toggle="toggle" data-on="Activer" data-off="Bloquer" data-onstyle="success" data-offstyle="danger">
     @endif
    </div> 
    </div>
    </div>
  </div>
</div>
@php $count++ @endphp
@endforeach
</div>
  <div class="d-flex justify-content-center mt-5">
    {{$list->links()}}
  </div>
</div>
<div class="col-md-2">
    <div class="float-right">
      <button type="button" class="btn btn-success mb-2 mx-auto btn-lg btn-block btn-circle btn-xl" data-toggle="modal" data-target="#ajouterUser"><span style="font-size: 35px; text-align: center;">+</span></button>
    </div>
  </div>
</div>

</div>
<form action="{{url('/userStore')}}" method="post">
      @csrf
<div class="modal fade" id="ajouterUser" tabindex="-1" role="dialog" aria-labelledby="ajouterUser" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ajouterUser">Ajouer User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputEmail4">Name</label>
      <input type="text" class="form-control" name="name" placeholder="Name" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Phone</label>
      <input type="text"   class="form-control" name="phone" placeholder="Phone" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
       

    </div>
  </div>
</div>
</form>

<form action="{{url('/userUpdate')}}" method="post">
      @csrf
      <input type="hidden" id="idn" name="id"/>
<div class="modal fade" id="modalModifierUser" tabindex="-1" role="dialog" aria-labelledby="modifierUser" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modifierUser">Modifier User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputEmail4">Name</label>
      <input type="text" id="modalName" class="form-control" name="name" placeholder="Name" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Phone</label>
      <input type="text" id="modalPhone"  class="form-control" name="phone" placeholder="Phone" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" id="modalEmail"  class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" id="modalPassword"  class="form-control" name="password" placeholder="Password" >
    </div>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
</form>
@endsection('content')
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
function modifierUser(ctr){

  $('#idn').val($('#id1'+ctr).val());
  var name =$('#name1'+ctr).val();
  var email =$('#email1'+ctr).val();
  var phone =$('#phone1'+ctr).val();
  $('#modalName').val(name);
  $('#modalEmail').val(email);
  $('#modalPhone').val(phone);
  $('#modalModifierUser').modal();

}

  function bloquer(cmp){
    if ($('#check'+cmp).is(':checked')) {
      var id=$('#id1'+cmp).val();
     // alert(idU);
        axios
          .get('/activerUser/'+id)
          .then(response => (toastr.success(response.data) ))
}
    
    else{
      var id=$('#id1'+cmp).val();
     // alert(idU);
      axios
          .get('/bloquerUser/'+id)
          .then(response => (toastr.error(response.data)))
    }
  }
 
</script>

@endsection('javascript')

