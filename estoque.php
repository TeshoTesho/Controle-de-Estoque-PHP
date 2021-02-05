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

echo '
        <div class="container bg-light">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                     '. $empresa .' - Estoque
                </div>
            </section>
         ';

if(!isset($_POST['id'])){

  $verifica = mysqli_query($connect,"select a.cd_item, b.ds_peso, b.cd_medida, a.nm_item, b.nm_marca, d.cd_quantidade, c.dt_validade, d.cd_entrega_produto, d.cd_estoque from tb_item as a inner join tb_produto as b on b.cd_item=a.cd_item inner join tb_entrega_produto as c on c.cd_produto=b.cd_produto inner join tb_estoque as d on d.cd_entrega_produto=c.cd_entrega_produto where d.cd_quantidade>0 order by c.dt_validade asc;");

  ?>



  <form method='post'></form>
  <div class="row mb-5   ">
    <div class="col">
      <p class="h2 text-center mt-3 mb-3  ">Estoque Por Produto</p>
      <table class="table mt-2">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Produto</th>
            <th scope="col">Peso</th>
            <th scope="col">Marca</th>
            <th scope="col">Em Estoque</th>
            <th scope="col">Data de Validade</th>
            <?php
            if($ic_funcionario==5){
              echo "<th scope = 'col'>Ações</th>";
            }
            ?>
            <!--<th scope="col">Ações</th>-->
          </tr>
        </thead>
        <tbody>

          <?php


          while($ut =mysqli_fetch_array($verifica)){
            $Produto = $ut['nm_item'];
            $dt = $ut['dt_validade'];
            $Marca = $ut['nm_marca'];
            $qtd = $ut['cd_quantidade'];
            $peso = $ut['ds_peso'];
            $cdMedida = $ut['cd_medida'];
            $cdestoque = $ut['cd_estoque'];
            $cdentregaproduto = $ut['cd_entrega_produto'];
            $data1 = date_create($dt);
            $data3 = date_create(date("Y-m-d"));
            $data4 = date_diff($data3,$data1)->format('%a');
              //echo "?" . $data4 . ";";



            if($data4<=30){echo "<tr class='bg-danger text-light'> ";}
            elseif($data4<=60){echo "<tr class='bg-warning '>";}
            elseif($data4<=90){echo "<tr class='text-danger'>";}
            elseif($data4>90){echo "<tr>";}


            echo " <td>$Produto</td>
            <td>$peso";

            
            $procura_medida = mysqli_query($connect,"Select * from tb_unidade_medida where cd_medida=$cdMedida;");
            while($La = mysqli_fetch_array($procura_medida)){
              $Medida = $La['cd_simbolo'];
              echo "$Medida";
            }

            echo "</td>
            <td>$Marca</td>
            <td>$qtd</td>
            <td >" . date_format(date_create($dt),'d/m/Y') . "</td>
            
            <!-- <td><a href=''><button class='btn btn-info btn-small' name='Alt'>Alt</button></td></a> -->
            ";
            if($ic_funcionario==5){

              echo "
              <td>
              <form method='post' action='alterar_estoque.php?tipo=1'>
              <input type='hidden' name='id_estoque' value='$cdestoque'></input>
              <input type='hidden' name='id_entrega_produto' value='$cdentregaproduto'></input>
              <button class='btn btn-warning'>Editar</button></td>
              </form>";
            }



            echo "</tr>";




          }
          echo "</tbody>
          </table>
          
          </div>
          </div>";
        }else{

          $verifica = mysqli_query($connect," select a.nm_item, sum(b.cd_quantidade*c.ds_peso) as cd_quantidade, sum(b.cd_quantidade) as cd_unidade, c.cd_medida from tb_item as a inner join tb_produto as c on c.cd_item=a.cd_item inner join tb_entrega_produto as d on d.cd_produto=c.cd_produto inner join tb_estoque as b on b.cd_entrega_produto=d.cd_entrega_produto where b.cd_quantidade>0 group by a.nm_item;");
          


          ?>
          <form method='post'></form>
          <div class="row mb-5   ">
            <div class="col">
              <p class="h2 text-center mt-3 mb-3  ">Estoque Por Item</p>
              <table class="table mt-2">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Em Estoque</th>
                    <th scope="col">Unidades</th>
                    <!-- <th scope="col">Ações</th> -->
                  </tr>
                </thead>
                <tbody>

                  <?php

                  while($ut =mysqli_fetch_array($verifica)){  
                    $Produto = $ut['nm_item'];
                    $qtd = $ut['cd_quantidade'];
                    $cdMedida = $ut['cd_medida'];
                    $unidade = $ut['cd_unidade'];
                    echo " 
                    <tr>  
                    
                    <td>$Produto</td>";
                    $procura_medida = mysqli_query($connect,"Select * from tb_unidade_medida where cd_medida=$cdMedida;");
                    while($La = mysqli_fetch_array($procura_medida)){
                      $Medida = $La['cd_simbolo'];
                      echo "
                    <td>$qtd $Medida</td>
                      <td>$unidade</td>";
                    }
                    echo"
                    <!-- <td><button class='btn btn-info btn-small'>Baixa</button></td> -->
                    </tr>";

                  }
                  echo "</tbody>
                  </table>
                  </div>
                  </div>";
                }


                echo "</div>";


                require("footer.php");
                require("script.php");
                ?>

