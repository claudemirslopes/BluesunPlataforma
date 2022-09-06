<style>
    .form-control.is-valid, .was-validated .custom-select:valid, .was-validated .form-control:valid {
        border: none;
        border-bottom: 1px dotted #777;
        background: #ECF8E0;
    }
    .form-control {
        border: 1px solid #585858;
    }
    .card-body .card-block {
        border: 1px solid #6C757D !important;
        border-radius: 5px;
    }
    .card .bdent {
        border: none;
    }
    input[type=number]::-webkit-inner-spin-button { 
        all: unset; 
        min-width: 21px;
        min-height: 45px;
        margin: 4px;
        padding: 0px;
        background-image: 
        linear-gradient(to top, transparent 0px, transparent 16px, #fff 16px, #fff 26px, transparent 26px, transparent 35px, #777 35px,#777 36px,transparent 36px, transparent 40px),
        linear-gradient(to right, transparent 0px, transparent 10px, #777 10px, #777 11px, transparent 11px, transparent 21px);
        transform: rotate(90deg) scale(0.8, 0.9);
        cursor:pointer;
    }
    .aumentaimg {
        transition: all 0.5s;
        cursor: pointer;
    }

    .aumentaimg:hover {
        -webkit-transform: scale(4.5);
        transform: scale(4.5);
        /* margin-left: 25px; */
    }
    table td{
        border:none !important;
    }
    /*tooltip Box*/
    .con-tooltip {
      position: relative;
      background: #fff;
      border-radius: 9px;
      display: inline-block;
      transition: all 0.3s ease-in-out;
      cursor: default;
    }

    /*tooltip */
    .tooltip {
      visibility: hidden;
      z-index: 1;
      opacity: .40;
      width: 100%;
      padding: 10px;
      background: #333;
      color: #F197E4;
      position: absolute;
      top:-350%;
      left: 55%;
      border-radius: 9px;
      font: 16px;
      transform: translateY(9px);
      transition: all 0.3s ease-in-out;
      box-shadow: 0 0 3px rgba(56, 54, 54, 0.86);
    }

    /* tooltip  after*/
    .tooltip::after {
      content: " ";
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 12px 12.5px 0 12.5px;
      border-color: #333 transparent transparent transparent;
      position: absolute;
      left: 40%;
    }

    .con-tooltip:hover .tooltip{
      visibility: visible;
      transform: translateY(-10px);
      opacity: 1;
        transition: .3s linear;
      animation: odsoky 1s ease-in-out infinite  alternate;
    }
    @keyframes odsoky {
      0%{
        transform: translateY(6px);	
      }
      100%{
        transform: translateY(1px);	
      }
    }

    /*hover ToolTip*/
    .left:hover {transform: translateX(-6px); }
    .top:hover {transform: translateY(-6px);  }
    .bottom:hover {transform: translateY(6px);}
    .right:hover {transform: translateX(6px); }

    /*left*/
    .left .tooltip{ top:-20%; left:-170%; }
    .left .tooltip::after{
      top:40%;
      left:90%;
      transform: rotate(-90deg);
    }

    /*bottom*/
    .bottom .tooltip { top:115%; left:-20%; }
    .bottom .tooltip::after{
      top:-17%;
      left:40%;
      transform: rotate(180deg);
    }

    /*right*/
    .right .tooltip { top:-20%; left:115%; }
    .right .tooltip::after{
      top:40%;
      left:-12%;
      transform: rotate(90deg);
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
                        <div class="progress-bar progress-bar-striped font-weight-bold bg-success text-light" role="progressbar" style="width: 100%;font-size: 1.2em;-webkit-text-stroke-width: .1px;-webkit-text-stroke-color: #ffffff;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">CONCLUÍDO [100%]</div>
                    </div>
                </div>
            </div>
        </div>-->

        <!-- content -->
        <div class="content mt-2">
            <div class="card" style="border: 1px solid #A4A4A4;border-top: none;">
                <div class="card-header bg-success text-light">
                    <strong class="card-title" v-if="headerText" style="font-size: 1.2em;">[Orçamento] Preço do KIT para o estado de <span class="text-warning"><big>SP</big></span></strong>
                    <span class="float-right">
                       <a title="Voltar" href="<?php echo base_url('orcamentos/preco_kit/index'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
                    </span>
                </div>
                <div class="card-body">
                
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
                    <div class="col-lg-12">
                        <div class="card bdent">
                            <div class="alert bg-danger text-light font-weight-bold text-center" role="alert">
                                <span class="badge badge-pill badge-light">Atenção</span><br/>Devido às solicitações dos Franqueados e Integradores, os StringBox CA passam ser Opcionais no KIT Fotovoltaico.<br/>
                                Se desejar o StringBox CA, LEMBRE-SE de ativá-lo nas opções abaixo!
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light" style="border: 1px solid #6C757D;">
                                <strong>Dados do Sistema</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="has-success form-group">
                                    <label for="inputIsValid" class=" form-control-label">Número Total de Painéis Fotovoltaicos</label>
                                    <input type="text" id="inputIsValid" class="is-valid form-control-success form-control" readonly="">
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-body card-block">
                                <div class="has-success form-group  col-md-5">
                                    <label for="inputIsValid" class=" form-control-label">Margem de Mão de Obra <big>(%)</big></label>
                                    <input type="text" id="inputIsValid" class="is-valid form-control-success form-control">
                                </div>
                                <div class="has-success form-group  col-md-1">
                                    <label for="inputIsValid" class=" form-control-label text-light">M </label>
                                    <input type="text" id="inputIsValid" class="is-valid form-control-success form-control border-0" value="%" style="font-size: 1.5em;background: #fff;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent" style="background-color: #E6E6E6;">
                            <div class="card-header bg-secondary text-light">
                                <strong>Abaixo, as melhores condições de Seguro do Mercado por uma das maiores seguradoras mundiais: LIBERTY SEGUROS</strong>
                            </div>
                            <div class="card-body card-block">
                                <fieldset class="border p-2" style="margin-top: -5px;">
                                    <legend class="font-small font-weight-bold" style="font-size: 1.2em;"><i class="fa fa-lock"></i> Seguro de Riscos Diversos</legend>
                                    <div class="container" style="margin-top: 25px;margin-bottom: 25px;">
                                        <div class="row">
                                            <div class="col externa">
                                                <div class="divbaixo">
                                                    <div class="col externa">
                                                        <span style="font-size: 1.1em;font-weight: bold;margin-bottom: 10px;color: #036696;">Incluir seguro nesta proposta</span>
                                                        <input type="radio" name="orc_id_painel" class="form-control form-check">
                                                    </div>
                                                </div>
                                                <div class="divbaixo">
                                                    <div class="col externa">
                                                        <ul style="list-style-type: none;text-align: center;color: #03668A;">
                                                            <li>Valor do Seguro: R$ 706,08</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col externa">
                                                <div class="divbaixo">
                                                    <div class="col externa" style="margin-top: -25px;">
                                                        <span style="font-size: 1.1em;font-weight: bold;margin-bottom: 10px;color: #036696;"><span class="text-danger font-weight-bold">Não</span> incluir seguro nesta proposta</span>
                                                        <input type="radio" name="orc_id_painel" class="form-control form-check">
                                                    </div>
                                                </div>
                                                <div class="divbaixo">
                                                    <div class="col externa">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light">
                                <strong>Seguro de Instalação</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="container">
                                    <div class="row">
                                        <div class="col externa">
                                            <img src="<?php echo base_url('public/images/img_orc/blueprime.jpg'); ?>" width="100%"/>
                                        </div>
                                    </div>
                                </div>
                                <a href="" target="_blank">
                                <div class="alert alert-warning bg-warning text-dark text-center font-weight-bold" role="alert" style="font-size: 1.2em;">
                                    CLIQUE AQUI E SAIBA MAIS SOBRE O SEGURO BLUEPRIME
                                </div>
                                </a>
                                <div class="container" style="margin-top: 25px;margin-bottom: 25px;">
                                    <div class="row">
                                        <div class="col externa">
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <span style="font-size: 1.1em;font-weight: bold;margin-bottom: 10px;color: #036696;">Incluir Seguro nesta Proposta | <small><b>Valor do seguro:</b> Grátis</small></span>
                                                    <input type="radio" name="orc_id_painel" class="form-control form-check">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <span style="font-size: 1.1em;font-weight: bold;margin-bottom: 10px;color: #036696;"><span class="text-danger font-weight-bold">Não</span> incluir Seguro nesta Proposta</span>
                                                    <input type="radio" name="orc_id_painel" class="form-control form-check">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light">
                                <strong>STRING BOX Corrente Alternada</strong>
                            </div>
                            <div class="card-body card-block" style="background: #CFE8FB;">
                                <div class="container" style="margin-top: 25px;margin-bottom: 25px;">
                                    <div class="row">
                                        <div class="col externa">
                                            <input type="radio" name="orc_id_painel" style="width: 20px;height: 20px;">&nbsp;<big class="font-weight-bold">Incluir StringBox CA nesta Proposta</big>
                                        </div>
                                        <div class="col externa">
                                            <input type="radio" name="orc_id_painel" style="width: 20px;height: 20px;" checked="">&nbsp;<big class="font-weight-bold"><span class="text-danger font-weight-bold">Não</span> incluir StringBox CA nesta Proposta</big> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent" style="background-color: #E6E6E6;">
                            <div class="card-header bg-secondary text-light">
                                <strong>Inversores</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="container" style="margin-top: 25px;margin-bottom: 25px;">
                                    <div class="row">
                                        <div class="col externa">
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <span style="font-size: 1.2em;font-weight: bold;">Inversor SAJ</span>
                                                </div>
                                            </div>
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <input type="radio" name="orc_id_painel" class="form-control form-check">
                                                </div>
                                            </div>
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <ul style="list-style-type: none;text-align: center;color: #03668A;font-size: .8em;">
                                                        <li>Orç. 1: <b>INCLUSO</b></li>
                                                        <li>Orç. 2: <b>INCLUSO</b></li>
                                                        <li>Orç. 3: <b>INCLUSO</b></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/inversor_saj.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <ul style="list-style-type: none;text-align: center;color: #434343;font-size: .7em;">
                                                        <li>Garantia: <b>10 anos</b></li>
                                                        <li>Em caso de defeito, envio de outro em até <b>10 dias</b></li>
                                                        <li><b>EXCLUSIVIDADE BLUESUN</b></li>
                                                        <li>Consulte <a href="">TERMO DE GARANTIA</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <span style="font-size: 1.2em;font-weight: bold;">Inversor Growatt</span>
                                                </div>
                                            </div>
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <input type="radio" name="orc_id_painel" class="form-control form-check">
                                                </div>
                                            </div>
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <ul style="list-style-type: none;text-align: center;color: #03668A;font-size: .8em;">
                                                        <li>Orç. 1: <b>Adiciona R$ 603,71</b></li>
                                                        <li>Orç. 2: <b>Adiciona R$ 10.661,12</b></li>
                                                        <li>Orç. 3: <b>Adiciona R$ -6.252,88</b></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/inversor_growatt.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <ul style="list-style-type: none;text-align: center;color: #434343;font-size: .7em;">
                                                        <li>Garantia: <b>5 anos</b></li>
                                                        <li>Retorno Garantia <b>30 dias</b></li>
                                                        <li>Consulte <a href="">TERMO DE GARANTIA</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <span style="font-size: 1.2em;font-weight: bold;">Inversor Fronius</span>
                                                </div>
                                            </div>
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <input type="radio" name="orc_id_painel" class="form-control form-check">
                                                </div>
                                            </div>
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <ul style="list-style-type: none;text-align: center;color: #03668A;font-size: .8em;">
                                                        <li>Orç. 1: <b>Adiciona R$ 3.135,69</b></li>
                                                        <li>Orç. 2: <b>Adiciona R$ 78.677,90</b></li>
                                                        <li>Orç. 3: <b>Adiciona R$ 82.309,44</b></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/inversor_fronius.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                            <div class="divbaixo">
                                                <div class="col externa">
                                                    <ul style="list-style-type: none;text-align: center;color: #434343;font-size: .7em;">
                                                        <li>Garantia: <b>7 anos</b></li>
                                                        <li>Retorno Garantia <b>30 dias</b></li>
                                                        <li>Consulte <a href="">TERMO DE GARANTIA</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 container">
                                            <div class="row">
                                                <div class="col externa">
                                                    <div class="col-md-1">
                                                        <input type="radio" id="mostrar-todos-processos" name="addInversor" value="Inversor" class="form-control form-check">
                                                    </div>
                                                    <div class="col-md-11 font-weight-bold" style="font-size: 1.2em;color: #0366A2;">
                                                        Deseja Alterar ou Adicionar Inversores? <span class="text-danger font-weight-normal">(Necessário Conhecimento Avançado em Projeto)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-3 row divAdicional bg-light" style="display: none;border: 1px solid #D2CACA;border-radius: 15px;">
                                                <div class="col externa">
                                                    <div class="col-sm-12 pt-3">
                                                        <div class="alert  alert-danger alert-dismissible fade show bg-danger text-light font-weight-bold" role="alert">
                                                            <span class="badge badge-pill badge-light font-weight-bold">Atenção: </span> A plataforma calcula automaticamente o dimensionamento dos inversores para cada sistema. Qualquer substituição será por conta e risco do Integrador/ Franqueado!
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 pt-1 pb-4">
                                                        <select data-placeholder="Selecione o Inversor..." class="standardSelect" tabindex="1">
                                                            <option value=""></option>
                                                            <option value="83">Inversor SAJ 2KWp </option>
                                                            <option value="14">Inversor SAJ 3KWp </option>
                                                            <option value="15">Inversor SAJ 5KWp-R5</option>
                                                            <option value="84">Inversor SAJ 8KWp </option>
                                                            <option value="16">Inversor SAJ 20KWp 380V</option>
                                                            <option value="17">Inversor SAJ 33KWp 380V</option>
                                                            <option value="85">Inversor SAJ 40KWp 380V</option>
                                                            <option value="94">Inversor SAJ 25KWp 220V (LV)</option>
                                                            <option value="18">Inversor SAJ 60KWp 380V</option>
                                                            <option value="95">Inversor SAJ 35KWp 220V (LV)</option>
                                                            <option value="86">Inversor Growatt 2,5KWp </option>
                                                            <option value="139">Inversor Growatt 3KWp MIN-TL-X</option>
                                                            <option value="87">Inversor Growatt 3KWp MIC</option>
                                                            <option value="88">Inversor Growatt 5KWp MIN</option>
                                                            <option value="138">Inversor Growatt 6KWp MIN</option>
                                                            <option value="75">Inversor Growatt 8KWp </option>
                                                            <option value="89">Inversor Growatt 25KWp  380V</option>
                                                            <option value="90">Inversor Growatt 60KWp 380V</option>
                                                            <option value="91">Inversor Growatt 75KWp 380V</option>
                                                            <option value="92">Inversor Fronius 3KWp </option>
                                                            <option value="24">Inversor Fronius 4KWp </option>
                                                            <option value="25">Inversor Fronius 5KWp </option>
                                                            <option value="73">Inversor Fronius 8,2KWp </option>
                                                            <option value="26">Inversor Fronius 15KWp 220V</option>
                                                            <option value="27">Inversor Fronius 15KWp 380V</option>
                                                            <option value="72">Inversor Fronius 25KWp 380V</option>
                                                            <option value="12">Inversor Solis 30KWp </option>
                                                            <option value="13">Inversor Solis 60KWp </option>
                                                            <option value="78">Inversor Sofar 7,5KWp </option>
                                                            <option value="140">Inversor Solis 20KWp LV</option>
                                                            <option value="148">Inversor Solis 30KWp LV</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2 pt-1 pb-4">
                                                        <input type="number" class="form-control form-control-user-date" value="1" min="0" max="99">
                                                    </div>
                                                    <div class="col-sm-2 pt-1 pb-4">
                                                        <button class="btn btn-primary btn-sm float-right" type="submit"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Adicionar</button>
                                                    </div>
                                                    <div class="col-sm-12 pt-1 pb-4">
                                                        <p class="text-dark font-weight-bold">Inversores selecionados para este KIT&nbsp;&nbsp;<sub><i class="fa fa-angle-double-down" aria-hidden="true"></i></sub></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light">
                                <strong>Estrutura de Fixação</strong>
                            </div>
                            <div class="card-body card-block" style="background: #cfe8fb;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col externa">
                                            <img src="<?php echo base_url('public/images/img_orc/banner-fotofixlight.jpg'); ?>" width="100%"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="container" style="margin-top: 25px;margin-bottom: 25px;">
                                    <div class="row">
                                        <div class="col externa">
                                            <div class="divbaixo bg-light text-center p-2" style="border-radius: 15px;">
                                                <input type="radio" name="tipo[]" id="tipo-0" value="Agente no Brasil" style="width: 30px;height: 30px;"><img src="<?php echo base_url('public/images/img_orc/fotofix-1.png'); ?>" width="70%"/>
                                                Adicional no Orçamento: INCLUSO
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="divbaixo bg-light text-center p-2" style="border-radius: 15px;">
                                                <input type="radio" name="tipo[]" id="tipo-0" value="Agente no Brasil" style="width: 30px;height: 30px;"><img src="<?php echo base_url('public/images/img_orc/fotoFix_light.png'); ?>" width="70%"/>
                                                Adicional no Orçamento: R$ - 0,00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-body card-block bg-light">
                                <div class="container">
                                    <div class="row">
                                        <div class="col externa">
                                            <img src="<?php echo base_url('public/images/img_orc/garantia30anos.jpg'); ?>" width="100%"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="container" style="margin-top: 25px;margin-bottom: 25px;">
                                    <div class="row">
                                        <div class="col externa">
                                            <div class="divbaixo bg-light text-center p-2" style="border-radius: 15px;">
                                                <span class="font-weight-bold">1 Mesas com 5 Painéis Fotovoltaicos</span>
                                                <img src="<?php echo base_url('public/images/img_orc/paineis_5.png'); ?>" height="100px" class="mt-2"/>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="divbaixo bg-light text-center p-2" style="border-radius: 15px;">
                                                <span class="font-weight-bold">1 Mesa com 1 Painéis Fotovoltaicos</span>
                                                <img src="<?php echo base_url('public/images/img_orc/paineis_1.png'); ?>" height="100px" class="mt-2"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light">
                                <strong>Sistema de Aterramento</strong>
                            </div>
                            <div class="card-body card-block" style="background: #E2EECE;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col externa">
                                            <input type="radio" name="orc_id_painel" style="width: 20px;height: 20px;">&nbsp;<big class="font-weight-bold text-primary">Incluir Aterramento nesta Proposta</big>
                                            <div class="divbaixo">
                                                <span class="mt-1 pl-4" style="color: #03668A;">Adicional no Orçamento: <b>Grátis</b></span>
                                            </div>
                                            <div class="divbaixo mt-2">
                                                <span class="mt-1"><b class="text-danger">GRÁTIS:</b> (Inclui Presilhas de Aterramento, Chapas para Quebra de Anodização). Caso queira adicionar Cabo Verde, selecione a quantidade abaixo.</span>
                                            </div>
                                        </div>
                                        <div class="col externa" style="margin-top: -95px;">
                                            <input type="radio" name="orc_id_painel" style="width: 20px;height: 20px;" checked="">&nbsp;<big class="font-weight-bold text-primary"><span class="text-danger font-weight-bold">Não</span> incluir Aterramento nesta Proposta</big>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light">
                                <strong>Deseja incluír mais cabo em seu kit?</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="container">
                                    <div class="row">
                                        <div class="col externa alert alert-secondary text-center m-2" style="border-radius: 15px;">
                                            <div class="divbaixo">
                                                <span class="text-dark font-weight-bold" style="font-size: 1.3em;">Cabo Preto</span>
                                                <img src="<?php echo base_url('public/images/img_orc/cabo-preto.png'); ?>" class="mt-2 mb-2"/>
                                                <span class="text-info font-weight-bold" style="font-size: .7em;">
                                                    Incluso no Kit | Orç. 1: 30(metros)<br/>
                                                    Incluso no Kit | Orç. 2: 30(metros)<br/>
                                                    Incluso no Kit | Orç. 3: 30(metros)
                                                </span>
                                                <span class="font-weight-bold text-secondary">Adicionar:</span>
                                                <input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99">
                                            </div>
                                        </div>
                                        <div class="col externa alert alert-danger text-center m-2" style="border-radius: 15px;">
                                            <div class="divbaixo">
                                                <span class="text-danger font-weight-bold" style="font-size: 1.3em;">Cabo Vermelho</span>
                                                <img src="<?php echo base_url('public/images/img_orc/cabo-vermelho.png'); ?>" class="mt-2 mb-2"/>
                                                <span class="text-info font-weight-bold" style="font-size: .7em;">
                                                    Incluso no Kit | Orç. 1: 30(metros)<br/>
                                                    Incluso no Kit | Orç. 2: 30(metros)<br/>
                                                    Incluso no Kit | Orç. 3: 30(metros)
                                                </span>
                                                <span class="font-weight-bold text-secondary">Adicionar:</span>
                                                <input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99">
                                            </div>
                                        </div>
                                        <div class="col externa alert alert-success text-center m-2" style="border-radius: 15px;">
                                            <div class="divbaixo">
                                                <span class="text-success font-weight-bold" style="font-size: 1.3em;">Cabo Verde</span>
                                                <img src="<?php echo base_url('public/images/img_orc/cabo-verde.png'); ?>" class="mt-2 mb-2"/>
                                                <span class="text-info font-weight-bold" style="font-size: .7em;">
                                                    Incluso no Kit | Orç. 1: 30(metros)<br/>
                                                    Incluso no Kit | Orç. 2: 30(metros)<br/>
                                                    Incluso no Kit | Orç. 3: 30(metros)
                                                </span>
                                                <span class="font-weight-bold text-secondary">Adicionar:</span>
                                                <input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light">
                                <strong>Deseja Incluir Transformadores em seu Orçamento?</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="container">
                                    <div class="row">
                                        <div class="col externa alert alert-dark text-center m-2" style="border-radius: 15px;">
                                            <div class="divbaixo">
                                                <span class="font-weight-bold" style="font-size: 1.3em;color: #03668A;">25 KVA</span><br/>
                                                <span class="text-info font-weight-bold" style="font-size: .9em;">Custo por Unidade: R$ 2320,00</span><br/>
                                                <span class="font-weight-bold text-secondary">Adicionar:</span>
                                                <input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99">
                                            </div>
                                        </div>
                                        <div class="col externa alert alert-warning text-center m-2" style="border-radius: 15px;">
                                            <div class="divbaixo">
                                                <span class="font-weight-bold" style="font-size: 1.3em;color: #03668A;">35 KVA</span><br/>
                                                <span class="text-info font-weight-bold" style="font-size: .9em;">Custo por Unidade: R$ 2680,00</span><br/>
                                                <span class="font-weight-bold text-secondary">Adicionar:</span>
                                                <input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99">
                                            </div>
                                        </div>
                                        <div class="col externa alert alert-success text-center m-2" style="border-radius: 15px;">
                                            <div class="divbaixo">
                                                <span class="font-weight-bold" style="font-size: 1.3em;color: #03668A;">75 KVA</span><br/>
                                                <span class="text-info font-weight-bold" style="font-size: .9em;">Custo por Unidade: R$ 4522,00</span><br/>
                                                <span class="font-weight-bold text-secondary">Adicionar:</span>
                                                <input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99">
                                            </div>
                                        </div>
                                        <div class="col externa alert alert-secondary text-center m-2" style="border-radius: 15px;">
                                            <div class="divbaixo">
                                                <span class="font-weight-bold" style="font-size: 1.3em;color: #03668A;">90 KVA</span><br/>
                                                <span class="text-info font-weight-bold" style="font-size: .9em;">Custo por Unidade: R$ 7145,00</span><br/>
                                                <span class="font-weight-bold text-secondary">Adicionar:</span>
                                                <input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light">
                                <strong>Deseja Incluir Ítens de Estrutura de Fixação Adicionais?</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="container">
                                    <div class="row">
                                        <div class="col externa">
                                            <table class="table table-striped">
                                                <thead style="background: #084A6D;color: #fff;">
                                                    <tr>
                                                        <th scope="col" class="text-center">#</th>
                                                        <th scope="col">Item Adicional</th>
                                                        <th scope="col" class="text-center">Custo por Unidade</th>
                                                        <th scope="col" class="text-right pr-2">Adicionar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center align-middle"><img class="aumentaimg" src="<?php echo base_url('public/images/img_orc/modelo_1.webp'); ?>" width="20" height="20"/></td>
                                                        <td class="align-middle">Presilhas Laterais com Parafusos</td>
                                                        <td class="text-center align-middle">R$ 6,89</td>
                                                        <td class="text-right align-middle"><input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center align-middle"><img class="aumentaimg" src="<?php echo base_url('public/images/img_orc/modelo_2.webp'); ?>" width="20" height="20"/></td>
                                                        <td class="align-middle">Presilhas Superiores com Parafusos</td>
                                                        <td class="text-center align-middle">R$ 6,93</td>
                                                        <td class="text-right align-middle"><input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center align-middle"><img class="aumentaimg" src="<?php echo base_url('public/images/img_orc/modelo_3.webp'); ?>" width="20" height="20"/></td>
                                                        <td class="align-middle">Trilhos Segmentados com Parafusos</td>
                                                        <td class="text-center align-middle">R$ 11,34</td>
                                                        <td class="text-right align-middle"><input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center align-middle"><img class="aumentaimg" src="<?php echo base_url('public/images/img_orc/modelo_4.jpg'); ?>" width="20" height="20"/></td>
                                                        <td class="align-middle">Conector MC4 (Par)</td>
                                                        <td class="text-center align-middle">R$ 9,23</td>
                                                        <td class="text-right align-middle"><input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center align-middle"><img class="aumentaimg" src="<?php echo base_url('public/images/img_orc/modelo_5.png'); ?>" width="20" height="20"/></td>
                                                        <td class="align-middle">Presilha Aterramento</td>
                                                        <td class="text-center align-middle">R$ 12,45</td>
                                                        <td class="text-right align-middle"><input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center align-middle"><img class="aumentaimg" src="<?php echo base_url('public/images/img_orc/modelo_6.webp'); ?>" width="20" height="20"/></td>
                                                        <td class="align-middle">Junção</td>
                                                        <td class="text-center align-middle">R$ 12,89</td>
                                                        <td class="text-right align-middle"><input type="number" class="form-control form-control-user-date mt-2" value="0" min="0" max="99"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light">
                                <strong>Serviço de Descarregamento de Carga</strong>
                            </div>
                            <div class="card-body card-block" style="background: #E2EECE;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col externa">
                                            <div class="alert alert-danger" role="alert">
                                                <span class="badge badge-pill badge-danger">Atenção</span> Caso a entrega seja feita fora expediente comercial, aos finais de semana ou feriados, o autorizado deverá combinar diretamente com o motorista. Não Trabalhamos com Plantão!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col externa">
                                            <input type="radio" name="orc_id_painel" style="width: 20px;height: 20px;">&nbsp;<big class="font-weight-bold text-primary">Incluir Mão de Obra de Descarregamento</big>
                                            <div class="divbaixo">
                                                <span style="color: #03668A;">
                                                    Valor do Serviço Orçamento 1: <b>R$ 80,00</b><br/>
                                                    Valor do Serviço Orçamento 2: <b>R$ 1.504,00</b><br/>
                                                    Valor do Serviço Orçamento 3: <b>R$ 80,00</b>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col externa" style="margin-top: -55px;">
                                            <input type="radio" name="orc_id_painel" style="width: 20px;height: 20px;" checked="">&nbsp;<big class="font-weight-bold text-primary"><span class="text-danger font-weight-bold">Não</span> incluir descarregamento</big>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <style>
                                .box1 {
                                    position: fixed;
                                    z-index: 1000;
                                    right: 25em;
                                    bottom: 0;
                                }
                                .box2 {
                                    position: fixed;
                                    z-index: 1000;
                                    right: 0;
                                    bottom: 0;
                                }
                            </style>
                            <div class="box1">
                                <div class="alert text-left" style="background: rgba(250,204,46, 0.9);color: #03668A;" role="alert">
                                    <label class=" form-control-label" style="font-size: .9em;">Preço de Tabela do Kit para <b>Integradores</b></label>
                                    <div class="input-group mb-2 bg-light" style="border: 1px solid #fff;border-radius: 5px;">
                                        <div class="input-group-addon"><span class="font-weight-bold" style="font-size: .9em;">R$</span></div>
                                        <input class="form-control border-0 text-dark font-weight-bold" style="font-size: .9em;" value="145.254,25" readonly="">
                                    </div>
                                    <label class=" form-control-label">Valor Final para o Cliente</label>
                                    <div class="input-group bg-light" style="border: 1px solid #fff;border-radius: 5px;">
                                        <div class="input-group-addon"><span class="font-weight-bold" style="font-size: .9em;">R$</span></div>
                                        <input class="form-control border-0 text-dark font-weight-bold" style="font-size: .9em;" value="165.524,98" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="box2">
                                <div class="alert text-light font-weight-bold text-left" style="background: rgba(180,4,4, 0.9);" role="alert">
                                    <label class=" form-control-label" style="font-size: .9em;">Valor do KIT para <span class="text-warning">Franqueado</span> Bluesun</label>
                                    <div class="input-group mb-2 bg-light" style="border: 1px solid #fff;border-radius: 5px;">
                                        <div class="input-group-addon"><span class="font-weight-bold text-danger" style="font-size: .9em;">R$</span></div>
                                        <input class="form-control border-0 text-danger font-weight-bold" style="font-size: .9em;" value="122.485,96" readonly="">
                                    </div>
                                    <label class=" form-control-label">Valor Franqueado Final</label>
                                    <div class="input-group bg-light" style="border: 1px solid #fff;border-radius: 5px;">
                                        <div class="input-group-addon"><span class="font-weight-bold text-danger" style="font-size: .9em;">R$</span></div>
                                        <input class="form-control border-0 text-danger font-weight-bold" style="font-size: .9em;" value="127.587.33" readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light">
                                <strong>Itens inclusos no Kit</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="container">
                                    <div class="row">
                                        <div class="col externa">
                                            <table class="table">
                                                <thead style="display: none;">
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="align-middle">Número total de Painéis Fotovoltaicos:</td>
                                                        <td class="align-middle font-weight-bold">12</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Potência de cada Painel Fotovoltaico:</td>
                                                        <td class="align-middle font-weight-bold">415 Wp (STC - Standard Test Conditions)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Potência de cada Painel Fotovoltaico:</td>
                                                        <td class="align-middle font-weight-bold">415 Wp (STC - Standard Test Conditions)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Potência Total do Sistema Fotovoltaico:</td>
                                                        <td class="align-middle font-weight-bold">4.98 KWp</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Total de Inversores:</td>
                                                        <td class="align-middle font-weight-bold">1 Inversor SAJ</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Potência Nominal Total dos Inversores:</td>
                                                        <td class="align-middle font-weight-bold">5.00 KWp</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Potência dos Inversores com Overload:</td>
                                                        <td class="align-middle font-weight-bold">7.50 KWp</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Cabo Solar Preto com Proteção UV de 4mm2:</td>
                                                        <td class="align-middle font-weight-bold">35 metros</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Cabo Solar Vermelho com Proteção UV de 4mm2:</td>
                                                        <td class="align-middle font-weight-bold">35 metros</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Cabo Solar Verde de 4mm2:</td>
                                                        <td class="align-middle font-weight-bold">0 metros (Caso tenha inserido no orçamento)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Conectores MC4 (pares):</td>
                                                        <td class="align-middle font-weight-bold">0 pares</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">String Box CC (Corrente Contínua):</td>
                                                        <td class="align-middle font-weight-bold">1 String(s) Box Completo(s)</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">String Box CA (Corrente Alternada):</td>
                                                        <td class="align-middle font-weight-bold">Não Incluso</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Estrutura de Fixação em Alumínio e Aço Inox:</td>
                                                        <td class="align-middle font-weight-bold">Estrutura de Telhado FotoFix</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Sistema de Aterramento Completo:</td>
                                                        <td class="align-middle font-weight-bold">SIM</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Seguro contra Riscos Diversos:</td>
                                                        <td class="align-middle font-weight-bold">NÃO</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Seguro de Instalação:</td>
                                                        <td class="align-middle font-weight-bold">SIM</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="align-middle">Mão de Obra de Descarregamento:</td>
                                                        <td class="align-middle font-weight-bold">NÃO</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-body card-block">
                                <div class="container" style="margin-top: 25px;margin-bottom: 25px;">
                                    <div class="row">
                                        <div class="col externa">
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/ulica_l.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/saj_l.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/fronius_l.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/growatt_l.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/zshine_l.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col externa">
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/fotofix_l.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/canadian_l.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/byd_l.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col externa">
                                            <div class="row mt-1">
                                                <div class="col externa">
                                                    <img src="<?php echo base_url('public/images/img_orc/proauto_l.png'); ?>" width="70%"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bdent">
                            <div class="card-header bg-secondary text-light">
                                <strong>O que são os Seguros?</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="container">
                                    <div class="row con-tooltip top">
                                        <p style="font-size: 1.2em;color: #222;">Seguro contra <strong>Riscos Diversos</strong> e <strong>Seguro de Instalação Opcionais</strong> <strong><big>(Saiba Mais...)</big></strong><br/>
                                            Frete Rodoviário <span class="text-danger font-weight-bold">GRÁTIS</span>
                                        <img src="<?php echo base_url('public/images/img_orc/frete-1.png'); ?>" width="100" alt="frete"></p>
                                        <div class="tooltip">
                                            <p style="font-size: .7em;line-height: 15px;text-align: justify;color: #ededed;">
                                                <b>SEGURO DE INSTALAÇÃO</b>:<br>
                                                UM SEGURO COMPLETO PARA QUE NENHUM RISCO AFETE O ANDAMENTO DA INSTALAÇÃO E MONTAGEM DO EQUIPAMENTO<br>
                                                 No momento da instalação e montagem do equipamento fotovoltaico você precisa de proteção contra imprevistos. Com o seguro Riscos de Engenharia você garante coberturas detalhadas para a instalação. Assim, os imprevistos passam longe e os riscos ficam amparados desde o início do projeto até sua conclusão. Veja algumas das coberturas com as quais você pode contar:
                                                 <br>• INCÊNDIO, ERROS DE EXECUÇÃO E SABOTAGENS: Cobre os danos físicos decorrentes de acidentes que causem prejuízos com o equipamento, como quebra, e outros bens instalados ou montados na obra;
                                                 <br>• ROUBO E FURTO QUALIFICADO: Garante o danos causados por roubo e furto de bens materiais inerentes à instalação e montagem do equipamento que estejam dentro do local a ser instalado;
                                                 <br>• RISCOS DA NATUREZA: Danos causados por vendaval, queda de granizo, queda de raio, alagamento entre outros fenômenos naturais não previsíveis;
                                                 <br> • RESPONSABILIDADE CIVIL GERAL: Garante os danos materiais ou corporais causados a terceiros em decorrência dos trabalhos relacionados a instalação e montagem dos equipamentos;
                                                 <br>
                                                 <br><b>SEGURO CONTRA RISCOS DIVERSOS</b>:<br>
                                                 Este seguro visa proteger o cliente final, tornando seu sistema protegido contra raios, chuva de granizo, danos elétricos, roubo qualificado, entre outros. 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row p-2" style="border-top: 1px dashed #222;background: #E6E6E6;border-radius: 5px;">
                                        <div class="form-check">
                                            <input style="width: 20px;height: 20px;" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1" style="font-weight: bold;color: #03668A;font-size: 1.3em;">
                                                &nbsp;&nbsp;Desejo que meu cliente visualize <span class="text-danger" style="font-size: 1.2em;">SEPARADAMENTE</span> o valor do Kit Fotovoltaico e da Mão de Obra.<br/>
                                                <img src="<?php echo base_url('public/images/img_orc/preco-separado.gif'); ?>" style="border-radius: 10px;width: 550px;margin-top: -5px;" alt="alt"/>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<button type="submit" class="btn btn-sm float-right mt-1" style="width: 100%;font-size: 1.5em;background: #03668A;color: #fff;"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;SALVAR ORÇAMENTO</button>-->
                        
                    </div>                    
                </div>

            </div>

        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script>
$('input[name="addInversor"]').change(function () {
    if ($('input[name="addInversor"]:checked').val() === "Inversor") {
        $('.divAdicional').show();
    } else {
        $('.divAdicional').hide();
    }
});
</script>
<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script>
