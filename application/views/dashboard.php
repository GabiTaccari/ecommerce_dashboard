<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include 'layout/head.php';
	?>
</head>

<body>
	<div class="wrapper">
		<?php
		include 'layout/header.php';
		include 'layout/sidebar.php';
		?>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<!-- Card -->
					<h4 class="page-title">Bem Vindo</h4>
					<div class="row">
						<div class="col-sm-6 col-lg-3">
							<div class="card p-3">
								<div class="d-flex align-items-center">
									<span class="stamp stamp-md bg-secondary mr-3">
										<i class="fa fa-dollar-sign"></i>
									</span>
									<div>
										<h5 class="mb-1"><b><a href="#"><?php echo $vendas ?> <small>Vendas no mês</small></a></b></h5>
										<small class="text-muted"><?php echo $vendas_pag ?> Aguardando Pagamento</small>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="card p-3">
								<div class="d-flex align-items-center">
									<span class="stamp stamp-md bg-success mr-3">
										<i class="fa fa-shopping-cart"></i>
									</span>
									<div>
										<h5 class="mb-1"><b><a href="#"><?php echo $pedidos ?> <small>Pedidos</small></a></b></h5>
										<small class="text-muted"><?php echo $pedidos ?> Enviados</small>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="card p-3">
								<div class="d-flex align-items-center">
									<span class="stamp stamp-md bg-danger mr-3">
										<i class="fa fa-users"></i>
									</span>
									<div>
										<h5 class="mb-1"><b><a href="#"><?php echo $membros ?> <small>Usuários</small></a></b></h5>
										<small class="text-muted"><?php echo $membros_bloc ?> Bloqueados</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		include 'layout/scripts.php';
		?>