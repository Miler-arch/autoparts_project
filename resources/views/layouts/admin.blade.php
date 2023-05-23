<!DOCTYPE html>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <!-- plugins:css -->
  {!! Html::style('melody/vendors/iconfonts/font-awesome/css/all.min.css') !!}
  {!! Html::style('melody/vendors/css/vendor.bundle.base.css') !!}
  {!! Html::style('melody/vendors/css/vendor.bundle.addons.css') !!}
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  {!! Html::style('melody/css/style.css') !!}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Chivo:ital,wght@0,200;0,900;1,800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
  <link rel="shortcut icon" href="./image/icono.png" type="image/x-icon"> 
  @yield('styles')
  <!-- endinject -->
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="/">
          {{-- <img src="images/logo.svg" alt="logo"/> --}}
          <span><b>Planeta</b>Camión</span>
        </a>
        <a class="navbar-brand brand-logo-mini" href="/">
          <span><b>P.</b>C.</span>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars text-white"></span>
        </button>
        {{-- <ul class="navbar-nav">
          <li class="nav-item nav-search d-none d-md-flex">
            <div class="nav-link">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search">
              </div>
            </div>
          </li>
        </ul> --}}
        <ul class="navbar-nav navbar-nav-right">

            @yield('create')

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{asset('image/perfil.png')}}" alt="profile" style="width:50px"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              {{-- <a class="dropdown-item">
                <i class="fas fa-cog text-primary"></i>
                Settings
              </a> --}}
              <div class="dropdown-divider"></div>
              {{-- <a class="dropdown-item">
                <i class="fas fa-power-off text-primary"></i>
                Logout
              </a> --}}

              <a class="dropdown-item" href="{{ route('logout') }}"              
                onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off text-primary"></i>
                {{ __('Cerrar Sesión') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>

              
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="fas fa-bars text-white"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @yield('preferences')
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @include('layouts._nav')
      <!-- partial -->
      <div class="main-panel">
          @yield('content')
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Ecomsoft Desarrollo de Software.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      $(document).ready(function() {

          $('#detalle').DataTable({

              "order": [
                  [1, 'asc']
              ],
              "lengthMenu": [
                  [5, 10, 50, -1],
                  [5, 10, 50, "Todo"]
              ],
              "language": {
                  "lengthMenu": "Mostrar _MENU_ registros por página",
                  "zeroRecords": "Ningun registro encontrado",
                  "info": "Mostrando la página _PAGE_ de _PAGES_",
                  "infoEmpty": "",
                  "infoFiltered": "(filtrado de _MAX_ registros totales)",
                  'search': 'Buscar:',
                  'paginate': {
                      'next': 'Siguiente',
                      'previous': 'Anterior'
                  }

              },
          });

      });
  </script>
  <!-- plugins:js -->
  {!! Html::script('melody/vendors/js/vendor.bundle.base.js') !!}
  {!! Html::script('melody/vendors/js/vendor.bundle.addons.js') !!}
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  {!! Html::script('melody/js/off-canvas.js') !!}
  {!! Html::script('melody/js/hoverable-collapse.js') !!}
  {!! Html::script('melody/js/misc.js') !!}
  {!! Html::script('melody/js/settings.js') !!}
  {!! Html::script('melody/js/todolist.js') !!}
  
  <!-- endinject -->
  <!-- Custom js for this page-->
  {!! Html::script('melody/js/dashboard.js') !!}
  <!-- End custom js for this page-->


  @yield('scripts')

</body>


</html>
