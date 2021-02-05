
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

$idfornecedor = $_POST['id_fornecedor'];
if(isset($_POST['btn'])){
  $nmfornecedor = $_POST['nmfornecedor'];
  $cdinscricaoestadual = $_POST['cdinscricao'];
  $cdcnpj = $_POST['cdcnpj'];
  
  mysqli_query($connect,"UPDATE `tb_fornecedor` SET `cd_incricao_estadual` = '$cdinscricaoestadual', nm_fornecedor = '$nmfornecedor', cd_cnpj = '$cdcnpj' WHERE `cd_fornecedor` = '$idfornecedor';");
  //echo "UPDATE `tb_fornecedor` SET `cd_incricao_estadual` = '$cdinscricaoestadual', nm_fornecedor = '$nmfornecedor', cd_cnpj = '$cdcnpj' WHERE `cd_fornecedor` = '$idfornecedor';";
  header("Location:fornecedor.php");

}elseif (isset($_POST['apaga'])){
  mysqli_query($connect,"DELETE FROM `tb_fornecedor` WHERE cd_fornecedor ='$idfornecedor';");
  header("Location:fornecedor.php");
}else{


  $verifica = mysqli_query($connect,"select * from tb_fornecedor where cd_fornecedor = $idfornecedor;");

  ?>
  <div class="page-content bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
      <div class="container">
        <?php echo $empresa; ?> - Alterar Fornecedor

        <div class="row mb-5   ">
          <div class="col">
            <p class="h2 text-center mt-3 mb-3  ">Fornecedor</p>

            <table class="table mt-2">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">CNPJ</th>
                  <th scope="col">Inscrição Estadual</th>
                  <?php
                  if($ic_funcionario==5){
                    echo "<th scope = 'col'>Ações</th>";
                  }
                  ?>
                </tr>
              </thead>
              <tbody>

                <?php



                while($ut =mysqli_fetch_array($verifica)){
                  $nmfornecedor = $ut['nm_fornecedor'];
                  $cdcnpj = $ut['cd_cnpj'];
                  $cdinscricaoestatual = $ut['cd_incricao_estadual'];
                  $id_fornecedor = $ut['cd_fornecedor'];
                  
                  echo"
                  <form method='post' action='alterar_fornecedor.php'>
                  <td><input class='form-control ' type='text' value='$nmfornecedor' name='nmfornecedor' autofocus></td>
                  <td><input class='form-control ' type='number' value='$cdcnpj' name='cdcnpj'></td>
                  <td><input class='form-control ' type='number' value='$cdinscricaoestatual' name='cdinscricao'></td>
                  ";
                  if($ic_funcionario==5){

                    echo "
                    <td>

                    <input type='hidden' name='id_fornecedor' value='$idfornecedor'></input>
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
