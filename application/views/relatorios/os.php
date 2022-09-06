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
                            <li><a href="<?php echo base_url('relatorios'); ?>">Relatórios</a></li>
                            <!--<li><a href="#">Estoque</a></li>-->
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
                    <strong class="card-title" v-if="headerText">Relatório de Ordem de Serviço</strong>
                    <!--<a title="Cadastrar novo categoria" href="<?php echo base_url('categorias/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Nova categoria</a>-->
                </div>
                
                <div class="card-body" style="border: 1px solid #A4A4A4;">
                                
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
                
                
                    <form action="" target="_blank" class="user" name="form_vendas" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                        <fieldset class="border p-2" style="margin-top: -10px;">

                            <legend class="font-small"><i class="fa fa-calendar"></i></i>&nbsp;&nbsp;Escolhas as datas</legend>

                            <div class="form-group row">

                                <div class="col-sm-6 mb-1 mb-sm-0">
                                    <label class="small my-0">Data inicial</label>
                                    <input type="date" class="form-control" name="data_inicial" required="">
                                </div>

                                <div class="col-sm-6 mb-1 mb-sm-0">
                                    <label class="small my-0">Data final</label>
                                    <input type="date" class="form-control" name="data_final">
                                </div>

                            </div>

                        </fieldset>

                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm mr-2 float-right"><i class="fa fa-list" aria-hidden="true"></i> Gerar relatório</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
