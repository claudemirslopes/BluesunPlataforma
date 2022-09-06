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
                            <li><a href="<?php echo base_url('avisos'); ?>">Avisos</a></li>
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
                    <strong class="card-title" v-if="headerText">Cadastrar Aviso</strong>
                    <span class="float-right" style="color: #777;font-size: .9em;">
                        <a title="Voltar" href="<?php echo base_url('avisos'); ?>" class="btn btn-light btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
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
                
                
                    <form method="post" name="form_edit" class="user">
                        
                        <fieldset class="border p-2" style="margin-top: -10px;">
                            <legend class="font-small"><i class="fa fa-th-list"></i> Dados do aviso</legend>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="avisado_assunto">Assunto <span style="color: red;font-weight: bold;">*</span></label> 
                                    <input type="text" name="avisado_assunto" class="form-control form-control-user" id="avisado_assunto" placeholder="Assunto" value="<?php echo set_value('avisado_assunto'); ?>">
                                    <?php echo form_error('avisado_assunto', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="avisado_tipo">Tipo <span style="font-size: .7em;">(Para Quem?) </span><span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="avisado_tipo" class="form-control custom-select" id="avisado_tipo">
                                        <option value="0">Colaboradores</option>
                                        <option value="1">Clientes</option>
                                        <option value="2">Todos</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="avisado_ativa">Ativo <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="avisado_ativa" class="form-control custom-select" id="avisado_ativa">
                                        <option value="0">Não</option>
                                        <option value="1" selected="">Sim</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="avisado_formato">Formato</label>
                                    <select name="avisado_formato" class="form-control custom-select" id="avisado_tipo">
                                        <option value="0">Texto</option>
                                        <option value="1">Vídeo</option>
                                        <option value="2">Imagem</option>
                                    </select>
                                </div>
                            </div>

                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-sticky-note"></i> Mensagem <span style="color: red;font-weight: bold;">*</span></legend>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea name="avisado_mensagem" rows="5" class="form-control form-control-user" id="txtArtigo" placeholder="Mensagem"><?php echo set_value('avisado_mensagem'); ?></textarea>
                                    <?php echo form_error('avisado_mensagem', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <script src="<?php echo base_url('public/assets/ckeditor/ckeditor.js'); ?>"></script>
                                <script>
                                        CKEDITOR.replace( 'txtArtigo' );
                                </script>
                            </div>
                        </fieldset>
                        
                        <button type="submit" class="btn btn-primary btn-sm float-right mt-1"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Adicionar aviso</button>
                    </form>
                </div>

            </div>

        </div>
