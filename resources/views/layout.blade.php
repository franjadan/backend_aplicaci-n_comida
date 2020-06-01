<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/plug-ins/1.10.20/integration/font-awesome/dataTables.fontAwesome.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4e337af5d8.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="{{ asset('js/refresh_orders.js') }}"></script>
    @yield('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('media/app/favicon//favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('media/app/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('media/app/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('media/app/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('media/app/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title')</title>
</head>
  <body>

    <div class="d-flex" id="wrapper">
      <!-- Sidebar -->
      <div class="sidebar p-4" id="sidebar-wrapper">
        <div class="sidebar-heading text-center">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('media/app/logo.png') }}" alt="" class="logo-app-layout">
            </a>
        </div>
        <div class="list-group list-group-flush mt-5 p-1">
          <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action lead shadow-sm"><i class="fas fa-check-square"></i> Pedidos.</a>
          <a href="{{ route('orders.record') }}" class="list-group-item list-group-item-action lead shadow-sm"><i class="fas fa-clipboard-list"></i> Historial de pedidos.</a>
          @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
            <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action lead shadow-sm"><i class="fas fa-users"></i> Usuarios.</a>
            <a href="{{ route('categories') }}" class="list-group-item list-group-item-action lead shadow-sm"><i class="fas fa-th-list"></i> Categorías.</a>
            <a href="{{ route('allergens') }}" class="list-group-item list-group-item-action lead shadow-sm"><i class="fas fa-exclamation-triangle"></i> Alérgenos.</a>
            <a href="#" class="list-group-item list-group-item-action lead shadow-sm"><i class="fas fa-egg"></i> Ingredientes.</a>
          @endif
            <a href="{{ route('products') }}" class="list-group-item list-group-item-action lead shadow-sm"><i class="fas fa-hamburger"></i> Productos.</a>
          @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
            <a href="{{ route('comments') }}" class="list-group-item list-group-item-action lead shadow-sm"><i class="fas fa-comments"></i> Comentarios.</a>
          @endif
          <a href="{{ route('profile.index') }}" class="list-group-item list-group-item-action lead shadow-sm"><i class="fas fa-id-badge"></i> Perfil.</a>
        </div>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">

          <nav class="navbar navbar-expand-lg navbar-light py-4 shadow-sm">
              <button class="btn my-btn-primary" id="menu-toggle"><i class="fas fa-bars"></i></button>

              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                  <li class="nav-item">
                      <a class="btn my-btn-other py-2 px-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión <i class="fas fa-sign-out-alt"></i>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: one;">
                          {{ csrf_field() }}
                      </form>
                  </li>
              </ul>
              </div>
          </nav>

          <div class="container-fluid p-5">
              @include('shared._flash-message')
              @yield('content')
          </div>
      </div>
    <!-- /#page-content-wrapper -->
    </div>

  </body>
  <script type="application/javascript">
      $('input[type="file"]').change(function(e){
          var fileName = e.target.files[0].name;
          $('.custom-file-label').html(fileName);
      });

      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggle();
      });
  </script>
  @yield('analytics')
  @yield('datatable')
</html>
