<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <script src="{{asset('/vendor/jquery/jquery.min.js') }}"
                        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('fullcalendar/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/UIjs/themes/base/jquery-ui.css') }}">
        
    <link rel='stylesheet' href="{{asset('vendor/sweetalert2/css/sweetalert2.min.css') }}"></link>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   

       
    <!-- Font Awesome -->
   

    <link rel="stylesheet"
        href="{{asset('/vendor/bootstrap4-toggle-master/css/bootstrap4-toggle.min.css') }}"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{asset('/vendor/AdminLTE/dist/css/adminlte.min.css') }}"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('/vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}"
        crossorigin="anonymous"/>

    <link rel="stylesheet" href="{{ asset('/vendor/select2-develop/dist/css/select2.min.css') }}"
        crossorigin="anonymous"/>

    <link rel="stylesheet"
        href="{{ asset('/vendor/bootstrap-datetimepicker/dist/css/bootstrap-datetimepicker.min.css') }}"
        crossorigin="anonymous"/>


 

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/form-steps.css')}}" rel="stylesheet">
    <link href="{{asset('css/factures.css')}}" rel="stylesheet">
    <link href="{{asset('bootstrap-fileinput/css/fileinput.min.css')}}" rel="stylesheet">

    <style>
        .hidden {
            display: none;
        }

        .dashed-line {
            border: 2px dashed grey;
        }
    </style>

    @stack('third_party_stylesheets')

    @stack('page_css')
</head>
<script>
    function prochaineVidange (dateVidange){
    tdateV=dateVidange.split('-');
    var lastDay =new Date(tdateV[2]+'-'+tdateV[1]+'-'+tdateV[0]) ;
    lastDay.setDate(lastDay.getDate() + 15);

    if(lastDay.getDay()==0)
        lastDay.setDate(lastDay.getDate() + 1);
 
        console.log(lastDay.getDate());

    var dd = lastDay.getDate();
    var mm = lastDay.getMonth()+1; //As January is 0.
    var yyyy = lastDay.getFullYear();
    if(dd<10) dd='0'+dd;
    if(mm<10) mm='0'+mm;
    return (dd+'-'+mm+'-'+yyyy);
};
</script>
<body class="hold-transition sidebar-mini layout-fixed">
@include('layouts.functions')
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('images/logo_bk_zed.png')}}"
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{asset('images/logo_bk_zed.png')}}"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }} 
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ route('password.my_edit') }}" class="btn btn-default btn-flat">Changer Mot de Passe</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0.1
        </div>
        <strong>Copyright &copy; BK Zed</a>.</strong> Tous droits resévés
    </footer>
</div>
<div id="dialog_conducteur" style="display: none;">
        <div>
            <iframe id="frame" width="1000" height="800">

            <div class="row">
                    
                </div>
            </iframe>
        </div>
    </div>               


<script src="{{ asset('/vendor/moment.js/js/moment.min.js') }}"  ></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{ asset('vendor/bootstrap-datetimepicker/dist/js/bootstrap-datetimepicker.min.js') }}"
        crossorigin="anonymous"></script>

<script src="{{ asset('/vendor/bootstrap4-toggle-master/js/bootstrap4-toggle.min.js') }}"></script>

<script src="{{ asset('/vendor/select2-develop/dist/js/select2.min.js') }}"
        crossorigin="anonymous"></script>
<script src="{{asset('/vendor/bootstrap-4.5.3/js/bootstrap.min.js') }}"
        integrity=""
        crossorigin="anonymous"></script><!--1-->

<script type="text/javascript" src="{{asset('/vendor/UIjs/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{asset('/vendor/UIjs/jquery.ui.datepicker-fr.js') }}"></script>                 
                       
<script type="text/javascript" src="{{ asset('fullcalendar/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('fullcalendar/locales-all.js') }}"></script>
<script src="{{ asset('/vendor/AdminLTE/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/vendor/popper/js/popper.min.js') }}"></script>


<script src="{{asset('js/request.js')}}"></script>
<script src="{{asset('js/form-steps.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>

<script src="{{asset('js/numbers/jquerySpellingNumber.js')}}"></script>

<script src="{{asset('bootstrap-fileinput/js/fileinput.min.js')}}"></script>
<script src="{{asset('bootstrap-fileinput/js/locales/fr.js')}}"></script>

    
<script>
    // CommonJS
    //const Swal = require('sweetalert2')
    function visualiser_conduteur(title,id){
       
       console.log(id);
       chemin="{{ route('conducteurs.show','id') }}";
       chemin=chemin.replace("id", id);
       console.log(chemin);
      
      $("#dialog_conducteur").dialog({
           height: 600,
        width: 1000,
        modal: true,
        title:title,
        position: { my: 'top', at: 'top+150' },
      }
         
      );
    
        $("#frame").attr("src",chemin);   
    
          
 }
</script>

@stack('third_party_scripts')

@stack('page_scripts')
</body>
</html>
<?php
//$res=json_decode($listeUrl , true);




?>