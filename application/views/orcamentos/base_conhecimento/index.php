<style>
    .form-control {
        border: 1px solid #585858;
    }
    .border {
        border: 1px solid #848484 !important;
    }
</style>

    <!-- PARRA LATERAL - SIDEBAR -->
    <?php $this->load->view('orcamentos/layout/sidebar') ?>
    <!-- PARRA LATERAL - SIDEBAR -->

    <!-- BARRA DIREITA -->

    <div id="right-panel" class="right-panel">

        <!-- BARRA SUPERIOR - NAVBAR -->
        <?php $this->load->view('orcamentos/layout/navbar') ?>
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
                            <li><a href="<?php echo base_url('orcamentos/home'); ?>" style="color: #47AA0B;">Home</a></li>
<!--                            <li><a href="#">Cadastros</a></li>
                            <li><a href="#">Estoque</a></li>-->
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
                    <!--<a title="Cadastrar novo KB" href="<?php echo base_url('kb/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Adicionar KB</a>-->
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
                
              
                   <table class="bootstrap-data-table-export table table-striped table-bordered">
                        <thead>
                            <tr class="bg-danger text-light">
                                <th style="font-size: .8em;">Listagem de KBs publicados</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kbs as $kb): ?>
                            <?php if ($kb->kb_tipo == 1): ?>
                            <tr>
                                <td>
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
                                                <p class="card-text text-justify"><span class="badge badge-secondary float-left mt-1"><?php echo formata_data_banco_sem_hora($kb->kb_data_alteracao); ?></span> <a href="<?php echo base_url('orcamentos/kb/view/'.$kb->kb_id); ?>">&nbsp;<?php echo $kb->kb_resumo; ?>...</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
