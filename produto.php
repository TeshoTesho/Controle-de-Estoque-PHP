
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

$verifica = mysqli_query($connect,"select * from tb_produto order by cd_item;");
?>
<div class="page-content bg-light">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                     <?php echo $empresa; ?> - Produto

<div class="row mb-5   ">
  <div class="col">
    <p class="h2 text-center mt-3 mb-3  ">Produto</p>
    <a class="btn btn-success" style="float:right; margin-bottom: 10px" href="item.php">Adicionar Produto</a>
    <table class="table mt-2">
      <thead class="thead-dark">
        <tr>

          <th scope="col">Item</th>

          <th scope="col">Marca</th>

          <th scope="col">Código</th>

          <th scope="col">Peso</th>

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
          <td>
          	$nmitem
          </td>
          <td>
          	$nmmarca
          </td>
          <td>
          	$cdbarra
          </td>
          <td>
          	$dspeso$cdsimbolo
          </td>

          ";
          if($ic_funcionario==5){

            echo "
            <td>
            <form method='post' action='alterar_produto.php'>
            <input type='hidden' name='id_produto' value='$cdproduto'></input>
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