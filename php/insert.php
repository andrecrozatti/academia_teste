   
<?php
 
function insereReg($aula = null){
    
    $codAula = $aula;
    $codAluno = $_SESSION['cod'];


    $sql = "INSERT INTO aula_aluno(cod_aula,cod_aluno)VALUES($codAula,$codAluno)";


    // Create connection
    $conn = mysqli_connect("localhost","root","","acad");
       //$conn->exec("set names utf8"); 
    // Check connection
    if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
    }
    if (mysqli_query($conn, $sql)) {
        // echo "Cadastro efetuado com Sucesso!";
        $resp = true;
    
    } else {
        $resp = false;
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    if($resp = true){
        $sucesso = "<h2><b>Sucesso!</b></h2>
        <p>Seu registro foi incluído com sucesso</p>
        <p>Aguarde... Redirecionando</p>";
echo "<meta HTTP-EQUIV='refresh'
 CONTENT='3;URL=menu_user.php'>";
    }
    else{
        $erro = "<h2><b>Erro!</b></h2>
                        <p>Você não pode ser registrado devido a um erro no sistema.
                        Pedimos desculpas por qualquer incoveniente.</p>";
    }

  return $resp;
}


?>






