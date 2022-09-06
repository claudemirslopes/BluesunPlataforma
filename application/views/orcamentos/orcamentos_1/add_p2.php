<?php
    if ($orcamento->orc_cli_cliente_id != $this->session->userdata('userlogado')->cliente_id) {
        $this->session->set_flashdata('error', 'Este orcamento não pode ser acessado por este franqueado/integrador!');
        redirect('orcamentos/orcamentos');
    }
?>
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
                        <h1 style="font-size: 1.2em;">Plataforma de Orçamentos</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?php echo base_url('orcamentos/home'); ?>" style="color: #47AA0B;">Home</a></li>
<!--                            <li><a href="#">Cadastros</a></li>
                            <li><a href="#">Pessoas</a></li>-->
                            <li><a href="<?php echo base_url('orcamentos/orcamentos'); ?>">Orçamentos</a></li>
                            <li class="active"><?php echo $titulo; ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="progress" style="background-color: #dcdcdc;height: 25px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated font-weight-bold bg-success text-light" role="progressbar" style="width: 50%;font-size: 1.2em;-webkit-text-stroke-width: .1px;-webkit-text-stroke-color: #ffffff;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">PASSO 2 [50%]</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- content -->
        <div class="content mt-2">
            <div class="card">
                <div class="card-header bg-secondary text-light">
                    <strong class="card-title" v-if="headerText">Criar Orçamento | INFORMAÇÕES DE CONSUMO MÉDIO</strong>
<!--                    <span class="float-right" style="color: #777;font-size: .9em;">
                       <a title="Voltar" href="<?php echo base_url('orcamentos/orcamentos'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
                    </span>-->
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
                            <legend class="font-small"><i class="fa fa-address-card"></i> Grupo do Cliente</legend>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <select name="orc_tipo_grupo" class="form-control form-control-user-date bg-info text-light font-weight-bold" id="grupo" onchange="grupoCheck()">
                                      <option value="" selected disabled="">Selecione</option>
                                      <option value="A">Grupo A</option>
                                      <option value="B">Grupo B</option>
                                    </select>
                                  </div>
                            </div>
<!--                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                <input type="radio" id="grupo_a" name="orc_tipo_grupo" class="custom-control-input" value="A" <?php echo set_checkbox('orc_tipo_grupo', 'A') ?> checked="">
                                <label class="custom-control-label pt-1" for="grupo_a">Grupo A</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="grupo_b" name="orc_tipo_grupo" class="custom-control-input" value="B" <?php echo set_checkbox('orc_tipo_grupo', 'B') ?> >
                                <label class="custom-control-label pt-1" for="grupo_b">Grupo B</label>
                            </div>-->
                        </fieldset>
                        
                        <div id="hiddenA" style="display: none;" class="grupo_a">
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-cogs"></i> Grupo A</legend>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="orc_demanda_contratada">Demanda Contratada em KW <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_demanda_contratada" class="form-control form-control-user" id="orc_demanda_contratada" placeholder="Digite a demanda contratada em KW" value="<?php echo $orcamento->orc_demanda_contratada; ?>">           
                                    <?php echo form_error('orc_demanda_contratada', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_consumo_ponta">Consumo (Ativo) PONTA (TE) em KWh <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_consumo_ponta" class="form-control form-control-user" id="orc_consumo_ponta" placeholder="Digite o Consumo de Ponta em KWh" value="<?php echo $orcamento->orc_consumo_ponta; ?>">
                                    <?php echo form_error('orc_consumo_ponta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_consumo_fora_ponta">Consumo (Ativo) FORA DE PONTA (TE) em KWh </label>
                                    <input type="text" name="orc_consumo_fora_ponta" class="form-control form-control-user" id="orc_consumo_fora_ponta" placeholder="Digite o Consumo Fora de Ponta em KWh" value="<?php echo $orcamento->orc_consumo_fora_ponta; ?>">
                                    <?php echo form_error('orc_consumo_fora_ponta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_kw_ponta">Valor KWh Ponta </label>
                                    <input type="text" name="orc_valor_kw_ponta" class="form-control form-control-user" id="orc_valor_kw_ponta" placeholder="Digite o valor do KWh no Horário de Ponta" value="<?php echo $orcamento->orc_valor_kw_ponta; ?>">           
                                    <?php echo form_error('orc_valor_kw_ponta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_kw_fora_ponta">Valor KWh Fora de Ponta </label>
                                    <input type="text" name="orc_valor_kw_fora_ponta" class="form-control form-control-user" id="orc_valor_kw_fora_ponta" placeholder="Digite o Valor do KWh fora de Ponta" value="<?php echo $orcamento->orc_valor_kw_fora_ponta; ?>">
                                    <?php echo form_error('orc_valor_kw_fora_ponta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_conta">Valor Total da Conta </label>
                                    <input type="text" name="orc_valor_conta" class="form-control form-control-user" id="orc_valor_conta" placeholder="Digite o Valor Total da Conta" value="<?php echo $orcamento->orc_valor_conta; ?>">
                                    <?php echo form_error('orc_valor_conta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_demanda_contratada">Valor da Demanda Contratada </label>
                                    <input type="text" name="orc_valor_demanda_contratada" class="form-control form-control-user" id="orc_valor_demanda_contratada" placeholder="Digite o Valor da Demanda" value="<?php echo $orcamento->orc_valor_demanda_contratada; ?>">
                                    <?php echo form_error('orc_valor_demanda_contratada', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                            <p><span class="text-danger font-weight-bold">*</span> Campos obrigatórios</p>
                        </div>
                        
                        <div id="hiddenB" style="display: none;" class="grupo_b">
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-cogs"></i> Grupo B</legend>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes1">Consumo Mês 01 <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_consumo_mes1" class="form-control form-control-user" id="orc_consumo_mes1" placeholder="Consumo Mês 01" value="<?php echo $orcamento->orc_consumo_mes1; ?>">           
                                    <?php echo form_error('orc_consumo_mes1', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes2">Consumo Mês 02 </label>
                                    <input type="text" name="orc_consumo_mes2" class="form-control form-control-user" id="orc_consumo_mes2" placeholder="Consumo Mês 02" value="<?php echo $orcamento->orc_consumo_mes2; ?>">           
                                    <?php echo form_error('orc_consumo_mes2', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes3">Consumo Mês 03 </label>
                                    <input type="text" name="orc_consumo_mes3" class="form-control form-control-user" id="orc_consumo_mes3" placeholder="Consumo Mês 03" value="<?php echo $orcamento->orc_consumo_mes3; ?>">           
                                    <?php echo form_error('orc_consumo_mes3', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes4">Consumo Mês 04 </label>
                                    <input type="text" name="orc_consumo_mes4" class="form-control form-control-user" id="orc_consumo_mes4" placeholder="Consumo Mês 04" value="<?php echo $orcamento->orc_consumo_mes4; ?>">           
                                    <?php echo form_error('orc_consumo_mes4', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes5">Consumo Mês 05 </label>
                                    <input type="text" name="orc_consumo_mes5" class="form-control form-control-user" id="orc_consumo_mes5" placeholder="Consumo Mês 05" value="<?php echo $orcamento->orc_consumo_mes5; ?>">           
                                    <?php echo form_error('orc_consumo_mes5', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes6">Consumo Mês 06 </label>
                                    <input type="text" name="orc_consumo_mes6" class="form-control form-control-user" id="orc_consumo_mes6" placeholder="Consumo Mês 06" value="<?php echo $orcamento->orc_consumo_mes6; ?>">           
                                    <?php echo form_error('orc_consumo_mes6', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes7">Consumo Mês 07 </label>
                                    <input type="text" name="orc_consumo_mes7" class="form-control form-control-user" id="orc_consumo_mes7" placeholder="Consumo Mês 07" value="<?php echo $orcamento->orc_consumo_mes7; ?>">           
                                    <?php echo form_error('orc_consumo_mes7', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes8">Consumo Mês 08 </label>
                                    <input type="text" name="orc_consumo_mes8" class="form-control form-control-user" id="orc_consumo_mes8" placeholder="Consumo Mês 08" value="<?php echo $orcamento->orc_consumo_mes8; ?>">           
                                    <?php echo form_error('orc_consumo_mes8', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes9">Consumo Mês 09 </label>
                                    <input type="text" name="orc_consumo_mes9" class="form-control form-control-user" id="orc_consumo_mes9" placeholder="Consumo Mês 09" value="<?php echo $orcamento->orc_consumo_mes9; ?>">           
                                    <?php echo form_error('orc_consumo_mes9', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes10">Consumo Mês 10 </label>
                                    <input type="text" name="orc_consumo_mes10" class="form-control form-control-user" id="orc_consumo_mes10" placeholder="Consumo Mês 10" value="<?php echo $orcamento->orc_consumo_mes10; ?>">           
                                    <?php echo form_error('orc_consumo_mes10', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes11">Consumo Mês 11 </label>
                                    <input type="text" name="orc_consumo_mes11" class="form-control form-control-user" id="orc_consumo_mes11" placeholder="Consumo Mês 11" value="<?php echo $orcamento->orc_consumo_mes11; ?>">           
                                    <?php echo form_error('orc_consumo_mes11', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes12">Consumo Mês 12 </label>
                                    <input type="text" name="orc_consumo_mes12" class="form-control form-control-user" id="orc_consumo_mes12" placeholder="Consumo Mês 12" value="<?php echo $orcamento->orc_consumo_mes12; ?>">           
                                    <?php echo form_error('orc_consumo_mes12', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="orc_consumo_mes13">Consumo Mês 13 </label>
                                    <input type="text" name="orc_consumo_mes13" class="form-control form-control-user" id="orc_consumo_mes13" placeholder="Consumo Mês 13" value="<?php echo $orcamento->orc_consumo_mes13; ?>">           
                                    <?php echo form_error('orc_consumo_mes13', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                            <p><span class="text-danger font-weight-bold">*</span> Campos obrigatórios</p>
                        </div>
                        
                        <input type="hidden" name="orc_id" value="<?php echo $orcamento->orc_id; ?>">                       
                        <button type="submit" class="btn btn-primary btn-sm float-right mt-1" style="width: 100%;font-size: 1.5em;">PRÓXIMO PASSO&nbsp;&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                        
                    </form>
                </div>

            </div>

        </div>
