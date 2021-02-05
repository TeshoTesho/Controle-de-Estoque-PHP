<?php

//Sessão
ob_start();
session_start();
date_default_timezone_set('America/Sao_Paulo');


    //Verificando login
if (!isset($_SESSION['funcionario'])) {
    header("Location:login.php");
    die();
}else{
    $empresa= "USPESP";
    $funcsenha=$_SESSION['funcionario'];
    $funcsenha=$_SESSION['funcionario'];
    $nome_funcionario=$_SESSION['nome'];
    $cd_funcionario=$_SESSION['cd'];
    $ic_funcionario=$_SESSION['ic'];
    if($ic_funcionario<1){
        header("Location:home.php");
    }
}

require("conn.php");
require("head.php");


if (!isset($_POST['searchsubcategoria'])){


   $verifica = mysqli_query($connect,"select c.nm_categoria, b.nm_sub_categoria, a.nm_item, a.cd_item from tb_item as a inner join tb_sub_categoria as b on b.cd_sub_categoria=a.cd_sub_categoria 
    inner join tb_categoria as c on b.cd_categoria = c.cd_categoria ;");

}else{

    $searchsubcategoria = $_POST['searchsubcategoria'];

    $verifica = mysqli_query($connect,"select c.nm_categoria, b.nm_sub_categoria, a.nm_item, a.cd_item from tb_item as a inner join tb_sub_categoria as b on b.cd_sub_categoria=a.cd_sub_categoria 
        inner join tb_categoria as c on b.cd_categoria = c.cd_categoria where b.cd_sub_categoria = $searchsubcategoria;");
}

?>



<!-- PAGE CONTENT-->
<div class="container bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
        <div class="container">
            <?php echo $empresa; ?> - Item
        </div>
        <div class="row mb-5   ">
          <div class="col">
            <p class="h2 text-center mt-3 mb-3  ">Itens</p>
            <?php if($ic_funcionario>3){ ?>
                <form method="post" action="cadastrar_item.php">
                  <?php
                  if(isset($_POST['searchsubcategoria'])){

                    echo "<input type='hidden' name='idsubcategoria' value='$searchsubcategoria'></input>";
                }
                ?>

                <button class="btn btn-success" style="float:right; margin-bottom: 10px" >Adicionar Item</button  >
            </form>
        <?php } ?>

        <input class="form-control" id="myInput" type="text" autocomplete="off" autofocus placeholder="Digite aqui para procurar">
        <br>
        <!-- END BREADCRUMB-->

        <?php
        echo "

        <table class='table mt-2' >
        <thead class='thead-dark'>
        <tr>
        <th scope='col'>Categoria</th>
        <th scope='col'>Sub-Categoria</th>
        <th scope='col'>Item</th>";
        if($ic_funcionario>3){
            echo "<th scope='col' colspan='2'>Ação</th>";
        }
        echo " </tr>
        </thead>
        <tbody id='myTable'>
        ";


        $verificarows= 0+$verifica->num_rows;
        if ($verificarows==0){

            //echo "<script> alert('Nenhum Item'); </script>";
        }else{
         while($uT =mysqli_fetch_array($verifica)){
            $categoria=$uT['nm_categoria'];
            $subcategoria=$uT['nm_sub_categoria'];
            $item=$uT['nm_item'];
            $cditem=$uT['cd_item'];
            echo "<tr class='checkBoxChecked'>
            ";

            echo "<td>
            $categoria
            </td>";
            echo "<td>
            $subcategoria
            </td>";
            echo "<td>
            $item
            </td>";
            if($ic_funcionario>3){
                echo "<td>
                <div class='row'>
                <div class='col'>
                <form method='post' action='alterar_item.php'>
                <input type='hidden' name='item' value='$cditem'> 

                </input><button class='btn btn-warning' title='Cadastrar $categoria $subcategoria $item'>Editar</button>
                </form>
                </div>
                <div class='col'>
                <form method='post' action='cadastrar_produto.php'>
                <input type='hidden' name='item' value='$cditem'> 
                ";
                if(isset($_GET['barra'])){
                    $barra=$_GET['barra'];
                    echo "
                    <input type='hidden' name='barra' value='$barra'>
                    ";
                }
                if(isset($_GET['entrega'])){
                    $entrega=$_GET['entrega'];
                    echo "
                    <input type='hidden' name='entrega' value='$entrega'>
                    ";
                }
                echo "  
                </input><button class='btn btn-info' title='Cadastrar $categoria $subcategoria $item'>Cadastrar</button>
                </form>
                </div>
                </div>
                
                
                

                </td>
                ";
            }
            echo "</tr>
            <!--  Fim form  -->

            ";

        }
    }

    echo "</div>";
    echo '
    <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
          });
          });
          </script>
          </div>
          </div>
          </section>';
          require('script.php');
          ?>