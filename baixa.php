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



?>







        <!-- PAGE CONTENT-->
        <div class="page-content bg-light">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                     <?php echo $empresa; ?> - Baixa
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <h1 class="title-4">Olá, 
                                <span><?php echo $nome_funcionario ?>!</span>
                               
                            </h1>
                            <hr class="line-seprate">
                        </div>
                        <div class="col-md-9">
                             <form class="au-form-icon--sm w-100" action="baixa.php" method="post" style="float:right;">

                                    <input autocomplete="off" id="inputBarra" class=" w-100 au-input--w300 au-input--style2" type="text" name="barra" placeholder="Escaneie o Código de Barras aqui para dar BAIXA!" autofocus required 
                                   >


                                    <button class="au-btn--submit2" name="btn" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                        </div>



                        <?php

if(isset($_POST['btn2'])){
    $barra= $_POST['barra'];
    $cd = $_POST['cd'];
    $qtd = $_POST['qtd'];
    $data = date('Y-m-d');
    $hora = date('H:i:s');
    //echo "insert into tb_baixa value(NULL,'$cd','$qtd','$CD','$data','$hora');";


    $Procurar = mysqli_query($connect,"
        select d.cd_entrega_produto, a.nm_item, b.nm_marca, d.cd_quantidade, date_format(c.dt_validade, '%d/%m/%Y') from tb_item as a 
        inner join tb_produto as b on b.cd_item=a.cd_item 
        inner join tb_entrega_produto as c on c.cd_produto=b.cd_produto 
        inner join tb_estoque as d on d.cd_entrega_produto=c.cd_entrega_produto 
        where b.cd_barra = $barra and d.cd_quantidade > 0 ORDER BY c.dt_validade asc limit 1;");
    while($bn = mysqli_fetch_array($Procurar)) {
        $cdentrega = $bn['cd_entrega_produto'];
        
        $procura_estoque = mysqli_query($connect,"select * from tb_estoque where cd_entrega_produto = '$cdentrega';");
        while($mK = mysqli_fetch_array($procura_estoque)){
            $cdestoque = $mK['cd_estoque'];
            
            
            $baixa = mysqli_query($connect,"insert into tb_baixa value(NULL,'$cd','$qtd','$cd_funcionario','$data','$hora','$cdestoque','0');");
            //echo "insert into tb_baixa value(NULL,'$cd','$qtd','$cdf','$data','$hora','$cdestoque');";
            
            $estoque = mysqli_query($connect," update tb_estoque set cd_quantidade = cd_quantidade-$qtd where cd_entrega_produto = $cdentrega;");

        }

        
    }
    
    //header("Location:baixa.php");

}else{
    if(isset($_POST['btn'])){
        $barra = $_POST['barra']; 
        $verifica = mysqli_query($connect,"select *
            from tb_item as a 
            inner join tb_produto as b on b.cd_item=a.cd_item 
            inner join tb_entrega_produto as c on c.cd_produto=b.cd_produto 
            inner join tb_estoque as d on d.cd_entrega_produto=c.cd_entrega_produto 
            inner join tb_sub_categoria as f on f.cd_sub_categoria=a.cd_sub_categoria
            where b.cd_barra = $barra and d.cd_quantidade > 0 ORDER BY c.dt_validade asc limit 1;");
        $verificarows= 0+$verifica->num_rows;
        if($verificarows==0){
            echo "<p class='h2 text-center mt-5'>Item fora de estoque</p>";
            echo "<script>document.getElementById('inputBarra').focus();</script>";


        }else{
            echo "
            <table class='table'>

             <thead class='thead-dark'>
            <tr>
            <th scope='col'>#</th>
            <th scope='col'>Codigo</th>
            <th scope='col'>Item</th>
            <th scope='col'>Marca</th>
            <th scope='col'>Peso</th>
            <th scope='col'>Quantidade</th>
            <th scope='col'></th>
            </tr>
            </thead>
            <tbody>";
            while($ut =mysqli_fetch_array($verifica)){
                $Item = $ut['nm_item'];
                $Categoria = $ut['nm_sub_categoria'];
                $Marca = $ut['nm_marca'];
                $barra = $ut['cd_barra'];
                $Uspesp = $ut['cd_uspesp'];
                $cdmedida = $ut['cd_medida'];
                $Peso = $ut['ds_peso'];
                $cdproduto = $ut['cd_produto'];
                $estoque = $ut['cd_quantidade'];
                echo "<form method='post'>
                <tr>
                <th scope='row'>$cdproduto<input name='cd' style='display:none' value='$cdproduto' required></input><input name='barra' style='display:none' value='$barra'></input></th>
                <td>$Uspesp</td>
                <td>$Item</td>
                <td>$Marca</td>
                <td>$Peso ";
                $procura_medida = mysqli_query($connect,"Select * from tb_unidade_medida where cd_medida=$cdmedida;");
                while($La = mysqli_fetch_array($procura_medida)){
                    $Medida = $La['cd_simbolo'];
                    echo "
                    $Medida";
                }

                echo "</td>


                <td><input type='number' class='form-control' min='1' max='$estoque' name='qtd' placeholder='Digite a Quantidade' autofocus   value='1' required></input></td>

                <td><button name='btn2' class='btn btn-primary'>Baixa</button></td>
                </tr>
                </form>";



            }
            echo "
            </tbody>
            </table>";
        }
    }   
}
                        ?>

                    </div>
                </div>
            </section>
        </div>
            <!-- END WELCOME-->




<?php
require("footer.php");
require("script.php");
?>