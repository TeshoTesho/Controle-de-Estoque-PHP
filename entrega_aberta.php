
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
if($ic_funcionario<2){
  header("Location:home.php");
}

require("head.php");

?>
<div class="page-content bg-light">
  <!-- BREADCRUMB-->
  <section class="au-breadcrumb2">
    <div class="container">
     <?php echo $empresa; ?> - Entregas Abertas

     <div class="row mb-5   ">
      <div class="col">
        <p class="h2 text-center mt-3">Entrega</p>
        <p class="h6 text-center mb-3">
          <?php
          if($num_notify==0){
            echo "Não Há entregas Abertas";
          }else{
            echo "Você possui ";

            echo "<a class='h4'>" . $num_notify . "</a>";
            if($num_notify==1){
              echo " entrega aberta";
            }else{
              echo " entregas abertas";
            }
          }
          ?>
        </p>
        <?php if($ic_funcionario>3){ ?>
        <a class="btn btn-success" style="float:right; margin-bottom: 10px" href="entrega.php">Adicionar Entrega</a>
      <?php } ?>
      </div>
    </div>

  </div>



  <div class="row ml-1">



    <?php

    $verifica_entrega = mysqli_query($connect,"select * from tb_entrega where ic_entrega=0 order by `dt_entrega`");

    while($ol = mysqli_fetch_array($verifica_entrega)){
      $cd = $ol['cd_nfe'];
      $cdfornecedor = $ol['cd_fornecedor'];
      $dataentrega = $ol['dt_entrega'];
      $verifica_fornecedor = mysqli_query($connect,"select * from tb_fornecedor where cd_fornecedor = $cdfornecedor");
      while ($pl = mysqli_fetch_array($verifica_fornecedor)) {
        $fornecedor = $pl['nm_fornecedor'];
        if($ic_funcionario>=2){
          echo "<form method='post' action='entrega.php?entrega=$cd'>
          </form>";
          ?>
          

    <div class="col-md-4 mt-1 mb-1">
      <?php echo "<a href='entrega.php?entrega=$cd' class='link text-dark'>"; ?>
      <div class="card border border-warning">
        <div class="card-header">
          <div class="notifi__item">
            <div class="bg-c3 img-cir img-40 mt-1">
              <i class="zmdi zmdi-truck"></i>
            </div>
            <div class="content">
              <p><strong class="card-title h2 "><?php echo $fornecedor; ?></strong> </p>
              <span class="date">Data: <?php echo date_format(date_create($dataentrega),'d/m/Y'); ?> - Nota: <?php echo $cd; ?> </span>
            </div>
          </div>
        </div>
        <div class="card-body">
          <p class="card-text">
            <?php
            if($cdfornecedor = '1'){
              echo "Há um balanço de $fornecedor que não foi finalizado";
            }else{
              echo "Há uma entrega do fornecedor: $fornecedor, que não foi finalizada";
          }
            ?>
            

          </p>
          
        </div>
      </div>
    </a>
    </div>

          <?php


        }

      }
    }


    ?>





  </div>



</section>
</div>

<?php
require("footer.php");
require("script.php");
?>