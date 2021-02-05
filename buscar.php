<?php


require("conn.php");
//Sessão
ob_start();
session_start();
date_default_timezone_set('America/Sao_Paulo');

//Verificando login
if (!isset($_SESSION['funcionario'])) {
  header("Location:login.php");
  die();
}
$empresa="USPESP";
$funcsenha=$_SESSION['funcionario'];
$nome_funcionario=$_SESSION['nome'];
$cd_funcionario=$_SESSION['cd'];
$ic_funcionario=$_SESSION['ic'];


require("head.php");



?>







<!-- PAGE CONTENT-->
<div class="container bg-light">
  <!-- BREADCRUMB-->
  <section class="au-breadcrumb2">
    <div class="container">
     <?php echo $empresa; ?> - Busca de Produto
   </div>
 </section>
 <!-- END BREADCRUMB-->

 <?php

 $barra = $_POST['barra'];
 $verifica = mysqli_query($connect,"select * from tb_produto where cd_barra=$barra");
 $verificarows= 0+$verifica->num_rows;
 if ($verificarows==0){
  header("Location:item.php?barra=$barra");
}else{

  $verifica = mysqli_query($connect,"select a.nm_item,a.cd_uspesp,b.cd_produto, b.nm_marca,b.ds_peso, b.cd_medida, d.cd_quantidade, date_format(c.dt_validade, '%d/%m/%Y') as dt_validade from tb_item as a 
    inner join tb_produto as b on b.cd_item=a.cd_item 
    inner join tb_entrega_produto as c on c.cd_produto=b.cd_produto 
    inner join tb_estoque as d on d.cd_entrega_produto=c.cd_entrega_produto 
    where (b.cd_barra = $barra) and (d.cd_quantidade > 0) ORDER BY c.dt_validade asc;
    ;");
  $verificarows= 0+$verifica->num_rows;

  if ($verificarows==0){
    echo "<p class='h2 mt-3 mb-5 text-center'>Item Não Lançado em Estoque</p>";
    echo "<table class='table'>

    <thead class='thead-dark'>
    <tr>
    <th scope='col'>#</th>
    <th scope='col'>Codigo USPESP</th>
    <th scope='col'>Item</th>
    <th scope='col'>Marca</th>
    <th scope='col'>Peso</th>
    </tr>
    </thead>
    <tbody>";

    $verifica = mysqli_query($connect,"select b.cd_produto, a.nm_item, b.nm_marca, b.cd_barra, a.cd_uspesp, b.cd_medida, b.ds_peso, c.nm_sub_categoria from tb_produto as b inner join tb_item as a on b.cd_item = a.cd_item inner join tb_sub_categoria as c on c.cd_sub_categoria=a.cd_sub_categoria   where b.cd_barra='$barra' limit 1;");
    $verificarows= 0+$verifica->num_rows;

    while($ut =mysqli_fetch_array($verifica)){
      $Item = $ut['nm_item'];
      $Categoria = $ut['nm_sub_categoria'];
      $Marca = $ut['nm_marca'];
      $barra = $ut['cd_barra'];
      $Uspesp = $ut['cd_uspesp'];
      $cdMedida = $ut['cd_medida'];
      $Peso = $ut['ds_peso'];
      $cdproduto = $ut['cd_produto'];
      echo "<form method='post'>
      <tr>
      <th scope='row'>$cdproduto<input name='cd' style='display:none' value='$cdproduto' required></input><input name='barra' style='display:none' value='$barra'></input></th>
      <td>$Uspesp</td>
      <td>$Item</td>
      <td>$Marca</td>";
      $procura_medida = mysqli_query($connect,"select * from tb_unidade_medida where cd_medida='$cdMedida';");
      while($mK = mysqli_fetch_array($procura_medida)){
        $Medida=    $mK['cd_simbolo'];
        echo "
        <td>$Peso $Medida</td>";
      }
      echo "</tr>
      </form>";



    }




  }else{

    echo "<p class='h2 mt-3 text-center'>Produto em Estoque</p>";
    echo "
    <table class='table'>
    <thead class='thead-dark'>
    <tr>
    <th scope='col'>#</th>
    <th scope='col'>Codigo USPESP</th>
    <th scope='col'>Item</th>
    <th scope='col'>Marca</th>
    <th scope='col'>Peso</th>     
    <th scope='col'>Em Estoque</th>
    </tr>
    </thead>
    <tbody>";
    while($ut =mysqli_fetch_array($verifica)){
      $Item = $ut['nm_item'];
      $Marca = $ut['nm_marca'];
      $Uspesp = $ut['cd_uspesp'];
      $cdMedida = $ut['cd_medida'];
      $Peso = $ut['ds_peso'];
      $cdproduto = $ut['cd_produto'];
      $Estoque = $ut['cd_quantidade'];
      if($Estoque>0){
        echo "
        <tr>
        <th scope='row'>$cdproduto</th>
        <td>$Uspesp</td>
        <td>$Item</td>
        <td>$Marca</td>";
        $procura_medida = mysqli_query($connect,"Select * from tb_unidade_medida where cd_medida=$cdMedida;");
        while($La = mysqli_fetch_array($procura_medida)){
          $Medida = $La['cd_simbolo'];
          echo "
          <td>$Peso$Medida</td>";
        }
        
        echo "
        <td>$Estoque</td>
        </tr>";
      }
    }
  }
  echo "
  </tbody>
  </table>

  ";
}
?>

</div>


<?php
require("footer.php");
require("script.php");
?>