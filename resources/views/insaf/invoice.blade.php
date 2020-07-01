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

<center><img src="{{public_path('storage/logo.jpg')}}" width="50px" height="50px" style="border-radius:100%;"></center><br><br>
<center><h2><u><i>Les restaurants membres</i></u></h2></center>
<table border="1" >
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
        @foreach($ListRestaurant as $ls)
        
        <tr>
<td><img src="{{public_path('storage/'.$ls->logo)}}" class="img-rounded" width="70px" height="50px"  style=" overflow: hidden; width: 50px; height: 50px; "></td>
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