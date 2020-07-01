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
<center><h2><u><i>Les restaurants membres</i></u></h2></center>

@php $v1=0; @endphp
@foreach($ListRestaurant as $ls)

@if($v1==0)

<h4><i><u>{{$ls->namemonth}}/{{$ls->year}}:</u></i></h4>
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
       
    
@elseif($ListRestaurant[$v1-1]->namemonth!=$ls->namemonth || $ListRestaurant[$v1-1]->year!=$ls->year)
</table>

<h4><i><u>{{$ls->namemonth}}/{{$ls->year}}:</u></i></h4>
<table style="border-collapse: collapse" >

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
       
  
@endif    
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


        
        @php $v1++; @endphp
        @endforeach