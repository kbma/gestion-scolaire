<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <link href="{{ URL::asset('css/Cerulean_bootstrap.css') }}" rel="stylesheet">
    <!--  <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">-->
    <link href="{{ URL::asset('css/my.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else

                                <!------------Paramètres---------------->
                            <li   ><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Paramètres  <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href=""  > Paramètres entreprise </a>
                                        <a href="{{route('ShowForm')}}"  > Catégorie de formation </a>
                                        <a href="{{route('ShowCatPres')}}"  > Catégorie de prestataire </a>
                                        <a href="{{route('ShowModeForma')}}"  > Mode de formation </a>
                                        <a href="{{route('ShowModePayement')}}"  > Mode de payement </a>
                                        <!--<a href=""  > Diplome  </a>-->
                                        <!--<a href="#"  > Theme  </a>-->
                                    </li>
                                </ul>

                            </li>


                                <!------------Formations---------------->
                            <li><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Formations  <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                      <!--  <a href="{{route('ShowForm')}}"  > Catégorie  </a>-->
                                        <a href="{{route('ShowDiplome')}}"  > Gerer les formations </a>
                                        <a href="{{route('ShowSession')}}"  > Gerer les sessions </a>
                                        <a href="{{route('ShowGroupe')}}"  > Gerer les groupes </a>

                                    </li>
                                </ul>

                            </li>


                                <!------------Etudiants---------------->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Clients <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{route('AddStudent')}}"  > Ajouter etudiant  </a>
                                        <a href="{{route('ShowStudent')}}"  > Lister les étudiants </a>
                                    </li>
                                    <li role="presentation" class="divider"></li>
                                    <li>
                                        <a href="{{route('AddCompany')}}"  > Ajouter  societé </a>
                                        <a href="{{route('ShowCompany')}}"  > Lister les sociétés </a>
                                    </li>
                                </ul>
                            </li>

                            <!------------Prestataire---------------->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Prestataire <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{route('AddPres')}}"  > Ajouter préstataire  </a>
                                        <a href="{{route('ShowPres')}}"  > Lister les préstataires</a>

                                    </li>
                                </ul>
                            </li>

                            <!------------Inscription---------------->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Inscription <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{route('AddRegister')}}"  > Nouvelle inscription  </a>
                                        <a href="{{route('ShowRegister')}}"  > Liser les inscriptions  </a>

                                    </li>
                                </ul>
                            </li>
                                <!------------Payement---------------->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Payements <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{route('AddRecette')}}"  >Recettes</a>
                                        <a href="{{route('AddDepence')}}"  >Dépences</a>
                                    </li>
                                    <li role="presentation" class="divider"></li>
                                    <li>

                                        <a href="{{route('ShowRecettesDepences')}}"  >Tableau Recettes/Depences</a>

                                    </li>
                                </ul>
                            </li>



                            <!----Etats--------->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Etats <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href=""> Par Groupe</a>


                                    </li>
                                </ul>
                            </li>
                            <!---------------->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ URL::asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/my.js') }}"></script>
   

</body>
</html>
