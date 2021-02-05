
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
if($ic_funcionario<4){
  header("Location:home.php");
}

require("head.php");

$cdproduto = $_POST['id_produto'];
if(isset($_POST['btn'])){
  $nmmarca = $_POST['nmmarca'];
  $cdbarra = $_POST['cdbarra'];
  $dspeso = $_POST['dspeso'];
  $cdmedida = $_POST['cdmedida'];

  mysqli_query($connect,"UPDATE `tb_produto` SET `cd_barra` = '$cdbarra', `nm_marca` = '$nmmarca', `ds_peso` = '$dspeso', `cd_medida` = '$cdmedida' WHERE `tb_produto`.`cd_produto` = '$cdproduto';");
  header("Location:produto.php");

}elseif (isset($_POST['apaga'])){

  mysqli_query($connect,"DELETE FROM `tb_produto` WHERE `tb_produto`.`cd_produto` = '$cdproduto'");
  //echo "DELETE FROM `tb_produto` WHERE `tb_produto`.`cd_produto` = '$cdproduto'";

  header("Location:produto.php");
}else{


  $verifica = mysqli_query($connect,"select * from tb_produto where cd_produto = $cdproduto;");

  ?>
  <div class="page-content bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
      <div class="container">
        <?php echo $empresa; ?> - Alterar Produto

        <div class="row mb-5   ">
          <div class="col">
            <p class="h2 text-center mt-3 mb-3  ">Produto</p>

            <table class="table mt-2">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Marca</th>

                  <th scope="col">Código de Barra</th>

                  <th scope="col">Peso</th>

                  <th scope="col">Unidade de Medida</th>
                  <?php
                  if($ic_funcionario>3){
                    echo "<th scope = 'col'>Ações</th>";
                  }
                  ?>
                </tr>
              </thead>
              <tbody>

                <?php


                while($ut =mysqli_fetch_array($verifica)){
                  $cdproduto = $ut['cd_produto'];
                  $nmmarca = $ut['nm_marca'];
                  $cdbarra = $ut['cd_barra'];
                  $dspeso = $ut['ds_peso'];
                  $cdmedida = $ut['cd_medida'];
                  $cditem = $ut['cd_item'];

                  $procura_item = mysqli_query($connect,"select * from tb_item where cd_item = '$cditem'");
                  while($ml = mysqli_fetch_array($procura_item)){
                    $nmitem = $ml['nm_item'];
                  }

                  $procura_medida = mysqli_query($connect,"select * from tb_unidade_medida where cd_medida = '$cdmedida';");
                  while($ow = mysqli_fetch_array($procura_medida)){
                    $cdsimbolo = $ow['cd_simbolo'];
                  }

                  echo"
                  <form method='post' action='alterar_produto.php'>

                  <td><input class='form-control ' type='text' value='$nmmarca' name='nmmarca' autofocus required></td>
                  <td><input class='form-control ' type='text' value='$cdbarra' name='cdbarra' required></td>

                  <td><input class='form-control ' type='text' value='$dspeso' name='dspeso' required></td>
                  <td>
                  <select class='form-control' name='cdmedida' required>
                  <option value=''>Selecione a Unidade de Medida </option>";
                  $procura_um = mysqli_query($connect,"select * from tb_unidade_medida");
                  while($al = mysqli_fetch_array($procura_um)){
                    $cdmedida2 = $al['cd_medida'];
                    $nmmedida = $al['nm_medida'];
                    $cdsimbolo2 = $al['cd_simbolo'];
                    echo "<option value='$cdmedida2'";
                    if($cdmedida==$cdmedida2){
                      echo " selected ";
                    }
                    echo ">$nmmedida ( $cdsimbolo2 ) </option>";
                  }
                  echo "
                  </select>
                  </td>


                  ";
                  if($ic_funcionario>3){

                    echo "
                    <td>

                    <input type='hidden' name='id_produto' value='$cdproduto'></input>
                    <button class='btn btn-warning' name='btn'>Editar</button>

                    <button class='ml-4 btn btn-danger' name='apaga'>Apagar</button></td>

                    </form>";
                  }



                  echo "</tr>";



                }
              }
              echo "</tbody>
              </table>
              </div>
              </div>
              </div>
              </section>
              </div>";
              require("footer.php");
              require("script.php");
              ?>
