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
						<h4 class="page-title">Visualizar Usuários</h4>
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
								<a href="#">Usuários</a>
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
									<h4 class="card-title">Usuários</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>E-mail</th>
													<th>Permissão</th>
                                                    <th>Ações</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
												<th>#</th>
													<th>E-mail</th>
													<th>Acesso</th>
                                                    <th>Ações</th>
												</tr>
											</tfoot>
											<tbody>
												<?php 
													$i = 0;
													foreach ($usuarios_tabela as $p) {
														echo("<tr>");
														echo("<td>" . $p['id'] . "</td>");
														echo("<td>" . $p['email'] . "</td>");
														echo("<td>" . $p['roles'] . "</td>");
														if($p['roles'] == 'Bloqueado')
														{
															echo("<td> <button id='btn_libera_usuario' type='button' class='btn btn-icon btn-round btn-success' onclick='liberarUsuario(".$p['id'].")'><i class='icon-check'></i></button><button type='button' class='btn btn-icon btn-round btn-danger' onclick='excluirUsuario(".$p['id'].")'><i class='flaticon-error'></i></button></td>");
														} else if($p['roles'] == 'Liberado') {
															echo("<td> <button id='btn_bloqueia_usuario' type='button' class='btn btn-icon btn-round btn-warning' onclick='bloquearUsuario(".$p['id'].")'><i class='la flaticon-signs-1'></i></button> <button type='button' class='btn btn-icon btn-round btn-danger' onclick='excluirUsuario(".$p['id'].")'><i class='flaticon-error'></i></button></td>");
														} else {
															echo("<td> <button type='button' class='btn btn-icon btn-round btn-danger' onclick='excluirUsuario(".$p['id'].")'><i class='flaticon-error'></i></button></td>");
														}
														
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

<div class="modal fade" id="modal_editar_usuario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            	<h4 class="modal-title">Usuário</h4>
                <button type="button" class="close" data-dismiss="modal">X</button>      
            </div>
            <div class="modal-body">
                <form action="" id="form_usuario">
                    <!-- <input hidden name="id" > -->

                    <div class="form-group">
                        <label for="name_editar_categoria">Nome:</label>
                        <div class="col-lg-12">
							<input type="hidden" name="editar_usuario_id" id="editar_usuario_id">
                            <input type="text" id="editar_usuario_name" class="form-control" name="editar_usuario_name" >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name_editar_categoria">Documento:</label>
                        <div class="col-lg-12">
                            <input type="text" id="doc_editar_usuario" class="form-control" name="doc_editar_usuario" >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name_editar_categoria">Telefone:</label>
                        <div class="col-lg-12">
                            <input type="text" id="tel_editar_usuario" class="form-control" name="tel_editar_usuario" >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name_editar_categoria">E-mail:</label>
                        <div class="col-lg-12">
                            <input type="text" id="email_editar_usuario" class="form-control" name="email_editar_usuario" >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name_editar_categoria">Senha:</label>
                        <div class="col-lg-12">
                            <input type="password" id="senha_editar_usuario" class="form-control" name="senha_editar_usuario" >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Permissão</label>
                        <div class="col-lg-12">
                            <?=form_dropdown('permissao_editar_usuario', [''=>'Selecione']+$permissao, '', 'id="permissao_editar_usuario" class="form-control"')?>
                            <span class="help-block"></span>
                        </div>
                    </div>

                   
                    <div class="form-group text-center">
                        <button id="btn_save_usuario" type="button" onclick="atualizarUsuario()" class="btn btn-success">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                        <span class="help-block"></span>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>