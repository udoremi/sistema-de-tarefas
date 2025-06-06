<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title')</title>

  <!-- Fonte do Google -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <!-- CSS da aplicação -->
  <link rel="stylesheet" href="/css/styles.css">
  <script src="/js/scripts.js"></script>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand text-dark fw-bold" href="/">
          <img src="/img/Logo.png" alt="TaskFlow">
        </a>

        <div class="collapse navbar-collapse" id="navbarNavCentered">
          <ul class="navbar-nav mx-auto">
            @auth
            <!-- Usuário está logado -->
            <li class="nav-item">
              <a class="links-nav" href="{{ url('/dashboard') }}">Tarefas</a>
            </li>
            <li class="nav-item">
              <a class="links-nav" href="{{ url('/tasks/create') }}">Criar Tarefas</a>
            </li>
            @elseguest
            <!-- Usuário NÃO está logado -->
            <li class="nav-item">
              <a class="links-nav" href="{{ url('/') }}">Tarefas</a>
            </li>
            <li class="nav-item">
              <a class="links-nav" href="{{ url('/') }}">Criar Tarefas</a>
            </li>
            @endguest
          </ul>
          @auth
          <form action="logout" method="POST">
            @csrf
            <a href="/logout" class="btn btn-sair" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
          </form>
          @endauth

          @guest
          <div class="d-flex ms-auto opc-login"> <a class="btn btn-link links-nav" href="/login">Entrar</a>
            <button class="btn btn-cadastro" type="button"><a href="/register">Cadastrar</a></button>
          </div>
          @endguest
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="container-fluid">
      <div class="row">
        @if(session('msg'))
        <p class="msg">{{ session('msg') }}</p>
        @endif
        @yield('content')
      </div>
    </div>
  </main>
  <script src="/js/script.js"></script>
  <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>

</html>