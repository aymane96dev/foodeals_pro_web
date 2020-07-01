@extends('layouts.app')

@section('content')
  
   <div class="container">

       <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Statistiques / Consommateurs</li>
                </ol>
            </div>
        </div>

       <div class="row justify-content-end mt-5 mb-2">

           <div class="col-4">
               <div class="dropdown bootstrap-select float-right">
                   <div class="form-group">
                       <select onchange="month()" class="form-control bg-info text-white" id="months">
                           @foreach($mons as $month)
                               <option value="{{ $month->month }}" @if($mois==$month->month) selected @endif ><span class="text-white" ><?php $month_name = date("F", mktime(0, 0, 0, $month->month, 10)); echo $month_name; ?></span></option>
                           @endforeach
                       </select>
                   </div>
               </div>
               <div class="dropdown bootstrap-select float-right mr-2">
                   <div class="form-group">
                       <select onchange="month()" class="form-control bg-info text-white" id="citys">
                           @foreach($cities as $city)
                               <option value="{{$city->id}}" @if($ville==$city->id) selected @endif ><span class="text-white" >{{ $city->nom }}</span></option>
                           @endforeach
                       </select>
                   </div>
               </div>
               <form method="POST" action="{{ url('getdashboard2post' ) }}" id="city_form"> 
                @csrf
               <input type="hidden" name="cityid" id="cityid">
               <input type="hidden" name="monthid" id="monthid">
               </form>
           </div>
       </div>
        
        <div class="row justify-content-start mt-3">


            <div class="col-3">
                <div class="card card-inverse card-success">

                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white"><span id="nbr_de_commandes">{{ $nbrcommandes[0]->products }} </span> &nbsp;&nbsp;&nbsp;<i class="fas fa-box"></i> </h1>
                        <h6 class="text-white">Nombre des commandes </h6>
                    </div>

                </div>
            </div>

            <div class="col-3">
                <div class="card card-inverse card-danger">

                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><span id="nbr_de_commandes_perday">{{ $nbrcommandes_perday[0]->products }} </span> &nbsp;&nbsp;&nbsp;<i class="fas fa-box"></i> </h1>
                        <h6 class="text-white">Nombre des commandes/jour </h6>
                    </div>

                </div>
            </div>

            <div class="col-3">
                <div class="card card-inverse card-warning">

                    <div class="box bg-primary text-center">
                        <h1 class="font-light text-white"><span>{{ $clients }}</span>&nbsp;&nbsp;&nbsp;<i class="fas fa-address-card"></i></h1>
                        <h6 class="text-white">Nombre des comptes</h6>
                    </div>

                </div>
            </div>

        </div>


        <div class="row justify-content-start mt-3"> 
            <div class="col-12" id="graphecltscmmds" >
                <canvas id="chart2" width="100" height="100" > </canvas>
            </div>
        </div>

       <div class="row justify-content-start mt-3">
           <div class="col-12" id="graphecltscmmdsperday" >
               <canvas id="chart4" width="100" height="100" > </canvas>
           </div>
       </div>

       <div class="row justify-content-start mt-3">
           <div class="col-12" id="graphe" >
               <canvas id="chart" width="100" height="100" > </canvas>
           </div>
       </div>

       <div class="row justify-content-start mt-3">
           <div class="col-12" id="grapheperday" >
               <canvas id="chart6" width="100" height="100" > </canvas>
           </div>
       </div>

       <div class="row justify-content-start">
           <div class="col-12" id="graphecmmdsmonth" >
               <canvas id="chart5" width="100" height="100" > </canvas>
           </div>
       </div>

       <div class="row justify-content-start">
           <div class="col-12" id="graphecmmdsperday" >
               <canvas id="chart7" width="100" height="100" > </canvas>
           </div>
       </div>

       <div class="row justify-content-start">
           <div class="col-12" id="graphesomme" >
               <canvas id="chart3" width="100" height="100" > </canvas>
           </div>
       </div>

       <div class="row justify-content-start">
           <div class="col-12" id="graphesommeperday" >
               <canvas id="chart8" width="100" height="100" > </canvas>
           </div>
       </div>




    </div>

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

           $.get('gettotalcommandes/'+selectedvalue+'/'+selectedvalueCity,function(produits)
           {
               $('#nbr_de_commandes').html(produits[0]['products']);
           });

             $.get('getcmmdsperday/'+selectedvalueCity,function(produits)
             {
                 $('#nbr_de_commandes_perday').html(produits[0]['products']);
             });

           $.get('getcltscmmds/'+selectedvalue+'/'+selectedvalueCity,function(data)
           {
               var  names = new Array();
               var  qtes = new Array();
               for(var i=0;i<data.length;i++)
               {
                   names.push(data[i]['name']);
                   qtes.push(data[i]['qtes'])
               }

               var  backcolors = new Array();
               var  bordcolors = new Array();
               var max = Math.max(...qtes);
               for(var i=0;i<data.length;i++)
               {
                   if(data[i]['qtes']<= max/4 ){

                       backcolors.push('rgba(255, 99, 132, 0.2)');
                       bordcolors.push('rgba(255, 99, 132, 1)');

                   } else if(data[i]['qtes']>max/4 && data[i]['qtes']<= max/2 ) {

                       backcolors.push('rgba(54, 162, 235, 0.2)');
                       bordcolors.push('rgba(54, 162, 235, 1)');

                   } else if(data[i]['qtes']>max/2 && data[i]['qtes']<= (3*max)/4 ) {

                       backcolors.push('rgba(255, 206, 86, 0.2)');
                       bordcolors.push('rgba(255, 206, 86, 1)');
                   } else {

                       backcolors.push('rgba(153, 102, 255, 0.2)');
                       bordcolors.push('rgba(153, 102, 255, 1)');
                   }
               }

               document.getElementById("graphecmmdsmonth").innerHTML = '&nbsp;';
               document.getElementById("graphecmmdsmonth").innerHTML = '<canvas id="chart5"></canvas>';

               var ctx = document.getElementById('chart5').getContext('2d');
               var myChart = new Chart(ctx, {

                   type: 'bar',
                   data: {
                       labels:names,
                       datasets: [{
                           label: 'quantité de client ',
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
                           text:'Les dépenses mensuelles de clients par quantité ',
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

         $.get('getcltscmmdsperday/'+selectedvalueCity,function(data)
         {
             var  names = new Array();
             var  qtes = new Array();
             for(var i=0;i<data.length;i++)
             {
                 names.push(data[i]['name']);
                 qtes.push(data[i]['qtes'])
             }

             var  backcolors = new Array();
             var  bordcolors = new Array();
             var max = Math.max(...qtes);
             for(var i=0;i<data.length;i++)
             {
                 if(data[i]['qtes']<= max/4 ){

                     backcolors.push('rgba(255, 99, 132, 0.2)');
                     bordcolors.push('rgba(255, 99, 132, 1)');

                 } else if(data[i]['qtes']>max/4 && data[i]['qtes']<= max/2 ) {

                     backcolors.push('rgba(54, 162, 235, 0.2)');
                     bordcolors.push('rgba(54, 162, 235, 1)');

                 } else if(data[i]['qtes']>max/2 && data[i]['qtes']<= (3*max)/4 ) {

                     backcolors.push('rgba(255, 206, 86, 0.2)');
                     bordcolors.push('rgba(255, 206, 86, 1)');
                 } else {

                     backcolors.push('rgba(153, 102, 255, 0.2)');
                     bordcolors.push('rgba(153, 102, 255, 1)');
                 }
             }

             document.getElementById("graphecmmdsperday").innerHTML = '&nbsp;';
             document.getElementById("graphecmmdsperday").innerHTML = '<canvas id="chart7"></canvas>';

             var ctx = document.getElementById('chart7').getContext('2d');
             var myChart = new Chart(ctx, {

                 type: 'bar',
                 data: {
                     labels:names,
                     datasets: [{
                         label: 'quantité de client ',
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
                         text:'Les dépenses mensuelles de clients par quantité/jour ',
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

         var myChart;
         $.get('getclientscommandesperday/'+selectedvalueCity,function(data)
         {
             var  names = new Array();
             var  commandes = new Array();
             for(var i=0;i<data.length;i++)
             {
                 names.push(data[i]['name']);
                 commandes.push(data[i]['commandes'])
             }

             var  backcolors = new Array();
             var  bordcolors = new Array();
             var max = Math.max(...commandes);
             for(var i=0;i<data.length;i++)
             {
                 if(data[i]['commandes']<=max/4){

                     backcolors.push('rgba(255, 99, 132, 0.2)');
                     bordcolors.push('rgba(255, 99, 132, 1)');

                 } else if(data[i]['commandes']>max/4 && data[i]['commandes']<=max/2 ) {

                     backcolors.push('rgba(54, 162, 235, 0.2)');
                     bordcolors.push('rgba(54, 162, 235, 1)');

                 } else if(data[i]['commandes']>max/2 && data[i]['commandes']<=(3*max)/4) {

                     backcolors.push('rgba(255, 206, 86, 0.2)');
                     bordcolors.push('rgba(255, 206, 86, 1)');
                 } else {

                     backcolors.push('rgba(153, 102, 255, 0.2)');
                     bordcolors.push('rgba(153, 102, 255, 1)');
                 }
             }

             document.getElementById("graphecltscmmdsperday").innerHTML = '&nbsp;';
             document.getElementById("graphecltscmmdsperday").innerHTML = '<canvas id="chart4"></canvas>';

             var ctx = document.getElementById('chart4').getContext('2d');
             var myChart = new Chart(ctx, {

                 type: 'bar',
                 data: {
                     labels:names,
                     datasets: [{
                         label: 'quantité de produits',
                         data: commandes,
                         backgroundColor: backcolors  ,
                         borderColor: bordcolors ,
                         borderWidth:1,
                     }]
                 },
                 options: {
                     animation:false,
                     title:{
                         display:true,
                         text:' nombre de commandes par client/jour ',
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


           $.get('getsommemens/'+selectedvalue+'/'+selectedvalueCity,function(data)
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
                   if(data[i]['somme']<=max/4){

                       backcolors.push('rgba(255, 99, 132, 0.2)');
                       bordcolors.push('rgba(255, 99, 132, 1)');

                   } else if(data[i]['somme']>max/4 && data[i]['somme']<=max/2 ) {

                       backcolors.push('rgba(54, 162, 235, 0.2)');
                       bordcolors.push('rgba(54, 162, 235, 1)');

                   } else if(data[i]['somme']>max/2 && data[i]['somme']<=(3*max)/4) {

                       backcolors.push('rgba(255, 206, 86, 0.2)');
                       bordcolors.push('rgba(255, 206, 86, 1)');
                   } else {

                       backcolors.push('rgba(153, 102, 255, 0.2)');
                       bordcolors.push('rgba(153, 102, 255, 1)');
                   }
               }

               document.getElementById("graphesomme").innerHTML = '&nbsp;';
               document.getElementById("graphesomme").innerHTML = '<canvas id="chart3"></canvas>';

               var ctx = document.getElementById('chart3').getContext('2d');
               var myChart = new Chart(ctx, {

                   type: 'bar',
                   data: {
                       labels:names,
                       datasets: [{
                           label: 'somme d\'argent en Dhs ',
                           data: sommes,
                           backgroundColor: backcolors  ,
                           borderColor: bordcolors ,
                           borderWidth:1,
                       }]
                   },
                   options: {
                       animation:false,
                       title:{
                           display:true,
                           text:'Les dépenses mensuelles de clients par DH ',
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

         $.get('getsommemensperday/'+selectedvalueCity,function(data)
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
                 if(data[i]['somme']<=max/4){

                     backcolors.push('rgba(255, 99, 132, 0.2)');
                     bordcolors.push('rgba(255, 99, 132, 1)');

                 } else if(data[i]['somme']>max/4 && data[i]['somme']<=max/2 ) {

                     backcolors.push('rgba(54, 162, 235, 0.2)');
                     bordcolors.push('rgba(54, 162, 235, 1)');

                 } else if(data[i]['somme']>max/2 && data[i]['somme']<=(3*max)/4) {

                     backcolors.push('rgba(255, 206, 86, 0.2)');
                     bordcolors.push('rgba(255, 206, 86, 1)');
                 } else {

                     backcolors.push('rgba(153, 102, 255, 0.2)');
                     bordcolors.push('rgba(153, 102, 255, 1)');
                 }
             }

             document.getElementById("graphesommeperday").innerHTML = '&nbsp;';
             document.getElementById("graphesommeperday").innerHTML = '<canvas id="chart8"></canvas>';

             var ctx = document.getElementById('chart8').getContext('2d');
             var myChart = new Chart(ctx, {

                 type: 'bar',
                 data: {
                     labels:names,
                     datasets: [{
                         label: 'somme d\'argent en Dhs ',
                         data: sommes,
                         backgroundColor: backcolors  ,
                         borderColor: bordcolors ,
                         borderWidth:1,
                     }]
                 },
                 options: {
                     animation:false,
                     title:{
                         display:true,
                         text:'Les dépenses mensuelles de clients par DH/jour ',
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


           var myChart;
           $.get('getclientscommandes/'+selectedvalue+'/'+selectedvalueCity,function(data)
           {
               var  names = new Array();
               var  commandes = new Array();
               for(var i=0;i<data.length;i++)
               {
                   names.push(data[i]['name']);
                   commandes.push(data[i]['commandes'])
               }

               var  backcolors = new Array();
               var  bordcolors = new Array();
               var max = Math.max(...commandes);
               for(var i=0;i<data.length;i++)
               {
                   if(data[i]['commandes']<=max/4){

                       backcolors.push('rgba(255, 99, 132, 0.2)');
                       bordcolors.push('rgba(255, 99, 132, 1)');

                   } else if(data[i]['commandes']>max/4 && data[i]['commandes']<=max/2 ) {

                       backcolors.push('rgba(54, 162, 235, 0.2)');
                       bordcolors.push('rgba(54, 162, 235, 1)');

                   } else if(data[i]['commandes']>max/2 && data[i]['commandes']<=(3*max)/4) {

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
                           label: 'quantité de produits',
                           data: commandes,
                           backgroundColor: backcolors  ,
                           borderColor: bordcolors ,
                           borderWidth:1,
                       }]
                   },
                   options: {
                       animation:false,
                       title:{
                           display:true,
                           text:' nombre de commandes par client ',
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


           var myChart;
           $.get('getcatproduits/'+selectedvalue+'/'+selectedvalueCity,function(data)
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

               document.getElementById("graphe").innerHTML = '&nbsp;';
               document.getElementById("graphe").innerHTML = '<canvas id="chart"></canvas>';

               var ctx = document.getElementById('chart').getContext('2d');
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
                           text:'les meilleures ventes des produits',
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

         var myChart;
         $.get('getcatproduitsperday/'+selectedvalueCity,function(data)
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

             document.getElementById("grapheperday").innerHTML = '&nbsp;';
             document.getElementById("grapheperday").innerHTML = '<canvas id="chart6"></canvas>';

             var ctx = document.getElementById('chart6').getContext('2d');
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
                         text:'les meilleures ventes des produits/jour',
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


     },5000);

   </script>

@stop

