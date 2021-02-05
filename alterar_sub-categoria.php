
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

$cdsubcategoria = $_POST['id_sub_categoria'];
if(isset($_POST['btn'])){
  $nmsubcategoria = $_POST['nmsubcategoria'];
  $cdcategoria = $_POST['cdcategoria'];

  
  mysqli_query($connect,"UPDATE `tb_sub_categoria` SET `nm_sub_categoria` = '$nmsubcategoria',cd_categoria = '$cdcategoria' WHERE `cd_sub_categoria` = '$cdsubcategoria';");
  header("Location:sub-categoria.php");

}elseif (isset($_POST['apaga'])){

  $nmsubcategoria = $_POST['nmsubcategoria'];


  mysqli_query($connect,"DELETE FROM `tb_sub_categoria` WHERE `cd_sub_categoria` ='$cdsubcategoria';");
  header("Location:sub-categoria.php");
}else{


  $verifica = mysqli_query($connect,"select * from tb_sub_categoria where cd_sub_categoria = $cdsubcategoria;");

  ?>
  <div class="page-content bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
      <div class="container">
        <?php echo $empresa; ?> - Alterar Sub-Categoria

       <div class="row mb-5   ">
        <div class="col">
          <p class="h2 text-center mt-3 mb-3  ">Categoria</p>

          <table class="table mt-2">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Categoria</th>
                <th scope="col">Sub-Categoria</th>
                <?php
                if($ic_funcionario>3){
                  echo "<th colspan='2'>Ações</th>";
                }
                ?>
              </tr>
            </thead>
            <tbody>

              <?php



              while($ut =mysqli_fetch_array($verifica)){
                $cdsubcategoria = $ut['cd_sub_categoria'];
                $nmsubcategoria = $ut['nm_sub_categoria'];
                $cdcategoria = $ut['cd_categoria'];

                echo"
                <form method='post' action='alterar_sub-categoria.php'>
                 <td>
                 <select name='cdcategoria' class='form-control'>
                ";

                $procura_categoria = mysqli_query($connect,"Select * from tb_categoria");

                while($kc = mysqli_fetch_array($procura_categoria)){
                  $cdcategoria2 = $kc['cd_categoria'];
                  $nmcategoria2 = $kc['nm_categoria'];
                
                echo "
               <option value='$cdcategoria2'";
               if($cdcategoria==$cdcategoria2){echo "selected";}
               echo ">$nmcategoria2</option>";
                
              }

                if($ic_funcionario>3){

                  echo "
                  </select>
                  </td>
                  <td><input class='form-control' type='text' value='$nmsubcategoria' name='nmsubcategoria'></td>
                  <td>

                  <input type='hidden' name='id_sub_categoria' value='$cdsubcategoria'></input>
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
