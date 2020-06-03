<?php

//ATENÇÃO: esse arquivo é diferente do "usuario_cad" em certos pontos


    $titulo = 'Alteração no cadastro';

    include_once('./cabecalho_user.php');
    include_once('./menulateral_user.php');
    include_once('./conexao.php');
    
    // if ((isset($_GET['cod'])) && (is_numeric($_GET['cod'])))
    // {
    //     $id = $_GET['cod'];
    // }
    // //Após form ser enviado, trabalha-se com POST ao invés de GET
    // else if ((isset($_POST['cod'])) && (is_numeric($_POST['cod'])))
    // {
    //     $id = $_POST['cod'];
    // }else
    // {
    //     header("Location: menu_user.php");
    //     exit();
    // }
        
    
    require_once('./conexao.php');

    if (isset($_POST['enviou'])) {
        
        $erros = array();
        //Verifica se há um nome
        if (empty($_POST['nome'])) {
            $erros[] = "Você esqueceu de digitar o seu nome.";
        } else {
            $n = mysqli_real_escape_string($dbc, trim($_POST['nome']));
        }

        //Verifica se há uma data de nascimento
        if (empty($_POST['data_nasc'])) {
            $erros[] = "Você esqueceu de digitar o sua data de nascimento.";
        } else {
            $dat = mysqli_real_escape_string($dbc, trim($_POST['data_nasc']));
        }

        //Verifica se há um cpf
        if (empty($_POST['cpf'])) {
            $erros[] = "Você esqueceu de digitar o seu cpf.";
        } else {
            $cpf = mysqli_real_escape_string($dbc, trim($_POST['cpf']));
        }
        //Verifica se há um peso
        if (empty($_POST['peso'])) {
            $erros[] = "Você esqueceu de digitar o seu peso.";
        } else {
            $p = mysqli_real_escape_string($dbc, trim($_POST['peso']));
        }
        //Verifica se há um endereco
        if (empty($_POST['endereco'])) {
            $erros[] = "Você esqueceu de digitar o seu endereco.";
        } else {
            $end = mysqli_real_escape_string($dbc, trim($_POST['endereco']));
        }
        //Verifica se há um numero
        if (empty($_POST['numero'])) {
            $erros[] = "Você esqueceu de digitar o seu numero.";
        } else {
            $num = mysqli_real_escape_string($dbc, trim($_POST['numero']));
        }
        //Verifica se há um telefone
        if (empty($_POST['tel'])) {
            $erros[] = "Você esqueceu de digitar o seu telefone.";
        } else {
            $tel = mysqli_real_escape_string($dbc, trim($_POST['tel']));
        }
        //Verifica se há um altura
        if (empty($_POST['altura'])) {
            $erros[] = "Você esqueceu de digitar o seu altura.";
        } else {
            $alt = mysqli_real_escape_string($dbc, trim($_POST['altura']));
        }
        //Verifica se há um email
        if (empty($_POST['email'])) {
            $erros[] = "Você esqueceu de digitar o seu email.";
        } else {
            $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
        }
        //Verifica se há uma senha e testa a confirmação
        if (!empty($_POST['senha'])) {
            if ($_POST['senha'] != $_POST['senha2']) {
                $erros[] = "Sua senha não corresponde a confirmação.";
            } else {
                $s = mysqli_real_escape_string($dbc, trim($_POST['senha']));
            }
        } else {
            $erros[] = "Você esqueceu de digitar a sua senha.";
        }

        if (empty($erros)) {
            $q = "UPDATE alunos SET
                    nome ='$n', 
                    data_nasc='$dat', 
                    cpf='$cpf', 
                    peso='$p',
                    endereco='$end',
                    numero='$num',
                    tel='$tel',
                    senha=SHA1('DWEB2.$s'),
                    altura='$alt',
                    email='$email'
                WHERE cod = " . $_SESSION['cod'] ;
            
            $r = mysqli_query($dbc, $q);

            if ($r) {
                $sucesso = "<h2><b>Sucesso!</b></h2>
                           <p>Seu registro foi incluído com sucesso</p>
                           <p>Aguarde... Redirecionando</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='3;URL=menu_user.php'>";
            } else {
                $erro = "<h2><b>Erro!</b></h2>
                        <p>$q Você não pode ser registrado devido a um erro no sistema.
                        Pedimos desculpas por qualquer incoveniente.</p>";
            }
        } else {

        $erro = "<h2><b>Erro!</b></h2>
                <p>Ocorreram o(s) seguinte(s) erro(s): <br />";
        foreach ($erros as $msg) {
            $erro .= "- $msg <br />";
        }
        $erro .= "</p><p>Por favor, tente novamente.</p>";
        }
    }
    
    //Pesquisa para exibir o registro por alteração
    $q = "SELECT * FROM alunos WHERE cod = " . $_SESSION['cod'];
    $r = @mysqli_query($dbc,$q);
    echo $q;
    //if (mysqli_num_rows($r) == 1)
    //Esse if fecha na linha q vem antes das ultimas 4 linhas desse documento
    { 
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
    
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" >
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Alteração - Usuário</h1>

        <form method="post" action="usuario_alt.php">

        <div id="acoes" align="right">
            <a href="menu_user.php" class="btn btn-secondary">Fechar sem Salvar</a>
            <input type="submit" class="btn btn-warning" value="Alterar" />
        </div>
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
            value="<?php echo $row['nome'];?>" />
        </div>
        
        <div class="form-group col-md-3">
        <label>Digite seu CPF</label>
        <input type="text"
            name="cpf"
            maxlength="40"
            class="form-control"
            placeholder="CPF"
            value="<?php echo $row['cpf'];?>" />
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
            value="<?php echo $row['endereco'];?>" />
        </div>
        <div class='form-group col-md-3'>
            <label>Numero</label>
            <input type="text" 
            name="numero" class="form-control" placeholder="N°" value="<?php echo $row['numero'];?>">
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
            <input type="number" name="peso" class="form-control" value="<?php echo $row['peso'];?>" placeholder="Digite seu peso">
        </div>
        <div class="form-group col-md-2">
            <label >Altura</label>
            <input type="text" name="altura" class="form-control" value="<?php echo $row['altura'];?>" placeholder="Digite sua altura">
        </div>
        <div class="form-group col-md-2">
            <label >Data de Nascimento</label>
            <input type="date" name="data_nasc" value="<?php echo $row['data_nasc'];?>" class="form-control" >
        </div>
        <div class="form-group col-md-2">
            <label>Telefone</label>
            <input type="tel" name="tel" value="<?php echo $row['tel'];?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" value="<?php echo $row['email'];?>" placeholder="Digite sua email">
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
    </div>
    <input type="hidden" name="enviou" value="Sim" />
    <input type="hidden" name="cod" value="<?=$row[0]; ?>" />
    </form>

</main>
<?php
     }
    // include_once('../include/rodape.php');
?>