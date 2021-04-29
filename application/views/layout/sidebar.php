<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?php echo base_url(); ?>public/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?php echo $nome_usuario; ?>
                            <span class="user-level"><?php echo $acesso_usuario; ?></span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">Meu Perfil</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Editar Perfil</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Configurações</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="http://a">
                        <i class="fas fa-home"></i>
                        <p>Painel</p>
                    </a>
                    
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">E-commerce</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Produtos</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo base_url();?>produto/">
                                    <span class="sub-item">Visualizar Todos</span>
                                </a>
                            </li>
                            <li>
                                <a href="" data-toggle='modal' data-target='#modal_novo_produto'>
                                    <span class="sub-item">Adicionar Novo</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Categorias</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?php echo base_url();?>categoria/">
                                    <span class="sub-item">Visualizar Todas</span>
                                </a>
                            </li>
                            <li>
                                <a href="" data-toggle='modal' data-target='#modal_nova_categoria'>
                                    <span class="sub-item">Adicionar Nova</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Usuários</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Visualizar Todos</span>
                                </a>
                            </li>

                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Liberação Pendente</span>
                                </a>
                            </li>

                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Adicionar Novo</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Controle de Vendas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Visualizar Todas</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Visualizar Novas</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Pendentes</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Em trajeto</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Concluídas</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Análise</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Vendas</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                
                <li class="mx-4 mt-2">
                    <a href="https://famcosmeticos.com.br/" target="_blank" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-shopping-cart"></i> </span>Visualizar Loja</a>
                </li>
            </ul>
        </div>
    </div>
</div>