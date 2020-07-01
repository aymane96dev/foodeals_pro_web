@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Statistiques / Partenaires  </li>
                </ol>
            </div>
        </div>

        <div class="row justify-content-end ">

            <div class="col-4">
                <div class="dropdown bootstrap-select float-right ">
                    <div class="form-group">
                        <select onchange="month()" class="form-control bg-info text-white" id="citys">
                            @foreach($cities as $city)
                            <option value="{{$city->id}}" @if($ville==$city->id) selected @endif><span class="text-white" >{{ $city->nom }}</span></option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="dropdown bootstrap-select float-right mr-3">
                    <div class="form-group">                    
                        <select onchange="month()" class="form-control bg-info text-white" id="months">
                            @foreach($months as $month)
                             <option value="{{ $month['month'] }}" @if($mois==$month['month']) selected @endif><span class="text-white" ><?php $month_name = date("F", mktime(0, 0, 0, $month['month'], 10)); echo $month_name; ?></span></option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <form method="POST" action="{{ url('getpartenaires2' ) }}" id="city_form">
                 @csrf   
                <input type="hidden"  name="cityid" id="cityid">
                <input type="hidden" name="monthid" id="monthid">
                </form>
            </div>

        </div>

        </div>

    <div class="container">
        <div class="row justify-content-start">
            
            <div class="col-3 ">

                <div class="card card-inverse card-info">

                       <div class="box bg-info text-center">
                           <h1 class="font-light text-white"><span id="nbr_de_parts">{{ $partenaires[0]->partenaires }} </span> &nbsp;&nbsp;<i class="fas fa-users"></i></h1>
                           <h6 class="text-white">Nombre de partenaires par ville</h6>
                       </div>

                </div>

            </div>

            <div class="col-3 ">


                <div class="card card-warning card-inverse ">

                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><span id="nbr_de_pros">{{ $prds_today[0]->prods  }} </span>&nbsp;&nbsp;&nbsp;<i class="fas fa-shopping-cart"></i></h1>
                        <h6 class="text-white">Nombre de produits par jour</h6>
                    </div>

                </div>

            </div>

            <div class="col-3 ">


                <div class="card card-primary card-inverse ">

                    <div class="box bg-primary text-center">
                        <h1 class="font-light text-white"><span id="nbr_de_produits">{{ $prds[0]->prods }}</span> &nbsp;&nbsp;&nbsp;<i class="fas fa-shopping-cart"></i></h1>
                        <h6 class="text-white">Nombre de produits par mois</h6>
                    </div>

                </div>

            </div>

        </div>

        <div class="row justify-content-start mt-3 mb-3">
            <div class="col-12" id="grapheplatsparts" >
                <canvas id="chart1" width="100" height="100" > </canvas>
            </div>
        </div>

        <div class="row justify-content-start mb-3">
            <div class="col-12" id="graphecltscmmds" >
                <canvas id="chart2" width="100" height="100" > </canvas>
            </div>
        </div>

        <div class="row justify-content-start mt-3 mb-3">
            <div class="col-12" id="grapheplatspartsday" >
                <canvas id="chart3" width="100" height="100" > </canvas>
            </div>
        </div>

        <div class="row justify-content-start mt-3 mb-3">
            <div class="col-12" id="graphecltscmmdsday" >
                <canvas id="chart4" width="100" height="100" > </canvas>
            </div>
        </div>

    </div>    

        <div class="row justify-content-end">
            <div class="col-3 mr-5">
                <a class="btn btn-secondary" href="{{ url('/gettable') }}">le tableau complet</a>
            </div>
        </div>

        <div class="row mt-2">
        <div class="col-md-9 offset-1 " id="tab">

        </div>
        </div> 

    </div>
    <!-- nombre de plats par partenaires -->

    <script>
         
                function month(){
                    var selectBox = document.getElementById("months");
                    var selectedvalue = selectBox.options[selectBox.selectedIndex].value;
                    var selectBoxCity = document.getElementById("citys");
                    var selectedvalueCity = selectBoxCity.options[selectBoxCity.selectedIndex].value;
                    $("#cityid").val(selectedvalueCity);
                    $("#monthid").val(selectedvalue);
                    $("#city_form").submit();
                }   

            setInterval(function () {


                         var selectBox = document.getElementById("months");
                         var selectedvalue = selectBox.options[selectBox.selectedIndex].value;
                         var selectBoxCity = document.getElementById("citys");
                         var selectedvalueCity = selectBoxCity.options[selectBoxCity.selectedIndex].value; 


                         $.get('getpar/'+selectedvalueCity,function(donne)
                         { 
                             $('#nbr_de_parts').html(donne[0]['numberof']);
                         });

                         $.get('getprdsbyday/'+selectedvalueCity,function(donne)
                         {
                             $('#nbr_de_pros').html(donne[0]['prods']);
                         });

                         $.get('getproduits/'+selectedvalue+'/'+selectedvalueCity,function(produits)
                         {
                             $('#nbr_de_produits').html(produits[0]['products']);
                         });

                         $.get('getrevsrest/'+selectedvalue+'/'+selectedvalueCity,function(data)
                         {
                             var  names = new Array();
                             var  sommes = new Array();
                             for(var i=0;i<data.length;i++)
                             {
                                 names.push(data[i]['name']);
                                 sommes.push(data[i]['somme'])
                             }

                             var  backcolors = new Array();
                             var  bordcolors = new Array();
                             var max = Math.max(...sommes);
                             for(var i=0;i<data.length;i++)
                             {
                                 if(data[i]['somme']<= max/4){

                                     backcolors.push('rgba(255, 99, 132, 0.2)');
                                     bordcolors.push('rgba(255, 99, 132, 1)');

                                 } else if(data[i]['somme']> max/4 && data[i]['somme']<= max/2 ) {

                                     backcolors.push('rgba(54, 162, 235, 0.2)');
                                     bordcolors.push('rgba(54, 162, 235, 1)');

                                 } else if(data[i]['somme']> max/2 && data[i]['somme']<= (3*max)/4) {

                                     backcolors.push('rgba(255, 206, 86, 0.2)');
                                     bordcolors.push('rgba(255, 206, 86, 1)');
                                 } else {

                                     backcolors.push('rgba(153, 102, 255, 0.2)');
                                     bordcolors.push('rgba(153, 102, 255, 1)');
                                 }
                             }

                             document.getElementById("graphecltscmmds").innerHTML = '&nbsp;';
                             document.getElementById("graphecltscmmds").innerHTML = '<canvas id="chart2"></canvas>';

                             var ctx = document.getElementById('chart2').getContext('2d');
                             var myChart = new Chart(ctx, {
                            
                                 type: 'bar',
                                 data: {
                                     labels:names,
                                     datasets: [{
                                         label: 'somme d\'argent en Dhs ',
                                         data:sommes,
                                         backgroundColor: backcolors  ,
                                         borderColor: bordcolors ,
                                         borderWidth:1,
                                     }]
                                 },
                                 options: {
                                     animation:false,
                                     title:{
                                         display:true,
                                         text:'Les revenues mensuelles des restaurants par DH ',
                                         fontSize:30
                                     },
                                     scales: {
                                         yAxes: [{
                                             ticks: {
                                                 beginAtZero: true
                                             }
                                         }]
                                     }
                                 }
                             });
                         });
                  
                         $.get('getpltspartsfiltre/'+selectedvalue+'/'+selectedvalueCity,function(data)
                         { 
                             var  names = new Array();
                             var  qtes = new Array();
                             for(var i=0;i<data.length;i++)
                             {
                                 names.push(data[i]['name']);
                                 qtes.push(data[i]['products'])
                             }

                             var  backcolors = new Array();
                             var  bordcolors = new Array();
                             var max = Math.max(...qtes);
                             for(var i=0;i<data.length;i++)
                             {
                                 if(data[i]['products']<=max/4){

                                     backcolors.push('rgba(255, 99, 132, 0.2)');
                                     bordcolors.push('rgba(255, 99, 132, 1)');

                                 } else if(data[i]['products']>max/4 && data[i]['products']<=max/2 ) {

                                     backcolors.push('rgba(54, 162, 235, 0.2)');
                                     bordcolors.push('rgba(54, 162, 235, 1)');

                                 } else if(data[i]['products']>max/2 && data[i]['products']<=(3*max)/4) {

                                     backcolors.push('rgba(255, 206, 86, 0.2)');
                                     bordcolors.push('rgba(255, 206, 86, 1)');
                                 } else {

                                     backcolors.push('rgba(153, 102, 255, 0.2)');
                                     bordcolors.push('rgba(153, 102, 255, 1)');
                                 }
                             }

                             document.getElementById("grapheplatsparts").innerHTML = '&nbsp;';
                             document.getElementById("grapheplatsparts").innerHTML = '<canvas id="chart1"></canvas>';

                             var ctx = document.getElementById('chart1').getContext('2d');
                             var myChart = new Chart(ctx, {

                                 type: 'bar',
                                 data: {
                                     labels:names,
                                     datasets: [{
                                         label: 'quantité de produits',
                                         data: qtes,
                                         backgroundColor: backcolors  ,
                                         borderColor: bordcolors ,
                                         borderWidth:1,
                                     }]
                                 },
                                 options: {
                                     animation:false,
                                     title:{
                                         display:true,
                                         text:' nombre de plats par partenaires ',
                                         fontSize:30
                                     },
                                     scales: {
                                         yAxes: [{
                                             ticks: {
                                                 beginAtZero: true
                                             }
                                         }]
                                     }
                                 }
                             });

                         });

             $.get('getpltspartsperday/'+selectedvalueCity,function(data)
             {
                 var  names = new Array();
                 var  qtes = new Array();
                 for(var i=0;i<data.length;i++)
                 {
                     names.push(data[i]['name']);
                     qtes.push(data[i]['products'])
                 }

                 var  backcolors = new Array();
                 var  bordcolors = new Array();
                 var max = Math.max(...qtes);
                 for(var i=0;i<data.length;i++)
                 {
                     if(data[i]['products']<=max/4){

                         backcolors.push('rgba(255, 99, 132, 0.2)');
                         bordcolors.push('rgba(255, 99, 132, 1)');

                     } else if(data[i]['products']>max/4 && data[i]['products']<=max/2 ) {

                         backcolors.push('rgba(54, 162, 235, 0.2)');
                         bordcolors.push('rgba(54, 162, 235, 1)');

                     } else if(data[i]['products']>max/2 && data[i]['products']<=(3*max)/4) {

                         backcolors.push('rgba(255, 206, 86, 0.2)');
                         bordcolors.push('rgba(255, 206, 86, 1)');
                     } else {

                         backcolors.push('rgba(153, 102, 255, 0.2)');
                         bordcolors.push('rgba(153, 102, 255, 1)');
                     }
                 }

                 document.getElementById("grapheplatspartsday").innerHTML = '&nbsp;';
                 document.getElementById("grapheplatspartsday").innerHTML = '<canvas id="chart3"></canvas>';

                 var ctx = document.getElementById('chart3').getContext('2d');
                 var myChart = new Chart(ctx, {

                     type: 'bar',
                     data: {
                         labels:names,
                         datasets: [{
                             label: 'quantité de produits',
                             data: qtes,
                             backgroundColor: backcolors  ,
                             borderColor: bordcolors ,
                             borderWidth:1,
                         }]
                     },
                     options: {
                         animation:false,
                         title:{
                             display:true,
                             text:' nombre de plats par partenaires/jour ',
                             fontSize:30
                         },
                         scales: {
                             yAxes: [{
                                 ticks: {
                                     beginAtZero: true
                                 }
                             }]
                         }
                     }
                 });
             });


             $.get('getrevsrestperday/'+selectedvalueCity,function(data)
             {
                 var  names = new Array();
                 var  sommes = new Array();
                 for(var i=0;i<data.length;i++)
                 {
                     names.push(data[i]['name']);
                     sommes.push(data[i]['somme'])
                 }

                 var  backcolors = new Array();
                 var  bordcolors = new Array();
                 var max = Math.max(...sommes);
                 for(var i=0;i<data.length;i++)
                 {
                     if(data[i]['somme']<= max/4){

                         backcolors.push('rgba(255, 99, 132, 0.2)');
                         bordcolors.push('rgba(255, 99, 132, 1)');

                     } else if(data[i]['somme']> max/4 && data[i]['somme']<= max/2 ) {

                         backcolors.push('rgba(54, 162, 235, 0.2)');
                         bordcolors.push('rgba(54, 162, 235, 1)');

                     } else if(data[i]['somme']> max/2 && data[i]['somme']<= (3*max)/4) {

                         backcolors.push('rgba(255, 206, 86, 0.2)');
                         bordcolors.push('rgba(255, 206, 86, 1)');
                     } else {

                         backcolors.push('rgba(153, 102, 255, 0.2)');
                         bordcolors.push('rgba(153, 102, 255, 1)');
                     }
                 }

                 document.getElementById("graphecltscmmdsday").innerHTML = '&nbsp;';
                 document.getElementById("graphecltscmmdsday").innerHTML = '<canvas id="chart4"></canvas>';

                 var ctx = document.getElementById('chart4').getContext('2d');
                 var myChart = new Chart(ctx, {

                     type: 'bar',
                     data: {
                         labels:names,
                         datasets: [{
                             label: 'somme d\'argent en Dhs ',
                             data:sommes,
                             backgroundColor: backcolors  ,
                             borderColor: bordcolors ,
                             borderWidth:1,
                         }]
                     },
                     options: {
                         animation:false,
                         title:{
                             display:true,
                             text:'Les revenues mensuelles des restaurants par DH/jour ',
                             fontSize:30
                         },
                         scales: {
                             yAxes: [{
                                 ticks: {
                                     beginAtZero: true
                                 }
                             }]
                         }
                     }
                 });
             });

             $.get('getinfos',function(data)
             {
                 $('#tab').html(data);
             });

      },5000);



    </script>
@stop
