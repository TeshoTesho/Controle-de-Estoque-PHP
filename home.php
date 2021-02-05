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
                     <?php echo $empresa; ?> - Tela Inicial
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
                             <form class="au-form-icon--sm w-100" action="buscar.php" method="post" style="float:right;">
                                    <input autocomplete="off" class=" w-100 au-input--w300 au-input--style2" name='barra' type="text" autofocus placeholder="Escaneie o Código de Barras, Aqui!">
                                    <button class="au-btn--submit2" name='btn' type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->


</div>


<?php
require("footer.php");
require("script.php");
?>