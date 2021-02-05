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

<?php if($ic_funcionario>2){ ?>





    <!-- PAGE CONTENT-->
    <div class="container bg-light">
        <!-- BREADCRUMB-->
        <section class="au-breadcrumb2">
            <div class="container">
               <?php echo $empresa; ?> - Cadastro Entrega
           </div>
       </section>
       <!-- END BREADCRUMB-->


       <?php
       $fornecedores = mysqli_query($connect,"select * from tb_fornecedor;");



       if (isset($_GET['entrega'])) {
        $entrega=$_GET['entrega'];
    //echo $entrega;
        $verifica2 = mysqli_query($connect,"select * from tb_entrega where cd_nfe=$entrega;");
        while($n2a = mysqli_fetch_array($verifica2)){
            $ic = $n2a['ic_entrega'];
            if($ic==1){
                header("Location:home.php");
                die();
            }
        }
    }

    if(isset($_POST['finalizar'])){
        $entrega=$_POST['entrega'];
        $finaliza = mysqli_query($connect,"UPDATE tb_entrega SET ic_entrega='1' WHERE cd_nfe = '$entrega';");
    //echo "UPDATE tb_entrega SET ic_entrega='1' WHERE cd_nfe = '$entrega';";
        header("Location:home.php");
        unset($_POST['finalizar']);
        die();

    }



    ?>



    <form class="form-signin" method="post" action="entrega.php">

        <h1 class="h3 mb-3 font-weight-normal">

            <?php
            if(isset($_GET['entrega'])){
                $entrega = $_GET['entrega'];
                $procura = mysqli_query($connect,"select * from tb_entrega as a inner join tb_fornecedor as b on b.cd_fornecedor=a.cd_fornecedor where a.cd_nfe=1");
                while($mn = mysqli_fetch_array($procura)){
                    $fornecedor = $mn['nm_fornecedor'];
                    $nota = $mn['cd_nfe'];
                    if($fornecedor == 'Estoque'){
                        echo "Balanço de $fornecedor no dia $dataf"; 
                    }else{
                        echo "Entrega de: $fornecedor no dia $dataf as $horaf";
                    }
                }
            }else{
                echo '<p class="h2 text-center mt-3 mb-3  ">Cadastro de Entrega</p>';
            }
            ?>


        </h1>

        <?php
        echo " <div class='form-group'>
        <div class='row'>
        <div class='col'>
        <label for='inputState'>Selecione o fornecedor</label>
        <select name='fornecedor' class='form-control'";
        if(isset($_GET['entrega'])){echo "disabled>";
    }else{
        echo " autofocus>";
    }
    $fornecedores = mysqli_query($connect,"select * from tb_fornecedor;");

    while($ua = mysqli_fetch_array($fornecedores)){
        $nome_fornecedor = $ua['nm_fornecedor'];
        $cd_fornecedor = $ua['cd_fornecedor'];
        if($cd_fornecedor==1){

            if($ic_funcionario>3){

                echo "<option value='$cd_fornecedor'";     
            }
        }else{

            echo "<option value='$cd_fornecedor'";
        }

        if(isset($_GET['entrega'])){
            $tet = mysqli_query($connect,"select * from tb_entrega where cd_nfe=$entrega Limit 1");
            $tetrow = 0+$tet->num_rows;
            if($tetrow==1){
                while($re = mysqli_fetch_array($tet)){
                    $f = $re['cd_fornecedor'];
                    if($cd_fornecedor==$f){
                        echo " selected ";
                    }
                }
            }

        }           
        echo ">$nome_fornecedor</option>";
    }

    echo "</select></div>";

    echo "<div class='col'>
    <label >Número da Nota </label><input type='number' class='form-control' required placeholder='Número da NFº' name='nfe' ";
    if(isset($_GET['entrega'])){

        $tet = mysqli_query($connect,"select * from tb_entrega where cd_nfe=$entrega Limit 1");
        $tetrow = 0+$tet->num_rows;
        if($tetrow==1){
            while($re = mysqli_fetch_array($tet)){
                $nota = $re['cd_nfe'];
                echo "disabled "; echo "value='$nota'";
            }
        }



    }echo "></div>";

    if (!isset($_GET['entrega'])) {
        echo '<div class="col"> 
        <label >Ação </label></br>
        <button class="form-btn btn text-center btn-success" name="btn" type="submit">Adicionar</button>

        </div>
        </form>';
    }else{
        ?>
        <div class="col"><form method="post" ><?php echo "<input style='display:none' value='$entrega' name='entrega'></input>"; ?> <label>Clique para Finalizar</label> <button name="finalizar" class="btn btn-block btn-danger">Finalizar </button></form></div>


        <?php
    }
    ?>

</div>
</div>




<?php

if (isset($_GET['entrega'])) {
    $entrega=$_GET['entrega'];
    //echo $entrega;
    $ksda = mysqli_query($connect,"select * from tb_entrega where cd_nfe=$entrega");
    $row = 0+$ksda->num_rows;
    if($row==0){header("Location:home.php");die();}
    ?>


    <form class="form-signin" method="post" action=<?php echo "'buscar_entrega.php?entrega=$entrega'"; ?>>
       <div class="row mt-5">
        <div class="col-md-3">
            <h1 class="title-4">
                <span>Scanear!</span>

            </h1>
            <hr class="line-seprate">
        </div>
        <div class="col-md-9">

            <input autocomplete="off"  id="inputBarra" class=" w-100 au-input--w300 au-input--style2" type="text" name="barra" required placeholder="Escaneie o Código de Barras aqui para inseir o produto na entrega!" autofocus>
            <button class="au-btn--submit2" name="btn" type="submit">
                <i class="zmdi zmdi-search"></i> 
            </button> 
        </div>
    </div>

</form>


<?php
}else{
    if(isset($_POST['btn'])){
        $cd_fornecedor = $_POST['fornecedor'];
        $nfe = $_POST['nfe'];

        $data = date('Y-m-d');
        $hora = date('H:m:s');
        //echo "$data e $hora";

        $insere = mysqli_query($connect,"insert into tb_entrega value('$nfe', '$data', '$hora',0, '$cd_funcionario', '$cd_fornecedor');");

        $procura = mysqli_query($connect,"SELECT * FROM `tb_entrega` WHERE `dt_entrega` = '$data' AND `hr_entrega` = '$hora'");
        echo "SELECT * FROM `tb_entrega` WHERE `dt_entrega` = '$data' AND `hr_entrega` = '$hora'";
        while($fn = mysqli_fetch_array($procura)){
            $cdentrega = $fn['cd_nfe'];
            $nota = $fn=['cd_nfe'];

            echo $cdentrega;
            header("Location:entrega.php?entrega=$cdentrega");

        }

    }

}





if(isset($_GET['entrega'])){


    $verifica = mysqli_query($connect,"select * from tb_item as a inner join tb_produto as b on b.cd_item=a.cd_item inner join tb_entrega_produto as c on c.cd_produto=b.cd_produto inner join tb_estoque as d on d.cd_entrega_produto=c.cd_entrega_produto 
        inner join tb_entrega as f on f.cd_nfe=c.cd_nfe where d.cd_quantidade>0 and f.cd_nfe=$entrega order by c.cd_entrega_produto desc;");
        ?>


        <div class="row mb-5   ">
            <div class="col">
                <p class="h2 text-center mt-3 mb-3  ">Produtos Inseridos</p>
                <table class="table mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Produto</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Em Estoque</th>
                            <th scope="col">Data de Validade</th>
                            <?php if($ic_funcionario>3){ ?>
                                <th scope="col">Ação</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php


                        while($ut =mysqli_fetch_array($verifica)){
                            $Produto = $ut['nm_item'];
                            $dt = $ut['dt_validade'];
                            $Marca = $ut['nm_marca'];
                            $qtd = $ut['cd_quantidade'];
                            $cdestoque = $ut['cd_estoque'];
                            $cdentregaproduto = $ut['cd_entrega_produto'];
                            $data1 = date_create($dt);
                            $data3 = date_create(date("Y-m-d"));
                            $data4 = date_diff($data3,$data1)->format('%a');
                            echo "<tr>";
                            echo " <td>$Produto</td>
                            <td>$Marca</td>
                            <td>$qtd</td>
                            <td >" . date_format(date_create($dt),'d/m/Y') . "</td>";
                            

                            if($ic_funcionario>3){

                              echo "
                              <td>
                              <form method='post' action='alterar_estoque.php?tipo=1'>
                              <input type='hidden' name='id_estoque' value='$cdestoque'></input>
                              <input type='hidden' name='id_entrega_produto' value='$cdentregaproduto'></input>
                              <input type='hidden' name='mlentrega' value='1'></input>
                              <button class='btn btn-warning'>Editar</button></td>
                              </form>";
                          }
                          echo "</tr>";




                      }
                      echo "</tbody>
                      </table>    
                      </div>
                      </div>";
                  }


                  ?>
              </div>
          </div>
      </div>


      <?php
  }else{header("Location:home.php");
  ?>


  <?php
}
require("footer.php");
require("script.php");
?>