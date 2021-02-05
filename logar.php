<?php

//Sessão
ob_start();
session_start();
date_default_timezone_set('America/Sao_Paulo');

//Verificando login
if (!isset($_SESSION['funcionario'])) {}Else{

    header("Location:login.php");
    die();
}

require("conn.php");

$funcsenha = $_POST['user'];
echo $funcsenha	;


$verifica = mysqli_query($connect,"Select * from tb_funcionario where cd_senha = '$funcsenha';");
$verificarows= 0+$verifica->num_rows;
echo "linhas: ".$verificarows;
if ($verificarows==0){

    echo "<script> alert('Nenhum Usuario'); </script>";
    header("Location:login.php");
}else{
	while($uT =mysqli_fetch_array($verifica)){
    $Nome=$uT['nm_funcionario'];
     $CD=$uT['cd_funcionario']; 
     $IC=$uT['ic_acesso']; 

  $_SESSION['funcionario'] = $funcsenha;
  $_SESSION['nome']=$Nome;
  $_SESSION['ic']=$IC;
  $_SESSION['cd']=$CD;
  
  header("Location:home.php");

}
}


?>