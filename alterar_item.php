
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

$cditem = $_POST['item'];
if(isset($_POST['btn'])){
  $nmitem = $_POST['nmitem'];
  $cduspesp = $_POST['cduspesp'];
  $cdsubcategoria = $_POST['cdsubcategoria'];

  
  mysqli_query($connect,"UPDATE `tb_item` SET `nm_item` = '$nmitem',cd_uspesp = '$cduspesp',cd_sub_categoria = '$cdsubcategoria' WHERE `cd_item` = '$cditem';");
  header("Location:item.php");
  

}elseif (isset($_POST['apaga'])){


  mysqli_query($connect,"DELETE FROM `tb_item` WHERE `cd_item` ='$cditem';");
  header("Location:item.php");
}else{


  $verifica = mysqli_query($connect,"select * from tb_item where cd_item = $cditem;");

  while($le = mysqli_fetch_array($verifica)){
    $idsubcategoria = $le['cd_sub_categoria'];
    $nmitem = $le['nm_item'];
    $cduspesp = $le['cd_uspesp'];
  }
  ?>
  <div class="page-content bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
      <div class="container">
        <?php echo $empresa; ?> - Alterar Unidade De Medida

        <div class="row mb-5   ">
          <div class="col">
            <p class="h2 text-center mt-3 mb-3  ">Unidades de Medida</p>

            <table class="table mt-2">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Sub-Categoria</th>
                  <th scope="col">Código</th>
                  <th scope="col">Nome</th>
                  <?php
                  if($ic_funcionario>3){
                    echo "<th scope = 'col'>Ações</th>";
                  }
                  ?>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php


                  echo"
                  <form method='post' action='alterar_item.php'>

                  <td>
                  <select name='cdsubcategoria' class=' form-control' required>
                  <option selected value=''>Selecione a Sub-Categoria</option>
                  ";

                  $procura_sub_categoria = mysqli_query($connect,"Select * from tb_sub_categoria");

                  while($kc = mysqli_fetch_array($procura_sub_categoria)){
                    $cdsubcategoria2 = $kc['cd_sub_categoria'];
                    $nmsubcategoria2 = $kc['nm_sub_categoria'];
                    $cdcategoria = $kc['cd_categoria'];

                    $procura_sub_categoria2 = mysqli_query($connect,"Select * from tb_categoria where cd_categoria = $cdcategoria");
                    while($md = mysqli_fetch_array($procura_sub_categoria2)){
                      $nmcategoria = $md['nm_categoria'];

                      echo "
                      <option value='$cdsubcategoria2' ";

                      if($cdsubcategoria2 == $idsubcategoria){
                        echo "selected";
                      }

                      echo ">$nmcategoria -- $nmsubcategoria2</option>";
                    }
                    
                  }



                  echo "
                  </select>


                  </td>";



                  echo "
                  <td><input class='form-control' type='text' value='$cduspesp' name='cduspesp' ></td>

                  <td><input class='form-control' type='text' value='$nmitem' required name='nmitem' autofocus></td>
                  ";
                  if($ic_funcionario>3){

                    echo "
                    <td>
                    <input class='form-control' type='hidden' value='$cditem' required name='item' >
                    <button class='btn btn-warning' name='btn'>Editar</button>

                    <button class='ml-4 btn btn-danger' name='apaga'>Apagar</button>
                    </td>
                    </form>";
                  }



                  echo "</tr>";



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
