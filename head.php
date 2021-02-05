
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<!-- Required meta tags-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Title Page-->
	<title>Sistema de estoque</title>

	<!-- Fontfaces CSS-->
	<link href="css/font-face.css" rel="stylesheet" media="all">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

	<!-- Bootstrap CSS-->
	<link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

	<!-- Vendor CSS-->
	<link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
	<link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
	<link href="vendor/wow/animate.css" rel="stylesheet" media="all">
	<link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
	<link href="vendor/slick/slick.css" rel="stylesheet" media="all">
	<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
	<link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

	<!-- Main CSS-->
	<link href="css/theme.css" rel="stylesheet" media="all">


	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript">
	</script>
	<script>
        /*
        $(document).ready(function(){

            setInterval(function(){
                $("#icon_notify").load('icon_notify.php')
            }, 10000);
        });
    </script>
</head>

<body class="animsition bg-light" onload="ajax();">
	<div class="page-wrapper bg-light">
		<!-- HEADER DESKTOP-->
		<header class="header-desktop3 d-none d-lg-block">
			<div class="section__content section__content--p35">
				<div class="header3-wrap">
					<div class="header__logo">
						<!-- Logo -->
						<a href="index.php" class='alert-link text-light'>
							Sistema de Estoque
						</a>
					</div>
					<?php if (isset($_SESSION['funcionario'])) {?>
						<div class="header__navbar">
							<ul class="list-unstyled">
								<li class="has-sub">
									<a href="#">
										<i class="fas fa-tv">
										</i>
										Sistema
										<span class="bot-line">
										</span>
									</a>
									<ul class="header3-sub-list list-unstyled">
										<li>
											<a href="baixa.php">
												<i class="fas fa-arrow-down">
												</i> 
												Baixa
											</a>
										</li>
										<?php if($ic_funcionario==5){ ?>
											<li>
												<a href="devolucao.php">
													<i class="fas fa-undo-alt">
													</i> 
													Devolução
												</a>
											</li>
										<?php } ?>
									</ul>
								</li>

								<li class="has-sub">
									<a href="#">
										<i class="fas fa-box">
										</i>
										Estoque
										<span class="bot-line">
										</span>
									</a>

									<ul class="header3-sub-list list-unstyled">

										<li>
											<a href="#">
												<form method='post' action='estoque.php' >
													<button type="Submit" name='btn' class="text-secondary"  style="font-size: 100%; border:0px;padding: 0px;" >
														<i class="fas fa-boxes">
														</i> 
														Estoque Por Produto
													</button>
												</form>
											</a>
										</li>
										<?php if($ic_funcionario==5){ ?>
											<li>
												<a href="#">
													<form method='post' action='estoque.php' >
														<button type="Submit" name='id' class="text-secondary"  style="font-size: 100%; border:0px;padding: 0px;" >
															<i class="fas fa-box">
															</i> 
															Estoque Por Item
														</button>
													</form>
												</a>
											</li>
										<?php } ?>
									</ul>
								</li>
								<?php if($ic_funcionario>1){ ?>
									<li class="has-sub"> 
										<a href="#">
											<i class="fas fa-truck-moving">
											</i>
											<span class="bot-line">
											</span>
											Entrega
										</a>
										<ul class="header3-sub-list list-unstyled">
											<?php if($ic_funcionario>2){ ?>
												<li>
													<a href="entrega.php">
														<i class="fas fa-plus">
														</i> 
														Cadastrar Entrega
													</a>
												</li>
											<?php } ?>
											<li>
												<a href="entrega_aberta.php">
													<i class="fas fa-search">
													</i>
													Consultar Entregas Abertas
												</a>
											</li>
										</ul>
									</li>
								<?php } ?>

								<li class="has-sub"> 
									<a href="#">
										<i class="fas fa-history">
										</i>
										<span class="bot-line">
										</span>
										Histórico
									</a>

									<ul class="header3-sub-list list-unstyled">
										<li>
											<a href="logbaixa.php"> 
												<i class="fas fa-list">
												</i>
												Histórico de Baixa
											</a>
										</li>
										<li>
											<a href="logentrega.php">
												<i class="far fa-list-alt">
												</i>
												Histórico de Entrega
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>  

						<!-- NOTIFICAÇÔES -->

						<div class="header__tool ">
							<?php
							$verifica_notify = mysqli_query($connect,"select cd_nfe from tb_entrega where ic_entrega=0");
							$num_notify = mysqli_num_rows($verifica_notify);
							if($num_notify==0){
								echo '<div id="icon_notify" class="header-button-item js-item-menu">';
							}else{
								echo '<div id="icon_notify" class="header-button-item has-noti js-item-menu">';
							}
							?>
							<i class="zmdi zmdi-notifications">
							</i>
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
													<div class="bg-c3 img-cir img-40">
														<i class="zmdi zmdi-truck">
														</i>
													</div>
													<div class="content">
														<p>
															Uma entrega está aberta
														</p>
														<span class="date">
															Fornecedor: <?php echo $fornecedor; ?>
														</span>
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
						</div>

						<div class="account-wrap">
							<div class="account-item account-item--style2 clearfix js-item-menu">
								<div class="content">
									<a class="js-acc-btn" href="#">
										<?php echo $nome_funcionario; ?>
									</a>
								</div>
								<div class="account-dropdown js-dropdown">

									<div class="account-dropdown__body">

										<div class="account-dropdown__item">
											<a href="config.php">
												<i class="zmdi zmdi-settings">
												</i>
												Configurações
											</a>
										</div>
									</div>

									<div class="account-dropdown__footer">
										<a href="logout.php">
											<i class="zmdi zmdi-power">
											</i>
											Sair
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 
				}
				?>
			</div>
		</div>
	</header>
	<!-- END HEADER DESKTOP-->

	<div class="page-wrapper bg-light">
		<header class="header-mobile header-mobile-2 d-block d-lg-none ">
			<div class="header-mobile__bar">
				<div class="container-fluid">
					<div class="header-mobile-inner">
						<a href="index.php" class='alert-link text-light'>Sistema de Estoque</a>
						<?php 
						if (isset($_SESSION['funcionario'])) {

							?>
							<button class="hamburger hamburger--slider" type="button">
								<span class="hamburger-box">
									<span class="hamburger-inner">
									</span>
								</span>
							</button>
							<?php 
						}

						?>
					</div>
				</div>
			</div>

			<?php 
			if (isset($_SESSION['funcionario'])) {

				?>
				<nav class="navbar-mobile">
					<div class="container-fluid ">
						<ul class="navbar-mobile__list list-unstyled">

							<li class="has-sub">
								<a href="#" class="js-arrow">
									<i class="fas fa-tv">
									</i>
									Sistema
									<span class="bot-line">
									</span>
								</a>
								<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
									<li>
										<a href="baixa.php">Baixa</a>
									</li>
									<li>
										<a href="devolucao.php">Devolução</a>
									</li>
								</ul>
							</li>


							<li class="has-sub">
								<a href="#" class="js-arrow">
									<i class="fas fa-box">
									</i>
									Estoque
									<span class="bot-line">
									</span>
								</a>

								<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">

									<li>
										<a href="#">
											<form method='post' action='estoque.php' >
												<button type="Submit" name='btn'  style="font-size: 100%; border:0px;padding: 0px;" >Estoque Por Produto</button>
											</form>
										</a>
									</li>
									<li>
										<a href="#">
											<form method='post' action='estoque.php' >
												<button type="Submit" name='id'  style="font-size: 100%; border:0px;padding: 0px;" >Estoque Por Item</button>
											</form>
										</a>
									</li>
								</ul>
							</li>
							<li class="has-sub"> 
								<a href="#" class="js-arrow">
									<i class="fas fa-truck-moving">
									</i>
									<span class="bot-line">
									</span>
									Entrega
								</a>
							</a>
							<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
								<li>
									<a href="entrega.php">Cadastrar Entrega</a>
								</li>
								<li>
									<a href="entrega_aberta.php">Consultar Entregas Abertas</a>
								</li>
							</ul>
						</li>

						<li class="has-sub"> 
							<a href="#" class="js-arrow">
								<i class="fas fa-history">
								</i>
								<span class="bot-line">
								</span>
								Histórico
							</a>
						</a>
						<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
							<li>
								<a href="logbaixa.php">Histórico de Baixa</a>
							</li>
							<li>
								<a href="logentrega.php">Histórico de Entrega</a>
							</li>
						</ul>
					</li>
					<li class="has-sub">
						<a class="js-acc-btn js-arrow" href="#">
							<i class="zmdi zmdi-account">
							</i>
							<?php echo $nome_funcionario; ?>
						</a>
						<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
							<li>
								<a href="conf.php">
									<i class="zmdi zmdi-settings">
									</i>
									Configurações
								</a>
							</li>
							<li>
								<a href="logout.php">
									<i class="zmdi zmdi-power">
									</i>
									Sair
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>

		<?php 
	}

	?>
</header>
</div>