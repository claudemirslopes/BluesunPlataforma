
    <!-- PARRA LATERAL - SIDEBAR -->
    <?php $this->load->view('layout/sidebar') ?>
    <!-- PARRA LATERAL - SIDEBAR -->

    <!-- BARRA DIREITA -->

    <div id="right-panel" class="right-panel">

        <!-- BARRA SUPERIOR - NAVBAR -->
        <?php $this->load->view('layout/navbar') ?>
        <!-- BARRA SUPERIOR - NAVBAR -->

        <!-- MAIN CONTENT - CONTEÚDO PRINCIPAL -->
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1 style="font-size: 1.2em;">Plataforma Administrativa</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?php echo base_url('/'); ?>" style="color: #47AA0B;">Home</a></li>
                            <li class="active"><?php echo $titulo; ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- content -->
        <div class="content mt-1">
            <div class="card">
                <div class="card-header bg-secondary text-light">
                    <strong class="card-title" v-if="headerText">Relatórios</strong>
                    <!--<a title="Cadastrar novo categoria" href="<?php echo base_url('relatorios/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Nova categoria</a>-->
                </div>
                
                <div class="card-body" style="border: 1px solid #A4A4A4;"> 
                    
                <!-- Mensagem de sucesso -->
                <?php if ($message = $this->session->flashdata('sucesso')): ?>
                    <div class="alert  alert-success alert-dismissible fade show " role="alert">
                        <span class="badge badge-pill badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Sucesso</span>&nbsp;&nbsp;
                         <?php echo $message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <!-- Mensagem de sucesso -->
                
                <!-- Mensagem de erro -->
                <?php if ($message = $this->session->flashdata('error')): ?>
                    <div class="alert  alert-danger alert-dismissible fade show " role="alert">
                        <span class="badge badge-pill badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;Atenção</span>&nbsp;&nbsp;
                         <?php echo $message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <!-- Mensagem de erro -->
                
                <!-- Mensagem de info -->
                <?php if ($message = $this->session->flashdata('info')): ?>
                    <div class="alert  alert-warning alert-dismissible fade show " role="alert">
                        <span class="badge badge-pill badge-warning"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;Advertência</span>&nbsp;&nbsp;
                         <?php echo $message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <!-- Mensagem de info -->
                
                                 
                    <div class="col-md-6">
                        <aside class="profile-nav alt">
                            <section class="card" style="border: 1px solid #B5B5B5;">
                                <div class="card-header user-header alt bg-light">
                                    <div class="media">
                                        <a href="#">
                                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?php echo base_url('public/images/icons/vendas.svg'); ?>">
                                        </a>
                                        <div class="media-body">
                                            <h3 class="text-dark display-6" style="font-size: 1.9em;">Vendas</h3>
                                            <p>gerar relatório de vendas</p>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('relatorios/vendas'); ?>" class="btn btn-outline-secondary btn-icon-split btn-lg btn-block">
                                        <span class="icon text-secondary-50" style="float: left;">
                                            <i class="fa fa-list"></i>
                                        </span>
                                        <span class="text" style="font-size: .7em;">&nbsp;Relatório de Vendas</span></span>
                                    </a>
                                </div>
                            </section>
                        </aside>
                    </div>
                    
                    <div class="col-md-6">
                        <aside class="profile-nav alt">
                            <section class="card" style="border: 1px solid #B5B5B5;">
                                <div class="card-header user-header alt bg-light">
                                    <div class="media">
                                        <a href="#">
                                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?php echo base_url('public/images/icons/servicos.svg'); ?>">
                                        </a>
                                        <div class="media-body">
                                            <h3 class="text-dark display-6" style="font-size: 1.9em;">Ordem de Serviços</h3>
                                            <p>gerar relatório de ordem de serviços</p>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('relatorios/os'); ?>" class="btn btn-outline-secondary btn-icon-split btn-lg btn-block">
                                        <span class="icon text-secondary-50" style="float: left;">
                                            <i class="fa fa-list"></i>
                                        </span>
                                        <span class="text" style="font-size: .7em;">&nbsp;Relatório de Ordem de Serviços</span>
                                    </a>
                                </div>
                            </section>
                        </aside>
                    </div>
                    
                    <div class="col-md-6">
                        <aside class="profile-nav alt">
                            <section class="card" style="border: 1px solid #B5B5B5;">
                                <div class="card-header user-header alt bg-light">
                                    <div class="media">
                                        <a href="#">
                                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?php echo base_url('public/images/icons/contareceber.svg'); ?>">
                                        </a>
                                        <div class="media-body">
                                            <h3 class="text-dark display-6" style="font-size: 1.9em;">Contas a Receber</h3>
                                            <p>gerar relatório de contas a receber</p>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('relatorios/receber'); ?>" class="btn btn-outline-secondary btn-icon-split btn-lg btn-block">
                                        <span class="icon text-secondary-50" style="float: left;">
                                            <i class="fa fa-list"></i>
                                        </span>
                                        <span class="text" style="font-size: .7em;">&nbsp;Relatório de Contas a Receber</span>
                                    </a>
                                </div>
                            </section>
                        </aside>
                    </div>
                    
                    <div class="col-md-6">
                        <aside class="profile-nav alt">
                            <section class="card" style="border: 1px solid #B5B5B5;">
                                <div class="card-header user-header alt bg-light">
                                    <div class="media">
                                        <a href="#">
                                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?php echo base_url('public/images/icons/contapagar.svg'); ?>">
                                        </a>
                                        <div class="media-body">
                                            <h3 class="text-dark display-6" style="font-size: 1.9em;">Contas a Pagar</h3>
                                            <p>gerar relatório de contas a pagar</p>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('relatorios/pagar'); ?>" class="btn btn-outline-secondary btn-icon-split btn-lg btn-block">
                                        <span class="icon text-secondary-50" style="float: left;">
                                            <i class="fa fa-list"></i>
                                        </span>
                                        <span class="text" style="font-size: .7em;">&nbsp;Relatório de Contas a Pagar</span>
                                    </a>
                                </div>
                            </section>
                        </aside>
                    </div>
                    
                </div>

            </div>

        </div>
