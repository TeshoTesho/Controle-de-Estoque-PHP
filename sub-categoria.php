
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
if($ic_funcionario<1){
  header("Location:home.php");
}

require("head.php");
if (!isset($_POST['searchcategoria'])){


  $verifica = mysqli_query($connect,"select * from tb_sub_categoria order by cd_categoria;");

}else{
  $searchcategoria = $_POST['searchcategoria'];
  $verifica = mysqli_query($connect,"select * from tb_sub_categoria WHERE cd_categoria = $searchcategoria order by cd_categoria");
}
?>
<div class="page-content bg-light">
  <!-- BREADCRUMB-->
  <section class="au-breadcrumb2">
    <div class="container">
     <?php echo $empresa; ?> - Sub-Categoria

     <div class="row mb-5   ">
      <div class="col">
        <p class="h2 text-center mt-3 mb-3  ">Sub-Categoria</p>


        <?php
        if(isset($_POST['searchcategoria'])){
          $procura_categoria2 = mysqli_query($connect,"SELECT nm_categoria FROM tb_categoria WHERE cd_categoria = $searchcategoria");

          while($ks1 = mysqli_fetch_array($procura_categoria2)){
            $nmcategoria2 = $ks1['nm_categoria'];
            echo   '<p class="h5 text-center mt-3 mb-3  ">' . $nmcategoria2 . '</p>';
          }
        }
        ?>

        <?php if($ic_funcionario>3){ ?>
          <form method="post" action="cadastrar_sub-categoria.php">
            <?php
            if(isset($_POST['searchcategoria'])){
              $searchcategoria = $_POST['searchcategoria'];

              echo "
              <input type='hidden' name='idcategoria' value='$searchcategoria'></input>";
            }
            ?>

            <button class="btn btn-success" style="float:right; margin-bottom: 10px" >Adicionar Sub-Categoria</button  >
          </form>
        <?php } ?>

        <table class="table mt-2">
          <thead class="thead-dark">
            <tr>
              <th scope="col-4">Categoria</th>
              <th scope="col-4">Nome Sub-Categoria</th>
              <?php
              if($ic_funcionario>3){
                echo "<th colspan='2' >Ações</th>";
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

              $procura_categoria = mysqli_query($connect,"SELECT nm_categoria FROM tb_categoria WHERE cd_categoria = $cdcategoria");

              while($ks = mysqli_fetch_array($procura_categoria)){
                $nmcategoria = $ks['nm_categoria'];
                echo "
                <td>$nmcategoria</td>";
              }
              echo"
              <td>$nmsubcategoria</td>
              ";
              if($ic_funcionario>3){

                echo "
                <td>
                <form method='post' action='alterar_sub-categoria.php'>
                <input type='hidden' name='id_sub_categoria' value='$cdsubcategoria'></input>
                <button class='btn btn-warning'>Editar</button>


                </form>
                </td>




                <td>
                <form method='post' action='item.php'>
                <input type='hidden' name='searchsubcategoria' value='$cdsubcategoria'></input>
                <button class='btn btn-primary'>Vizualizar</button>
                </form>
                </td>

                ";
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