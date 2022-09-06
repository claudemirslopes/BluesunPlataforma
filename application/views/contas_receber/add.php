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
                            <li><a href="#">Financeiro</a></li>
                            <li><a href="<?php echo base_url('contas_receber'); ?>">Contas a Receber</a></li>
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
                    <strong class="card-title" v-if="headerText">Cadastrar Conta a Receber</strong>
                    <span class="float-right" style="color: #777;font-size: .9em;">
                        <a title="Voltar" href="<?php echo base_url('contas_receber'); ?>" class="btn btn-light btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
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
                            <legend class="font-small"><i class="fa fa-credit-card-alt"></i> Dados da conta</legend>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="conta_receber_cliente_id">Autorizado <span style="color: red;font-weight: bold;">*</span></label> 
                                    <select class="custom-select contas_receber" name="conta_receber_cliente_id" required="">
                                        <?php foreach($clientes as $cliente): ?>
                                        <option value="<?php echo $cliente->cliente_id ?>"><?php echo $cliente->cliente_nome.'&nbsp;'.$cliente->cliente_sobrenome; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('conta_receber_cliente_id', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="conta_receber_valor">Valor <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="conta_receber_valor" class="form-control form-control-user money2" id="conta_receber_valor" placeholder="Ex: 99,99" value="<?php echo set_value('conta_receber_valor'); ?>">
                                    <?php echo form_error('conta_receber_valor', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="conta_receber_data_vencimento">Data de Vencimento <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="date" name="conta_receber_data_vencimento" class="form-control form-control-user-date" id="conta_receber_data_vencimento" placeholder="Vencimento" value="<?php echo set_value('conta_receber_data_vencimento'); ?>">
                                    <?php echo form_error('conta_receber_data_vencimento', '<small class="form-text text-danger">','</small>') ?>
                                </div>
<!--                                <div class="form-group col-md-2">
                                    <label for="conta_receber_data_pagamento">Data de Pagamento <span style="color: red;font-weight: bold;">*</span></label>
                                                                    <input type="date" name="conta_receber_data_pagamento" class="form-control form-control-user-date" id="conta_receber_data_pagamento" placeholder="Pagamento" value="<?php echo set_value('conta_receber_data_pagamento'); ?>">
                                    <?php echo form_error('conta_receber_data_pagamento', '<small class="form-text text-danger">','</small>') ?>
                                </div>-->
                                <div class="form-group col-md-2">
                                    <label for="conta_receber_ativo">Situação <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="conta_receber_status" class="form-control custom-select" id="conta_receber_ativo">
                                        <option value="0">Pendente</option>
                                        <option value="1">Paga</option>
                                    </select>
                                </div>
                            </div>

                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-sticky-note"></i> Observação</legend>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea name="conta_receber_obs" rows="5" class="form-control form-control-user" id="conta_receber_obs" placeholder="Observação"><?php echo set_value('conta_receber_obs'); ?></textarea>
                                    <?php echo form_error('conta_receber_obs', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <button type="submit" class="btn btn-primary btn-sm float-right mt-1"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar conta a receber</button>
                        
                    </form>
                </div>

            </div>

        </div>
