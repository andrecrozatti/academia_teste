<?php

    $titulo = 'Altereção de Aula';

    include_once('./cabecalho_adm.php');
    include_once('./menulateral_adm.php');
    
    if ((isset($_GET['cod_aula'])) && (is_numeric($_GET['cod_aula'])))
    {
        $cod_aula = $_GET['cod_aula'];
    }
    //Após form ser enviado, trabalha-se com POST ao invés de GET
    else if ((isset($_POST['cod_aula'])) && (is_numeric($_POST['cod_aula'])))
    {
        $cod_aula = $_POST['cod_aula'];
    }else
    {
        header("Location: aula_menu.php");
        exit();
    }
        
    
    require_once('./conexao.php');

    if (isset($_POST['enviou'])) {
        
        $erros = array();
        //Verifica se há um nome
        if (empty($_POST['nome_aula'])) {
            $erros[] = "Você esqueceu de digitar o nome da aula.";
        } else {
            $n = mysqli_real_escape_string($dbc, trim($_POST['nome_aula']));
        }

        //Verifica o hora
        if (empty($_POST['hora'])) {
            $erros[] = "Você esqueceu de digitar o seu hora";
        } else {
            $h = mysqli_real_escape_string($dbc, trim($_POST['hora']));
        }

        //Verifica se há um duracao
        if (empty($_POST['duracao'])) {
            $erros[] = "Você esqueceu de digitar o seu duracao.";
        } else {
            $d = mysqli_real_escape_string($dbc, trim($_POST['duracao']));
        }
        //Verifica se há um professor
        if (empty($_POST['cod_prof'])) {
            $erros[] = "Você esqueceu de digitar o professor.";
        } else {
            $cp = mysqli_real_escape_string($dbc, trim($_POST['cod_prof']));
        }
        //Verifica se há um semana
        if (empty($_POST['semana'])) {
            $erros[] = "Você esqueceu de digitar o dia da semana.";
        } else {
            $sem = mysqli_real_escape_string($dbc, trim($_POST['semana']));
        }

        

        if (empty($erros)) {
            $q = "UPDATE aulas SET
                    nome_aula ='$n', 
                    hora='$h', 
                    duracao='$d',
                    cod_prof='$cp',
                    semana='$sem'
                WHERE cod_aula = $cod_aula";
            
            $r = mysqli_query($dbc, $q);

            if ($r) {
                $sucesso = "<h2><b>Sucesso!</b></h2>
                           <p>Seu registro foi incluído com sucesso</p>
                           <p>Aguarde... Redirecionando</p>";
                echo "<meta HTTP-EQUIV='refresh'
                    CONTENT='3;URL=aula_menu.php'>";
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
    $q = "SELECT * FROM aulas WHERE cod_aula=$cod_aula";
    $r = @mysqli_query($dbc,$q);

    if (mysqli_num_rows($r) == 1)
    //Esse if fecha na linha q vem antes das ultimas 4 linhas desse documento
    { 
        $row = mysqli_fetch_array($r,MYSQLI_NUM);
    
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Alteração - Aulas</h1>
    
        <form method="post" action="aula_alt.php">

        <div id="acoes" align="right">
            <a href="aula_menu.php" class="btn btn-secondary">Fechar sem Salvar</a>
            <input type="submit" class="btn btn-warning" value="Alterar" />
        </div>
    </div>

    <?php
        if (isset($erro)) echo "<div class='alert alert-danger'>$erro</div>";
        if (isset($sucesso)) echo "<div class='alert alert-success'>$sucesso</div>";
    ?>

    <div class="row">
        <div class="form-group col-md-4">
        <label>Nome da aula</label>
        <input type="text"
            name="nome_aula"
            maxlength="20"
            class="form-control"
            placeholder="Digite o nome da aula"
            value="<?php echo $row[1];?>" />
        </div>

        <div class="form-group col-md-8">
        <label>Hora</label>
        <input type="time"
            name="hora"
            class="form-control"
            value="<?php echo $row[2];?>" />
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
        <label>Duração</label>
        <input type="time"
            name="duracao"
            class="form-control"
            value="<?php echo $row[3];?>" />
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
        <label>Professor</label>
        <select name="cod_prof" class="form-control">
                <option value="1">Cleiton</option>
                <option value="2">Vagner</option>
                <option value="4">Ronaldo de Souza</option>
            </select>
        </div>

        <div class="form-group col-md-6">
        <label>Dia da semana</label>
        <select name="semana"   value="<?php echo $row[5]?>" class="form-control">
                <option >Segunda</option>
                <option >Terça</option>
                <option >Quarta</option>
                <option >Quinta</option>
                <option >Sexta</option>
                <option >Sabado</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="enviou" value="Sim" />
    <input type="hidden" name="cod_aula" value="<?=$row[0]; ?>" />
    </form>

</main>
<?php
     }
    // include_once('../include/rodape.php');
?>