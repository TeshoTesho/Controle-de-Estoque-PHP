
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
	$cdbarra = $_POST['cdbarra'];
	$marca= $_POST['marca'];
	$peso= $_POST['peso'];
	$Medida= $_POST['medida'];
	$item= $_POST['item'];

	
	if(!isset($_POST['sif'])){
		$sif = 0;
	}else{
		$sif = $_POST['sif'];
	}

	mysqli_query($connect,"INSERT INTO `tb_produto` (`cd_produto`, `cd_barra`, `nm_marca`, `ds_peso`, `cd_medida`, `cd_item`) VALUES (NULL, '$cdbarra', '$marca', '$peso', '$Medida', '$item');");
	
	
	
	if(isset($_POST['entrega'])){
		$entrega=$_POST['entrega'];
		unset($_POST['entrega']);
		header("Location:entrega.php?entrega=$entrega");
	}else{
		header("Location:home.php");
	}
	
}else{

	if(!isset($_POST['item'])){
		header("Location:item.php");
	}
	$cditem = $_POST['item'];

	$procura_item = mysqli_query($connect,"SELECT * FROM tb_item WHERE cd_item = '$cditem';");
	while ($mk= mysqli_fetch_array($procura_item)) {
		$item = $mk['nm_item'];

		?>
		<div class="page-content bg-light">
			<!-- BREADCRUMB-->
			<section class="au-breadcrumb2">
				<div class="container">
					<?php echo $empresa; ?> - Adicionar Produto

					<div class="row mb-5   ">
						<div class="col">
							<p class="h2 text-center mt-3 mb-3  ">Cadastrar <?php echo $item; ?></p>

							<table class="table mt-2">
								<thead class="thead-dark">
									<tr>
										<th scope="col">Marca</th>
										<th scope="col">Peso</th>
										<th scope="col">Unidade de Medida</th>
										<th scope="col">Código de Barra</th>
										<?php
										if($ic_funcionario>3){
											echo "<th scope = 'col'>Ações</th>";
										}
										?>
									</tr>
								</thead>
								<tbody>

									<?php



									$verifica = mysqli_query($connect," select c.nm_categoria, b.nm_sub_categoria, a.nm_item, a.cd_item from tb_item as a inner join tb_sub_categoria as b on b.cd_sub_categoria=a.cd_sub_categoria inner join tb_categoria as c on b.cd_categoria = c.cd_categoria where cd_item='$cditem';");


									while($uT =mysqli_fetch_array($verifica)){
										$categoria=$uT['nm_categoria'];
										$subcategoria=$uT['nm_sub_categoria'];
										$itemc = $uT['cd_item'];
										$cditem=$uT['cd_item']; 

										echo "<form method='post' action='cadastrar_produto.php'>
										<td><input name='marca' class='form-control' placeholder='Marca' type='Text' autofocus  required></input></td>
										<td><input class='form-control' name='peso' placeholder='Peso' type='number'  required></td>
										<td>
										<select class='form-control' name='medida' required>
										<option value=''>Selecione a Unidade de Medida</option>
										";



										$Medida = mysqli_query($connect,"Select * from tb_unidade_medida;");

										while($ai=mysqli_fetch_array($Medida)){
											$nmmedida = $ai['nm_medida'];
											$cdmedida = $ai['cd_medida'];
											echo "<option value='$cdmedida'>$nmmedida</option>";
										}


										echo "</select>
										</td>
										<td>
										<input class='form-control' name='item' type='hidden' value='$cditem' placeholder='Item' type='Text'></input>

										<input name='cdbarra' class='form-control' placeholder='Codigo de Barra' type='Text'";

										if(isset($_POST['barra'])){
											$barra=$_POST['barra'];
											echo "value='$barra'";
										}

										echo " required></input></td>";
										if($ic_funcionario>3){
											if(isset($_POST['entrega'])){
												$entrega=$_POST['entrega'];
												echo "<input type='hidden' name='entrega' value='$entrega'></input>";
											}
											echo "<td><button name='btn' class='btn btn-success'>Cadastrar</button></td>";
										}
										echo "</form>";



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
							}
							require("footer.php");
							require("script.php");
							?>
