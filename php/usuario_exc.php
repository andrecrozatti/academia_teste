<?php

    $titulo = 'Top Fit - Exclusão de aulas';

    include_once('./cabecalho_adm.php');
    include_once('./menulateral_adm.php');
    
    if ((isset($_GET['cod'])) && (is_numeric($_GET['cod'])))
    {
        $cod = $_GET['cod'];
    }
    //Após form ser enviado, trabalha-se com POST ao invés de GET
    else if ((isset($_POST['cod'])) && (is_numeric($_POST['cod'])))
    {
        $cod = $_POST['cod'];
    }else
    {
        header("Location: usuario_menu.php");
        exit();
    }
        
    
    require_once('./conexao.php');

    if (isset($_POST['enviou'])) {
       

        
        $q = "DELETE FROM alunos WHERE cod = $cod";
        
        $r = mysqli_query($dbc, $q);

        if ($r) {
            $sucesso = "<h2><b>Sucesso!</b></h2>
                        <p>Seu registro foi excluido com sucesso</p>
                        <p>Aguarde... Redirecionando</p>";
            echo "<meta HTTP-EQUIV='refresh'
                CONTENT='3;URL=usuario_menu.php'>";
        } else {
            $erro = "<h2><b>Erro!</b></h2>
                    <p>$q Você não pode ser registrado devido a um erro no sistema.
                    Pedimos desculpas por qualquer incoveniente.</p>";
        }
        

       
    }

    //Pesquisa para exibir o registro por alteração
    $q = "SELECT * FROM alunos WHERE cod=$cod";
    $r = @mysqli_query($dbc,$q);

    if (mysqli_num_rows($r) == 1)
    //Esse if fecha na linha q vem antes das ultimas 4 linhas desse documento
    { 
        $row = mysqli_fetch_array($r,MYSQLI_NUM);
    
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Exclusão - Alunos</h1>

        <form method="post" action="usuario_exc.php">

        <div id="acoes" align="right">
            <a href="usuario_menu.php" class="btn btn-secondary">Fechar sem Salvar</a>
            <input type="submit" class="btn btn-danger" value="Excluir" />
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
            value="<?php echo $row[1];?>" />
        </div>

        <div class="form-group col-md-3">
        <label>Digite seu CPF</label>
        <input type="text"
            name="cpf"
            maxlength="40"
            class="form-control"
            placeholder="CPF"
            value="<?php echo $row[3];?>" />
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
            value="<?php echo $row[5];?>" />
        </div>
        <div class='form-group col-md-3'>
            <label>Numero</label>
            <input type="text" 
            name="numero" class="form-control" placeholder="N°" value="<?php echo $row[6];?>">
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
            <input type="number" name="peso" class="form-control" value="<?php echo $row[4];?>" placeholder="Digite seu peso">
        </div>
        <div class="form-group col-md-2">
            <label >Altura</label>
            <input type="text" name="altura" class="form-control"value="<?php echo $row[10];?>" placeholder="Digite sua altura">
        </div>
        <div class="form-group col-md-2">
            <label >Data de Nascimento</label>
            <input type="date" name="data_nasc" value="<?php echo $row[2];?>" class="form-control" >
        </div>
        <div class="form-group col-md-2">
            <label>Telefone</label>
            <input type="tel" name="tel" value="<?php echo $row[8];?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label>Plano Desejado</label>
            <select name="plano" id="" class="form-control">
                <option value="">Mensal</option>
                <option value="">Trimestral</option>
                <option value="">Semestral</option>
            </select>
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