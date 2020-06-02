<?php

    $titulo = '';

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
       

        
        $q = "DELETE FROM professor WHERE cod_prof = $cod_prof";
        
        $r = mysqli_query($dbc, $q);

        if ($r) {
            $sucesso = "<h2><b>Sucesso!</b></h2>
                        <p>Seu registro foi excluido com sucesso</p>
                        <p>Aguarde... Redirecionando</p>";
            echo "<meta HTTP-EQUIV='refresh'
                CONTENT='3;URL=prof_menu.php'>";
        } else {
            $erro = "<h2><b>Erro!</b></h2>
                    <p>$q Você não pode ser registrado devido a um erro no sistema.
                    Pedimos desculpas por qualquer incoveniente.</p>";
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
        <h1 class="h2">Exclusão - Professor</h1>

        <form method="post" action="prof_exc.php">

        <div id="acoes" align="right">
            <a href="prof_menu.php" class="btn btn-secondary">Fechar sem Salvar</a>
            <input type="submit" class="btn btn-danger" value="Excluir" />
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