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
						<h4 class="page-title">Visualizar Categorias</h4>
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
								<a href="#">Produtos</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Listar</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Categorias</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Nome</th>
													<th>Ação</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
												<th>#</th>
													<th>Nome</th>
													<th>Ação</th>
												</tr>
											</tfoot>
											<tbody>
											<?php 
												$i = 0;
													foreach ($categorias_tabela as $p) {
														echo("<tr>");
														echo("<td>" . $p['id'] . "</td>");
														echo("<td>" . $p['nome'] . "</td>");
														echo("<td> <button id='btn_edit_produto' type='button' data-toggle='modal' data-target='#modal_categoria' class='btn btn-icon btn-round btn-primary' onclick='editarCategoria(".$p['id'].")'><i class='icon-note'></i></button> <button type='button' class='btn btn-icon btn-round btn-danger' onclick='excluirProduto(".$p['id'].")'><i class='flaticon-error'></i></button></td>");
														echo("</tr>");
														$i++;
													}
												?>
												
											</tbody>
										</table>
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


<!-- Modal para adicionar produto -->

<div id="modal_categoria" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Cursos</h4>
                <button type="button" class="close" data-dismiss="modal">X</button>
                
            </div>
            <div class="modal-body">
                <form action="" id="form_produto">
                    <input hidden name="id">

                    <div class="form-group">
                        <label for="name">Nome do Produto:</label>
                        <div class="col-lg-12">
                            <input type="text" id="name" class="form-control" name="name"  >
                            <span class="help-block"></span>
                        </div>
                    </div>

                   
                    <div class="form-group text-center">
                        <button id="btn_save_produto" type="button" onclick="salvaProduto()" class="btn btn-success">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                        <span class="help-block"></span>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>