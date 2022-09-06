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
<!--                            <li><a href="#">Cadastros</a></li>
                            <li><a href="#">Estoque</a></li>-->
                            <li><a href="<?php echo base_url('kb'); ?>">Base de Conhecimento</a></li>
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
                    <strong class="card-title" v-if="headerText">Base de Conhecimento <small>(Knowledge Base)</small></strong>
                    <a title="Cadastrar novo KB" href="<?php echo base_url('kb/add'); ?>" class="btn btn-light btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Adicionar KB</a><a title="Voltar" href="<?php echo base_url('kb'); ?>" class="btn btn-dark btn-sm float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
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
                
               
                    <div class="ui-typography">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="border: 1px solid #B5B5B5;">
                                    <div class="card-header">
                                        <strong class="card-title">
                                            <?php echo $kb->kb_titulo; ?>
                                            <?php if($kb->kb_tipo == 0) {
                                                    echo '<span class="badge badge-warning btn-sm float-right">Colaboradores</span>';
                                                } else {
                                                    echo '<span class="badge badge-secondary btn-sm float-right">Público</span>';
                                                }
                                            ?>
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="typo-articles">
                                            <?php echo $kb->kb_ativo == 1 ? '<span class="badge badge-primary btn-sm float-left">Ativo</span>' : '<span class="badge badge-danger btn-sm float-left">Desativado</span>' ?><span class="float-right"><small><strong>Data da publicação:</strong> <?php echo formata_data_banco_sem_hora($kb->kb_data_alteracao); ?></small></span>
                                        </div>
                                        <br><hr/>
                                        <div class="typo-articles">
                                            <?php echo $kb->kb_texto; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
