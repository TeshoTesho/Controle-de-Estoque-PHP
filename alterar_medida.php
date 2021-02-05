
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

$cdmedida = $_POST['id_medida'];
if(isset($_POST['btn'])){
  $nmmedida = $_POST['nome'];
  $cdsimbolo = $_POST['simbolo'];

  
  mysqli_query($connect,"UPDATE `tb_unidade_medida` SET `nm_medida` = '$nmmedida',cd_simbolo = '$cdsimbolo' WHERE `cd_medida` = '$cdmedida';");
  header("Location:unidade_medida.php");

}elseif (isset($_POST['apaga'])){

  $nmmedida = $_POST['nome'];
  $cdsimbolo = $_POST['simbolo'];


  mysqli_query($connect,"DELETE FROM `tb_unidade_medida` WHERE `tb_unidade_medida`.`cd_medida` ='$cdmedida';");
  header("Location:unidade_medida.php");
}else{


  $verifica = mysqli_query($connect,"select * from tb_unidade_medida where cd_medida = $cdmedida;");

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
                <th scope="col">Nome</th>
                <th scope="col">Simbolo</th>
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
                $cdmedida = $ut['cd_medida'];
                $nome = $ut['nm_medida'];
                $simbolo = $ut['cd_simbolo'];

                echo"
                <form method='post' action='alterar_medida.php'>
                <td><input class='form ' type='text' value='$nome' name='nome' autofocus></td>
                <td><input type='text' value='$simbolo' name='simbolo'></td>
                ";
                if($ic_funcionario>3){

                  echo "
                  <td>

                  <input type='hidden' name='id_medida' value='$cdmedida'></input>
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
