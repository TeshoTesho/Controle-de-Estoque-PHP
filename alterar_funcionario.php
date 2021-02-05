
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
if($ic_funcionario<5){
  header("Location:home.php");
}

require("head.php");

$cdfuncionario = $_POST['id_funcionario'];
if(isset($_POST['btn'])){
  $nmfuncionario = $_POST['nome_funcionario'];
  $idfuncionario = $_POST['id_funcionario'];
  $senha = $_POST['senha'];
  $acesso = $_POST['ic_acesso'];

  
  mysqli_query($connect,"UPDATE `tb_funcionario` SET `nm_funcionario` = '$nmfuncionario',cd_senha = '$senha', ic_acesso = '$ic_acesso' WHERE `cd_funcionario` = '$idfuncionario';");
  header("Location:funcionario.php");

}elseif (isset($_POST['apaga'])){

  $idfuncionario = $_POST['id_funcionario'];


  mysqli_query($connect,"DELETE FROM `tb_funcionario` WHERE cd_funcionario ='$idfuncionario';");
  header("Location:funcionario.php");
}else{


  $verifica = mysqli_query($connect,"select * from tb_funcionario where cd_funcionario = $cdfuncionario;");

  ?>
  <div class="page-content bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
      <div class="container">
        <?php echo $empresa; ?> - Alterar Funcionario

       <div class="row mb-5   ">
        <div class="col">
          <p class="h2 text-center mt-3 mb-3  ">Funcionario</p>

          <table class="table mt-2">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Nivel de acesso</th>
                <th scope="col">Senha</th>
                <?php
                if($ic_funcionario==5){
                  echo "<th scope = 'col'>Ações</th>";
                }
                ?>
              </tr>
            </thead>
            <tbody>

              <?php



              while($ut =mysqli_fetch_array($verifica)){
                $cdfunc = $ut['cd_funcionario'];
                $nmfunc = $ut['nm_funcionario'];
                $acessofunc = $ut['ic_acesso'];
                $senhafunc = $ut['cd_senha'];

                echo"
                <form method='post' action='alterar_funcionario.php'>
                <td><input class='form-control ' type='text' value='$nmfunc' name='nome_funcionario'></td>
                <td>
                <select class='form-control'  name='ic_acesso' required>
                <option value=''>Selecione o nivel de acesso</option>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>Acesso Máximo</option>
                </select>
                </td>
                <td><input type='password' class='form-control' value='$senhafunc' name='senha'></td>
                ";
                if($ic_funcionario==5){

                  echo "
                  <td>

                  <input type='hidden' name='id_funcionario' value='$cdfunc'></input>
                  <button class='btn btn-warning' name='btn'>Editar</button>

                  <button class='ml-4 btn btn-danger' name='apaga'>Apagar</button></td>

                  </form>";
                }



                echo "</tr>";



              }
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
