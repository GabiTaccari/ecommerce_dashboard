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
						<h4 class="page-title">Visualizar Produtos</h4>
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
									<h4 class="card-title">Produtos</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover">
											<thead>
												<tr>
													<th>Nome</th>
													<th>Imagem Principal</th>
													<th>Preço</th>
													<th>Categoria</th>
													<th>Status</th>
													<th>Ação</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Nome</th>
													<th>Imagem Principal</th>
													<th>Preço</th>
													<th>Categoria</th>
													<th>Status</th>
													<th>Ação</th>
												</tr>
											</tfoot>
											<tbody>
											<?php 
												$i = 0;
													foreach ($produtos as $p) {
														echo("<tr>");
														echo("<td>" . $p['nome'] . "</td>");
														echo("<td><img src='" .base_url() . $p['imagem'] . "' style='max-width:100px;'></td>");
														echo("<td>" . $p['preco'] . "</td>");
														echo("<td>" . $p['categoria'] . "</td>");
														echo("<td>" . $p['status'] . "</td>");
														echo("<td> <button id='btn_edit_produto' type='button' data-toggle='modal' data-target='#modal_produto' class='btn btn-icon btn-round btn-primary' onclick='editarProduto(".$p['id'].")'><i class='icon-note'></i></button>  <button id='btn_edit_produto' type='button' data-toggle='modal' data-target='#modal_produto' class='btn btn-icon btn-round btn-primary' onclick='copiarProduto(".$p['id'].")'><i class='icon-copy'></i></button>   <button type='button' class='btn btn-icon btn-round btn-danger' onclick='excluirProduto(".$p['id'].")'><i class='flaticon-error'></i></button></td>");
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

<div id="modal_produto" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            	<h4 class="modal-title">Produtos</h4>
                <button type="button" class="close" data-dismiss="modal">X</button>  
            </div>
            <div class="modal-body">
                <form action="" id="form_produto">
                    <input hidden name="editar_produto_id" id="editar_produto_id">

                    <div class="form-group">
                        <label for="name">Nome do Produto:</label>
                        <div class="col-lg-12">
                            <input type="text" id="editar_produto_name" class="form-control" name="editar_produto_name"  >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição do Produto</label>
                        <div class="col-lg-12">
                            <textarea id="editar_produto_description" name="editar_produto_description" class="form-control" rows="5" cols="33"></textarea>
                            
                            <span class="help-block"></span>
                        </div>
                    </div>

					<div class="form-group">
                        <label for="price">Preço</label>
                        <div class="col-lg-12">
                        <input type="float" id="editar_produto_price" class="form-control" name="editar_produto_price"  >
                            <span class="help-block"></span>
                        </div>
                    </div>

					<div class="form-group">
                        <label for="price">Preço para CNPJ: </label>
                        <div class="col-lg-12">
                        <input type="float" id="editar_produto_price_cnpj" class="form-control" name="editar_produto_price_cnpj"  >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <div class="col-lg-12">
                            <?=form_dropdown('editar_produto_category_id', [''=>'Selecione']+$categorias, '', 'id="editar_produto_category_id" class="form-control"')?>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="col-lg-12">
                            <select name="editar_produto_status" id="editar_produto_status" class="form-control">
                                <option value="" selected="selected">Selecione</option>
                                <option value="1">Ativo</option>
                                <option value="2">Inativo</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <div class="col-lg-12">
                            <input type="int" id="editar_produto_quantidade" class="form-control" name="editar_produto_quantidade"  >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="necessario_cnpj">É necessário CNPJ?</label>
                        <div class="col-lg-12">
                            <select name="editar_produto_necessario_cnpj" id="editar_produto_necessario_cnpj" class="form-control">
                                <option value="" selected="selected">Selecione</option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>


    
                    <div class="form-group">
                        <label for="cover_image">Imagem Principal: </label>
                        <div class="col-lg-12">
							<img src="" style="max-height:400px; max-width: 400px;" alt="" id="imagem_antiga_1">
                            <img src="" style="max-height:400px; max-width: 400px;" alt="" id="editar_produto_img_path">
                            <label class="btn btn-block btn-info">
                                <i class="fa fa-upload"></i> Importar Imagem
                                <input type="file" accept="image/*" style="display: none;" id="btn_upload_editar_produto_img">
                            </label>
                            <input id="editar_cover_image" type="hidden"name="editar_produto_cover-image">
                            <span class="help-block"></span>
                        </div>
                    </div>


                    <div class="form-group text-center">
                        <button id="btn_save_produto" type="button" onclick="salvaEditarProduto()" class="btn btn-success">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                        <span class="help-block"></span>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>