<?php

function absolute_url($page = 'index.php'){
    $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;
    return $url;
}

function check_login($dbc, $nome ='',$senha =''){
    $erros = array();
    if (empty($nome)){
        $erros[] = 'Você esqueceu de digitar o seu login';
    }
    else{
        $n = mysqli_real_escape_string($dbc, trim($nome));
    }
    if (empty($senha)){
        $erros[] = 'Você esqueceu de digitar a sua senha!!';
    }
    else{
        $s = mysqli_real_escape_string($dbc, trim($senha));
    }
    if(empty($erros)){
        $q = "SELECT cod,nome FROM alunos WHERE email ='$n' AND senha=SHA1('DWEB2.$s')";
        $r = mysqli_query($dbc, $q);
        
        if (mysqli_num_rows($r)==1){
            $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
            return array (true, $row);
        }
        else{
            $erros [] ='O endereço de E-mail ou a senha estão erradas';
        }
    }
    
    return array (false, $erros);
}

?>