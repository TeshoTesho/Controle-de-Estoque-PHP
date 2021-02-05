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
           <?php echo $empresa; ?> - Configurações
       </div>
   </section>
   <!-- END BREADCRUMB-->

   <!-- WELCOME-->
   <section class="welcome p-t-10">
    <div class="container">
        <div class="row">


            <!-- -->
            <div class="col-md-3">
                
                <div class="card border border-primary">
                    <a href="categoria.php" class="link text-dark">
                    <div class="card-header">
                        <strong class="card-title">Categoria</strong>
                    </div>
                </a>
                </div>
            
            </div>
             <div class="col-md-3">
                
                <div class="card border border-primary">
                    <a href="sub-categoria.php" class="link text-dark">
                    <div class="card-header">
                        <strong class="card-title">Sub-Categoria</strong>
                    </div>
                </a>
                </div>
            
            </div>

             <div class="col-md-3">
                
                <div class="card border border-primary">
                    <a href="item.php" class="link text-dark">
                    <div class="card-header">
                        <strong class="card-title">Item</strong>
                    </div>
                </a>
                </div>
            
            </div>
            <?php if($ic_funcionario==5){ ?>
             <div class="col-md-3">
                
                <div class="card border border-primary">
                    <a href="produto.php" class="link text-dark">
                    <div class="card-header">
                        <strong class="card-title">Produto</strong>
                    </div>
                </a>
                </div>
            
            </div>
<?php } ?>

             <div class="col-md-3">
                <div class="card border border-secondary">
                    <a href="unidade_medida.php" class="link text-dark">
                    <div class="card-header">
                        <strong class="card-title">Unidade de Medida</strong>
                    </div>
                </a>
                </div>
            </div>

             <div class="col-md-3">
                <div class="card border border-secondary">
                    <a href="funcionario.php" class="link text-dark">
                    <div class="card-header">
                        <strong class="card-title">Funcionário</strong>
                    </div>
                </a>
                </div>
            </div>


             <div class="col-md-3">
                <div class="card border border-success">
                    <a href="fornecedor.php" class="link text-dark">
                    <div class="card-header">
                        <strong class="card-title">Fornecedor</strong>
                    </div>
                </a>
                </div>
            </div>


            <!-- -->






        </div>

    </div>
</section>

</div>
<!-- END WELCOME-->




<?php
require("footer.php");
require("script.php");
?>