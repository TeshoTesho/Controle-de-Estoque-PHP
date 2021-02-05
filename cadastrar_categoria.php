
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

if(isset($_POST['btn'])){
  $nmcategoria = $_POST['nmcategoria'];
  mysqli_query($connect,"INSERT INTO `tb_categoria` (`cd_categoria`, `nm_categoria`) VALUES (NULL, '$nmcategoria');");
  header("Location:categoria.php");

}else{
 
  ?>
  <div class="page-content bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
      <div class="container">
        <?php echo $empresa; ?> - Adicionar Categoria

       <div class="row mb-5   ">
        <div class="col">
          <p class="h2 text-center mt-3 mb-3  ">Categoria</p>

          <table class="table mt-2">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nome</th>
                <th scope = 'col'>Ações</th>
              </tr>
            </thead>
            <tbody>

              <?php



             

                echo"
                <form method='post' action='cadastrar_categoria.php'>
                <td><input class='form-control ' type='text' value='' required name='nmcategoria' autofocus></td>
                ";

                  echo "
                  <td>

                  <button class='btn btn-success' name='btn'>Adicionar</button></td>
                  </form>";
                



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
