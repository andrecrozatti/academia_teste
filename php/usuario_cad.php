<?php
    $titulo = 'Top Fit - Cadastro de Alunos';
    

    if (isset($_POST['enviou'])) {
        require_once('./conexao.php');

        $erros = array();
        //Verifica se há um nome completo
        if (empty($_POST['nome'])) {
            $erros[] = "Você esqueceu de digitar o seu primeiro nome.";
        } else {
            $n = mysqli_real_escape_string($dbc, trim($_POST['nome']));
        }

        //Verifica se há cpf
        if (empty($_POST['cpf'])) {
            $erros[] = "Você esqueceu de digitar o seu último nome.";
        } else {
            $cpf = mysqli_real_escape_string($dbc, trim($_POST['cpf']));
        }

        //Verifica se há um endereco
        if (empty($_POST['endereco'])) {
            $erros[] = "Você esqueceu de digitar o seu endereço.";
        } else {
            $end = mysqli_real_escape_string($dbc, trim($_POST['endereco']));
        }

        //Verifica se há um numero
        if (empty($_POST['numero'])) {
            $erros[] = "Você esqueceu de digitar o seu numero de endereco.";
        } else {
            $num = mysqli_real_escape_string($dbc, trim($_POST['numero']));
        }
        //Verifica se há um peso
        if (empty($_POST['peso'])) {
            $erros[] = "Você esqueceu de digitar o seu peso.";
        } else {
            $peso = mysqli_real_escape_string($dbc, trim($_POST['peso']));
        }
        //Verifica se há uma altura
        if (empty($_POST['altura'])) {
            $erros[] = "Você esqueceu de digitar o seu altura.";
        } else {
            $a = mysqli_real_escape_string($dbc, trim($_POST['altura']));
        }
        //Verifica se há uma data de nascimento
        if (empty($_POST['data_nasc'])) {
            $erros[] = "Você esqueceu de digitar o sua data nascimento.";
        } else {
            $dat = mysqli_real_escape_string($dbc, trim($_POST['data_nasc']));
        }
        //Verifica se há um email
        if (empty($_POST['email'])) {
            $erros[] = "Você esqueceu de digitar o seu email.";
        } else {
            $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
        }

        //Verifica se há um tefone
        if (empty($_POST['tel'])) {
            $erros[] = "Você esqueceu de digitar o seu telefone.";
        } else {
            $t = mysqli_real_escape_string($dbc, trim($_POST['tel']));
        }

        //Verifica se há uma senha e testa a confirmação
        if (!empty($_POST['senha'])) {
            if ($_POST['senha'] != $_POST['senha2']) {
                $erros[] = "Sua senha não corresponde a confirmação.";
            } else {
                $p = mysqli_real_escape_string($dbc, trim($_POST['senha']));
            }
        } else {
            $erros[] = "Você esqueceu de digitar a sua senha.";
        }

        if (empty($erros)) {
            $q = "INSERT INTO alunos 
                    (nome, cpf, endereco, numero, peso, altura, data_nasc, email, tel, senha)
                VALUES
                    ('$n', '$cpf', '$end', '$num', $peso, $a, '$dat','$e', '$t', SHA1('DWEB2.$p'))";
            $r = mysqli_query($dbc, $q);
           
            if ($r) {
                $sucesso = "<h2><b>Sucesso!</b></h2>
                           <p>Seu registro foi incluído com sucesso</p>
                           <p>Aguarde... Redirecionando</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='3;URL=login_user.php'>";
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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricula</title>
    
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
        <h1 class="h2">Cadastre-se e tenha acesso a conteudos exclusivos</h1>

        <form method="post" action="usuario_cad.php">

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
        <label>Digite seu nome completo</label>
        <input type="text"
            name="nome"
            maxlength="20"
            class="form-control"
            placeholder="Nome completo"
            value="<?php if (isset($_POST['nome'])) echo $_POST['nome']; ?>" />
        </div>

        <div class="form-group col-md-3">
        <label>Digite seu CPF</label>
        <input type="text"
            name="cpf"
            maxlength="40"
            class="form-control"
            placeholder="CPF"
            value="<?php if (isset($_POST['cpf'])) echo $_POST['cpf']; ?>" />
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label>Endereço</label>
            <input type="text"
            name="endereco"
            maxlength="80"
            class="form-control"
            placeholder="Digite seu endereço"
            value="<?php if (isset($_POST['endereco'])) echo $_POST['endereco']; ?>" />
        </div>
        <div class='form-group col-md-3'>
            <label>Numero</label>
            <input type="text" 
            name="numero" class="form-control" placeholder="N°" value="<?php if (isset($_POST['numero'])) echo $_POST['numero']; ?>">
        </div>
        <div class='form-group col-md-3'>
            <label>Complemento</label>
            <input type="text" 
            name="complemento" class="form-control" placeholder="Bloco/Quadra" value="">
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-md-2">
            <label>Peso</label>
            <input type="number" name="peso" class="form-control" value="<?php if (isset($_POST['peso'])) echo $_POST['peso']; ?>" placeholder="Digite seu peso">
        </div>
        <div class="form-group col-md-2">
            <label >Altura</label>
            <input type="text" name="altura" class="form-control" value="<?php if (isset($_POST['altura'])) echo $_POST['altura']; ?>" placeholder="Digite sua altura">
        </div>
        <div class="form-group col-md-2">
            <label >Data de Nascimento</label>
            <input type="date" name="data_nasc" value="<?php if (isset($_POST['data_nasc'])) echo $_POST['data_nasc']; ?>" class="form-control" >
        </div>
        <div class="form-group col-md-2">
            <label>Telefone</label>
            <input type="tel" name="tel" value="<?php if (isset($_POST['tel'])) echo $_POST['tel']; ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Digite sua email">
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-md-6">
        <label>Senha</label>
        <input type="password"
            name="senha"
            maxlength="10"
            class="form-control"
            placeholder="Digite a senha"  />
        </div>

        <div class="form-group col-md-6">
        <label>Confirmação de Senha</label>
        <input type="password"
            name="senha2"
            maxlength="10"
            class="form-control"
            placeholder="Confirme a Senha" />
        </div>
    </div>
    <input type="hidden" name="enviou" value="Sim" />
    <div id="acoes" align="right">
            <a href="usuario_menu.php" class="btn btn-secondary">Fechar sem Salvar</a>
            <input type="submit" class="btn btn-primary" value="Salvar" />
        </div>
    </form>

</main>
</body>
</html>


