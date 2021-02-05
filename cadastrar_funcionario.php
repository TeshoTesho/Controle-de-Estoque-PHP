
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

if(isset($_POST['btn'])){
  $nmfuncionario = $_POST['nmfuncionario'];
  $icacesso = $_POST['icacesso'];
  $cdsenha = $_POST['cdsenha'];
  $cadastra = mysqli_query($connect, "INSERT INTO `tb_funcionario` (`cd_funcionario`, `nm_funcionario`, `ic_acesso`, `cd_senha`) VALUES (NULL, '$nmfuncionario', '$icacesso', '$cdsenha');");

  header("Location:funcionario.php");

}else{
 
  ?>
  <div class="page-content bg-light">
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb2">
      <div class="container">
        <?php echo $empresa; ?> - Adicionar Funcionario

       <div class="row mb-5   ">
        <div class="col">
          <p class="h2 text-center mt-3 mb-3  ">Unidades de Medida</p>

          <table class="table mt-2">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Nivel de Acesso</th>
                <th scope="col">Senha</th>
                <?php                  
                echo "<th scope = 'col'>Ações</th>";
                
                ?>
              </tr>
            </thead>
            <tbody>

              <?php



             

                echo"
                <form method='post' action='cadastrar_funcionario.php'>
                <td><input class='form-control ' type='text' value='' name='nmfuncionario' autofocus required></td>
                <td><select name='icacesso' class='form-control' required>
                <option value='' selected> Selecione o nivel de acesso</option>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>Acesso total</option>

                </select>
                </td>
                <td><input class='form-control' type='password' value='' name='cdsenha' required></td>
                ";
                if($ic_funcionario==5){

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
