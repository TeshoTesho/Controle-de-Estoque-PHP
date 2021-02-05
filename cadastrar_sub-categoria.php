
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

if(isset($_POST['btn'])){
  $cdcategoria = $_POST['cdcategoria'];
  $nmsubcategoria = $_POST['nmsubcategoria'];
  mysqli_query($connect,"INSERT INTO `tb_sub_categoria` (`cd_sub_categoria`, `nm_sub_categoria`, `cd_categoria`) VALUES (NULL, '$nmsubcategoria', '$cdcategoria');");
  header("Location:sub-categoria.php");

}else{
  if(isset($_POST['idcategoria'])){
   $idcategoria = $_POST['idcategoria'];
  }
  ?>
  <div class="page-content bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
      <div class="container">
        <?php echo $empresa; ?> - Adicionar Sub-Categoria

       <div class="row mb-5   ">
        <div class="col">
          <p class="h2 text-center mt-3 mb-3  ">Sub-Categoria</p>

          <table class="table mt-2">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Categoria</th>
                <th scope="col">Nome Sub-Categoria</th>
                <?php
                if($ic_funcionario>3){
                  echo "<th scope = 'col'>Ações</th>";
                }
                ?>
              </tr>
            </thead>
            <tbody>

              <?php



             

                echo"
                <form method='post' action='cadastrar_sub-categoria.php'>
                

                <td>
                 <select name='cdcategoria' class=' form-control' required>
                 <option selected value=''>Selecione a Sub-Categoria</option>
                ";

                $procura_categoria = mysqli_query($connect,"Select * from tb_categoria");

                while($kc = mysqli_fetch_array($procura_categoria)){
                  $cdcategoria2 = $kc['cd_categoria'];
                  $nmcategoria2 = $kc['nm_categoria'];
                
                echo "
               <option value='$cdcategoria2' ";
               if(isset($idcategoria)){
               if($cdcategoria2 == $idcategoria){
                echo "selected";
               }
             }

               echo ">$nmcategoria2</option>";
                
              }


                  echo "
                  </select>


                  </td>
                <td><input class='form-control' type='text' value='' required name='nmsubcategoria' autofocus></td>
                ";
                if($ic_funcionario>3){

                  echo "
                  <td>

                  <button class='btn btn-success' name='btn'>Adicionar</button></td>
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
