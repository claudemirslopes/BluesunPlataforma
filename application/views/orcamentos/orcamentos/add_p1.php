<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
        
<!--        <div class="content">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="progress" style="background-color: #dcdcdc;height: 25px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated font-weight-bold bg-success text-light" role="progressbar" style="width: 25%;font-size: 1.2em;-webkit-text-stroke-width: .1px;-webkit-text-stroke-color: #ffffff;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">PASSO 1 [25%]</div>
                    </div>
                </div>
            </div>
        </div>-->
        
        <!-- content -->
        <div class="content mt-2">
            <div class="card">
                <div class="card-header bg-secondary text-light">
                    <strong class="card-title" v-if="headerText">CRIAR ORÇAMENTO</strong>
                    <span class="float-right">
                       <a title="Voltar" href="<?php echo base_url('orcamentos/orcamentos'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
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
                
                <form method="post" name="form_add" class="user" id="post">
                    <fieldset class="border p-2 fset" style="margin-top: -10px;">
                        <legend class="font-small"><i class="fa fa-address-card"></i> Tipo de pessoa</legend>
                        <div class="custom-control custom-radio custom-control-inline mt-2">
                            <input type="radio" id="pessoa_fisica" name="orc_cli_pessoa" class="custom-control-input" value="1" <?php echo set_checkbox('orc_cli_pessoa', '1') ?> checked="">
                            <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa Física</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="pessoa_juridica" name="orc_cli_pessoa" class="custom-control-input" value="2" <?php echo set_checkbox('orc_cli_pessoa', '2') ?> >
                            <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa Jurídica</label>
                        </div>
                    </fieldset>
                    
                    <fieldset class="mt-2 border p-2">
                        <legend class="font-small"><i class="fa fa-user-circle"></i> Dados Pessoais/Empresariais</legend>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <div class="pessoa_fisica">
                                    <label for="orc_cli_cpf">CPF <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_cli_cpf" class="form-control form-control-user cpfmask" id="cpf" placeholder="CPF" value="<?php echo set_value('orc_cli_cpf'); ?>">           
                                    <?php echo form_error('orc_cli_cpf', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="pessoa_juridica">
                                    <label for="orc_cli_cnpj">CNPJ <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_cli_cnpj" class="form-control form-control-user cnpjmask" id="cnpj" placeholder="CNPJ" value="<?php echo set_value('orc_cli_cnpj'); ?>">
                                    <?php echo form_error('orc_cli_cnpj', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            <!--<div class="form-group col-md-2">
                                <label for="orc_cli_uniconsum">Unidade Consumidora <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_uniconsum" class="form-control form-control-user" id="uncon" placeholder="Unidade Consumidora" value="<?php echo set_value('orc_cli_uniconsum'); ?>">
                                <?php echo form_error('orc_cli_uniconsum', '<small class="form-text text-danger">','</small>') ?>
                            </div>-->
                            <div class="form-group col-md-2" style="display: none;">
                                <label for="orc_status">Ativo <span style="color: red;font-weight: bold;">*</span></label>
                                <select name="orc_status" class="form-control custom-select" id="orc_status">
                                    <option value="0">Não</option>
                                    <option value="1" selected="">Sim</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2" style="display: none;">
                                <label for="orc_codigo">Orçamento nº <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_codigo" class="form-control form-control-user-date bg-dark text-light font-weight-bold" id="orc_codigo" value="<?php echo $orc_codigo; ?>" readonly="">
                            </div>
                            <div class="form-group col-md-5">
                                <label class="pessoa_fisica" for="orc_cli_nome">Nome <span style="color: red;font-weight: bold;">*</span></label>
                                <label class="pessoa_juridica" for="orc_cli_nome">Razão Social <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_nome" class="form-control form-control-user" id="nome" placeholder="Nome/Razão Social" value="<?php echo set_value('orc_cli_nome'); ?>">
                                <?php echo form_error('orc_cli_nome', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="orc_cli_email">E-mail <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="email" name="orc_cli_email" class="form-control form-control-user" id="email" placeholder="E-mail" value="<?php echo set_value('orc_cli_email'); ?>">
                                <?php echo form_error('orc_cli_email', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="orc_cli_telcel">Telefone/Celular <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_telcel" class="form-control form-control-user celular" id="telefone" placeholder="Telefone/Celular" value="<?php echo set_value('orc_cli_telcel'); ?>">
                                <?php echo form_error('orc_cli_telcel', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                    </fieldset>
                    
                    <fieldset class="mt-2 border p-2">
                        <legend class="font-small"><i class="fa fa-address-card"></i> Grupo do Cliente</legend>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <select name="orc_tipo_grupo" class="form-control form-control-user-date font-weight-bold text-info" id="grupo" onchange="grupoCheck()">
                                  <option value="" selected disabled="">Selecione</option>
                                  <option value="A">Grupo A</option>
                                  <option value="B">Grupo B</option>
                                </select>
                              </div>
                        </div>
                    </fieldset>
                    
                    <div id="hiddenA" style="display: none;" class="grupo_a">
                    <fieldset class="mt-2 border p-2">
                        <legend class="font-small"><i class="fa fa-cogs"></i> Grupo A</legend>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="orc_demanda_contratada">Demanda Contratada em KW <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_demanda_contratada" class="form-control form-control-user" id="orc_demanda_contratada" placeholder="Digite a demanda contratada em KW" value="<?php echo set_value('orc_demanda_contratada'); ?>">           
                                <?php echo form_error('orc_demanda_contratada', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="orc_consumo_ponta">Consumo (Ativo) PONTA (TE) em KWh <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_consumo_ponta" class="form-control form-control-user" id="orc_consumo_ponta" placeholder="Digite o Consumo de Ponta em KWh" value="<?php echo set_value('orc_consumo_ponta'); ?>">
                                <?php echo form_error('orc_consumo_ponta', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="orc_consumo_fora_ponta">Consumo (Ativo) FORA DE PONTA (TE) em KWh </label>
                                <input type="text" name="orc_consumo_fora_ponta" class="form-control form-control-user" id="orc_consumo_fora_ponta" placeholder="Digite o Consumo Fora de Ponta em KWh" value="<?php echo set_value('orc_consumo_fora_ponta'); ?>">
                                <?php echo form_error('orc_consumo_fora_ponta', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="orc_valor_kw_ponta">Valor KWh Ponta </label>
                                <input type="text" name="orc_valor_kw_ponta" class="form-control form-control-user" id="orc_valor_kw_ponta" placeholder="Digite o valor do KWh no Horário de Ponta" value="<?php echo set_value('orc_valor_kw_ponta'); ?>">           
                                <?php echo form_error('orc_valor_kw_ponta', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="orc_valor_kw_fora_ponta">Valor KWh Fora de Ponta </label>
                                <input type="text" name="orc_valor_kw_fora_ponta" class="form-control form-control-user" id="orc_valor_kw_fora_ponta" placeholder="Digite o Valor do KWh fora de Ponta" value="<?php echo set_value('orc_valor_kw_fora_ponta'); ?>">
                                <?php echo form_error('orc_valor_kw_fora_ponta', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="orc_valor_conta">Valor Total da Conta </label>
                                <input type="text" name="orc_valor_conta" class="form-control form-control-user" id="orc_valor_conta" placeholder="Digite o Valor Total da Conta" value="<?php echo set_value('orc_valor_conta'); ?>">
                                <?php echo form_error('orc_valor_conta', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="orc_valor_demanda_contratada">Valor da Demanda Contratada </label>
                                <input type="text" name="orc_valor_demanda_contratada" class="form-control form-control-user" id="orc_valor_demanda_contratada" placeholder="Digite o Valor da Demanda" value="<?php echo set_value('orc_valor_demanda_contratada'); ?>">
                                <?php echo form_error('orc_valor_demanda_contratada', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                    </fieldset>
                    </div>

                    <div id="hiddenB" style="display: none;" class="grupo_b">
                    <fieldset class="mt-2 border p-2">
                        <legend class="font-small"><i class="fa fa-cogs"></i> Grupo B</legend>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes1">Consumo Mês 01 <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_consumo_mes1" class="form-control form-control-user" id="orc_consumo_mes1" placeholder="Consumo Mês 01" value="<?php echo set_value('orc_consumo_mes1'); ?>">           
                                <?php echo form_error('orc_consumo_mes1', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes2">Consumo Mês 02 </label>
                                <input type="text" name="orc_consumo_mes2" class="form-control form-control-user" id="orc_consumo_mes2" placeholder="Consumo Mês 02" value="<?php echo set_value('orc_consumo_mes2'); ?>">           
                                <?php echo form_error('orc_consumo_mes2', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes3">Consumo Mês 03 </label>
                                <input type="text" name="orc_consumo_mes3" class="form-control form-control-user" id="orc_consumo_mes3" placeholder="Consumo Mês 03" value="<?php echo set_value('orc_consumo_mes3'); ?>">           
                                <?php echo form_error('orc_consumo_mes3', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes4">Consumo Mês 04 </label>
                                <input type="text" name="orc_consumo_mes4" class="form-control form-control-user" id="orc_consumo_mes4" placeholder="Consumo Mês 04" value="<?php echo set_value('orc_consumo_mes4'); ?>">           
                                <?php echo form_error('orc_consumo_mes4', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes5">Consumo Mês 05 </label>
                                <input type="text" name="orc_consumo_mes5" class="form-control form-control-user" id="orc_consumo_mes5" placeholder="Consumo Mês 05" value="<?php echo set_value('orc_consumo_mes5'); ?>">           
                                <?php echo form_error('orc_consumo_mes5', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes6">Consumo Mês 06 </label>
                                <input type="text" name="orc_consumo_mes6" class="form-control form-control-user" id="orc_consumo_mes6" placeholder="Consumo Mês 06" value="<?php echo set_value('orc_consumo_mes6'); ?>">           
                                <?php echo form_error('orc_consumo_mes6', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes7">Consumo Mês 07 </label>
                                <input type="text" name="orc_consumo_mes7" class="form-control form-control-user" id="orc_consumo_mes7" placeholder="Consumo Mês 07" value="<?php echo set_value('orc_consumo_mes7'); ?>">           
                                <?php echo form_error('orc_consumo_mes7', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes8">Consumo Mês 08 </label>
                                <input type="text" name="orc_consumo_mes8" class="form-control form-control-user" id="orc_consumo_mes8" placeholder="Consumo Mês 08" value="<?php echo set_value('orc_consumo_mes8'); ?>">           
                                <?php echo form_error('orc_consumo_mes8', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes9">Consumo Mês 09 </label>
                                <input type="text" name="orc_consumo_mes9" class="form-control form-control-user" id="orc_consumo_mes9" placeholder="Consumo Mês 09" value="<?php echo set_value('orc_consumo_mes9'); ?>">           
                                <?php echo form_error('orc_consumo_mes9', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes10">Consumo Mês 10 </label>
                                <input type="text" name="orc_consumo_mes10" class="form-control form-control-user" id="orc_consumo_mes10" placeholder="Consumo Mês 10" value="<?php echo set_value('orc_consumo_mes10'); ?>">           
                                <?php echo form_error('orc_consumo_mes10', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes11">Consumo Mês 11 </label>
                                <input type="text" name="orc_consumo_mes11" class="form-control form-control-user" id="orc_consumo_mes11" placeholder="Consumo Mês 11" value="<?php echo set_value('orc_consumo_mes11'); ?>">           
                                <?php echo form_error('orc_consumo_mes11', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes12">Consumo Mês 12 </label>
                                <input type="text" name="orc_consumo_mes12" class="form-control form-control-user" id="orc_consumo_mes12" placeholder="Consumo Mês 12" value="<?php echo set_value('orc_consumo_mes12'); ?>">           
                                <?php echo form_error('orc_consumo_mes12', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="orc_consumo_mes13">Consumo Mês 13 </label>
                                <input type="text" name="orc_consumo_mes13" class="form-control form-control-user" id="orc_consumo_mes13" placeholder="Consumo Mês 13" value="<?php echo set_value('orc_consumo_mes13'); ?>">           
                                <?php echo form_error('orc_consumo_mes13', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                    </fieldset>
                        <p><span class="text-danger font-weight-bold">*</span> Campos obrigatórios</p>
                    </div>
                    
                    <fieldset class="mt-2 border p-2">
                        <legend class="font-small"><i class="fa fa-solar-panel"></i> Estrutura/Kits</legend>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="orc_cli_cep">Potência (Kwp) <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_cep" class="form-control form-control-user" id="" placeholder="Potência (Kwp)" value="<?php echo set_value('orc_cli_cep'); ?>">
                                <?php echo form_error('orc_cli_cep', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="orc_cli_cep">Módulo <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_cep" class="form-control form-control-user" id="" placeholder="Módulo" value="<?php echo set_value('orc_cli_cep'); ?>">
                                <?php echo form_error('orc_cli_cep', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="orc_cli_cep">Marca do Inversor <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_cep" class="form-control form-control-user" id="" placeholder="Marca do Inversor" value="<?php echo set_value('orc_cli_cep'); ?>">
                                <?php echo form_error('orc_cli_cep', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="orc_cli_cep">String Box <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_cep" class="form-control form-control-user" id="" placeholder="String Box" value="<?php echo set_value('orc_cli_cep'); ?>">
                                <?php echo form_error('orc_cli_cep', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="orc_cli_cep">Fase <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_cep" class="form-control form-control-user" id="" placeholder="Fase" value="<?php echo set_value('orc_cli_cep'); ?>">
                                <?php echo form_error('orc_cli_cep', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="orc_cli_cep">Tensão <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_cep" class="form-control form-control-user" id="" placeholder="Tensão" value="<?php echo set_value('orc_cli_cep'); ?>">
                                <?php echo form_error('orc_cli_cep', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="orc_cli_cep">Tipo da Estrutura <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_cep" class="form-control form-control-user" id="" placeholder="String Box" value="<?php echo set_value('orc_cli_cep'); ?>">
                                <?php echo form_error('orc_cli_cep', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="orc_cli_cep">Marca da Estrutura <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_cep" class="form-control form-control-user" id="" placeholder="Fase" value="<?php echo set_value('orc_cli_cep'); ?>">
                                <?php echo form_error('orc_cli_cep', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="orc_cli_cep">Transformador/Autotransformador <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="orc_cli_cep" class="form-control form-control-user" id="" placeholder="Transformador/Autotransformador" value="<?php echo set_value('orc_cli_cep'); ?>">
                                <?php echo form_error('orc_cli_cep', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                    </fieldset>
                </form>
                
<!--                    <form method="post" name="form_add" class="user">
                        
                        <fieldset class="border p-2 fset" style="margin-top: -10px;">
                            <legend class="font-small"><i class="fa fa-address-card"></i> Tipo de pessoa</legend>
                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                <input type="radio" id="pessoa_fisica" name="orc_cli_pessoa" class="custom-control-input" value="1" <?php echo set_checkbox('orc_cli_pessoa', '1') ?> checked="">
                                <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa Física</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="pessoa_juridica" name="orc_cli_pessoa" class="custom-control-input" value="2" <?php echo set_checkbox('orc_cli_pessoa', '2') ?> >
                                <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa Jurídica</label>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-cogs"></i> Configurações</legend>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <div class="pessoa_fisica">
                                        <label for="orc_cli_cpf">CPF <span style="color: red;font-weight: bold;">*</span></label>
                                        <input type="text" name="orc_cli_cpf" class="form-control form-control-user cpfmask" id="orc_cli_cpf" placeholder="CPF" value="<?php echo set_value('orc_cli_cpf'); ?>">           
                                        <?php echo form_error('orc_cli_cpf', '<small class="form-text text-danger">','</small>') ?>
                                    </div>
                                    <div class="pessoa_juridica">
                                        <label for="orc_cli_cnpj">CNPJ <span style="color: red;font-weight: bold;">*</span></label>
                                        <input type="text" name="orc_cli_cnpj" class="form-control form-control-user cnpjmask" id="orc_cli_cnpj" placeholder="CNPJ" value="<?php echo set_value('orc_cli_cnpj'); ?>">
                                        <?php echo form_error('orc_cli_cnpj', '<small class="form-text text-danger">','</small>') ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_cli_uniconsum">Unidade Consumidora <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_cli_uniconsum" class="form-control form-control-user" id="uncon" placeholder="Unidade Consumidora" value="<?php echo set_value('orc_cli_uniconsum'); ?>">
                                    <?php echo form_error('orc_cli_uniconsum', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="orc_status">Ativo <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="orc_status" class="form-control custom-select" id="orc_status">
                                        <option value="0">Não</option>
                                        <option value="1" selected="">Sim</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="orc_codigo">Orçamento nº <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_codigo" class="form-control form-control-user-date bg-dark text-light font-weight-bold" id="orc_codigo" value="<?php echo $orc_codigo; ?>" readonly="">
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-user-circle"></i> Dados Pessoais/Empresariais</legend>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="pessoa_fisica" for="orc_cli_nome">Nome <span style="color: red;font-weight: bold;">*</span></label>
                                    <label class="pessoa_juridica" for="orc_cli_nome">Razão Social <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_cli_nome" class="form-control form-control-user" id="orc_cli_nome" placeholder="Nome/Razão Social" value="<?php echo set_value('orc_cli_nome'); ?>">
                                    <?php echo form_error('orc_cli_nome', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_cli_email">E-mail <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="email" name="orc_cli_email" class="form-control form-control-user" id="orc_cli_email" placeholder="E-mail" value="<?php echo set_value('orc_cli_email'); ?>">
                                    <?php echo form_error('orc_cli_email', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_cli_telcel">Telefone/Celular <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_cli_telcel" class="form-control form-control-user celular" id="orc_cli_telcel" placeholder="Telefone/Celular" value="<?php echo set_value('orc_cli_telcel'); ?>">
                                    <?php echo form_error('orc_cli_telcel', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-map-marker"></i> Informações de Endereço</legend>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="orc_cli_cep">CEP <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_cli_cep" class="form-control form-control-user cep" id="cep" placeholder="CEP" value="<?php echo set_value('orc_cli_cep'); ?>">
                                    <?php echo form_error('orc_cli_cep', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="orc_cli_endereco">Endereço <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_cli_endereco" class="form-control form-control-user" id="rua" placeholder="Logradouro, rua, etc..." value="<?php echo set_value('orc_cli_endereco'); ?>">
                                    <?php echo form_error('orc_cli_endereco', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="orc_cli_numero">Nº</label>
                                    <input type="text" name="orc_cli_numero" class="form-control form-control-user" id="numero" placeholder="nº" value="<?php echo set_value('orc_cli_numero'); ?>">
                                    <?php echo form_error('orc_cli_numero', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="orc_cli_complemento">Complemento</label>
                                    <input type="text" name="orc_cli_complemento" class="form-control form-control-user" id="complemento" placeholder="Complemento" value="<?php echo set_value('orc_cli_complemento'); ?>">
                                    <?php echo form_error('orc_cli_complemento', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_cli_bairro">Bairro <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_cli_bairro" class="form-control form-control-user" id="bairro" placeholder="Bairro" value="<?php echo set_value('orc_cli_bairro'); ?>">
                                    <?php echo form_error('orc_cli_bairro', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_cli_cidade">Cidade <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_cli_cidade" class="form-control form-control-user" id="cidade" placeholder="Cidade" value="<?php echo set_value('orc_cli_cidade'); ?>">
                                    <?php echo form_error('orc_cli_cidade', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="orc_cli_estado">UF <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="orc_cli_estado" class="form-control custom-select" id="uf">
                                        <option disabled="" selected="">Selecione</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>   
                                    <?php echo form_error('orc_cli_estado', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        <input type="hidden" name="orc_cli_cliente_id" value="<?php echo $this->session->userdata('userlogado')->cliente_id; ?>">
                        
                        <button type="submit" class="btn btn-primary btn-sm float-right mt-3" style="width: 100%;font-size: 1.5em;">PRÓXIMO PASSO&nbsp;&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                    </form>-->
                </div>

            </div>

        </div>
<script type="text/javascript">
$("#cnpj").focusout(function(){
        //Início do Comando AJAX
        $.ajax({
            //O campo URL diz o caminho de onde virá os dados
            //É importante concatenar o valor digitado no CNPJ
            url: 'http://localhost/BluesunPlataforma/dados/cnpj.php?cnpj='+$("#cnpj").val(),
            //Atualização: caso use java, use cnpj.jsp, usando o outro exemplo.
            //Aqui você deve preencher o tipo de dados que será lido,
            //no caso, estamos lendo JSON.
            dataType: 'json',
            //SUCESS é referente a função que será executada caso
            //ele consiga ler a fonte de dados com sucesso.
            //O parâmetro dentro da função se refere ao nome da variável
            //que você vai dar para ler esse objeto.
            success: function(resposta){
                    //Confere se houve erro e o imprime
                    if(resposta.status == "ERROR"){
                            alert(resposta.message + "\nPor favor, digite os dados manualmente.");
                            $("#post #nome").focus().select();
                            return false;
                    }
                    //Agora basta definir os valores que você deseja preencher
                    //automaticamente nos campos acima.
                    $("#post #nome").val(resposta.nome);
                    $("#post #telefone").val(resposta.telefone);
                    $("#post #email").val(resposta.email);
                }
            });
});
</script>