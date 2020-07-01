@extends('layouts.app') 
@section('content')
   
           
    <button type="button" class="btn btn-info2 mb-2 btn-circle btn-xl"  data-toggle="modal"  data-target="#ajouterpays"><span style="font-size: 35px; text-align: center;">+</span></button>
               
        
    @php $cnt=1;  @endphp 
        @foreach($ListPV[1] as $list1)  
        <input type="hidden" id="id1{{$cnt}}" value="{{$list1->id}}">        
        @php $cnt++; @endphp 
    @endforeach

    
   
        <h1>Liste des Villes</h1>
        <div class="tbl-header">
          <table class="col-12"cellpadding="0" cellspacing="0" border="0">
            <thead>
              <tr>
                <th>Nom de la ville</th>
                <th>Code postal</th>
                <th><pre>                    </pre></th>                                                                                                                                     </pre></th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="tbl-content">
          <table cellpadding="0" cellspacing="0" class="table table-hover" border="0">
            <tbody>
     @php $cnt=1;  @endphp 
        @foreach($ListPV[0] as $list)
<input type="hidden" id="id{{$cnt}}" value="{{$list->id}}">   
                            <input type="hidden" id="nom{{$cnt}}" value="{{$list->nom}}">
                            <input type="hidden" id="cont{{$cnt}}" value="{{$list->zip}}">                  
                  <tr> 
                <td>{{$list->nom}}</td>
                <td>{{$list->zip}} </td>
                <td>
                <button type="button" class="btn btn-outline-warning"  onclick="modify({{$cnt}})"  >Modifier</button>
                <button type="button" onclick="deleted({{$cnt}})" class="btn btn-outline-danger" >Supprimer</button>
                </td>
            </tr>
 <!-- supprimerVille -->           
            <div>
<form action="{{url('/DeleteVille')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="deletepays" tabindex="-1" role="dialog" aria-labelledby="ajouterPays" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterPays">Supprimer une Ville</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div> 
                <input type="hidden" id="idinput" value="{{$list->id}}" name="idinput">                
                <h5>Voulez vous vraiment supprimer cette ville?</>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary" id="submit">Oui</button>
                    </div>

                    </div>
                    </div>
                    </div>

</form>
</div>
<div>
           
<!-- ModifierVille -->
<div>
<form action="{{url('/ModifyVille')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modifierpays" tabindex="-1" role="dialog" aria-labelledby="ajouterPays" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterPays">Modifier une Ville</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
                </div>  
                <input type="hidden" id="idinput1" value="{{$list->id}}" name="idinput">                
                <div class="modal-body">
                    <div class="form-row"> 

                        <div class="form-group col-md-4">

                            <label for="inputEmail4">Nom:</label>
                            <input type="text" class="form-control @if($errors->get('name')) is-invalid  @endif" name="name" required value="{{$list->nom}}" id="name" 
                                > @foreach ($errors->get('name') as $error)
                            <div class="invalid-feedback">
                                {{$error}}
                            </div>
                            @endforeach
                        </div> 
                        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">ZIP:</label>
                            <input type="text" class="form-control @if($errors->get('ZIP1')) is-invalid  @endif" name="ZIP1" required value="{{$list->zip}}" id="continent"
                                > @foreach ($errors->get('ZIP1') as $error)
                            <div class="invalid-feedback">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                   </div>
                   <div>
                   <label for="recipient-name" class="col-form-label" >Pays:</label>
          <select class="custom-select @if($errors->get('type')) is-invalid @endif" id="choosepays_id"  name="type1" >
          
  <option selected>Choose ...</option>
  @foreach($ListPV[1] as $list1)
  <option value="{{$list1->id}}">{{$list1->nom}}</option>
  @endforeach
</select>
@foreach ($errors->get('type1') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
</div>
                </div>
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit">Save</button>
                    </div>



            </div>
        </div>
    </div>
</form>
</div>
<div>
        @php $cnt++; @endphp 
    @endforeach
            </tbody>
          </table>
        
        </div>
        
    <div class="d-flex justify-content-center mt-5">
    </div> 
</div>
      


{{ $ListPV[0]->links() }}  
<!-- AjouterVille-->
<div>
<form action="{{url('/AjouterVille')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ajouterpays" tabindex="-1" role="dialog" aria-labelledby="ajouterPays" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterPays">Ajouter une Ville</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Nom:</label>
                            <input type="text" class="form-control @if($errors->get('name')) is-invalid  @endif" name="name" required 
                                > @foreach ($errors->get('name') as $error)
                            <div class="invalid-feedback">
                                {{$error}}
                            </div>
                            @endforeach
                        </div> 
                        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">ZIP:</label>
                            <input type="text" class="form-control @if($errors->get('ZIP')) is-invalid  @endif" name="ZIP" required 
                                > @foreach ($errors->get('ZIP') as $error)
                            <div class="invalid-feedback">
                                {{$error}}
                            </div>
                            @endforeach
                        </div>
                   </div>
                   <div>
                   <label for="recipient-name" class="col-form-label" >Pays:</label>
          <select class="custom-select @if($errors->get('type')) is-invalid @endif" id="choosepays_id"  name="type1" >
          
  <option selected>Choose ...</option>
  @foreach($ListPV[1] as $list1)
  <option value="{{$list1->id}}">{{$list1->nom}}</option>
  @endforeach
</select>
@foreach ($errors->get('type1') as $error)
            <div class="invalid-feedback">
            {{ $error }}
        </div>
             
            @endforeach
</div>
                </div>
                </div>                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit">Save</button>
                    </div>



            </div>
        </div>
    </div>
</form>
</div>
@php $cnt=1;  @endphp 
                        
                  




                

@endsection('content') 

@section('style')
<style>
body{
  background-color: lightblue   ;
}
.btnC.btnS
{
    width: 70px;
        height: 70px;
        padding: 10px 16px;
        font-size: 24px;
        line-height: 1.33;
        border:none;
        position: absolute;
        right: 15%;
        top: 54px;
}
.btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        font-size: 24px;
        line-height: 1.33;
        border-radius: 35px;
        border:none;
        position: absolute;
        right: 15%;
        top: 54px;
    }
    .btn-circle.btn-xl:hover{
        background: #25ba7b;
    }
.editBTN1
{
       
       border:none;
        font-size: 20px;
        border-radius: 35px;
} 
.editBTN:hover{
        background: #25ba7b;
    }     
h1{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
  margin-top: 25px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:500px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 18px 0px;
  text-align: left;
  font-weight: 700;
  font-size: 13px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding-left: 5px;
  padding-top: 8px;
  padding-right: 8px;

  text-align: left;
  vertical-align:middle;
  font-weight: 600;
  font-size: 14px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
  /* display:flex */
}
tr td:nth-child(10){
    display: flex;
    align-items: baseline;

}

tr td:nth-child(10) button:nth-child(1){
    margin-right:2px ;
    background: #fff;
    color:#25c481;
    border:none;
    margin-left: -45px;
}
tr td:nth-child(10) button:nth-child(2){
    background:transparent;
    color:#fff;
    border:2px solid #fff
}

tr td:nth-child(9) button:nth-child(1){
    background:transparent;
    color:#fff;
    border:2px solid #fff;

}
@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);

section{
  margin: 0 20px 50px 20px;
}


.modal-body, .modal-header, .modal-footer{
    background: -webkit-linear-gradient(left, #25c481, #25b7c4);
    background: linear-gradient(to right, #25c481, #25b7c4);

}  
</style>
@endsection('style')

@section('javascript')

<script>
    function modify(id){
 
var idp=$('#id'+id).val();
$('#idinput1').val(idp);
var name=$('#nom'+id).val();
$('#name').val(name);
var zip=$('#cont'+id).val();
$('#continent').val(zip);


        $('#modifierpays').modal();
            
}

function deleted(id){
   
    var idp=$('#id'+id).val();
$('#idinput').val(idp);

  
 
         $('#deletepays').modal();
             
 }
 
 
 


</script>
@endsection('javascript')