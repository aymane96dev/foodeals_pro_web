<div class="h-100 row align-items-center mt-5">
    <div class="page-header col-md-6 offset-4 mb-4 ">  
       <h2 class="text-primary font-weight-bold">Les informations d'une commande</h2>
    </div>
<div class="col-md-9 offset-2">
    <table class="table table-striped table-info ">
            <thead>
                <tr>
                <th scope="col">id</th>
                <th scope="col">checked at</th>
                <th scope="col">date de collection</th>
                <th scope="col">nom de produit</th>
                <th scope="col">téléphone</th>
                <th scope="col">nom de restaurant</th>
                </tr>
            </thead>
            <tbody>
            @foreach($infos as $command)
                <tr id="trinfos">
                <td><?php echo $command->id ?></td>
                <td> @if($command->checked_at != null) 
                <span class="badge badge-success"><i class="fas fa-check"></i>&nbspSeen</span>
                @else <span class="badge badge-danger">Not Seen</span>
                @endif
                </td>
                <td> <?php echo $command->date_collecte ?></td>
                <td> <?php echo $command->name ?></td>
                <td> <?php echo $command->tele ?></td>
                <td> <?php echo $command->res_nom ?></td>
                </tr>
                @endforeach
            </tbody>
    </table>
</div>
</div> 

<div class="row justify-content-center mt-3"> {{ $infos->links() }} </div>