@extends('layouts.app')

@section('content')
<div class="container" id="app11">
        <div class="row">
          <div class="col-sm-12">
                <button type="button" class="btn btn-primary float-right mb-2" data-toggle="modal" data-target="#modelajout"><i class="fas fa-plus-circle"></i> Ajouter</button>

                <div class="modal fade" id="modelajout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Nouveau Type de Produit</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form onsubmit="return false;">
                            <div class="modal-body">
                                <div class="form-group">
                                  <label for="name1" class="col-form-label">Nom de type de produit :</label>
                                  <input type="text" v-model="name" class="form-control" name="name" id="name1" required>
                                </div>
                                <div class="form-group">
                                  <label for="obs1" class="col-form-label">Observation :</label>
                                  <input type="text" v-model="obs" class="form-control" name="obs" id="obs1" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
                              <button type="submit"  class="btn btn-primary" v-on:click="addtype_produit"> Submit</button>
                            </div>
                        </form>
                          </div>
                        </div>
                      </div>
                <div class="modal fade" id="modalmod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel1">Modification de Type de produit</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form onsubmit="return false;">
                            <div class="modal-body">
                            <input type="hidden" disabled class="form-control" id="idt" name="id" required  :value="this.id">
                                <div class="form-group">
                                  <label for="name" class="col-form-label">Nom de type de produit :</label>
                                  <input type="text" :value="this.name_m" class="form-control" name="name" id="name" required>
                                </div>
                                <div class="form-group">
                                  <label for="obs" class="col-form-label">Observation :</label>
                                  <input type="text" :value="this.obs_m" class="form-control" name="obs" id="obs" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close</button>
                              <button type="submit"  class="btn btn-primary"  @click="edittype_produit()"> Update</button>
                            </div>
                        </form>
                          </div>
                        </div>
                    </div>

                <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">num</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Observation</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody >
                        <tr v-for="list in lists">
                            <td scope="row text-center">@{{list.id}}</td>
                        <td scope="row text-center">@{{list.name}}</td>
                        <td scope="row text-center">@{{list.obs}}</td>
                        <td>
                            <button data-toggle="modal" data-target="#modalmod" type="button" class="btn btn-success" v-on:click="setVal(list.id, list.name, list.obs)">
                                    <i class="fas fa-edit"></i> Modifier
                            </button>
                            <button class="btn btn-danger" v-on:click="deletetype_produit(list)"><i class="fas fa-trash-alt"></i> Supprimer</button>
                        </td>
                        </tr>
                </tbody>
            </table>
        </div>
        </div>
</div>
  @endsection

@section('javascript')
<script>
var app = new Vue({
    el: '#app11',
    data:{
        id :"",
        name_m: "",
        obs_m: "",
        ///pour ajouter:
        name: "",
        obs: "",
        lists: []
        },
        methods: {
            readlists:function()
            {
                axios.get('listTypeProduit')
                    .then(response => {
                        this.lists = response.data;
                    })
                    .catch((err) => console
                    .error(err));
            },
            addtype_produit: function()
            {
              var self = this;
            axios.post('AddTypeProduit',{name : self.name, obs : self.obs})
                .then((res) => {
                    this.lists = res.data;
                    toastr.success('Bien Ajouté');
                    $('#modelajout').modal('toggle');
                    if(res.data)
                    {
                        self.name="";
                        self.obs="";
                    }
                })
                .catch((err) => console
                    .error(err));
            },
            setVal(val_id, val_name, val_obs) {
                this.id = val_id;
                this.name_m = val_name;
                this.obs_m = val_obs;
            },
            edittype_produit:function()
            {
                var id = document.getElementById('idt');
                var name_m = document.getElementById('name');
                var obs_m = document.getElementById('obs');
            axios.post('/editTypeProduit/' + id.value, {name: name_m.value, obs: obs_m.value})
                .then(res => {
                this.lists = res.data;
                toastr.success('Bien modifier');
                $('#modalmod').modal('toggle');
                })
                .catch((err) => console
                    .error(err));
            },
            deletetype_produit:function(list)
            {
                Swal.fire({
                title: 'Êtes-vous sûr de vouloir supprimer cette élément ?',
                text: "Vous ne pouvez pas récupérer l'élément !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Oui'
                }).then((result) => {
                if (result.value) {

                axios.post('/deleteTypeProduit/' + list.id)
                .then(res => {
                this.readlists();
                toastr.error('Bien supprimer');
                })
                .catch(error =>{
                    toastr.error('Ce type de produit ne peut pas être supprimer');
                    console.error(err)});
                }
                })
            }
        },
    mounted : function()
        {
            this.readlists();
        }
    })
</script>
@endsection
