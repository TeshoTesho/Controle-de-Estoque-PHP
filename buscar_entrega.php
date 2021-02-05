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
        <div class="container bg-light">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                     <?php echo $empresa; ?> - Cadastro Entrega
                </div>
            </section>
            <!-- END BREADCRUMB-->




<form class="form-signin" method="post" action="">
    <h1 class="h3 mb-3 font-weight-normal mt-3">Preencha os dados do Produto</h1>
    <div class="row">
        
        <?php


        if (isset($_GET['entrega'])) {
            $entrega=$_GET['entrega'];



            if(isset($_POST['btn2'])){
                $cdproduto = $_POST['cdproduto'];
                $qtd = $_POST['qtd'];
                $dtvalidade = $_POST['dtvalidade'];
                $sif = $_POST['sif'];
                $lote = $_POST['lote'];
                $datag =date_format(date_create($dtvalidade),'Y-m-d');
                //echo $datag;
                if(!isset($_POST['sif'])){
                    $sif = 0;}
                //echo $sif;


        //echo $dtvalidade;

                    $verifica = mysqli_query($connect,"select * from tb_entrega_produto where cd_nfe=$entrega and dt_validade='$dtvalidade' and cd_produto=$cdproduto ");
                    $verificarows= 0+$verifica->num_rows;
                    if($verificarows==0){
            //echo "não cadastrado"; 


                    //echo "insert into tb_entrega_produto value(NULL,1,$datag,$cdproduto,$qtd);";


                        $set = mysqli_query($connect,"INSERT INTO tb_entrega_produto (cd_entrega_produto, cd_nfe, dt_validade, cd_produto, cd_quantidade, cd_sif,cd_lote) VALUES (NULL, '$entrega', '$dtvalidade', '$cdproduto', '$qtd','$sif','$lote');"); 

                        //echo "INSERT INTO tb_entrega_produto (cd_entrega_produto, cd_nfe, dt_validade, cd_produto, cd_quantidade, cd_sif,cd_lote) VALUES (NULL, '$entrega', '$dtvalidade', '$cdproduto', '$qtd','$sif','$lote');<br>";
                        //die();


                        $verifica2 = mysqli_query($connect,"select * from tb_entrega_produto where cd_nfe=$entrega and dt_validade='$dtvalidade' and cd_produto=$cdproduto and cd_quantidade=$qtd");
                        //echo "select * from tb_entrega_produto where cd_nfe=$entrega and dt_validade='$dtvalidade' and cd_produto=$cdproduto and cd_quantidade=$qtd";
                        //die();
                        while($ut2 =mysqli_fetch_array($verifica2)){    
                            $cdentrega = $ut2['cd_entrega_produto'];
                            $item = $ut2['cd_produto'];



                            if($item >=32){
                                $est = mysqli_query($connect,"insert into tb_estoque(cd_entrega_produto) value($cdentrega)");

                                $up = mysqli_query($connect,"
                                    update tb_estoque set cd_quantidade = cd_quantidade+$qtd where cd_entrega_produto = $cdentrega;");
                                
                            }
                        }
                        ;
                    }else{echo "Produto já lançado";}

                    header("Location:entrega.php?entrega=$entrega");
                    unset($_POST['btn2']);
                    unset($_POST['cdproduto']);
                    unset($_POST['qtd']);
                    unset($_POST['dtvalidade']);        
                }else{


                    if(isset($_POST['barra'])){ 
                        $barra = $_POST['barra'];
                        $verifica = mysqli_query($connect,"select a.cd_item, b.cd_produto,a.nm_item, c.nm_sub_categoria, b.nm_marca, b.cd_barra, a.cd_uspesp, b.ds_peso, b.cd_medida from tb_produto as b inner join tb_item as a on b.cd_item = a.cd_item inner join tb_sub_categoria as c on c.cd_sub_categoria=a.cd_sub_categoria where b.cd_barra='$barra';");
                        $pe = 0+$verifica->num_rows;
                        if($pe==0){

                            header("Location:item.php?barra=$barra&entrega=$entrega");


                        }else{

                            while($ut =mysqli_fetch_array($verifica)){
                                $cdproduto = $ut['cd_produto'];
                                $Produto = $ut['nm_item'];
                                $Categoria = $ut['nm_sub_categoria'];
                                $Marca = $ut['nm_marca'];
                                $barra = $ut['cd_barra'];
                                $Uspesp = $ut['cd_uspesp'];
                                $cdMedida = $ut['cd_medida'];
                                $Peso = $ut['ds_peso'];
                                $item = $ut['cd_item'];

                                $procura_medida = mysqli_query($connect,"select * from tb_unidade_medida where cd_medida='$cdMedida';");



                                echo '<table class="table mt-2">
                                <thead class="thead-dark">
                                <tr>
                                <th scope="col">Produto</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Peso</th>';
                                while($mK = mysqli_fetch_array($procura_medida)){
                                    $Medida=    $mK['cd_simbolo'];
                                    echo "
                                    <th scope='col'>Medida</th>";
                                }
                                echo '
                                <th scope="col">Quantidade</th>
                                <th scope="col">Data de Validade</th>
                                ';


                                if($item <32){echo '
                                <th scope="col" pl-5>SIF</th>';}

                                echo'
                                <th>Lote</th>
                                <th scope="col">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form method="post">';



                                echo " 
                                <td>$Produto</td>        
                                <td>$Marca</td>
                                <td>$Peso</td>
                                <td>$Medida</td>
                                <input type='text' style='display:none' name='cdproduto' value='$cdproduto'>

                                <td><input type='text' class='form-control'  name='qtd' placeholder='Quantidade' autofocus required></td>
                                <td><input type='date' class='form-control' name='dtvalidade'  id='outra_data' max='2050-12-30' placeholder='Data de Validade' required></td>
                                ";

                                if($item <32){echo "<td><input type='number' class='form-control' name='sif' value='0'  id='sif' placeholder='SIF' required></td>";}
                                echo "<td><input type='number' class='form-control' name='lote' value='0'  id='lote' placeholder='Lote' required></td>";
                                echo "
                                <td><button name='btn2' class='form-btn btn btn-success'> Cadastrar </button></td>
                                </tr>";




                            }
                        }
                        echo "
                        </form>
                        </table>

                        ";









                        ?>
                    </div>

                </form>

                <?PHP



            }else{
                ?>




                <form class="form-signin" method="post" action=<?php echo "'buscar_entrega.php?entrega=$entrega'"; ?>>
                    <img class="mb-4" src="logo.png" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Scanear</h1>
                    <div class="row">
                        <div class="col mt-1">
                            <input type="number" id="inputBarra" class="form-control " placeholder="Codigo de Barra" autocomplete="off" required autofocus name="barra">
                        </div>
                        <div class="col-1">
                            <button class="form-btn btn btn-lg btn-success float-right" name="btn" type="submit">Procurar</button>

                        </div>
                    </div>

                </form>



                <?php


            }







        }







        unset($_POST);














    }else{
        if(isset($_POST['btn'])){
            $cd = $_POST['fornecedor'];
            $data = date('Y-m-d');
            $hora = date('H:m:s');
        //echo "$data e $hora";

            $insere = mysqli_query($connect,"insert into tb_entrega value(NULL, '$data', '$hora', '$CD', '$cd');");
            $procura = mysqli_query($connect,"SELECT * FROM `tb_entrega` WHERE `dt_entrega` = '$data' AND `hr_entrega` = '$hora'");
            while($fn = mysqli_fetch_array($procura)){
                $cdentrega = $fn['cd_entrega'];
            //echo $cdentrega;
                header("Location:entrega.php?entrega=$cdentrega");

            }
            unset($_POST['']);
            unset($_POST);

        }

    }
    unset($_POST);
    ?>


</div>  
                </div>


<?php
require("footer.php");
require("script.php");
?>