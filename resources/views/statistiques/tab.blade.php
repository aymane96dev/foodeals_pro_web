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
        <tr>
            <td id="id"><?php echo $command->id ?></td>
            <td id="checked"> @if($command->checked_at != null)
                    <span class="badge badge-success"><i class="fas fa-check"></i>&nbspSeen</span>
                @else <span class="badge badge-danger">Not Seen</span>
                @endif
            </td>
            <td id="date_collection"> <?php echo $command->date_collecte ?></td>
            <td id="nom"> <?php echo $command->name ?></td>
            <td id="tele"> <?php echo $command->tele ?></td>
            <td id="restaurant"> <?php echo $command->res_nom ?></td>
        </tr>
    @endforeach
    </tbody>
</table>