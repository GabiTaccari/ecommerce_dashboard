<!DOCTYPE html>
<html lang="pt-br">

<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: -webkit-box;
      display: flex;
      -ms-flex-align: center;
      -ms-flex-pack: center;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    .form-signin .checkbox {
      font-weight: 400;
    }
    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
</head>

<body class="text-center">

  <form class="form-signin">
    <img class="mb-4" src="<?php base_url() ?>public/assets/img/logo-fam-horizontal.png" alt="" width="150" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Faça Login</h1>
    <label for="login" class="sr-only">Email</label>
    <input type="hidden" id="teste" class="form-control" placeholder="teste" required="" autofocus=""><br>
    <input type="email" id="login" class="form-control" placeholder="Email" required="" autofocus=""><br>
    <label for="senha" class="sr-only">Senha</label>
    <input type="password" id="senha" class="form-control" placeholder="Senha" required="">
    
    <button class="btn btn-lg btn-primary btn-block" type="button" onclick="realizaLogin()">Entrar</button>
  </form>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php base_url(); ?>public/assets/js/login.js"></script>
<script src="<?php base_url(); ?>public/assets/js/util.js"></script>

</body>
</html>