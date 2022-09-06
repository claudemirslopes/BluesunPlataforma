<style>
    .form-control {
        border: 1px solid #A4A4A4;
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
                            <li><a href="#">Estoque</a></li>-->
                            <li class="active"><?php echo $titulo; ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .notifica {
                color: #ffffff;
                text-align: justify;
                float: left;
            }
            .notifica a {
                color: #FFFF00;
            }
            .notifica a:hover {
                color: #fff;
            }
            #cortexto p {
                color: #fff !important;
                font-size: 1.1em !important;
            }
        </style>
                    
        <!-- content -->
        <div class="content mt-1">
            <div class="card">
                <div class="card-header bg-secondary text-light">
                    <strong class="card-title" v-if="headerText">Preço de Kits</strong>
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

                    <div class="row">
                       <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" style="font-size: 1.5em;">
                                    Digite a Quantidade de <strong>Módulos Fotovoltaicos</strong> ou <strong>Potência do Sistema</strong> em KWps
                                </div>
                                <div class="card-body card-block">
                                    <form  action="preco_kit/preco_kit" method="post" enctype="multipart/form-data" name="form_cadastro" id="form_cadastro" class="form-horizontal">
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <label for="inputSuccess2i" class=" form-control-label">Quantidade de Painéis (Módulos)</label>
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success">
                                                            <i class="fa fa-solar-panel" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="placas" id="placas" placeholder="Digite a quantidade de painéis (módulos)" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <label for="inputSuccess2i" class=" form-control-label">Potência do Sistema (KWp)</label>
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-danger">
                                                            <i class="fa fa-battery-full" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="kwp" id="kwp" value="" placeholder="Digite a potência total" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6">
                                                <label for="inputSuccess2i" class=" form-control-label">Estado (UF)</label>
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-secondary">
                                                            UF
                                                        </button>
                                                    </div>
                                                    <select id="uf-c" name="uf-c" class="form-control">
                                                        <option value="AC">Acre</option>
                                                        <option value="AL">Alagoas</option>
                                                        <option value="AP">Amapá</option>
                                                        <option value="AM">Amazonas</option>
                                                        <option value="BA">Bahia</option>
                                                        <option value="CE">Ceará</option>
                                                        <option value="DF">Distrito Federal</option>
                                                        <option value="ES">Espírito Santo</option>
                                                        <option value="GO">Goiás</option>
                                                        <option value="MA">Maranhão</option>
                                                        <option value="MT">Mato Grosso</option>
                                                        <option value="MS">Mato Grosso do Sul</option>
                                                        <option value="MG">Minas Gerais</option>
                                                        <option value="PA">Pará</option>
                                                        <option value="PB">Paraíba</option>
                                                        <option value="PR">Paraná</option>
                                                        <option value="PE">Pernambuco</option>
                                                        <option value="PI">Piauí</option>
                                                        <option value="RJ">Rio de Janeiro</option>
                                                        <option value="RN">Rio Grande do norte</option>
                                                        <option value="RS">Rio Grande do Sul</option>
                                                        <option value="RO">Rondônia</option>
                                                        <option value="RR">Roraima</option>
                                                        <option value="SC">Santa Catarina</option>
                                                        <option value="SP" selected="">São Paulo</option>
                                                        <option value="SE">Sergipe</option>
                                                        <option value="TO">Tocantins</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col col-md-6">
                                                <label for="inputSuccess2i" class=" form-control-label">Tipo de Estrutura</label>
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-secondary">
                                                            <i class="fa fa-home" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <select id="tipo_estrutura" name="tipo_estrutura" class="form-control">
                                                        <!--<option selected="" disabled="" readonly="">Selecione a estrutura</option>-->
                                                        <option value="0">Telha Metálica</option>
                                                        <option value="1">Laje Plana - Montagem em Paisagem (Horizontal)</option>
                                                        <option value="5">Laje Plana - Montagem em Retrato (Vertical)</option>
                                                        <option value="2">Telhas Fibrocimento com Parafuso Dupla Rosca para Viga Metálica</option>
                                                        <option value="8">Telhas Fibrocimento com Parafuso Dupla Rosca para Madeira</option>
                                                        <option value="3">Telhas Cerâmicas (Romanas/ Americanas)</option>
                                                        <option value="6">Usina de Solo - Montagem em Paisagem (Horizontal)</option>
                                                        <option value="7">Usina de Solo - Montagem em Retrato (Vertical)</option>
                                                        <option value="4">Não Incluir</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <small class="form-text text-muted font-weight-bold float-right" style="font-size: 1.0em;margin-top: -15px;">Quando houver 2 ou mais tipos de telhado, UTILIZAR A ESTRUTURA 'FIBROCIMENTO'</small>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <img src="<?php echo base_url('public/images/img_orc/tarja.gif'); ?>" width="100%"/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                        <?php 
                                            $sel  = executa("select","produto_id, produto_descricao, produto_ativo, produto_preco_venda, produto_potencia, produto_obs, produto_codigo_interno, produto_marca_id",'',"produtos"," where produto_categoria_id in('1') and produto_ativo = '1' order by produto_potencia asc, produto_id ASC");

                                            $contador = 0;

                                            while($f_campos = mysqli_fetch_array($sel)){

                                             $produto_descricao= $f_campos['produto_descricao'];
                                             $produto_ativo= $f_campos['produto_ativo'];
                                             $produto_potencia= $f_campos['produto_potencia'];
                                             $produto_marca_id= $f_campos['produto_marca_id'];
                                             $produto_obs= $f_campos['produto_obs'];
                                             $produto_preco_venda= $f_campos['produto_preco_venda'];
                                             $id_campo= $f_campos['produto_id'];
                                             $produto_codigo_interno= $f_campos['produto_codigo_interno'];

                                             //  if ($shortname == 'painel_byd_335') {
                                             //   $potenciav = 335;
                                             // }else if($shortname == 'painel_ulica_410'){
                                             //       $potenciav = 410;
                                             // }else{
                                                $potenciav = $produto_potencia;
                                             // }
                                            if ($contador == '0') {
                                                              $checked = "checked";
                                                            }else{
                                                              $checked = "";
                                                            }

                                                            if (strlen($produto_obs)>0) {
                                                                $obs = "<span class=\"observacao_painel\">$produto_obs</span>";
                                                            }else{
                                                                $obs="";
                                                            }
                                                            
                                        ?>
                                             
                                            <div class="col col-md-6">
                                                <div class="row">
                                                    <div class="col externa">
                                                        <img src="<?php echo base_url('public/images/img_orc/'.$produto_marca_id.'.jpg'); ?>" width="35%"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col externa">
                                                        <span style="font-size: 1.2em;font-weight: bold;"><?php echo $potenciav; ?>&nbsp;Wp</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col externa">
                                                        <img src="<?php echo base_url('public/images/img_orc/paineis-05.gif'); ?>" width="30%"/>
                                                        <div class="textocima" style="padding: 8px;font-size: 1.2em;">Pronta Entrega</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col externa">
                                                        <p style="text-align: center;font-size: 1.0em;color: #333;"><?php echo $produto_descricao; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col externa">
                                                        <input type="radio" name="painel" id="painel" value="<?php echo $id_campo; ?>" class="form-control form-check" <?php echo $checked; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <?php
                                             $contador++;
                                           }
                                        ?>
                                        <?php
                                            function executa($consulta,$campos,$valores,$tabela,$adicional){
                                                global $con;
                                                $con = mysqli_connect("localhost","bluesu66_plataforma","E[YjR5[ucN2$","bluesu66_plataforma");
                                                            if ($consulta == "insert") {
                                                                    $sql = "INSERT into $tabela($campos) values($valores)";
                                                                    //echo $sql;
                                                                    //exit();
                                                                    $qry = mysqli_query($con,$sql);
                                                                    return true;
                                                            }
                                                            if ($consulta == "select") {
                                                                    $sql = "SELECT $campos from $tabela $adicional";
                                                                    //echo $sql;
                                                                    //exit();
                                                                    $qry = mysqli_query($con,$sql);
                                                                    $numCol = @mysqli_num_fields($qry);
                                                                    return $qry;
                                                            }

                                                            if ($consulta == "update") {
                                                                    $sql = "update $tabela set $campos $adicional";
                                                                    //echo $sql;
                                                                    //exit();
                                                                    $qry  = mysqli_query($con,$sql);
                                                                    return true;
                                                            }

                                                            if ($consulta == "delete") {
                                                                    $sql = "delete from $tabela $adicional";
                                                                    $qry = mysqli_query($con,$sql);

                                                                    return true;
                                                            }
                                                    }
                                        ?>
                                            </div>
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <imput type="button" class="btn btn-dark btn-lg btn-block" onclick="javascript:valida_preco();"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;CONSULTAR PREÇO DO KIT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                       </div>
                    </div>
                    
                </div>

            </div>

        </div>
        