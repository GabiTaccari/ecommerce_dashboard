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
						<h4 class="page-title">Adicionar Rastreio</h4>
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
								<a href="#">Rastreio</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Adicionar</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Adicionar Código de Rastreio</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<div class="form-group">
											<label for="name">Código:</label>
											<div class="col-lg-4">
												<input type="text" id="codigo_rastreio" class="form-control" name="codigo_rastreio">
												<span class="help-block"></span>
											</div>
										</div>

										<div class="form-group">
											<div class="col-lg-4 text-center">
												<button id="btn_save_produto" type="button" onclick="salvaCodigoRastreamento(<?php echo $_GET['venda']; ?>)" class="btn btn-success">
													<i class="fa fa-save"></i> Adicionar
												</button>
											</div>
											<span class="help-block"></span>
										</div>

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