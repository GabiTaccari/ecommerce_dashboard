<!--   Core JS Files   -->
<script src="<?php  echo base_url(); ?>public/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="<?php  echo base_url(); ?>public/assets/js/core/popper.min.js"></script>
<script src="<?php  echo base_url(); ?>public/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Chart JS -->
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Sweet Alert -->
<script src="<?php  echo base_url(); ?>public/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Atlantis JS -->
<script src="<?php  echo base_url(); ?>public/assets/js/atlantis.min.js"></script>

<script src="<?php echo base_url(); ?>public/assets/js/util.js"></script>

<!-- <script>
    Circles.create({
        id: 'circles-1',
        radius: 45,
        value: 60,
        maxValue: 100,
        width: 7,
        text: 5,
        colors: ['#f1f1f1', '#FF9E27'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-2',
        radius: 45,
        value: 70,
        maxValue: 100,
        width: 7,
        text: 36,
        colors: ['#f1f1f1', '#2BB930'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    Circles.create({
        id: 'circles-3',
        radius: 45,
        value: 40,
        maxValue: 100,
        width: 7,
        text: 12,
        colors: ['#f1f1f1', '#F25961'],
        duration: 400,
        wrpClass: 'circles-wrp',
        textClass: 'circles-text',
        styleWrapper: true,
        styleText: true
    })

    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    var mytotalIncomeChart = new Chart(totalIncomeChart, {
        type: 'bar',
        data: {
            labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
            datasets: [{
                label: "Total Income",
                backgroundColor: '#ff9e27',
                borderColor: 'rgb(23, 125, 255)',
                data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: false //this will remove only the label
                    },
                    gridLines: {
                        drawBorder: false,
                        display: false
                    }
                }],
                xAxes: [{
                    gridLines: {
                        drawBorder: false,
                        display: false
                    }
                }]
            },
        }
    });

    $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script> -->


<!-- Modal para adicionar produto -->

<div id="modal_novo_produto" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Produto</h4>
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

                    <div class="form-group">
                        <label for="description">Descrição do Produto</label>
                        <div class="col-lg-12">
                            <textarea id="description" name="description" class="form-control" rows="5" cols="33"></textarea>
                            
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price">Preço</label>
                        <div class="col-lg-12">
                        <input type="float" id="price" class="form-control" name="price"  >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <div class="col-lg-12">
                            <?=form_dropdown('category_id', [''=>'Selecione']+$categorias, '', 'id="category_id" class="form-control"')?>
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="col-lg-12">
                            <select name="status" id="status" class="form-control">
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
                            <input type="int" id="quantidade" class="form-control" name="quantidade"  >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="necessario_cnpj">É necessário CNPJ?</label>
                        <div class="col-lg-12">
                            <select name="necessario_cnpj" id="status" class="form-control">
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
                            <img src="" style="max-height:400px; max-width: 400px;" alt="" id="produto_img_path">
                            <label class="btn btn-block btn-info">
                                <i class="fa fa-upload"></i> Importar Imagem
                                <input type="file" accept="image/*" style="display: none;" id="btn_upload_produto_img">
                            </label>
                            <input id="cover_image" type="hidden" name="cover-image">
                            <span class="help-block"></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="image2">Imagem Secundária: </label>
                        <div class="col-lg-12">
                            <img src="" style="max-height:400px; max-width: 400px;" alt="" id="produto_img_path2">
                            <label class="btn btn-block btn-info">
                                <i class="fa fa-upload"></i> Importar Imagem
                                <input type="file" accept="image/*" style="display: none;" id="btn2_upload_produto_img">
                            </label>
                            <input id="image2" type="hidden" name="image2">
                            <span class="help-block"></span>
                        </div>
                        <!--
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2">

                        <button type="button" class="btn btn-icon btn-round btn-primary">
											<i class="fa fa-plus"></i>
										</button>

                        </div>-->

                        <div class="col-lg-12">
                            <img src="" style="max-height:400px; max-width: 400px;" alt="" id="produto_img_path3">
                            <label class="btn btn-block btn-info">
                                <i class="fa fa-upload"></i> Importar Imagem
                                <input type="file" accept="image/*" style="display: none;" id="btn3_upload_produto_img">
                            </label>
                            <input id="image3" type="hidden" name="image3">
                            <span class="help-block"></span>
                        </div>

                        <div class="col-lg-12">
                            <img src="" style="max-height:400px; max-width: 400px;" alt="" id="produto_img_path4">
                            <label class="btn btn-block btn-info">
                                <i class="fa fa-upload"></i> Importar Imagem
                                <input type="file" accept="image/*" style="display: none;" id="btn4_upload_produto_img">
                            </label>
                            <input id="image4" type="hidden" name="image4">
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



<!-- Modal para adicionar categoria -->

<div id="modal_nova_categoria" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Categoria</h4>
                <button type="button" class="close" data-dismiss="modal">X</button>
                
            </div>
            <div class="modal-body">
                <form action="" id="form_produto">
                    <input hidden name="id">

                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <div class="col-lg-12">
                            <input type="text" id="name_categoria" class="form-control" name="name_categoria"  >
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <button id="btn_save_produto" type="button" onclick="salvaCategoria()" class="btn btn-success">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                        <span class="help-block"></span>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>