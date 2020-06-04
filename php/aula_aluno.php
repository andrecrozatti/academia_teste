<?php
    $titulo = "Top fit - Matricula nas aulas";

    include_once('./cabecalho_user.php');
    include_once('./menulateral_user.php');

    require_once('./conexao.php');
    require_once('./insert.php');
    
    if(isset($_POST['save']) && $_POST['save'] == "salvar"){
        $elementos = $_POST['aula']; 
        foreach($elementos as $e) { 
             insereReg($e); 
        }

    }



    // Número de registros para mostrar por página
    $exiba = 10;
    $saida = "";
    //Captura busca
    $where = mysqli_real_escape_string($dbc, trim(isset($_GET['q'])) ? $_GET['q'] : '');

    $ordem = '';

    // // Determina quantas páginas existem
    // if (isset($_GET['p']) && is_numeric($_GET['p'])) {
    //     $pagina = $_GET['p'];
    // } else { // Não foi determinada
    //     // Conta a qtd de registros
    //     $q = "SELECT COUNT(cod) FROM alunos WHERE nome like '%$where%' ";
    //     $r = @mysqli_query($dbc, $q);
    //     $row = @mysqli_fetch_array($r, MYSQLI_NUM);
    //     $qtde = $row[0];
    //     // Calcule o número de página
    //     if ($qtde > $exiba) {
    //         // A função ceil arredondando o valor pra cima ex. 5,05 é 6.
    //         $pagina = ceil($qtde/$exiba);
    //     } else {
    //         $pagina = 1;
    //     }
    // }

    // Determina uma posição no BD para começar a
    // retornar os resultados
    if (isset($_GET['s']) && is_numeric($_GET['s'])) {
        $inicio = $_GET['s'];
    } else {
        $inicio = 0;
    }


    //Determina a ordenação, por Padrao é ID
    $ordem = isset($_GET['ordem']) ? $_GET['ordem'] : 'cod';

    //Determina a ordem de classificação
    switch ($ordem) {
        case 'cod': $order_by = 'cod_aula';
                   break;
        case 'n' : $order_by = 'nome_aula';
                   break;
        case 'e' : $order_by = 'duracao';
                   break;
        default:
                   $order_by = 'cod_aula';
                   $ordem    = 'cod_aula';
                   break;
    }


    $q = "SELECT * 
            FROM aulas
            ORDER BY $order_by
            LIMIT $inicio, $exiba";
    $r = @mysqli_query($dbc, $q); //@ -> Não apresenta erro, se tiver.
    

        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            $saida .=  '<tr>
            <td>' . $row['cod_aula'] . '</td>
            <td>' . $row['nome_aula'] . ' ' . '</td>
            <td>' . $row['duracao'] . '</td>
            <td class="actions">
                <input type="checkbox" name="aula[]" value="'.$row['cod_aula'].'"/>
            </td>
            </tr>';
        };
        
    
?>

<main role="main" class="col-md-9 ml-sm-auto pt-3 col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3">    
        <div class="col-md-3">
            <h2>Aulas</h2>
        </div>
            <div class="col-md-6">
            <?php
         if (isset($erro)) echo "<div class='alert alert-danger'>$erro</div>";
         if (isset($sucesso)) echo "<div class='alert alert-success'>$sucesso</div>";
    ?>
        </div>
    </div>
    <div id="list" >
        <form action="aula_aluno.php" class="row" method="POST">
        <div class="table-responsive col-md-12">
        <table class="table table-striped">
        <thead>
            <tr>
                <th width="10%"><strong>
                    <a href="aula_aluno.php?ordem=cod">Código</a></strong></th>
                <th width="25%"><strong>
                    <a href="aula_aluno.php?ordem=n">Nome da aula</a></strong></th>
                <th width="25%"><strong>
                    <a href="aula_aluno.php?ordem=e">duracao</a></strong></th>
                <th width="20%"><strong>
                    Ações</strong></th>
            </tr>
        </thead><tbody>
            <?php echo $saida;?>
            <tr>
            <td colspan="3" align="right"><input type="submit" class="btn btn-primary" value="Matricular"></td>
            <td><a href="menu_user.php" class="btn btn-secondary">Fechar sem Salvar</a></td>
            <td><input type="hidden" value="salvar" name="save"/></td>
            </tr>
            </tbody></table></div>
        </form>
        
    </div>
    <div id="bottom" class="row">
        <ul class="pagination">
            <?php if (isset($pag)) echo $pag; ?>
        </ul>
    </div>
<?php
    include_once('./rodape.php');
?>