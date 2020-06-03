<?php
    $titulo = 'Menu do Usuario';
    // session_start();
    include_once('./cabecalho_user.php');
    include_once('./menulateral_user.php');
    include_once('./conexao.php');

    $q = "SELECT * FROM alunos where cod =" . $_SESSION['cod'];
    
   $r = mysqli_query($dbc,$q);
   $row = mysqli_fetch_array($r);
    
?>

<main role="main" class="col-md-9 ml-sm-auto pt-5 col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Menu Principal</h1>
    </div>
    <p>
        Seja bem vindo,
        <?php echo $n = $_SESSION['nome'];
            
        ?>
        <div class="row">
            <div class="card border-dark mb-3" style="max-width: 18rem; margin-right: 10px">
                <div class="card-header" style="font-size:20px">Seu Peso</div>
                    <div class="card-body text-dark">
                    <h5 class="card-title"><?php echo $row['peso']." KG";?></h5>
                    </div>
            </div>           
            <div class="card border-warning mb-3" style="max-width: 18rem;">
                <div class="card-header" style="font-size:20px">Sua Altura</div>
                    <div class="card-body text-dark">
                    <h5 class="card-title"><?php echo $row['altura']." Metros";?></h5>
                    </div>
            </div>           
        
        
        </div>
    
    </p>

