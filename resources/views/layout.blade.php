<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/plug-ins/1.10.20/integration/font-awesome/dataTables.fontAwesome.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4e337af5d8.js" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    @yield('scripts')

    <title>@yield('title')</title>
</head>
<body>
    <div class="section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse d-flex justify-content-between p-3">
              <a class="navbar-brand" href="{{ url('/') }}">Menu of the day</a>
              <div>
                <a href="nav-link" class="btn btn-outline-secondary">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
              </div>
            </div>
        </nav>
        <div class="d-flex" id="wrapper">
            <div class="bg-light pt-4" id="sidebar-wrapper">
              <div class="list-group list-group-flush">
                <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action bg-light"><i class="fas fa-check-square"></i> Pedidos</a>
                <a href="{{ route('categories') }}" class="list-group-item list-group-item-action bg-light"><i class="fas fa-th-list"></i> Categorías</a>
                <a href="{{ route('products') }}" class="list-group-item list-group-item-action bg-light"><i class="fas fa-hamburger"></i> Productos</a>
                <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-egg"></i> Ingredientes</a>
                <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-exclamation-triangle"></i> Alérgenos</a>
                <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users"></i> Usuarios</a>
                <a href="{{ route('comments') }}" class="list-group-item list-group-item-action bg-light"><i class="fas fa-comments"></i> Comentarios</a>
                <a href="{{ route('orders.record') }}" class="list-group-item list-group-item-action bg-light"><i class="fas fa-clipboard-list"></i> Historial de pedidos</a>
                <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-id-badge"></i> Perfil</a>
              </div>
            </div>
            <div id="page-content-wrapper">
              <div class="container mt-5 mb-5">
                @include('shared._flash-message')

                @yield('content')
            </div>
          </div>
    </div>
</body>
@yield('datatable')
</html>
