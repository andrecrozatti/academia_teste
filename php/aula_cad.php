<?php
    $titulo = 'Top Fit - Cadastro de aulas';
    include_once('./menulateral_adm.php');
    include_once('./cabecalho_adm.php');
  
    

    if (isset($_POST['enviou'])) {
        require_once('./conexao.php');

        $erros = array();
        //Verifica se há um nome de aula
        if (empty($_POST['nome_aula'])) {
            $erros[] = "Você esqueceu de digitar o seu primeiro nome.";
        } else {
            $n = mysqli_real_escape_string($dbc, trim($_POST['nome_aula']));
        }

        //Verifica se há hora
        if (empty($_POST['hora'])) {
            $erros[] = "Você esqueceu de digitar o seu último nome.";
        } else {
            $hora = mysqli_real_escape_string($dbc, trim($_POST['hora']));
        }

        //Verifica se há um duracao
        if (empty($_POST['duracao'])) {
            $erros[] = "Você esqueceu de digitar a duracao .";
        } else {
            $dur = mysqli_real_escape_string($dbc, trim($_POST['duracao']));
        }

        //Verifica se há um professor
        if (empty($_POST['professor'])) {
            $erros[] = "Você esqueceu de digitar o seu professor.";
        } else {
            $prof = mysqli_real_escape_string($dbc, trim($_POST['professor']));
        }
        //Verifica se há um semana
        if (empty($_POST['semana'])) {
            $erros[] = "Você esqueceu de digitar o seu semana.";
        } else {
            $semana = mysqli_real_escape_string($dbc, trim($_POST['semana']));
        }
        

        if (empty($erros)) {
            $q = "INSERT INTO aulas 
                    (nome_aula, hora, duracao, cod_prof, semana)
                VALUES
                    ('$n', '$hora', '$dur', '$prof', '$semana')";
            $r = mysqli_query($dbc, $q);
            echo"$q";
            if ($r) {
                $sucesso = "<h2><b>Sucesso!</b></h2>
                           <p>Seu registro foi incluído com sucesso</p>
                           <p>Aguarde... Redirecionando</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='3;URL=menu_adm.php'>";
            } else {
                
                $erro = "<h2><b>Erro!</b></h2>
                        <p>Você não pode ser registrado devido a um erro no sistema.
                        Pedimos desculpas por qualquer incoveniente.</p>";}
          
        } else {

        $erro = "<h2><b>Erro!</b></h2>
                <p>Ocorreram o(s) seguinte(s) erro(s): <br />";
        foreach ($erros as $msg) {
            $erro .= "- $msg <br />";
        }
        $erro .= "</p><p>Por favor, tente novamente.</p>";
        }
    }

    //tabela de professores
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/pricing/">

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

</head>
<body>
<main role="main" class="col-md-9 m-sm-auto  col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastro de uma Aula</h1>

        <form method="post" action="aula_cad.php">

        <!-- <div id="acoes" align="right">
            <a href="usuario_menu.php" class="btn btn-secondary">Fechar sem Salvar</a>
            <input type="submit" class="btn btn-primary" value="Salvar" />
        </div> -->
    </div>

    <?php
        if (isset($erro)) echo "<div class='alert alert-danger'>$erro</div>";
        if (isset($sucesso)) echo "<div class='alert alert-success'>$sucesso</div>";
    ?>

    <div class="row">
        <div class="form-group col-md-8">
        <label>Digite o nome da aula </label>
        <input type="text"
            name="nome_aula"
            maxlength="20"
            class="form-control"
            placeholder="Nome da aula"
            value="<?php if (isset($_POST['nome_aula'])) echo $_POST['nome_aula']; ?>" />
        </div>

        <div class="form-group col-md-2">
        <label>Hora</label>
        <input type="time"
            name="hora"
            class="form-control"
            value="<?php if (isset($_POST['hora'])) echo $_POST['hora']; ?>" />
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-2">
            <label>Duração</label>
            <input type="time"
            name="duracao"
            class="form-control"
            value="<?php if (isset($_POST['duracao'])) echo $_POST['duracao']; ?>" />
        </div>
        <div class='form-group col-md-3'>
            <label>Professor</label>
            <select name="professor" id="" class="form-control">
                <option value="1">Cleiton</option>
                <option value="2">Vagner</option>
                <option value="4">Ronaldo de Souza</option>
            </select>
        </div>
        <div class='form-group col-md-3'>
            <label>Dia Semana</label>
            <select name="semana" id="" class="form-control">
                <option>Segunda</option>
                <option>Terça</option>
                <option>Quarta</option>
                <option>Quinta</option>
                <option>Sexta</option>
                <option>Sabado</option>
            </select>
        </div>
    </div>
    </div>
    <input type="hidden" name="enviou" value="Sim" />
    <div id="acoes" align="right">
            <a href="aula_menu.php" class="btn btn-secondary">Fechar sem Salvar</a>
            <input type="submit" class="btn btn-primary" value="Salvar" />
        </div>
    </form>

</main>
</body>
</html>


