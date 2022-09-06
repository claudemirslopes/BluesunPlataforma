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
                        <div class="progress-bar progress-bar-striped progress-bar-animated font-weight-bold bg-success text-light" role="progressbar" style="width: 75%;font-size: 1.2em;-webkit-text-stroke-width: .1px;-webkit-text-stroke-color: #ffffff;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">PASSO 3 [75%]</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- content -->
        <div class="content mt-2">
            <div class="card">
                <div class="card-header bg-secondary text-light">
                    <strong class="card-title" v-if="headerText">Criar Orçamento | INFORMAÇÕES DO SISTEMA</strong>
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
                      
                        <input type="hidden" name="orc_tipo_grupo" readonly=""  class="form-control form-control-user" id="orc_tipo_grupo" value="<?php echo $orcamento->orc_tipo_grupo; ?>">
                               
                        <?php if($orcamento->orc_tipo_grupo == 'A'): ?>
                        <fieldset class="border p-2" style="margin-top: -10px;">
                            <legend class="font-small"><i class="fa fa-cogs"></i> Grupo A</legend>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="orc_consumo_ponta">Consumo (Ativo) PONTA (TE) em KWh <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_consumo_ponta" class="form-control form-control-user" id="orc_consumo_ponta" placeholder="Digite o Consumo de Ponta em KWh" value="<?php echo $orcamento->orc_consumo_ponta; ?>">
                                    <?php echo form_error('orc_consumo_ponta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_consumo_fora_ponta">Consumo (Ativo) FORA DE PONTA (TE) em KWh <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_consumo_fora_ponta" class="form-control form-control-user" id="orc_consumo_fora_ponta" placeholder="Digite o Consumo Fora de Ponta em KWh" value="<?php echo $orcamento->orc_consumo_fora_ponta; ?>">
                                    <?php echo form_error('orc_consumo_fora_ponta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_kw_ponta">Valor KWh Ponta <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_valor_kw_ponta" class="form-control form-control-user" id="orc_valor_kw_ponta" placeholder="Digite o valor do KWh no Horário de Ponta" value="<?php echo $orcamento->orc_valor_kw_ponta; ?>">           
                                    <?php echo form_error('orc_valor_kw_ponta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_kw_fora_ponta">Valor KWh Fora de Ponta <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_valor_kw_fora_ponta" class="form-control form-control-user" id="orc_valor_kw_fora_ponta" placeholder="Digite o Valor do KWh fora de Ponta" value="<?php echo $orcamento->orc_valor_kw_fora_ponta; ?>">
                                    <?php echo form_error('orc_valor_kw_fora_ponta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_demanda_contratada">Demanda Contratada em KW <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_demanda_contratada" class="form-control form-control-user" id="orc_demanda_contratada" placeholder="Digite a demanda contratada em KW" value="<?php echo $orcamento->orc_demanda_contratada; ?>">           
                                    <?php echo form_error('orc_demanda_contratada', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_conta">Valor Total da Conta <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_valor_conta" class="form-control form-control-user" id="orc_valor_conta" placeholder="Digite o Valor Total da Conta" value="<?php echo $orcamento->orc_valor_conta; ?>">
                                    <?php echo form_error('orc_valor_conta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_demanda_contratada">Valor da Demanda Contratada <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_valor_demanda_contratada" class="form-control form-control-user" id="orc_valor_demanda_contratada" placeholder="Digite o Valor da Demanda" value="<?php echo $orcamento->orc_valor_demanda_contratada; ?>">
                                    <?php echo form_error('orc_valor_demanda_contratada', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_irradiacao_local_dia">Irradiação Local/Dia <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_irradiacao_local_dia" class="form-control form-control-user" id="orc_irradiacao_local_dia" placeholder="Irradiação Local/Dia" value="<?php echo $orcamento->orc_irradiacao_local_dia; ?>">
                                    <?php echo form_error('orc_irradiacao_local_dia', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_inclinacao_ideal">Inclinação Ideal (em º) <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_inclinacao_ideal" class="form-control form-control-user" id="orc_inclinacao_ideal" placeholder="Inclinação Ideal" value="<?php echo $orcamento->orc_inclinacao_ideal; ?>">           
                                    <?php echo form_error('orc_inclinacao_ideal', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_perda">Porcentagem de Perda <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="orc_valor_perda" class="form-control form-control-user-date bg-bluec" id="orc_valor_perda">
                                        <option value="10">10%</option>
                                        <option value="20">20%</option>
                                        <option value="30">30%</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_concessionaria">Concessionária <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="orc_concessionaria" class="form-control form-control-user-date bg-bluem" id="orc_concessionaria">
                                        <option disabled="" selected="">Selecione</option>
                                        <option value="AES Eletropaulo" >AES Eletropaulo</option>
                                        <option value="AES Sul Distribuidora Gaúcha de Energia S.A." >AES Sul Distribuidora Gaúcha de Energia S.A.</option>
                                        <option value="AES Tietê S/A" >AES Tietê S/A</option>
                                        <option value="Amazonas Energia S/A" >Amazonas Energia S/A</option>
                                        <option value="Ampla Energia e Serviços S.A." >Ampla Energia e Serviços S.A.</option>
                                        <option value="Caiuá Distribuição de Energia S.A." >Caiuá Distribuição de Energia S.A.</option>
                                        <option value="Cartel Energia" >Cartel Energia</option>
                                        <option value="CEA - Companhia de Eletricidade do Amapá" >CEA - Companhia de Eletricidade do Amapá</option>
                                        <option value="CEB Distribuição S.A." >CEB Distribuição S.A.</option>
                                        <option value="CEEE-D - Companhia Estadual de Distribuição de Energia Elétrica" >CEEE-D - Companhia Estadual de Distribuição de Energia Elétrica</option>
                                        <option value="Celesc-Dis - Centrais Elétricas de Santa Catarina S.A." >Celesc-Dis - Centrais Elétricas de Santa Catarina S.A.</option>
                                        <option value="Celg Distribuição S.A." >Celg Distribuição S.A.</option>
                                        <option value="Equatorial Pará Distribuidora de Energia S/A" >Equatorial Pará Distribuidora de Energia S/A</option>
                                        <option value="Celpe - Companhia Energética de Pernambuco" >Celpe - Companhia Energética de Pernambuco</option>
                                        <option value="Celtins - Companhia de Energia Elétrica do Estado do Tocantins" >Celtins - Companhia de Energia Elétrica do Estado do Tocantins</option>
                                        <option value="Equatorial Maranhão Distribuidora de Energia S.A." >Equatorial Maranhão Distribuidora de Energia S.A.</option>
                                        <option value="Cemat - Centrais Elétricas Matogrossenses S.A." >Cemat - Centrais Elétricas Matogrossenses S.A.</option>
                                        <option value="Cemig-D - Companhia Energética de Minas Gerais S.A." >Cemig-D - Companhia Energética de Minas Gerais S.A.</option>
                                        <option value="Cemirim - Cooperativa de Eletrificação e Desenvolvimento" >Cemirim - Cooperativa de Eletrificação e Desenvolvimento</option>
                                        <option value="Cerr - Companhia Energética de Roraima" >Cerr - Companhia Energética de Roraima</option>
                                        <option value="CERIM - Cooperativa de Eletrificação e Desenvolvimento da Região de Itu-Mairinque" >CERIM - Cooperativa de Eletrificação e Desenvolvimento da Região de Itu-Mairinque</option>
                                        <option value="CERIPA - Cooperativa de Eletrificação Rural de Itaí Paranapanema Avaré LTDA" >CERIPA - Cooperativa de Eletrificação Rural de Itaí Paranapanema Avaré LTDA</option>
                                        <option value="CESP - Companhia Energética de São Paulo" >CESP - Companhia Energética de São Paulo</option>
                                        <option value="CETRIO - Cooperativa de Eletrificação de Ibiúna e Região" >CETRIO - Cooperativa de Eletrificação de Ibiúna e Região</option>
                                        <option value="Cooperativa de Eletricidade Grão Pará (SC)" >Cooperativa de Eletricidade Grão Pará (SC)</option>
                                        <option value="Companhia de Energização e de Desenvolvimento do Vale do Mogi" >Companhia de Energização e de Desenvolvimento do Vale do Mogi</option>
                                        <option value="CFLO - Companhia Força e Luz do Oeste" >CFLO - Companhia Força e Luz do Oeste</option>
                                        <option value="CHESF - Companhia Hidrelétrica do São Francisco" >CHESF - Companhia Hidrelétrica do São Francisco</option>
                                        <option value="Chesp - Companhia Hidroelétrica São Patrício" >Chesp - Companhia Hidroelétrica São Patrício</option>
                                        <option value="CNEE - Companhia Nacional de Energia Elétrica" >CNEE - Companhia Nacional de Energia Elétrica</option>
                                        <option value="Cocel - Companhia Campolarguense de Energia" >Cocel - Companhia Campolarguense de Energia</option>
                                        <option value="Coelba - Companhia de Eletricidade do Estado da Bahia" >Coelba - Companhia de Eletricidade do Estado da Bahia</option>
                                        <option value="Coelce - Companhia Energética do Ceará" >Coelce - Companhia Energética do Ceará</option>
                                        <option value="Cooperaliança - Cooperativa Aliança" >Cooperaliança - Cooperativa Aliança</option>
                                        <option value="Copel-Dis - Companhia" >Copel-Dis - Companhia</option>
                                        <option value="Cosern - Companhia Energética do Rio Grande do Norte" >Cosern - Companhia Energética do Rio Grande do Norte</option>
                                        <option value="CPFL Jaguari" >CPFL Jaguari</option>
                                        <option value="CPFL Leste Paulista" >CPFL Leste Paulista</option>
                                        <option value="CPFL Mococa" >CPFL Mococa</option>
                                        <option value="CPFL Paulista" >CPFL Paulista</option>
                                        <option value="CPFL Piratininga" >CPFL Piratininga</option>
                                        <option value="CPFL Santa Cruz" >CPFL Santa Cruz</option>
                                        <option value="CPFL Sul Paulista" >CPFL Sul Paulista</option>
                                        <option value="CTEEP - Companhia de Transmissão de Energia Elétrica Paulista" >CTEEP - Companhia de Transmissão de Energia Elétrica Paulista</option>
                                        <option value="Demei - Departamento Municipal de Energia Elétrica de Ijuí" >Demei - Departamento Municipal de Energia Elétrica de Ijuí</option>
                                        <option value="DMED - DME Distribuição S.A." >DMED - DME Distribuição S.A.</option>
                                        <option value="DCELT Energia" >DCELT Energia</option>
                                        <option value="EBO - Energisa Borborema S.A." >EBO - Energisa Borborema S.A.</option>
                                        <option value="EDP Bandeirante" >EDP Bandeirante</option>
                                        <option value="EDP Escelsa" >EDP Escelsa</option>
                                        <option value="EFLJC - Empresa Força e Luz João Cesa" >EFLJC - Empresa Força e Luz João Cesa</option>
                                        <option value="Eflul - Empresa Força e Luz de Urussanga Ltda." >Eflul - Empresa Força e Luz de Urussanga Ltda.</option>
                                        <option value="Elektro Eletricidade e Serviços S.A." >Elektro Eletricidade e Serviços S.A.</option>
                                        <option value="ELETROBRÁS - Centrais Elétricas Brasileiras S.A" >ELETROBRÁS - Centrais Elétricas Brasileiras S.A</option>
                                        <option value="Eletrobras Amazonas Energia" >Eletrobras Amazonas Energia</option>
                                        <option value="Eletrobras Distribuição Acre" >Eletrobras Distribuição Acre</option>
                                        <option value="Equatorial Distribuição Alagoas" >Equatorial Distribuição Alagoas</option>
                                        <option value="Equatorial Piauí Distribuidora de Energia S.A." >Equatorial Piauí Distribuidora de Energia S.A.</option>
                                        <option value="Eletrobras Distribuição Rondônia" >Eletrobras Distribuição Rondônia</option>
                                        <option value="Eletrobras Distribuição Roraima" >Eletrobras Distribuição Roraima</option>
                                        <option value="Eletrocar - Centrais Elétricas de Carazinho S.A." >Eletrocar - Centrais Elétricas de Carazinho S.A.</option>
                                        <option value="ELETRONORTE - Centrais Elétricas do Norte do Brasil S.A" >ELETRONORTE - Centrais Elétricas do Norte do Brasil S.A</option>
                                        <option value="ELETRONUCLEAR - Eletrobrás Termonuclear S/A" >ELETRONUCLEAR - Eletrobrás Termonuclear S/A</option>
                                        <option value="ELETROSUL - Eletrosul Centrais Elétricas S/A" >ELETROSUL - Eletrosul Centrais Elétricas S/A</option>
                                        <option value="ELFSM - Empresa Luz e Força Santa Maria S.A." >ELFSM - Empresa Luz e Força Santa Maria S.A.</option>
                                        <option value="EMG - Energisa Minas Gerais" >EMG - Energisa Minas Gerais</option>
                                        <option value="Empresa de Distribuição de Energia Vale Paranapanema S.A." >Empresa de Distribuição de Energia Vale Paranapanema S.A.</option>
                                        <option value="Empresa Elétrica Bragantina S.A." >Empresa Elétrica Bragantina S.A.</option>
                                        <option value="Energisa Bragança Paulista" >Energisa Bragança Paulista</option>
                                        <option value="Grupo Energisa Tocantins" >Grupo Energisa Tocantins</option>
                                        <option value="Enel Brasil" >Enel Brasil</option>
                                        <option value="Energisa Mato Grosso/ Mato Grosso do Sul" >Energisa Mato Grosso/ Mato Grosso do Sul</option>
                                        <option value="ENF - Energisa Nova Friburgo Distribuidora de Energia S.A." >ENF - Energisa Nova Friburgo Distribuidora de Energia S.A.</option>
                                        <option value="EPB - Energisa Paraíba S.A." >EPB - Energisa Paraíba S.A.</option>
                                        <option value="ESE - Energisa Sergipe Distribuidora de Energia S.A." >ESE - Energisa Sergipe Distribuidora de Energia S.A.</option>
                                        <option value="FURNAS - Furnas Centrais Elétricas S.A" >FURNAS - Furnas Centrais Elétricas S.A</option>
                                        <option value="GEAM - Grupo de Empresas Associadas Machadinho" >GEAM - Grupo de Empresas Associadas Machadinho</option>
                                        <option value="Grupo Rede - Holding que controla as Concessionárias" >Grupo Rede - Holding que controla as Concessionárias</option>
                                        <option value="Hidropan - Hidroelétrica Panambi S.A." >Hidropan - Hidroelétrica Panambi S.A.</option>
                                        <option value="Iguaçu Distribuidora de Energia Elétrica Ltda" >Iguaçu Distribuidora de Energia Elétrica Ltda</option>
                                        <option value="ITAIPU - Binacional" >ITAIPU - Binacional</option>
                                        <option value="Light Serviços de Eletricidade S.A." >Light Serviços de Eletricidade S.A.</option>
                                        <option value="Muxfeldt, Marin & Cia. Ltda." >Muxfeldt, Marin & Cia. Ltda.</option>
                                        <option value="Nova Palma Energia" >Nova Palma Energia</option>
                                        <option value="RGE - Rio Grande Energia S.A." >RGE - Rio Grande Energia S.A.</option>
                                        <option value="Sulgipe - Companhia Sul Sergipana de Eletricidade" >Sulgipe - Companhia Sul Sergipana de Eletricidade</option>
                                        <option value="TRACTEBEL - Tractebel Energia S/A" >TRACTEBEL - Tractebel Energia S/A</option>
                                        <option value="Energisa Mato Grosso" >Energisa Mato Grosso</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_perda">Tipo de Estrutura <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="orc_valor_perda" class="form-control form-control-user-date bg-bluem" id="orc_valor_perda">
                                        <option value="0"selected>Telha Metálica</option>
                                        <option value="1">Laje Plana - Montagem em Paisagem (Horizontal)</option>
                                        <option value="5">Laje Plana - Montagem em Retrato (Vertical)</option>
                                        <option value="2">Telhas Fibrocimento com parafuso dupla rosca para viga METÁLICA</option>
                                        <option value="8">Telhas Fibrocimento com parafuso dupla rosca para MADEIRA</option>
                                        <option value="3">Telhas Cerâmicas (Romanas/ Americanas)</option>
                                        <option value="6">Usina de Solo - Montagem em Paisagem (Horizontal)</option>
                                        <option value="7">Usina de Solo - Montagem em Retrato (Vertical)</option>
                                        <option value="4">Não Incluir</option>
                                    </select>
                                </div>
                            </div>
                            <label class="float-right"><small class="form-text text-dark" style="font-size: .9em;">Quando houver 2 ou mais tipos de telhado, UTILIZAR A ESTRUTURA <b>'FIBROCIMENTO'</b></small></label>
                        </fieldset>
                        <?php endif; ?>
                        
                        <?php if($orcamento->orc_tipo_grupo == 'B'): ?>
                        <fieldset class="border p-2" style="margin-top: -10px;">
                            <legend class="font-small"><i class="fa fa-cogs"></i> Grupo B</legend>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <?php
                                        $divisor_media = 0;
                                        if ($orcamento->orc_consumo_mes1 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes2 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes3 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes4 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes5 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes6 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes7 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes8 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes9 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes10 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes11 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes12 != "0") {
                                          $divisor_media++;
                                        }
                                        if ($orcamento->orc_consumo_mes13 != "0") {
                                          $divisor_media++;
                                        }

                                        $media = ceil(($orcamento->orc_consumo_mes1+$orcamento->orc_consumo_mes2+$orcamento->orc_consumo_mes3
                                        +$orcamento->orc_consumo_mes4+$orcamento->orc_consumo_mes5+$orcamento->orc_consumo_mes6
                                        +$orcamento->orc_consumo_mes7+$orcamento->orc_consumo_mes8+$orcamento->orc_consumo_mes9
                                        +$orcamento->orc_consumo_mes10+$orcamento->orc_consumo_mes11+$orcamento->orc_consumo_mes12
                                        +$orcamento->orc_consumo_mes13)/$divisor_media);
                                    ?>
                                    <label for="orc_consumo_mes_media">Consumo Médio/Mês <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_consumo_mes_media" class="form-control form-control-user" id="orc_consumo_mes_media" placeholder="Consumo médio no mês" value="<?php echo $media; ?>">           
                                    <?php echo form_error('orc_consumo_mes_media', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_valor_kw_atual">Valor kWh Atual <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_valor_kw_atual" class="form-control form-control-user" id="orc_valor_kw_atual" placeholder="Consumo Mês 02" value="<?php echo $orcamento->orc_valor_kw_atual; ?>">           
                                    <?php echo form_error('orc_valor_kw_atual', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_irradiacao_local_dia">Irradiação Local/Dia <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_irradiacao_local_dia" class="form-control form-control-user" id="orc_irradiacao_local_dia" placeholder="Irradiação Local/Dia" value="<?php echo $orcamento->orc_irradiacao_local_dia; ?>">
                                    <?php echo form_error('orc_irradiacao_local_dia', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="orc_inclinacao_ideal">Inclinação Ideal (em º) <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="orc_inclinacao_ideal" class="form-control form-control-user" id="orc_inclinacao_ideal" placeholder="Inclinação Ideal" value="<?php echo $orcamento->orc_inclinacao_ideal; ?>">           
                                    <?php echo form_error('orc_inclinacao_ideal', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="orc_valor_perda">Porcentagem de Perda <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="orc_valor_perda" class="form-control form-control-user-date bg-bluec" id="orc_valor_perda">
                                        <option value="10">10%</option>
                                        <option value="20">20%</option>
                                        <option value="30">30%</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_tipo_contrato">Tipo de Contrato <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="orc_tipo_contrato" class="form-control form-control-user-date bg-bluec" id="orc_tipo_contrato">
                                        <option disabled="" selected="">Selecione</option>
                                        <option value="Monofásico">Monofásico</option>
                                        <option value="Bifásico">Bifásico</option>
                                        <option value="Trifásico">Trifásico</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="orc_tensao">Tensão <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="orc_tensao" class="form-control form-control-user-date bg-bluec" id="orc_tensao">
                                        <option value="127v/220v">127v/220v</option>
                                        <option value="220v/380v">220v/380v</option>
                                        <option value="Acima de 380v">Acima de 380v</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="orc_concessionaria">Concessionária <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="orc_concessionaria" class="form-control form-control-user-date bg-bluem" id="orc_concessionaria">
                                        <option disabled="" selected="">Selecione</option>
                                        <option value="AES Eletropaulo" >AES Eletropaulo</option>
                                        <option value="AES Sul Distribuidora Gaúcha de Energia S.A." >AES Sul Distribuidora Gaúcha de Energia S.A.</option>
                                        <option value="AES Tietê S/A" >AES Tietê S/A</option>
                                        <option value="Amazonas Energia S/A" >Amazonas Energia S/A</option>
                                        <option value="Ampla Energia e Serviços S.A." >Ampla Energia e Serviços S.A.</option>
                                        <option value="Caiuá Distribuição de Energia S.A." >Caiuá Distribuição de Energia S.A.</option>
                                        <option value="Cartel Energia" >Cartel Energia</option>
                                        <option value="CEA - Companhia de Eletricidade do Amapá" >CEA - Companhia de Eletricidade do Amapá</option>
                                        <option value="CEB Distribuição S.A." >CEB Distribuição S.A.</option>
                                        <option value="CEEE-D - Companhia Estadual de Distribuição de Energia Elétrica" >CEEE-D - Companhia Estadual de Distribuição de Energia Elétrica</option>
                                        <option value="Celesc-Dis - Centrais Elétricas de Santa Catarina S.A." >Celesc-Dis - Centrais Elétricas de Santa Catarina S.A.</option>
                                        <option value="Celg Distribuição S.A." >Celg Distribuição S.A.</option>
                                        <option value="Equatorial Pará Distribuidora de Energia S/A" >Equatorial Pará Distribuidora de Energia S/A</option>
                                        <option value="Celpe - Companhia Energética de Pernambuco" >Celpe - Companhia Energética de Pernambuco</option>
                                        <option value="Celtins - Companhia de Energia Elétrica do Estado do Tocantins" >Celtins - Companhia de Energia Elétrica do Estado do Tocantins</option>
                                        <option value="Equatorial Maranhão Distribuidora de Energia S.A." >Equatorial Maranhão Distribuidora de Energia S.A.</option>
                                        <option value="Cemat - Centrais Elétricas Matogrossenses S.A." >Cemat - Centrais Elétricas Matogrossenses S.A.</option>
                                        <option value="Cemig-D - Companhia Energética de Minas Gerais S.A." >Cemig-D - Companhia Energética de Minas Gerais S.A.</option>
                                        <option value="Cemirim - Cooperativa de Eletrificação e Desenvolvimento" >Cemirim - Cooperativa de Eletrificação e Desenvolvimento</option>
                                        <option value="Cerr - Companhia Energética de Roraima" >Cerr - Companhia Energética de Roraima</option>
                                        <option value="CERIM - Cooperativa de Eletrificação e Desenvolvimento da Região de Itu-Mairinque" >CERIM - Cooperativa de Eletrificação e Desenvolvimento da Região de Itu-Mairinque</option>
                                        <option value="CERIPA - Cooperativa de Eletrificação Rural de Itaí Paranapanema Avaré LTDA" >CERIPA - Cooperativa de Eletrificação Rural de Itaí Paranapanema Avaré LTDA</option>
                                        <option value="CESP - Companhia Energética de São Paulo" >CESP - Companhia Energética de São Paulo</option>
                                        <option value="CETRIO - Cooperativa de Eletrificação de Ibiúna e Região" >CETRIO - Cooperativa de Eletrificação de Ibiúna e Região</option>
                                        <option value="Cooperativa de Eletricidade Grão Pará (SC)" >Cooperativa de Eletricidade Grão Pará (SC)</option>
                                        <option value="Companhia de Energização e de Desenvolvimento do Vale do Mogi" >Companhia de Energização e de Desenvolvimento do Vale do Mogi</option>
                                        <option value="CFLO - Companhia Força e Luz do Oeste" >CFLO - Companhia Força e Luz do Oeste</option>
                                        <option value="CHESF - Companhia Hidrelétrica do São Francisco" >CHESF - Companhia Hidrelétrica do São Francisco</option>
                                        <option value="Chesp - Companhia Hidroelétrica São Patrício" >Chesp - Companhia Hidroelétrica São Patrício</option>
                                        <option value="CNEE - Companhia Nacional de Energia Elétrica" >CNEE - Companhia Nacional de Energia Elétrica</option>
                                        <option value="Cocel - Companhia Campolarguense de Energia" >Cocel - Companhia Campolarguense de Energia</option>
                                        <option value="Coelba - Companhia de Eletricidade do Estado da Bahia" >Coelba - Companhia de Eletricidade do Estado da Bahia</option>
                                        <option value="Coelce - Companhia Energética do Ceará" >Coelce - Companhia Energética do Ceará</option>
                                        <option value="Cooperaliança - Cooperativa Aliança" >Cooperaliança - Cooperativa Aliança</option>
                                        <option value="Copel-Dis - Companhia" >Copel-Dis - Companhia</option>
                                        <option value="Cosern - Companhia Energética do Rio Grande do Norte" >Cosern - Companhia Energética do Rio Grande do Norte</option>
                                        <option value="CPFL Jaguari" >CPFL Jaguari</option>
                                        <option value="CPFL Leste Paulista" >CPFL Leste Paulista</option>
                                        <option value="CPFL Mococa" >CPFL Mococa</option>
                                        <option value="CPFL Paulista" >CPFL Paulista</option>
                                        <option value="CPFL Piratininga" >CPFL Piratininga</option>
                                        <option value="CPFL Santa Cruz" >CPFL Santa Cruz</option>
                                        <option value="CPFL Sul Paulista" >CPFL Sul Paulista</option>
                                        <option value="CTEEP - Companhia de Transmissão de Energia Elétrica Paulista" >CTEEP - Companhia de Transmissão de Energia Elétrica Paulista</option>
                                        <option value="Demei - Departamento Municipal de Energia Elétrica de Ijuí" >Demei - Departamento Municipal de Energia Elétrica de Ijuí</option>
                                        <option value="DMED - DME Distribuição S.A." >DMED - DME Distribuição S.A.</option>
                                        <option value="DCELT Energia" >DCELT Energia</option>
                                        <option value="EBO - Energisa Borborema S.A." >EBO - Energisa Borborema S.A.</option>
                                        <option value="EDP Bandeirante" >EDP Bandeirante</option>
                                        <option value="EDP Escelsa" >EDP Escelsa</option>
                                        <option value="EFLJC - Empresa Força e Luz João Cesa" >EFLJC - Empresa Força e Luz João Cesa</option>
                                        <option value="Eflul - Empresa Força e Luz de Urussanga Ltda." >Eflul - Empresa Força e Luz de Urussanga Ltda.</option>
                                        <option value="Elektro Eletricidade e Serviços S.A." >Elektro Eletricidade e Serviços S.A.</option>
                                        <option value="ELETROBRÁS - Centrais Elétricas Brasileiras S.A" >ELETROBRÁS - Centrais Elétricas Brasileiras S.A</option>
                                        <option value="Eletrobras Amazonas Energia" >Eletrobras Amazonas Energia</option>
                                        <option value="Eletrobras Distribuição Acre" >Eletrobras Distribuição Acre</option>
                                        <option value="Equatorial Distribuição Alagoas" >Equatorial Distribuição Alagoas</option>
                                        <option value="Equatorial Piauí Distribuidora de Energia S.A." >Equatorial Piauí Distribuidora de Energia S.A.</option>
                                        <option value="Eletrobras Distribuição Rondônia" >Eletrobras Distribuição Rondônia</option>
                                        <option value="Eletrobras Distribuição Roraima" >Eletrobras Distribuição Roraima</option>
                                        <option value="Eletrocar - Centrais Elétricas de Carazinho S.A." >Eletrocar - Centrais Elétricas de Carazinho S.A.</option>
                                        <option value="ELETRONORTE - Centrais Elétricas do Norte do Brasil S.A" >ELETRONORTE - Centrais Elétricas do Norte do Brasil S.A</option>
                                        <option value="ELETRONUCLEAR - Eletrobrás Termonuclear S/A" >ELETRONUCLEAR - Eletrobrás Termonuclear S/A</option>
                                        <option value="ELETROSUL - Eletrosul Centrais Elétricas S/A" >ELETROSUL - Eletrosul Centrais Elétricas S/A</option>
                                        <option value="ELFSM - Empresa Luz e Força Santa Maria S.A." >ELFSM - Empresa Luz e Força Santa Maria S.A.</option>
                                        <option value="EMG - Energisa Minas Gerais" >EMG - Energisa Minas Gerais</option>
                                        <option value="Empresa de Distribuição de Energia Vale Paranapanema S.A." >Empresa de Distribuição de Energia Vale Paranapanema S.A.</option>
                                        <option value="Empresa Elétrica Bragantina S.A." >Empresa Elétrica Bragantina S.A.</option>
                                        <option value="Energisa Bragança Paulista" >Energisa Bragança Paulista</option>
                                        <option value="Grupo Energisa Tocantins" >Grupo Energisa Tocantins</option>
                                        <option value="Enel Brasil" >Enel Brasil</option>
                                        <option value="Energisa Mato Grosso/ Mato Grosso do Sul" >Energisa Mato Grosso/ Mato Grosso do Sul</option>
                                        <option value="ENF - Energisa Nova Friburgo Distribuidora de Energia S.A." >ENF - Energisa Nova Friburgo Distribuidora de Energia S.A.</option>
                                        <option value="EPB - Energisa Paraíba S.A." >EPB - Energisa Paraíba S.A.</option>
                                        <option value="ESE - Energisa Sergipe Distribuidora de Energia S.A." >ESE - Energisa Sergipe Distribuidora de Energia S.A.</option>
                                        <option value="FURNAS - Furnas Centrais Elétricas S.A" >FURNAS - Furnas Centrais Elétricas S.A</option>
                                        <option value="GEAM - Grupo de Empresas Associadas Machadinho" >GEAM - Grupo de Empresas Associadas Machadinho</option>
                                        <option value="Grupo Rede - Holding que controla as Concessionárias" >Grupo Rede - Holding que controla as Concessionárias</option>
                                        <option value="Hidropan - Hidroelétrica Panambi S.A." >Hidropan - Hidroelétrica Panambi S.A.</option>
                                        <option value="Iguaçu Distribuidora de Energia Elétrica Ltda" >Iguaçu Distribuidora de Energia Elétrica Ltda</option>
                                        <option value="ITAIPU - Binacional" >ITAIPU - Binacional</option>
                                        <option value="Light Serviços de Eletricidade S.A." >Light Serviços de Eletricidade S.A.</option>
                                        <option value="Muxfeldt, Marin & Cia. Ltda." >Muxfeldt, Marin & Cia. Ltda.</option>
                                        <option value="Nova Palma Energia" >Nova Palma Energia</option>
                                        <option value="RGE - Rio Grande Energia S.A." >RGE - Rio Grande Energia S.A.</option>
                                        <option value="Sulgipe - Companhia Sul Sergipana de Eletricidade" >Sulgipe - Companhia Sul Sergipana de Eletricidade</option>
                                        <option value="TRACTEBEL - Tractebel Energia S/A" >TRACTEBEL - Tractebel Energia S/A</option>
                                        <option value="Energisa Mato Grosso" >Energisa Mato Grosso</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="orc_valor_perda">Tipo de Estrutura <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="orc_valor_perda" class="form-control form-control-user-date bg-bluem" id="orc_valor_perda">
                                        <option value="0"selected>Telha Metálica</option>
                                        <option value="1">Laje Plana - Montagem em Paisagem (Horizontal)</option>
                                        <option value="5">Laje Plana - Montagem em Retrato (Vertical)</option>
                                        <option value="2">Telhas Fibrocimento com parafuso dupla rosca para viga METÁLICA</option>
                                        <option value="8">Telhas Fibrocimento com parafuso dupla rosca para MADEIRA</option>
                                        <option value="3">Telhas Cerâmicas (Romanas/ Americanas)</option>
                                        <option value="6">Usina de Solo - Montagem em Paisagem (Horizontal)</option>
                                        <option value="7">Usina de Solo - Montagem em Retrato (Vertical)</option>
                                        <option value="4">Não Incluir</option>
                                    </select>
                                </div>
                            </div>
                            <label class="float-right"><small class="form-text text-dark" style="font-size: .9em;">Quando houver 2 ou mais tipos de telhado, UTILIZAR A ESTRUTURA <b>'FIBROCIMENTO'</b></small></label>
                        </fieldset>
                            
                        <?php endif; ?>
                            
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-cogs"></i> Mais Informações</legend>
                            <div class="container">
                                <div class="row">
                                    <div class="col externa">
                                        <img src="<?php echo base_url('public/images/img_orc/tarja.gif'); ?>" width="100%"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="container" style="margin-top: 25px;margin-bottom: 25px;">
                                <div class="row">
                                    <div class="col externa">
                                        <div class="row">
                                            <div class="col externa">
                                                <img src="<?php echo base_url('public/images/img_orc/canadian.jpg'); ?>" width="35%"/>
                                            </div>
                                        </div>
                                        <div class="divbaixo">
                                            <div class="col externa">
                                                <span style="font-size: 1.2em;font-weight: bold;">415&nbsp;Wp</span>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col externa">
                                                <img src="<?php echo base_url('public/images/img_orc/paineis-05.gif'); ?>" width="70%"/>
                                                <div class="textocima" style="padding: 8px;">Pronta Entrega<br/>TIER 1</div>
                                            </div>
                                        </div>
                                        <div class="divbaixo">
                                            <div class="col externa">
                                                <p style="text-align: center;font-size: 1.0em;color: #333;">Painel Fotovoltaico 415 Wp Canadian <strong>POLIPERC</strong></p>
                                            </div>
                                        </div>
                                        <div class="divbaixo" style="margin-top: -15px;">
                                            <div class="col externa">
                                                <input type="radio" name="orc_id_painel" class="form-control form-check">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col externa">
                                        <div class="row">
                                            <div class="col externa">
                                                <img src="<?php echo base_url('public/images/img_orc/ulica.jpg'); ?>" width="35%"/>
                                            </div>
                                        </div>
                                        <div class="divbaixo">
                                            <div class="col externa">
                                                <span style="font-size: 1.2em;font-weight: bold;">415&nbsp;Wp</span>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col externa">
                                                <img src="<?php echo base_url('public/images/img_orc/paineis-05.gif'); ?>" width="70%"/>
                                                <div class="textocima" style="padding: 8px;">Pronta Entrega<br/>TIER 1</div>
                                            </div>
                                        </div>
                                        <div class="divbaixo">
                                            <div class="col externa">
                                                <p style="text-align: center;font-size: 1.0em;color: #333;">Painel Fotovoltaico 415 Wp Ulica Solar <strong>MONOPERC</strong></p>
                                            </div>
                                        </div>
                                        <div class="divbaixo" style="margin-top: -15px;">
                                            <div class="col externa">
                                                <input type="radio" name="orc_id_painel" class="form-control form-check">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col externa">
                                        <div class="row">
                                            <div class="col externa">
                                                <img src="<?php echo base_url('public/images/img_orc/canadian.jpg'); ?>" width="35%"/>
                                            </div>
                                        </div>
                                        <div class="divbaixo">
                                            <div class="col externa">
                                                <span style="font-size: 1.2em;font-weight: bold;">420&nbsp;Wp</span>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col externa">
                                                <img src="<?php echo base_url('public/images/img_orc/paineis-05.gif'); ?>" width="70%"/>
                                                <div class="textocima" style="padding: 8px;">Pronta Entrega<br/>TIER 1</div>
                                            </div>
                                        </div>
                                        <div class="divbaixo">
                                            <div class="col externa">
                                                <p style="text-align: center;font-size: 1.0em;color: #333;">Painel Fotovoltaico 420 Wp Canadian <strong>POLIPERC</strong></p>
                                            </div>
                                        </div>
                                        <div class="divbaixo" style="margin-top: -15px;">
                                            <div class="col externa">
                                                <input type="radio" name="orc_id_painel" class="form-control form-check">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col externa">
                                        <div class="row">
                                            <div class="col externa">
                                                <img src="<?php echo base_url('public/images/img_orc/canadian.jpg'); ?>" width="35%"/>
                                            </div>
                                        </div>
                                        <div class="divbaixo">
                                            <div class="col externa">
                                                <span style="font-size: 1.2em;font-weight: bold;">450&nbsp;Wp</span>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col externa">
                                                <img src="<?php echo base_url('public/images/img_orc/paineis-05.gif'); ?>" width="70%"/>
                                                <div class="textocima" style="padding: 8px;">Pronta Entrega<br/>TIER 1</div>
                                            </div>
                                        </div>
                                        <div class="divbaixo">
                                            <div class="col externa">
                                                <p style="text-align: center;font-size: 1.0em;color: #333;">Painel Fotovoltaico 450 Wp Canadian <strong>MONOPERC</strong></p>
                                            </div>
                                        </div>
                                        <div class="divbaixo" style="margin-top: -15px;">
                                            <div class="col externa">
                                                <input type="radio" name="orc_id_painel" class="form-control form-check">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                            <p><span class="text-danger font-weight-bold">*</span> Campos obrigatórios</p>
                        <input type="hidden" name="orc_id" value="<?php echo $orcamento->orc_id; ?>">                       
                        <button type="submit" class="btn btn-primary btn-sm float-right mt-1" style="width: 100%;font-size: 1.5em;">FINALIZAR&nbsp;&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                        
                    </form>
                </div>

            </div>

        </div>
