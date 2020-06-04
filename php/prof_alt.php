<?php

    $titulo = 'Top Fit - Alteração de Professores';

    include_once('./cabecalho_adm.php');
    include_once('./menulateral_adm.php');
    
    if ((isset($_GET['cod_prof'])) && (is_numeric($_GET['cod_prof'])))
    {
        $cod_prof = $_GET['cod_prof'];
    }
    //Após form ser enviado, trabalha-se com POST ao invés de GET
    else if ((isset($_POST['cod_prof'])) && (is_numeric($_POST['cod_prof'])))
    {
        $cod_prof = $_POST['cod_prof'];
    }else
    {
        header("Location: prof_menu.php");
        exit();
    }
        
    
    require_once('./conexao.php');

    if (isset($_POST['enviou'])) {
        
        $erros = array();
        //Verifica se há um primeiro nome
        if (empty($_POST['nome'])) {
            $erros[] = "Você esqueceu de digitar o seu  nome.";
        } else {
            $n = mysqli_real_escape_string($dbc, trim($_POST['nome']));
        }

        //Verifica o cpf
        if (empty($_POST['cpf'])) {
            $erros[] = "Você esqueceu de digitar o seu cpf";
        } else {
            $c = mysqli_real_escape_string($dbc, trim($_POST['cpf']));
        }

        //Verifica se há um e-mail
        if (empty($_POST['email'])) {
            $erros[] = "Você esqueceu de digitar o seu e-mail.";
        } else {
            $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
        }
        //Verifica se há um tefone
        if (empty($_POST['tel'])) {
            $erros[] = "Você esqueceu de digitar o seu telefone.";
        } else {
            $t = mysqli_real_escape_string($dbc, trim($_POST['tel']));
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
        //Verifica se há uma data de nascimento
        if (empty($_POST['data_nasc'])) {
            $erros[] = "Você esqueceu de digitar a sua data de nascimento.";
        } else {
            $dat = mysqli_real_escape_string($dbc, trim($_POST['data_nasc']));
        }

        
        // //Verifica se há uma senha e testa a confirmação
        // if (!empty($_POST['senha1'])) {
        //     if ($_POST['senha1'] != $_POST['senha2']) {
        //         $erros[] = "Sua senha não corresponde a confirmação.";
        //     } else {
        //         $p = mysqli_real_escape_string($dbc, trim($_POST['senha1']));
        //     }
        // } else {
        //     $erros[] = "Você esqueceu de digitar a sua senha.";
        // }

        if (empty($erros)) {
            $q = "UPDATE professor SET
                    nome ='$n', 
                    cpf='$c', 
                    email='$e',
                    tel='$t',
                    endereco='$end',
                    numero='$num', 
                    data_nasc='$dat'
                WHERE cod_prof = $cod_prof";
            
            $r = mysqli_query($dbc, $q);

            if ($r) {
                $sucesso = "<h2><b>Sucesso!</b></h2>
                           <p>Seu registro foi incluído com sucesso</p>
                           <p>Aguarde... Redirecionando</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='3;URL=prof_menu.php'>";
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
    $q = "SELECT * FROM professor WHERE cod_prof=$cod_prof";
    $r = @mysqli_query($dbc,$q);

    if (mysqli_num_rows($r) == 1)
    //Esse if fecha na linha q vem antes das ultimas 4 linhas desse documento
    { 
        $row = mysqli_fetch_array($r,MYSQLI_NUM);
    
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Alteração - Professor</h1>

        <form method="post" action="prof_alt.php">

        <div id="acoes" align="right">
            <a href="prof_menu.php" class="btn btn-secondary">Fechar sem Salvar</a>
            <input type="submit" class="btn btn-warning" value="Alterar" />
        </div>
    </div>

    <?php
        if (isset($erro)) echo "<div class='alert alert-danger'>$erro</div>";
        if (isset($sucesso)) echo "<div class='alert alert-success'>$sucesso</div>";
    ?>

    <div class="row">
        <div class="form-group col-md-4">
        <label>Nome</label>
        <input type="text"
            name="nome"
            maxlength="20"
            class="form-control"
            placeholder="Digite o nome"
            value="<?php echo $row[1];?>" />
        </div>

        <div class="form-group col-md-8">
        <label>CPF</label>
        <input type="text"
            name="cpf"
            maxlength="20"
            class="form-control"
            placeholder="Digite o CPF"
            value="<?php echo $row[3];?>" />
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
        <label>Endereço de E-mail</label>
        <input type="email"
            name="email"
            maxlength="40"
            class="form-control"
            placeholder="Digite o e-mail"
            value="<?php echo $row[6];?>" />
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
        <label>Telefone</label>
        <input type="tel"
            name="tel"
            maxlength="10"
            class="form-control"
            placeholder="Digite seu telefone" 
            value="<?php echo $row[7];?>"/>
        </div>

        <div class="form-group col-md-6">
        <label>endereco</label>
        <input type="text"
            name="endereco"
            maxlength="10"
            class="form-control"
            placeholder="Digite seu endereço" 
            value="<?php echo $row[4];?>"/>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label>Numero</label>
            <input type="text"
                name="numero"
                maxlength="10"
                class="form-control"
                placeholder="Digite seu numero"
                value="<?php echo $row[5];?>" />
            </div>
            <div class="form-group col-md-6">
        <label>data_nasc</label>
        <input type="date"
            name="data_nasc"
            value="<?php echo $row[2];?>"
            class="form-control"
             />
        </div>
        </div>
    </div>
    <input type="hidden" name="enviou" value="Sim" />
    <input type="hidden" name="cod_prof" value="<?=$row[0]; ?>" />
    </form>

</main>
<?php
     }
    // include_once('../include/rodape.php');
?>