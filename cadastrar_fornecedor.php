
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
  $nmfornecedor = $_POST['nmfornecedor'];
  $cdinscricaoestadual = $_POST['cdinscricao'];
  $cdcnpj = $_POST['cdcnpj'];

  mysqli_query($connect,"INSERT INTO `tb_fornecedor` (`cd_fornecedor`, `nm_fornecedor`, `cd_cnpj`, `cd_incricao_estadual`) VALUES (NULL, '$nmfornecedor', '$cdcnpj', '$cdinscricaoestadual');");
  header("Location:fornecedor.php");

}else{




  ?>
  <div class="page-content bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
      <div class="container">
        <?php echo $empresa; ?> - Adicionar Fornecedor
        <div class="row mb-5   ">
          <div class="col">
            <p class="h2 text-center mt-3 mb-3  ">Fornecedor</p>
            <table class="table mt-2">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">CNPJ</th>
                  <th scope="col">Inscrição Estadual</th>
                  <th scope = 'col'>Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <form method='post' action='cadastrar_fornecedor.php'>
                    <td><input class='form-control ' type='text' value='' name='nmfornecedor' required autofocus></td>
                    <td><input class='form-control ' type='number' value='' required name='cdcnpj'></td>
                    <td><input class='form-control ' type='number' value='' required name='cdinscricao'></td>

                    <td>

                      <input type='hidden' name='id_fornecedor' value='$idfornecedor'></input>
                      <button class='btn btn-success' name='btn'>Cadastrar</button>
                    </td>

                  </form>

                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php
}


require("footer.php");
require("script.php");
?>
