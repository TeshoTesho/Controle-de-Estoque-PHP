<?php 

require("conn.php");

ob_start();
session_start();
date_default_timezone_set('America/Sao_Paulo');

$empresa="USPESP";
$funcsenha=$_SESSION['funcionario'];
$nome_funcionario=$_SESSION['nome'];
$cd_funcionario=$_SESSION['cd'];
$ic_funcionario=$_SESSION['ic'];


$verifica_notify = mysqli_query($connect,"select cd_nfe from tb_entrega where ic_entrega=0");
$num_notify = mysqli_num_rows($verifica_notify);

if($num_notify==0){
	echo '<div id="icon_notify" class="header-button-item js-item-menu">';
}else{
	echo '<div id="icon_notify" class="header-button-item has-noti js-item-menu">';
}

?>

<i class="zmdi zmdi-notifications"></i>
<div class="notifi-dropdown notifi-dropdown--no-bor js-dropdown">
	<div class="notifi__title">
		<p>
			<?php
			if($num_notify==0){
				echo "Não Há entregas Abertas";
			}else{
				echo "Você possui ";

				echo $num_notify;
				if($num_notify==1){
					echo " entrega aberta";
				}else{
					echo " entregas abertas";
				}
			}
			?>
		</p>
	</div>

	<?php

	$verifica_entrega = mysqli_query($connect,"select * from tb_entrega where ic_entrega=0");

	while($ol = mysqli_fetch_array($verifica_entrega)){
		$cd = $ol['cd_nfe'];
		$cdfornecedor = $ol['cd_fornecedor'];
		$verifica_fornecedor = mysqli_query($connect,"select * from tb_fornecedor where cd_fornecedor = $cdfornecedor");
		while ($pl = mysqli_fetch_array($verifica_fornecedor)) {
			$fornecedor = $pl['nm_fornecedor'];
			if($ic_funcionario>=3){
				echo "<form method='post' action='entrega.php?entrega=$cd'>";
				?>
				<button>
					<div class="notifi__item">
						<div class="bg-c1 img-cir img-40">
							<i class="zmdi zmdi-truck"></i>
						</div>
						<div class="content">
							<p>Uma entrega está aberta</p>
							<span class="date">Fornecedor: <?php echo $fornecedor; ?></span>
						</div>
					</div>
				</button>

					<?php

					echo "</form>";

				}

			}
		}


		?>

	</div>
