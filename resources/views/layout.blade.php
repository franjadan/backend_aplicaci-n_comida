<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4e337af5d8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title')</title>
</head>
<body>
    <div class="section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse d-flex justify-content-between p-3">
              <a class="navbar-brand" href="#">Menu of the day</a>
              <div>
                <a href="nav-link" class="btn btn-outline-secondary">Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
              </div>
            </div>
        </nav>
        <div class="d-flex" id="wrapper">
            <div class="bg-light pt-4" id="sidebar-wrapper">
              <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-check-square"></i> Pedidos</a>
                <a href="{{ route('categories') }}" class="list-group-item list-group-item-action bg-light"><i class="fas fa-th-list"></i> Categorías</a>
                <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-hamburger"></i> Productos</a>
                <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-egg"></i> Ingredientes</a>
                <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-exclamation-triangle"></i> Alérgenos</a>
                <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users"></i> Usuarios</a>
                <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-comments"></i> Comentarios</a>
                <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-clipboard-list"></i> Historial de pedidos</a>
                <a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-id-badge"></i> Perfil</a>
              </div>
            </div>
            <div id="page-content-wrapper">
              <div class="container mt-5">
                @yield('content')
            </div>
          </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
