<head>
<style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

   th,
    td {
      
      border: 1px solid black;
     }
   </style>
</head>
<center><img src="{{public_path('storage/logo.jpg')}}" width="140px" height="120px"></center><br><br>
<h3>Liste des restaurants de la semaine du : {{$inf[0]}} au {{$inf[1]}}</h3>
<table>
<tr>
           <th>Logo</th>
           <th>Nom</th>
           <th>Nom Gérant</th>
           <th>Email</th>
           <th>Télephone</th>
           <th>adresse</th>
           <th>Description</th>
           <th>Type</th>
           <th>Localilsation</th>
</tr>
@foreach($lst as $ls)
<tr>
<td><img src="{{public_path('storage/'.$ls->logo)}}" style="border-radius:100%;" width="50px" height="50px"></td>
<td>{{$ls->name}}</td>
<td>{{$ls->gerant}}</td>
<td>{{$ls->email}}</td>
<td>{{$ls->tele}}</td>
<td>{{$ls->adresse}}</td>
<td>{{$ls->description}}</td>
<td>{{$ls->typename}}</td>
<td>{{$ls->localisationlatitude}},{{$ls->localisationlongitude}}</td>
</tr>
@endforeach
</table>