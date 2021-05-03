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
					<div class="page-header">
						<h4 class="page-title">Visualizar Venda</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Venda 00<?php echo($order[0]->id); ?></a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Visualizar</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Dados da Compra</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
                                        <h4>Dados Pessoais</h4>
                                        <hr>
                                        <p><b>Comprador: </b> <?php echo($pessoa[0]->name); ?></p>
                                        <p><b>Documento: </b><?php echo($pessoa[0]->doc); ?></p>
                                        <p><b>Telefone:</b> <?php echo($pessoa[0]->phone); ?></p>

                                        <h4>Produtos</h4>
                                        <hr>
                                        <?php 
                                            $i = 0;
                                            foreach($prod as $p)
                                            {
                                                
                                                echo("<p><b> Produto: </b>".  ($p->name)." </b>
                                                <br>
                                                <b>Quantidade: </b> ".$p->quantity."
                                                
                                                </p>");
                                                $i++;
                                            }
                                        ?>
                                        <h4>Dados de Envio</h4>
                                        <hr>
                                        <p><b>Preço Total: </b> <?php echo($order[0]->price_total); ?></p>
                                        <p><b>Endereço de Entrega: </b><?php echo($order[0]->delivery_address); ?></p>
                                        <p><b>CEP:</b> <?php echo($order[0]->pincode); ?></p>
                                        <p><b>Status:</b> <?php echo($order[0]->order_status); ?></p>

                                        <?php 
                                        if($order[0]->order_status == 'pendente' and $order[0]->track_code == NULL)
                                        {
                                            echo("<a target='_blank' href='". base_url() ."venda/rastreio?venda=".$order[0]->id."'><button class='btn btn-warning'><i class='la flaticon-signs-3'></i> Adicionar Código de Rastreio</button></a>");
                                            //echo("<button id='campo_rastreio' class='btn btn-warning'><i class='la flaticon-signs-3'></i> Adicionar Código de Rastreio</button>");
                                        }

										if($order[0]->order_status == 'Aguardando Pagamento' and $order[0]->track_code == NULL)
                                        {
                                            echo("<a target='_blank' href='". base_url() ."venda/liberarPagamento?venda=".$order[0]->id."'><button class='btn btn-warning'><i class='la flaticon-signs-3'></i> Liberar Pagamento</button></a>");
                                            //echo("<button id='campo_rastreio' class='btn btn-warning'><i class='la flaticon-signs-3'></i> Adicionar Código de Rastreio</button>");
                                        }
                                        ?>

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

		<script>
			$(document).ready(function() {
				$('#basic-datatables').DataTable({});

				$('#multi-filter-select').DataTable({
					"pageLength": 5,
					initComplete: function() {
						this.api().columns().every(function() {
							var column = this;
							var select = $('<select class="form-control"><option value=""></option></select>')
								.appendTo($(column.footer()).empty())
								.on('change', function() {
									var val = $.fn.dataTable.util.escapeRegex(
										$(this).val()
									);

									column
										.search(val ? '^' + val + '$' : '', true, false)
										.draw();
								});

							column.data().unique().sort().each(function(d, j) {
								select.append('<option value="' + d + '">' + d + '</option>')
							});
						});
					}
				});

				// Add Row
				$('#add-row').DataTable({
					"pageLength": 5,
				});

				var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger"  data-original-title="Remove" > <i class="fa fa-times"></i> </button> </div> </td>';

				$('#addRowButton').click(function() {
					$('#add-row').dataTable().fnAddData([
						$("#addName").val(),
						$("#addPosition").val(),
						$("#addOffice").val(),
						action
					]);
					$('#addRowModal').modal('hide');

				});
			});
		</script>

