<style>
    .form-control {
        border: 1px solid #585858;
    }
    .border {
        border: 1px solid #848484 !important;
    }
</style>

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
                            <li><a href="#">Orçamentos</a></li>
                            <li><a href="<?php echo base_url('servicos'); ?>">Ordem de Serviços</a></li>
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
                    <strong class="card-title" v-if="headerText">Escolha uma Opção</strong>
                    <span class="float-right" style="color: #777;font-size: .9em;">
                        <!--<strong><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Última alteração: </strong><?php echo formata_data_banco_com_hora($ordem_servico->ordem_servico_data_alteracao); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                        <!--<a title="Voltar" href="<?php echo base_url('os'); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>-->
                    </span>
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
                
                
                    <div class="col-md-4">
                        <div class="card">
                            <style>
                                .timd1 {
                                    background: #F8F9FA;
                                }
                                .timd1:hover {
                                    background: #DC3545;
                                }
                                .timd2 {
                                    background: #F8F9FA;
                                }
                                .timd2:hover {
                                    background: #28A745;
                                }
                                .timd3 {
                                    background: #F8F9FA;
                                }
                                .timd3:hover {
                                    background: #17A2B8;
                                }
                            </style>
                            <div class="card-body text-white timd1" style="border: 1px solid #A4A4A4;">
                                <a href="<?php echo base_url('os/pdf/'.$ordem_servico->ordem_servico_id); ?>" target="_blank" class="btn btn-danger btn-icon-split btn-lg btn-block">
                                    <span class="icon text-white-50" style="float: left;">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    <span class="text">&nbsp;Imprimir OS <span style="font-size: .6em;"><i class="fa fa-file-pdf-o"></i></span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-white timd2" style="border: 1px solid #A4A4A4;">
                                <a href="<?php echo base_url('os/add'); ?>" class="btn btn-success btn-icon-split btn-lg btn-block">
                                    <span class="icon text-white-50" style="float: left;">
                                        <i class="fa fa-plus-square"></i>
                                    </span>
                                    <span class="text">&nbsp;Cadastrar OS</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-white timd3" style="border: 1px solid #A4A4A4;">
                                <a href="<?php echo base_url('os'); ?>" class="btn btn-info btn-icon-split btn-lg btn-block">
                                    <span class="icon text-white-50" style="float: left;">
                                        <i class="fa fa-list"></i>
                                    </span>
                                    <span class="text">&nbsp;Listar OS</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
