
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

$verifica = mysqli_query($connect,"select * from tb_categoria;");
?>
<div class="page-content bg-light">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                     <?php echo $empresa; ?> - Categoria

<div class="row mb-5">
  <div class="col">
    <p class="h2 text-center mt-3 mb-3  ">Categoria</p>
    <?php if($ic_funcionario>3){ ?>
    <a class="btn btn-success" style="float:right; margin-bottom: 10px" href="cadastrar_categoria.php">Adicionar Categoria</a>
   <?php } ?>
    <table class="table mt-2">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Nome</th>
          <?php
          if($ic_funcionario>3){
            echo "<th colspan='2' scope = 'col-2'>Ações</th>";
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
          <td class='col-6'>$nome</td>
          ";
          if($ic_funcionario>3){

            echo "
            <td class='col-3'>
            <form method='post' action='alterar_categoria.php'>
            <input type='hidden' name='id_categoria' value='$cdcategoria'></input>
            
            <button class='btn btn-warning'>Editar</button>
            </form
            </td>


            <td class='col-3'>
            <form method='post' action='sub-categoria.php'>
            <input type='hidden' name='searchcategoria' value='$cdcategoria'></input>
            
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