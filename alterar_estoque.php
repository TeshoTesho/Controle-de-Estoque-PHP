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
if($ic_funcionario<4){
  header("Location:home.php");
}


require("head.php");


$cdestoque = $_POST['id_estoque'];
$cdentregaproduto = $_POST['id_entrega_produto'];
$qual = $_GET['tipo'];


echo '
<div class="container bg-light">
<!-- BREADCRUMB-->
<section class="au-breadcrumb2">
<div class="container">
'. $empresa .' - Alterar Estoque
</div>
</section>
';


if($qual==1){

  $verifica = mysqli_query($connect,"select a.cd_item, b.ds_peso, b.cd_medida, a.nm_item, b.nm_marca, d.cd_quantidade, c.dt_validade, d.cd_entrega_produto, d.cd_estoque from tb_item as a inner join tb_produto as b on b.cd_item=a.cd_item inner join tb_entrega_produto as c on c.cd_produto=b.cd_produto inner join tb_estoque as d on d.cd_entrega_produto=c.cd_entrega_produto where d.cd_quantidade>0 order by c.dt_validade asc;");
  ?>

  <div class="row mb-5   ">
    <div class="col">
      <p class="h2 text-center mt-3 mb-3  ">Alterando o estoque do Produto</p>
      <table class="table mt-2">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Produto</th>
            <th scope="col">Peso</th>
            <th scope="col">Marca</th>
            <th scope="col">Em Estoque</th>
            <th scope="col">Data de Validade</th>
            <th scope="col">Ação</th>
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
            $idestoque = $ut['cd_estoque'];
            $identregaproduto = $ut['cd_entrega_produto'];
            $data1 = date_create($dt);
            $data3 = date_create(date("Y-m-d"));
            $data4 = date_diff($data3,$data1)->format('%a');
              //echo "?" . $data4 . ";";

            $procura_medida = mysqli_query($connect,"Select * from tb_unidade_medida where cd_medida=$cdMedida;");
            while($La = mysqli_fetch_array($procura_medida)){
              $medida = $La['cd_simbolo'];
            }

            if($idestoque == $cdestoque && $identregaproduto == $cdentregaproduto){


              echo "<tr class='bg-info text-light'>";
              echo " <form method='post' action='alterar_estoque_confirma.php'>
              <td>$Produto</td>
              <td>$peso $medida</td>
              <td>$Marca</td>
              <td> <input type='number' class='form-control' name='vl_estoque' value='$qtd'></input></td>
              <td ><input type='date' class='form-control' name='vl_data' value='$dt'></input></td>

              <input type='hidden' name='id_estoque' value='$cdestoque'></input>
              <input type='hidden' name='id_entrega_produto' value='$cdentregaproduto'></input>
              <td>";

              if(isset($_POST['mlentrega'])){
                echo "<input type='hidden' name='mlentrega' value='1'></input>";
              }

              echo "<a href=''><button class='btn btn-success btn-small' name='Alt'>Alterar</button></a> </td>
              </form>
              </tr>";






            }else{

              /*
              if($data4<=30){echo "<tr class='bg-danger text-light'> ";}
              elseif($data4<=60){echo "<tr class='bg-warning '>";}
              elseif($data4<=90){echo "<tr class='text-danger'>";}
              elseif($data4>90){echo "<tr>";}



              echo " <td>$Produto</td>
              <td>$peso $medida</td>
              <td>$Marca</td>
              <td>$qtd</td>
              <td >" . date_format(date_create($dt),'d/m/Y') . "</td>";
              echo "</tr>";


            */

            }

          }
          echo "</tbody>
          </table>
          <hr><a href='home.php'>Voltar</a>
          
          </div>
          </div>
          </div>";
        }

        require("footer.php");
        require("script.php");
        ?>

