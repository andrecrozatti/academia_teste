<?php
    $titulo = "Top Fit - Menu de Professores";

    include_once('./cabecalho_adm.php');
    include_once('./menulateral_adm.php');

    require_once('./conexao.php');

    // Número de registros para mostrar por página
    $exiba = 10;
    
    //Captura busca
    $where = mysqli_real_escape_string($dbc, trim(isset($_GET['q'])) ? $_GET['q'] : '');

    $ordem = '';

    // Determina quantas páginas existem
    if (isset($_GET['p']) && is_numeric($_GET['p'])) {
        $pagina = $_GET['p'];
    } else { // Não foi determinada
        // Conta a qtd de registros
        $q = "SELECT COUNT(cod_prof) FROM professor WHERE nome like '%$where%' ";
        $r = @mysqli_query($dbc, $q);
        $row = @mysqli_fetch_array($r, MYSQLI_NUM);
        $qtde = $row[0];
        // Calcule o número de página
        if ($qtde > $exiba) {
            // A função ceil arredondando o valor pra cima ex. 5,05 é 6.
            $pagina = ceil($qtde/$exiba);
        } else {
            $pagina = 1;
        }
    }

    // Determina uma posição no BD para começar a
    // retornar os resultados
    if (isset($_GET['s']) && is_numeric($_GET['s'])) {
        $inicio = $_GET['s'];
    } else {
        $inicio = 0;
    }


    //Determina a ordenação, por Padrao é ID
    $ordem = isset($_GET['ordem']) ? $_GET['ordem'] : 'cod_prof';

    //Determina a ordem de classificação
    switch ($ordem) {
        case 'cod': $order_by = 'cod_prof';
                   break;
        case 'n' : $order_by = 'nome';
                   break;
        case 'e' : $order_by = 'email';
                   break;
        default:
                   $order_by = 'cod_prof';
                   $ordem    = 'cod_prof';
                   break;
    }


    $q = "SELECT cod_prof, nome, email
            FROM professor
            WHERE nome like '%$where%'
            ORDER BY $order_by
            LIMIT $inicio, $exiba";
    $r = @mysqli_query($dbc, $q); //@ -> Não apresenta erro, se tiver.
    if (mysqli_num_rows($r) > 0) {
        $saida = '<div class="table-responsive col-md-12">
        <table class="table table-striped">
        <thead>
            <tr>
                <th width="10%"><strong>
                    <a href="prof_menu.php?ordem=cod_prof">Código</a></strong></th>
                <th width="25%"><strong>
                    <a href="prof_menu.php?ordem=n">Nome</a></strong></th>
                <th width="25%"><strong>
                    <a href="prof_menu.php?ordem=e">E-Mail</a></strong></th>
                <th width="20%"><strong>
                    Ações</strong></th>
            </tr>
        </thead><tbody>';
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            $saida .=  '<tr>
            <td>' . $row['cod_prof'] . '</td>
            <td>' . $row['nome'] . ' ' . '</td>
            <td>' . $row['email'] . '</td>
            <td class="actions">
                <a href="prof_alt.php?cod_prof=' . $row['cod_prof'] . '" class="btn btn-xs btn-warning">
                    Editar</a>
                <a href="prof_exc.php?cod_prof=' . $row['cod_prof'] . '" class="btn btn-xs btn-danger">
                    Excluir</a>
            </td>
            </tr>';
        }
        $saida .= '</tbody></table></div>';
    } else {
        $saida = "<div class='alert alert-warning'>
        Sua pesquisa por <strong>$where</strong>
        não encontrou nenhum resultado.<br />";
        $saida .= "<strong>Dicas</strong><br />";
        $saida .= "- Tente palavras menos específicas<br />";
        $saida .= "- Tente palavras chaves diferentes<br />";
        $saida .= "- Confira a ortografia das palavras
        e se elas foram acentuadas corretamente.<br />";
        //</div>"
    }
    if ($pagina > 1) {
        $pag = '';
        $pagina_correta = ($inicio/$exiba) + 1;

        //botao anterior
        if($pagina_correta != 1)
        {
            $pag .= '<li class="page-item"><a class="page-link" href="prof_menu.php?s=' . 
            ($inicio - $exiba) . 
            '&p=' . $pagina . '&ordem=' . $ordem . '">Anterior</a></li>';
        }
        else
        {
            $pag .= '<li class="page-item disabled"><a class="page-link">Anterior</a></li>';
        }
        
        //Todas as paginas
        for ($i = 1; $i <= $pagina; $i++)
        {
            if ($i != $pagina_correta)
            {
                $pag .= '<li class="page-item"><a class="page-link" href=prof_menu.php?s=' . 
                ($exiba * ($i - 1)) . '&p=' . $pagina . '&ordem=' . $ordem . '">' . 
                $i . '</a></li>';
            }
            else
            {
                $pag .= '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
            }
        }
    
        //botao proximo
        if($pagina_correta != $pagina)
        {
            $pag .= '<li class="page-item"><a class="page-link" href="prof_menu.php?s=' . 
            ($inicio + $exiba) . 
            '&p=' . $pagina . '&ordem=' . $ordem . '">Próximo</a></li>';
        }
        else
        {
            $pag .= '<li class="page-item disabled"><a class="page-link">Próximo</a></li>';
        }
    }
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3">
        <div class="col-md-2">
            <h2>Professores</h2>
        </div>
        <div class="col-md-2">
            <a href="prof_cad.php" class="btn btn-primary h2">Inserir Professor</a>
        </div>
        <div class="col-md-6">
            <div class="input-group h2">
                <input type="text" id="busca" class="form-control" placeholder="Pesquisa de professores por nome:">
                             <span class="input-group-btn">
                                <a href="#" class="btn btn-primary" onclick="this.href='prof_menu.php?q='+ document.getElementById('busca').value">
                                    <span class="fa fa-search"></span>
                                </a>
                            </span>
            </div>

        </div>
        <div class="col-md-6">
        </div>
        
    </div>
    <div id="list" class="row">
        <?php echo $saida ?>
    </div>
    <div id="bottom" class="row">
        <ul class="pagination">
            <?php if (isset($pag)) echo $pag; ?>
        </ul>
    </div>
<?php
    include_once('./rodape.php');
?>