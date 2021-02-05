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

$data = date('Y-m-d');
$dat3 = date('d/m/Y');


?>







<!-- PAGE CONTENT-->
<div class="container bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
        <div class="container">
           <?php echo $empresa; ?> - Procurar Entrega
       </div>
   </section>
   <!-- END BREADCRUMB-->



   <?php


   if(isset($_GET['entrega'])){
    $cd = $_GET['entrega'];
    
    $verifica = mysqli_query($connect,"
        select d.dt_validade, d.cd_sif, d.cd_lote, a.nm_item, b.nm_marca, b.cd_barra, a.cd_uspesp, d.cd_quantidade 
        from tb_entrega_produto as d 
        inner join tb_produto as b on b.cd_produto = d.cd_produto
        inner join tb_item as a on a.cd_item = b.cd_item where d.cd_nfe=$cd;
        ");
    $verifica2 = mysqli_query($connect,"
        select d.dt_entrega
        from tb_entrega as d where d.cd_nfe=$cd;
        ");



    while($uta =mysqli_fetch_array($verifica2)){
        $data5 = $uta['dt_entrega'];
        $data5 =  date_format(date_create($data5),'d/m/Y');

        ?>


        <div class="row mb-5   ">
            <div class="col">
              <p class="h2 text-center mt-3 mb-3  ">Histório de Entrega </p>
              <p class="h5 text-center"><?php echo "Entrega: $data5"; ?></p>
              <table class="table mt-2 text-center">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">SIF</th>
                    <th scope="col">Lote</th>
                    <th scope="col">Dt Validade</th>
                </tr>
            </thead>
            <tbody>

              <?php
              while($ut =mysqli_fetch_array($verifica)){
                $Produto = $ut['nm_item'];
                $Uspesp = $ut['cd_uspesp'];
                $Marca = $ut['nm_marca'];
                $qtd = $ut['cd_quantidade']; 
                $sif = $ut['cd_sif'];
                $dt_validade =$ut['dt_validade'];
                $lote = $ut['cd_lote'];
                $dt =date_format(date_create($dt_validade),'d/m/Y');
                echo " 
                <tr>  
                <td>$Uspesp</td>
                <td>$Produto</td>
                <td>$Marca</td>
                <td>$qtd</td>
                <td>$sif</td>
                <td>$lote</td>
                <td>$dt</td>
                </tr>";




            }
            echo "</tbody>
            </table>";
        }

    }else{

        $verifica = mysqli_query($connect,"select a.cd_nfe, c.nm_fornecedor, a.dt_entrega, a.hr_entrega, b.nm_funcionario from tb_entrega as a inner join tb_funcionario as b on a.cd_funcionario = b.cd_funcionario inner join tb_fornecedor as c on c.cd_fornecedor = a.cd_fornecedor order by a.dt_entrega DESC ;
          ");
          ?>

          <div class="row mb-5   ">
            <div class="col">
                <p class="h2 text-center mb-3  ">Histório de Entrega </p>
              <p class="h5 text-center"><?php echo "Entregas até o dia: $dat3"; ?></p>
              <table class="table mt-2 text-center">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Nota</th>
                    <th scope="col">Fornecedor</th>
                    <th scope="col">Data</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Funcionário</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>

              <?php
              while($ut =mysqli_fetch_array($verifica)){
                $nota = $ut['cd_nfe'];
                $Fornecedor = $ut['nm_fornecedor'];
                $cdentrega = $ut['cd_nfe'];
                $dt = $ut['dt_entrega'];
                $hr = $ut['hr_entrega'];
                $func = $ut['nm_funcionario'];
                $dt =  date_format(date_create($dt),'d/m/Y');
                echo " 
                <tr>  
                <td>$nota</td>
                <td>$Fornecedor</td>
                <td>$dt</td>
                <td>$hr</td>
                <td>$func</td>
                <td><form method='GET'><input type='text'style='display:none' value='$cdentrega' name='entrega'><button class='btn btn-danger' >Ver Produtos</button></form></td>
                </tr>";




            }
            echo "</tbody>
            </table>";

        }



        echo"    
        </div></div>";
        ?>



    </div>


    <?php
    require("footer.php");
    require("script.php");
    ?>