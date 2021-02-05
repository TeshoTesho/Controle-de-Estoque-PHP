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


require("head.php");


$data1 = date('Y-m-d');

   if(isset($_POST['databtn'])){
      $data  = date_format(date_create($_POST['dataipn']),'Y-m-d');
  }else{
      $data = $data1;
  }

  $dat3 = date_format(date_create($data),'d/m/Y');
  
if(isset($_POST['apagar'])){
  $cdbaixa = $_POST['cdbaixa'];
  $procura_baixa = mysqli_query($connect,"Select * FROM `tb_baixa` WHERE `tb_baixa`.`cd_baixa` = '$cdbaixa'");
  while($xi = mysqli_fetch_array($procura_baixa)){
    $cdestoque = $xi['cd_estoque'];
    $cdqtd = $xi['cd_quantidade'];
    $voltaestoque = mysqli_query($connect,"UPDATE `tb_estoque` SET `cd_quantidade` = cd_quantidade + $cdqtd WHERE `cd_estoque` = $cdestoque;");
  }
  $delbaixa = mysqli_query($connect,"DELETE FROM `tb_baixa` WHERE `tb_baixa`.`cd_baixa` = '$cdbaixa'");
  
 }

?>







<!-- PAGE CONTENT-->
<div class="container bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
        <div class="container">
            <div class="row">
                <div class="col">
                     <?php echo $empresa; ?> - Histórico de Baixas
                </div>
                <div class="col">
                    <?php 
                        
  echo "
  <form method='post'>
  <div class='row '>
  <div class='col'>
  <input class='form-control' name='dataipn' type='date' value='$data'>
  </div> 
  <div = class='col'> 
  <button name='databtn' class='form-btn btn btn-danger'>Confirmar</button>
  </div>
  </div>
  <form>";
                    ?>
                </div>
            </div>
          
       </div>
   </section>
   <!-- END BREADCRUMB-->

   <?php




  $verifica = mysqli_query($connect,"select d.cd_baixa, a.nm_item, b.nm_marca, b.cd_barra, a.cd_uspesp, d.cd_quantidade, e.nm_funcionario, d.dt_baixa, d.hr_baixa 
      from tb_baixa as d 
      inner join tb_produto as b on b.cd_produto = d.cd_produto
      inner join tb_funcionario as e on d.cd_funcionario = e.cd_funcionario
      inner join tb_item as a on a.cd_item = b.cd_item where d.dt_baixa = '$data' and d.cd_quantidade > 0;
      ");
      ?>

      <div class="row mb-5   ">
        <div class="col">
          <p class="h2 text-center mb-3  ">Histório de baixa </p>
          <p class="h5 text-center"><?php echo "Baixas do dia: <a class='text-danger'>$dat3</a>"; ?></p>
          <table class="table mt-2 text-center">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Produto</th>
                <th scope="col">Marca</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Data</th>
                <th scope="col">Hora</th>
                <th scope="col">Funcionário</th>

                <?php
                if($ic_funcionario>3){
                	echo '<th scope="col">Ações</th>';

                }
                ?>
            </tr>
        </thead>
        <tbody>

          <?php
          while($ut =mysqli_fetch_array($verifica)){
            $Produto = $ut['nm_item'];
            $Uspesp = $ut['cd_uspesp'];
            $dt = $ut['dt_baixa'];
            $hr = $ut['hr_baixa'];
            $Marca = $ut['nm_marca'];
            $qtd = $ut['cd_quantidade'];
            $func = $ut['nm_funcionario'];
            $cdbaixa = $ut['cd_baixa'];
            $dt =  date_format(date_create($dt),'d/m/Y');
            echo " 
            <tr>  
            <td>$Uspesp</td>
            <td>$Produto</td>
            <td>$Marca</td>
            <td>$qtd</td>
            <td>$dt</td>
            <td>$hr</td>
            <td>$func</td>
            <td>";
            if($ic_funcionario>3){
            	echo "
            <form method='post' action='logbaixa.php'>
            <input name='cdbaixa' type='hidden' value='$cdbaixa'></input>
            <button class='btn btn-danger' name='apagar'>Apagar</button>
            </form>
            </td>";
            }
            echo"
            </tr>";




        }
        echo "</tbody>
        </table>
        </div></div>";
        ?>

    </div>


    <?php
    require("footer.php");
    require("script.php");
    ?>