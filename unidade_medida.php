
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

$verifica = mysqli_query($connect,"select * from tb_unidade_medida;");
?>
<div class="page-content bg-light">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                     <?php echo $empresa; ?> - Unidades De Medida

<div class="row mb-5   ">
  <div class="col">
    <p class="h2 text-center mt-3 mb-3  ">Unidades de Medida</p>
    <?php if($ic_funcionario>3){ ?>
    <a class="btn btn-success" style="float:right; margin-bottom: 10px" href="cadastrar_medida.php">Adicionar Unidade de Medida</a>
  <?php } ?>
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
          <td>$nome</td>
          <td>$simbolo</td>
          ";
          if($ic_funcionario>3){

            echo "
            <td>
            <form method='post' action='alterar_medida.php'>
            <input type='hidden' name='id_medida' value='$cdmedida'></input>
            <button class='btn btn-warning'>Editar</button></td>
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