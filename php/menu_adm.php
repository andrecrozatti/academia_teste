<?php
    $titulo='Top Fit - Menu Administrador';
    session_start();
    include_once('./cabecalho_adm.php');
    include_once('./menulateral_adm.php');
?>

<main role="main" class="col-md-9 ml-sm-auto pt-5 col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Menu Principal</h1>
    </div>
    <p>
        Seja bem vindo,
        <?php
        echo $_SESSION['nome'];
    
    
    
    
    ?></p>

