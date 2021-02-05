<?php


require("conn.php");
//Sessão
ob_start();
session_start();
date_default_timezone_set('America/Sao_Paulo');


//Verificando login
if (!isset($_SESSION['funcionario'])) {

}else{

  header("Location:home.php");
  die();

}


$empresa="USPESP";


require("head.php");



?>





    <!-- PAGE CONTENT-->
        <div class="page-content bg-light">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                     <?php echo $empresa; ?> - Indentificação
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <h1 class="title-4">Olá, 
                                <span>Indentifique-se </span>
                               
                            </h1>
                            <hr class="line-seprate">
                        </div>
                        <div class="col-md-9">
                             <form class="au-form-icon--sm w-100"  method="post" style="float:right;">
                                    <input autocomplete="off" id="inputBarra" class=" w-100 au-input--w300 au-input--style2" name="user" id="inputPassword" type="password" placeholder="Escaneie o Código de Barras aqui para se Indentificar!" autofocus>
                                    <button class="au-btn--submit2" name="btn" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>


  <?php

  if (isset($_POST['btn'])) {

    $funcsenha = $_POST['user'];
    $verifica = mysqli_query($connect,"Select * from tb_funcionario where cd_senha = '$funcsenha';");
    $verificarows= 0+$verifica->num_rows;
    echo "linhas: ".$verificarows;
    if ($verificarows==0){

      echo "<script> alert('Nenhum Usuario'); </script>";
      header("Location:login.php");
    }else{
      while($uT =mysqli_fetch_array($verifica)){
        $nome=$uT['nm_funcionario'];
        $cd=$uT['cd_funcionario']; 
        $ic=$uT['ic_acesso']; 

        $_SESSION['funcionario'] = $funcsenha;
        $_SESSION['nome']=$nome;
        $_SESSION['ic']=$ic;
        $_SESSION['cd']=$cd;

        header("Location:home.php");

      }
    }

  }
  ?>

                </div>


<?php
require("footer.php");
require("script.php");
?>