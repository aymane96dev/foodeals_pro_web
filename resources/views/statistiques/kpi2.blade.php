@extends('layouts.app')

@section('content')
  
   <div class="container">

           <div class="row page-titles">
                <div class="col-md-12 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Statistiques / Comportement de Consommateurs</li>
                    </ol>
                </div>
            </div>

        <div class="row justify-content-end mt-3">

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
           </div>
           <form method="POST" action="{{ url('getdashboard3post' ) }}" id="city_form"> 
                @csrf
                <input type="hidden" name="cityid" id="cityid">
                <input type="hidden" name="monthid" id="monthid">
           </form>
        </div>

       <div class="row justify-content-start mt-3">
           <div class="col-3">
               <div class="card card-inverse card-info">

                   <div class="box bg-info text-center">
                       <h1 class="font-light text-white">{{ $type }} &nbsp;&nbsp;<i class="mdi mdi-food" ></i></h1>
                       <h6 class="text-white">Le type de plat <br> le plus recommandé</h6>
                   </div>

               </div>
           </div>
       </div>

       <div class="row justify-content-start mt-3">
           <div class="col-12" id="grapheprix" >
               <canvas id="chart4" width="100" height="100" > </canvas>
           </div>
       </div>

       <div class="row justify-content-start mt-3">
           <div class="col-12" id="grapheprixperday" >
               <canvas id="chart2" width="100" height="100" > </canvas>
           </div>
       </div>

       <div class="row justify-content-start mt-3">
           <div class="col-12" id="graphemodalite" >
               <canvas id="chart3" width="100" height="100" > </canvas>
           </div>
       </div>

       <div class="row justify-content-start mt-3">
           <div class="col-12" id="graphemodaliteperday" >
               <canvas id="chart1" width="100" height="100" > </canvas>
           </div>
       </div>

    </div>


   <!-- l'intervalle des prix d'acceptabilité -->


   <script>
     
            function month()
            {
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

           var myChart;
           $.get('getintprix/'+selectedvalue+'/'+selectedvalueCity,function(data)
           {
               var  prices = new Array();
               var  qtes = new Array();
               for(var i=0;i<data.length;i++)
               {
                   prices.push(data[i]['prix']+' Dhs');
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

               document.getElementById("grapheprix").innerHTML = '&nbsp;';
               document.getElementById("grapheprix").innerHTML = '<canvas id="chart4"></canvas>';

               var ctx = document.getElementById('chart4').getContext('2d');
               var myChart = new Chart(ctx, {

                   type: 'bar',
                   data: {
                       labels:prices,
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
                           text:' l\'intervalle des prix d\'acceptabilité ',
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

               console.log(myChart.config.type);
           });

          var myChart;
          $.get('getintprixperday/'+selectedvalueCity,function(data)
          {
              var  prices = new Array();
              var  qtes = new Array();
              for(var i=0;i<data.length;i++)
              {
                  prices.push(data[i]['prix']+' Dhs');
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

              document.getElementById("grapheprixperday").innerHTML = '&nbsp;';
              document.getElementById("grapheprixperday").innerHTML = '<canvas id="chart2"></canvas>';

              var ctx = document.getElementById('chart2').getContext('2d');
              var myChart = new Chart(ctx, {

                  type: 'bar',
                  data: {
                      labels:prices,
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
                          text:' l\'intervalle des prix d\'acceptabilité/jour ',
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

           $.get('getmodalite/'+selectedvalue+'/'+selectedvalueCity,function(data)
           {

               var  surplaces = new Array();
               for(var i=0;i<data.length;i++)
               {
                   surplaces.push(data[i][0]);
               }
               var  backcolors = new Array();
               var  bordcolors = new Array();


               if(surplaces[0]['surplace']>surplaces[1]['emporter'] && surplaces[0]['surplace']>surplaces[2]['livrées'] ){

                   backcolors.push('rgba(54, 162, 235, 0.2)');
                   bordcolors.push('rgba(54, 162, 235, 1)');
                   backcolors.push('rgba(255, 159, 64, 0.2)');
                   bordcolors.push('rgba(255, 159, 64, 0.2)');
                   backcolors.push('rgba(255, 99, 132, 0.2)');
                   bordcolors.push('rgba(255, 99, 132, 1)');

               }else if(surplaces[1]['emporte']>surplaces[0]['surplace'] && surplaces[1]['emporte']>surplaces[2]['livrées'] ){

                   backcolors.push('rgba(255, 99, 132, 0.2)');
                   bordcolors.push('rgba(255, 99, 132, 1)');
                   backcolors.push('rgba(255, 159, 64, 0.2)');
                   bordcolors.push('rgba(255, 159, 64, 0.2)');
                   backcolors.push('rgba(54, 162, 235, 0.2)');
                   bordcolors.push('rgba(54, 162, 235, 1)');
               }else {
                   backcolors.push('rgba(255, 99, 132, 0.2)');
                   bordcolors.push('rgba(255, 99, 132, 1)');
                   backcolors.push('rgba(54, 162, 235, 0.2)');
                   bordcolors.push('rgba(54, 162, 235, 1)');
                   backcolors.push('rgba(255, 159, 64, 0.2)');
                   bordcolors.push('rgba(255, 159, 64, 0.2)');
               }

               document.getElementById("graphemodalite").innerHTML = '&nbsp;';
               document.getElementById("graphemodalite").innerHTML = '<canvas id="chart3"></canvas>';

               var ctx = document.getElementById('chart3').getContext('2d');
               var myChart = new Chart(ctx, {

                   type: 'pie',
                   data: {
                       labels:['surplace','emportées','livraison'],
                       datasets: [{
                           label: 'somme d\'argent en Dhs ',
                           data: [surplaces[0]['surplace'],surplaces[1]['emporter'],surplaces[2]['livrées']],
                           backgroundColor: backcolors  ,
                           borderColor: bordcolors ,
                           borderWidth:1,
                       }]
                   },
                   options: {
                       animation:false,
                       title:{
                           display:true,
                           text:'Modalité de consommation ',
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

          $.get('getmodaliteperday/'+selectedvalueCity,function(data)
          {
              var  surplaces = new Array();
              for(var i=0;i<data.length;i++)
              {
                  surplaces.push(data[i][0]);
              }
              var  backcolors = new Array();
              var  bordcolors = new Array();

              if(surplaces[0]['surplace']>surplaces[1]['emporter'] && surplaces[0]['surplace']>surplaces[2]['livrées'] ){

                  backcolors.push('rgba(54, 162, 235, 0.2)');
                  bordcolors.push('rgba(54, 162, 235, 1)');
                  backcolors.push('rgba(255, 159, 64, 0.2)');
                  bordcolors.push('rgba(255, 159, 64, 0.2)');
                  backcolors.push('rgba(255, 99, 132, 0.2)');
                  bordcolors.push('rgba(255, 99, 132, 1)');

              }else if(surplaces[1]['emporte']>surplaces[0]['surplace'] && surplaces[1]['emporte']>surplaces[2]['livrées'] ){

                  backcolors.push('rgba(255, 99, 132, 0.2)');
                  bordcolors.push('rgba(255, 99, 132, 1)');
                  backcolors.push('rgba(255, 159, 64, 0.2)');
                  bordcolors.push('rgba(255, 159, 64, 0.2)');
                  backcolors.push('rgba(54, 162, 235, 0.2)');
                  bordcolors.push('rgba(54, 162, 235, 1)');
              }else {
                  backcolors.push('rgba(255, 99, 132, 0.2)');
                  bordcolors.push('rgba(255, 99, 132, 1)');
                  backcolors.push('rgba(54, 162, 235, 0.2)');
                  bordcolors.push('rgba(54, 162, 235, 1)');
                  backcolors.push('rgba(255, 159, 64, 0.2)');
                  bordcolors.push('rgba(255, 159, 64, 0.2)');
              }

              document.getElementById("graphemodaliteperday").innerHTML = '&nbsp;';
              document.getElementById("graphemodaliteperday").innerHTML = '<canvas id="chart1"></canvas>';

              var ctx = document.getElementById('chart1').getContext('2d');
              var myChart = new Chart(ctx, {

                  type: 'pie',
                  data: {
                      labels:['surplace','emportées','livraison'],
                      datasets: [{
                          label: 'somme d\'argent en Dhs ',
                          data: [surplaces[0]['surplace'],surplaces[1]['emporter'],surplaces[2]['livrées']],
                          backgroundColor: backcolors  ,
                          borderColor: bordcolors ,
                          borderWidth:1,
                      }]
                  },
                  options: {
                      animation:false,
                      title:{
                          display:true,
                          text:'Modalité de consommation/jour ',
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

