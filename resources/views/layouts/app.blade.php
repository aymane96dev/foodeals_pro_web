<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">          
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert.css')}}"> 
    <link rel="stylesheet" href="{{asset('assets/css/bootstraptoggle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/smartphone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.min.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('assets/css/font-awesome.css')}}"> -->
    <title>{{ config('app.name', 'Laravel') }}</title>


<script src="{{asset('assets/js/jquery.min.js')}}" ></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/alert.js')}}" ></script>
<script src="{{asset('assets/js/vue.js')}}" ></script>
<script src="{{asset('assets/js/axios.js')}}" ></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" ></script>
<script src="{{asset('assets/js/Chart.min.js')}}" ></script>
<script src="https://kit.fontawesome.com/2bff6acff0.js" crossorigin="anonymous"></script>

<script src="{{asset('assets/js/bootstrap-toggle.min.js')}}"></script>

    <!-- Scripts -->
   

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        li
        {list-style:none;}
    </style>
</head>
<body>
    <div id="app">

            <nav class="navbar navbar-expand-lg " style="background-color: white; font-size: 18px;" >
                    <a class="navbar-brand" href="#">
                            <img src="{{ asset('storage/logo.jpg') }}" width="130" height="30" alt="">
                          </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto" style="list-style:none;">
                                    @guest
                                    @else
                        <li class="nav-item active">
                          <a class="nav-link" href="{{url('home')}}" style="font-size:18px">Accueil <span class="sr-only">(current)</span></a>
                        </li>
                        
                        <li class="nav-item">
                        <a class="nav-link" href="{{url('listeUsers')}}" style="font-size:18px">Utilisateurs</a>
                        </li>
                        <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdow8" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:18px">
                                      Types
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="{{url('typeRestaurant')}}">Restaurant</a>
                                      <a class="dropdown-item" href="{{url('typeProduit')}}">Produit</a>
                                      
                                    </div>
                                  </li>
                        
                        <li class="nav-item">

                               <!-- <a class="nav-link" href="{{url('client')}}">Clients</a>-->

                                <a class="nav-link" href="{{url('listeClients')}}" style="font-size:18px">Clients</a>

                              </li>
                              <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdow8" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:18px">
                                            Statistiques
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{url('getpartenaires')}}">Partenaires</a>
                                            <a class="dropdown-item" href="{{url('getdashboard2')}}">Consommateurs</a>
                                            <a class="dropdown-item" href="{{url('getdashboard3')}}">Comportement de consommateur</a>
                                            <a class="dropdown-item" href="{{url('getformnotifsparts')}}">Notifications Partenaires</a>
                                            <a class="dropdown-item" href="{{url('getnotifsclients')}}">Notifications Clients</a>
                                        </div>
                              </li>
                             <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:18px">
                                      Réglages
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="#">Roles</a>
                                      <a class="dropdown-item" href="#">Privilège</a>
                                      <a class="dropdown-item" href="#">Pages</a>
                                      <a class="dropdown-item" href="{{url('pays')}}">Pays</a>
                                      <a class="dropdown-item" href="{{url('ville')}}">Villes</a>
                                    </div>
                                  </li>
                                  <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:18px">
                                      Imprimer
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="{{url('pdf1')}}">La liste des restaurants</a>
                                      <a class="dropdown-item" href="{{url('pdf3')}}">La liste des restaurants de cette semaine</a>
                                      <a class="dropdown-item" href="{{url('pdf2')}}">La liste des restaurants de ce mois</a>
                                     </div> 
                                  </li>
                                  @endguest
                      
                      
                    </ul>
                     
                      @guest

                      <li class="nav-item" >
                          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                      @if (Route::has('register'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                          </li>
                          
                      @endif
                  @else
                  <form class="form-inline my-2 my-lg-0  float-right">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2" type="submit">Search</button>
                      </form>
                      <ul>
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                          </div>
                      </li>
                      </ul>
                  @endguest
                    </div>
                  </nav>




          
        


        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <input type="hidden" value="{{Session::get('success')}}" id="success">
<input type="hidden" value="{{session()->get('warning')}}" id="warning">
<script type="text/javascript">
            var sc = $('#success').val();
	        var wr = $('#warning').val();

	if(sc!="")
			toastr.success(sc);

    if(wr!="")
			toastr.error(wr);
</script>

@yield('style')
@yield('javascript')





</body>
</html>

