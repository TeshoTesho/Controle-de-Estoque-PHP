<?php
//Sessão
ob_start();
session_start();
date_default_timezone_set('America/Sao_Paulo');

  //Verificando login
if (!isset($_SESSION['funcionario'])) {
  header("Location:login.php");
  die();
}else{

  
$empresa="USPESP";
$funcsenha=$_SESSION['funcionario'];
$nome_funcionario=$_SESSION['nome'];
$cd_funcionario=$_SESSION['cd'];
$ic_funcionario=$_SESSION['ic'];

  if($ic_funcionario<5){
    header("Location:home.php");
  }
}
require("conn.php");
require("head.php");
$dt = $_POST['vl_data'];
$est = $_POST['vl_estoque'];
$cdestoque = $_POST['id_estoque'];
$cdentregaproduto = $_POST['id_entrega_produto'];



$data = mysqli_query($connect,"UPDATE `tb_entrega_produto` SET `dt_validade` = '$dt' WHERE `tb_entrega_produto`.`cd_entrega_produto` = $cdentregaproduto;");
$estoque = mysqli_query($connect,"UPDATE `tb_estoque` SET `cd_quantidade` = '$est' WHERE `tb_estoque`.`cd_estoque` = $cdestoque;");
if(isset($_POST['mlentrega'])){
$entrega_produto = mysqli_query($connect,"UPDATE `tb_entrega_produto` SET `cd_quantidade` = '$est' WHERE `cd_entrega_produto` = $cdentregaproduto;");
}
//


header("Location:estoque.php");



require('footer.php');
?>