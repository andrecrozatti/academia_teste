<?php
  if (isset($_POST['enviado']))
  {
    
    require_once('./funcoes_admin.php');

    require_once('./conexao.php');

    list($check, $data) = check_login($dbc, $_POST['inputEmail'], $_POST['inputPassword']);
    
    if ($check)
    // LOGIN COM SUCESSO
    {
      session_start();
      $_SESSION['cod_adm'] = $data['cod_adm'];
      $_SESSION['nome'] = $data['nome'];
     
      $url = absolute_url('menu_adm.php');
      header("Location: $url");
      exit();
    }
    else
    // LOGIN SEM SUCESSO
    {
      $erros = $data;
    }

    if (!empty($erros))
    {
      $saida = '<h2>ERROR!!!</h2>';
      foreach ($erros as $msg)
      {
        $saida .= "- $msg </br>";
      }
      $saida .= '<p>Por Favor, tente Novamente seu animal.</p>';
    }

  } 

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>top Fit - Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link href="../dist/css/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../styles/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" action="login_admin.php" method="post">
  <img class="mb-4" src="../img/logo.png" alt="" width="200" height="200">
  <h1 class="h3 mb-3 font-weight-normal">Login Administrador</h1>
  <?php
      if (isset($saida)) echo "<div class='alert alert-danger'>$saida</div>";
  ?>
  <!-- <label for="inputEmail" class="sr-only">Endereço Email</label> -->
  <input type="email" name="inputEmail" class="form-control" placeholder="Endereço de Email"  autofocus>
  <!-- <label for="inputPassword" class="sr-only">Senha</label> -->
  <input type="password" name="inputPassword" class="form-control" placeholder="Senha" >
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Lembre-me
    </label>
  </div>
  <div>
    Ou <a href="./usuario_cad.php">Registre-se</a>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
  <input type="hidden" value="True" name="enviado" />
</form>
</body>
</html>
