<?php

//ATENÇÃO: esse arquivo é diferente do "usuario_cad" em certos pontos


    $titulo = 'Loja de Miniaturas - Cadastro de Usuário';

    include_once('./cabecalho_user.php');
    include_once('./menulateral_user.php');
    
    if ((isset($_GET['cod'])) && (is_numeric($_GET['cod'])))
    {
        $id = $_GET['cod'];
    }
    //Após form ser enviado, trabalha-se com POST ao invés de GET
    else if ((isset($_POST['cod'])) && (is_numeric($_POST['cod'])))
    {
        $id = $_POST['cod'];
    }else
    {
        header("Location: menu_user.php");
        exit();
    }
        
    
    require_once('./conexao.php');

    if (isset($_POST['enviou'])) {
        
        $erros = array();
        //Verifica se há um primeiro nome
        if (empty($_POST['p_nome'])) {
            $erros[] = "Você esqueceu de digitar o seu primeiro nome.";
        } else {
            $pn = mysqli_real_escape_string($dbc, trim($_POST['p_nome']));
        }

        //Verifica se há um último nome
        if (empty($_POST['u_nome'])) {
            $erros[] = "Você esqueceu de digitar o seu último nome.";
        } else {
            $un = mysqli_real_escape_string($dbc, trim($_POST['u_nome']));
        }

        //Verifica se há um e-mail
        if (empty($_POST['email'])) {
            $erros[] = "Você esqueceu de digitar o seu e-mail.";
        } else {
            $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
        }

        //Verifica se há uma senha e testa a confirmação
        if (!empty($_POST['senha1'])) {
            if ($_POST['senha1'] != $_POST['senha2']) {
                $erros[] = "Sua senha não corresponde a confirmação.";
            } else {
                $p = mysqli_real_escape_string($dbc, trim($_POST['senha1']));
            }
        } else {
            $erros[] = "Você esqueceu de digitar a sua senha.";
        }

        if (empty($erros)) {
            $q = "UPDATE usuario SET
                    p_nome ='$pn', 
                    u_nome='$un', 
                    email='$e', 
                    senha=SHA1('DWEB2.$p'), 
                    data_reg=NOW()
                WHERE id = $id";
            
            $r = mysqli_query($dbc, $q);

            if ($r) {
                $sucesso = "<h2><b>Sucesso!</b></h2>
                           <p>Seu registro foi incluído com sucesso</p>
                           <p>Aguarde... Redirecionando</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='3;URL=usuario_menu.php'>";
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
    $q = "SELECT * FROM usuario WHERE id=$id";
    $r = @mysqli_query($dbc,$q);

    if (mysqli_num_rows($r) == 1)
    //Esse if fecha na linha q vem antes das ultimas 4 linhas desse documento
    { 
        $row = mysqli_fetch_array($r,MYSQLI_NUM);
    
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Alteração - Usuário</h1>

        <form method="post" action="usuario_alt.php">

        <div id="acoes" align="right">
            <a href="usuario_menu.php" class="btn btn-secondary">Fechar sem Salvar</a>
            <input type="submit" class="btn btn-warning" value="Alterar" />
        </div>
    </div>

    <?php
        if (isset($erro)) echo "<div class='alert alert-danger'>$erro</div>";
        if (isset($sucesso)) echo "<div class='alert alert-success'>$sucesso</div>";
    ?>

    <div class="row">
        <div class="form-group col-md-4">
        <label>Primeiro Nome</label>
        <input type="text"
            name="p_nome"
            maxlength="20"
            class="form-control"
            placeholder="Digite o primeiro nome"
            value="<?php echo $row[1];?>" />
        </div>

        <div class="form-group col-md-8">
        <label>Último Nome</label>
        <input type="text"
            name="u_nome"
            maxlength="40"
            class="form-control"
            placeholder="Digite o último nome"
            value="<?php echo $row[2];?>" />
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
        <label>Endereço de E-mail</label>
        <input type="email"
            name="email"
            maxlength="80"
            class="form-control"
            placeholder="Digite o e-mail"
            value="<?php echo $row[3];?>" />
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
        <label>Senha</label>
        <input type="password"
            name="senha1"
            maxlength="10"
            class="form-control"
            placeholder="Digite a senha" />
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
    <input type="hidden" name="id" value="<?=$row[0]; ?>" />
    </form>

</main>
<?php
     }
    // include_once('../include/rodape.php');
?>