
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

$cdcategoria = $_POST['id_categoria'];
if(isset($_POST['btn'])){
  $nmcategoria = $_POST['nome'];
  $cdsimbolo = $_POST['categoria'];

  
  mysqli_query($connect,"UPDATE `tb_categoria` SET `nm_categoria` = '$nmcategoria' WHERE `cd_categoria` = '$cdcategoria';");
  header("Location:categoria.php");

}elseif (isset($_POST['apaga'])){

  $nmcategoria = $_POST['nome'];
  $cdsimbolo = $_POST['categoria'];


  mysqli_query($connect,"DELETE FROM `tb_categoria` WHERE `cd_categoria` ='$cdcategoria';");
  header("Location:categoria.php");
}else{


  $verifica = mysqli_query($connect,"select * from tb_categoria where cd_categoria = $cdcategoria;");

  ?>
  <div class="page-content bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
      <div class="container">
        <?php echo $empresa; ?> - Alterar Categoria

       <div class="row mb-5   ">
        <div class="col">
          <p class="h2 text-center mt-3 mb-3  ">Categoria</p>

          <table class="table mt-2">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nome</th>
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
                $cdcategoria = $ut['cd_categoria'];
                $nome = $ut['nm_categoria'];

                echo"
                <form method='post' action='alterar_categoria.php'>
                <td><input class='form-control ' type='text' value='$nome' name='nome' autofocus></td>
                ";
                if($ic_funcionario>3){

                  echo "
                  <td>

                  <input type='hidden' name='id_categoria' value='$cdcategoria'></input>
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
