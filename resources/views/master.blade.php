<!DOCTYPE html>







<html lang="es">

  <head>

      <meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <meta name="description" content="">

      <meta name="author" content="">

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />




      @section('style')

          <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

          <link rel="stylesheet" href="{{ asset('public/Css/jquery-ui.css') }}" media="screen">    

          <link rel="stylesheet" href="{{ asset('public/Css/bootstrap.min.css') }}" media="screen">    

          <link rel="stylesheet" href="{{ asset('public/Css/sticky-footer.css') }}" media="screen">   

          <link rel="icon" type="image/png" href="{{ asset('public/Img/Icono.png') }}" />

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">

          <!-- Data Table-->

          <link rel="stylesheet" href="{{ asset('public/Css/css_datatable/jquery.dataTables.min.css') }}" media="screen">

          <link rel="stylesheet" href="{{ asset('public/Css/css_datatable/buttons.dataTables.min.css') }}" media="screen">  

          <meta name="csrf-token" content="{{ csrf_token() }}" />

          <script type="text/javascript">
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
          </script>  

              

      @show





      @section('script')

          <!--<script src="{{ asset('public/Js/jquery.js') }}"></script>-->

          <script src="{{ asset('public/Js/js_datatable/jquery-1.12.3.js') }}"></script>

          <script src="{{ asset('public/Js/jquery-ui.js') }}"></script>

          <script src="{{ asset('public/Js/bootstrap.min.js') }}"></script>

          <script src="{{ asset('public/Js/main.js') }}"></script>

          <script src="{{ asset('public/Js/bootstrap-datetimepicker.min.js') }}"></script>

          <script src="{{ asset('public/Js/moment-with-locales.js') }}"></script>

          <script src="{{ asset('public/Js/bootstrap-datetimepicker.js') }}"></script>

          <!-- Data Table-->

          <script src="{{ asset('public/Js/js_datatable/jquery.dataTables.min.js') }}"></script>

          <script src="{{ asset('public/Js/js_datatable/dataTables.buttons.min.js') }}"></script>

          <script src="{{ asset('public/Js/js_datatable/jszip.min.js') }}"></script>

          <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js">

  </script>

          <script src="{{ asset('public/Js/js_datatable/vfs_fonts.js') }}"></script>

          <script src="{{ asset('public/Js/js_datatable/buttons.html5.min.js') }}"></script>                 



          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>



          <style type="text/css">

              .glyphicon-refresh-animate {

                  -animation: spin .7s infinite linear;

                  -webkit-animation: spin2 .7s infinite linear;

              }



              @-webkit-keyframes spin2 {

                  from { -webkit-transform: rotate(0deg);}

                  to { -webkit-transform: rotate(360deg);}

              }

              .imagen-error{

                border-radius:5px;

                border: solid;

                border-color: #b94a48;

                border-width: 1px;

              }

          </style>

          <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/i18n/defaults-*.min.js"></script>-->

      @show



      <title>Módulo Campaña Cultura Ciudadana</title>

  </head>



  <body>

       <!-- Menu Módulo -->

       <div class="navbar navbar-default navbar-fixed-top">

        <div class="container">

          <div class="navbar-header">

            <a href="#" class="navbar-brand">SIM</a>

            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

            </button>

          </div>

          <div class="navbar-collapse collapse" id="navbar-main">

            <ul class="nav navbar-nav">

              

              <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Administración<span class="caret"></span></a>

                <ul class="dropdown-menu" aria-labelledby="themes">

              

                  <li ><a href="#" style="color:#1995dc">GESTIÓN USUARIO</a></li>

                  <li class="divider"></li>



                  @if($_SESSION['Usuario'][1] == 1) 

                      <li class=”{{ Request::is( 'personas') ? 'active' : '' }}”><a href="{{ URL::to( 'personas') }}">Crear usuario</a></li>

                  @endif



                  @if($_SESSION['Usuario'][2] == 1) 

                      <li class=”{{ Request::is( 'asignarLocalidad') ? 'active' : '' }}”><a href="{{ URL::to( 'asignarLocalidad') }}">Asignar Localidad</a></li>

                  @endif



                  @if($_SESSION['Usuario'][7] == 1) 

                  <li class=”{{ Request::is( 'asignarTipoPersona') ? 'active' : '' }}”><a href="{{ URL::to( 'asignarTipoPersona') }}">Asignar Tipo Persona</a></li>

                  @endif

                  

                  @if($_SESSION['Usuario'][8] == 1) 

                  <li class=”{{ Request::is( 'asignarActividades') ? 'active' : '' }}”><a href="{{ URL::to( 'asignarActividades') }}">Asignar Actividades</a></li>

                  @endif

                  

                </ul>

              </li>



              <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Programación<span class="caret"></span></a>

                <ul class="dropdown-menu" aria-labelledby="download">

                  <li><a href="#" style="color:#1995dc">CONFIGURACIÓN ACTIVIDADES</a></li>

                  <li class="divider"></li>



                   @if($_SESSION['Usuario'][3] == 1)  

                      <li class=”{{ Request::is( 'CrearActividad') ? 'active' : '' }}”><a href="{{ URL::to( 'CrearActividad') }}">Registro de actividad</a></li>

                  @endif



                  @if($_SESSION['Usuario'][4] == 1) 

                      <li class=”{{ Request::is( 'MisProgramaciones') ? 'active' : '' }}”><a href="{{ URL::to( 'MisProgramaciones') }}">Mis programaciones</a></li>

                  @endif



                </ul>

              </li>





              <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Aprobación<span class="caret"></span></a>

                <ul class="dropdown-menu" aria-labelledby="download">

                  <li><a href="#" style="color:#1995dc">APROBACIÓN Y MODIFICACIÓN</a></li>

                  <li class="divider"></li>



                 @if($_SESSION['Usuario'][6] == 1) 

                    <li class=”{{ Request::is( 'ActividadesAprobar') ? 'active' : '' }}”><a href="{{ URL::to( 'ActividadesAprobar') }}">Aprobar actividades</a></li>

                 @endif



                </ul>

              </li>



              <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Mis Actividades(Ejecución)<span class="caret"></span></a>

                <ul class="dropdown-menu" aria-labelledby="download">

                  <li><a href="#" style="color:#1995dc">EJECUCIÓN ACTIVIDADES</a></li>

                  <li class="divider"></li>



                  @if($_SESSION['Usuario'][5] == 1) 

                      <li class=”{{ Request::is( 'MisActividades') ? 'active' : '' }}”><a href="{{ URL::to( 'MisActividades') }}">Mis actividades</a></li>

                  @endif

                </ul>

              </li>



              <li class="dropdown">

                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Reporte<span class="caret"></span></a>

                <ul class="dropdown-menu" aria-labelledby="download">

                  <li><a href="#" style="color:#1995dc">REPORTES</a></li>

                  <li class="divider"></li>



                  @if($_SESSION['Usuario'][9] == 1) 

                      <li class=”{{ Request::is( 'Reporte') ? 'active' : '' }}”><a href="{{ URL::to( 'Reporte') }}">Reporte Poblacional</a></li>

                  @endif

                  @if($_SESSION['Usuario'][9] == 1) 

                      <li class=”{{ Request::is( 'Reporte2') ? 'active' : '' }}”><a href="{{ URL::to( 'Reporte2') }}">Reporte Datos Actividad</a></li>

                  @endif

                  @if($_SESSION['Usuario'][9] == 1) 

                      <li class=”{{ Request::is( 'Reporte3') ? 'active' : '' }}”><a href="{{ URL::to( 'Reporte3') }}">Reporte de Actividades</a></li>

                  @endif

                  @if($_SESSION['Usuario'][9] == 1) 

                      <li class=”{{ Request::is( 'Reporte4') ? 'active' : '' }}”><a href="{{ URL::to( 'Reporte4') }}">Reporte de las Ejecuciones</a></li>

                  @endif

                </ul>

              </li>



            </ul>



            <ul class="nav navbar-nav navbar-right" >

              <li><a href="http://www.idrd.gov.co/sitio/idrd/" target="_blank">I.D.R.D</a></li>

              <li class=”{{ Request::is( 'Reporte') ? 'Cerrar' : '' }}”><a href="{{ URL::to( 'Cerrar') }}"  >Cerrar Sesión</a></li>

            </ul>



          </div>

        </div>

      </div>

      <!-- FIN Menu Módulo -->

        

      <!-- Contenedor información módulo -->

      </br></br>

      <div class="container">

          <div class="page-header" id="banner">

            <div class="row">

              <div class="col-lg-8 col-md-7 col-sm-6">

                <h1>MÓDULO CAMPAÑA CULTURA CIUDADANA 

                </h1>

                <p class="lead"><h1>Área de parques</h1></p>

              </div>

              <div class="col-lg-4 col-md-5 col-sm-6">

                 <div align="right"> 

                    <img src="public/Img/IDRD.JPG" width="50%" heigth="40%"/>

                 </div>                    

              </div>

            </div>

          </div>        

      </div>

      <!-- FIN Contenedor información módulo -->



      <!-- Contenedor panel principal -->

      <div class="container">

          @yield('content')



      </div>        

      <!-- FIN Contenedor panel principal -->

  </body>



</html>











