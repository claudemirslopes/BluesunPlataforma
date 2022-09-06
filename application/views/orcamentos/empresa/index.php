<script src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
    <!-- Adicionando Javascript -->
    <script>
    $(document).ready(function() {
        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }       
        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {
            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');
            //Verifica se campo cep possui valor informado.
            if (cep != "") {
                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;
                //Valida o formato do CEP.
                if(validacep.test(cep)) {
                    //Preenche os campos com "carregando..." enquanto consulta webservice.
                    $("#rua").val("carregando...");
                    $("#bairro").val("carregando...");
                    $("#cidade").val("carregando...");
                    $("#uf").val("carregando...");
                    $("#ibge").val("carregando...");
                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });
    </script>
    
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
                    <strong class="card-title" v-if="headerText">Configuração da Empresa</strong>
                    <!--<a title="Alterar senha de acesso" href="senha_altera/" class="btn btn-dark btn-sm float-right"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;Alterar senha de acesso</a>-->
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
                
                    
                        <style type="text/css">
                        #container {
                          display: inline-block;
                          position: relative;
                        }

                        #container figcaption {
                          position: absolute;
                          top: 5px;
                          left: 5px;
                          font-size: .9em;
                          color: #FFC40D;
                          font-weight: bolder;
                          text-shadow: 0px 0px 2px black;
                          background: rgba(39,44,51, 0.5);
                          padding-left: 5px;
                          padding-right: 5px;
                          border-radius: 10px;
                        }
                        #linkmage {
                            color: #232323;
                            background: #ababab;
                            font-weight: bold;
                            padding: 5px;
                            font-size: .8em;
                            border-radius: 10px;
                        }
                        #linkmage:hover {
                            color: #ababab;
                            background: #232323;
                        }
                        </style>
                        <fieldset class="border p-2 col-md-5 float-left" style="margin-top: -10px;margin-bottom: 15px;">
                            <legend class="font-small"><i class="fa fa-cogs"></i> Logo da Empresa <small>[Medida: 499x143 | Tipo: Somente <b>PNG</b>]</small></legend>
                            <div class="form-row">
                                <div class="form-group col-md-12" style="height: 125px;">
                                    <div style="width: 100%;height: 100%;background-image: url('https://via.placeholder.com/499x143/cdcdcd/ababab/?text=499&nbsp;x&nbsp;143');background-color: #cccccc;background-position: center;background-repeat: no-repeat;background-size: cover;">
                                        <?php if($cliente->cliente_logo == 0) {
                                            echo '<div style="padding-top: 10px;float: right;clear: both;line-height: 190px;"><a id="linkmage" href="" data-toggle="modal" data-target="#foto" style="margin-right: 6px;">ADICIONAR LOGO</a></div>';
                                        } else {
                                        ?>
                                        <a href="" data-toggle="modal" data-target="#foto">
                                        <figure id="container">
                                            <img src="<?php echo base_url('public/images/orcamentos/'.$cliente->cliente_id.'.png'); ?>" alt="Logo" width="100%" height="100%" style="background-color: #cdcdcd;"/>
                                            <figcaption>TROCAR LOGO</figcaption>
                                        </figure></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        
                        <div class="modal fade swing" id="foto" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mediumModalLabel">Logo da Empresa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div style="width: 100%;height: 100%;">
                                        <?php if($cliente->cliente_logo == 0) { ?>
                                            <img src="<?php echo base_url('public/images/orcamentos/semlogo.jpg'); ?>" alt="Logo" width="100%" height="100%" style="background-color: #cdcdcd;"/>
                                        <?php } else { ?>
                                        <figure id="container">
                                            <img src="<?php echo base_url('public/images/orcamentos/'.$cliente->cliente_id.'.png'); ?>" alt="Logo" width="100%" height="100%" style="background-color: #cdcdcd;"/>
                                        </figure>
                                        <?php } ?>
                                    </div>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                            $divopen = '<div class="form-group col-md-12">';
                                            $divclose = '</div>';
                                            echo form_open_multipart('orcamentos/clientes/nova_foto');
                                            echo form_hidden('cliente_id', $cliente->cliente_id);
                                            echo $divopen;
                                            $imagem = array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control');
                                            echo form_upload($imagem);
                                            echo $divclose;
                                        ?>
                                        <small class="form-text text-danger text-center"><b>Formato aceito:</b> Somente PNG | <b>Medida indicada:</b> 499x143</small>
                                    </div>
                                    <div class="modal-footer">
                                        <?php
                                            echo $divopen;
                                        ?>                                            
                                        <div class="float-right">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <?php
                                                $botao = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'class' => 'btn btn-info', 'value' => 'Adicionar Logo');
                                                echo form_submit($botao);
                                                echo $divclose;
                                                echo form_close();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <form method="post" name="form_edit" class="user" autocomplete="no">
                        <fieldset class="border p-2 col-md-7 float-right" style="margin-top: -10px;">
                            <legend class="font-small"><i class="fa fa-cogs"></i> Configurações</legend>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="cliente_pessoa">Cliente Tipo <span style="color: red;font-weight: bold;">*</span></label>
                                    <select style="pointer-events: none;touch-action: none;" name="cliente_pessoa" class="form-control custom-select" id="cliente_pessoa" readonly="">
                                        <option readonly="" value="<?php echo ($cliente->cliente_pessoa == 1 ? '1' : '2'); ?>"><?php echo ($cliente->cliente_pessoa == 1 ? 'Pessoa Física' : 'Pessoa Jurídica'); ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                <?php if ($cliente->cliente_pessoa == 1):  ?>
                                     <label for="cliente_cpf">CPF <span style="color: red;font-weight: bold;">*</span></label>
                                     <input style="pointer-events: none;touch-action: none;" type="text" name="cliente_cpf" readonly="" class="form-control form-control-user cpfmask" id="cliente_cpf" placeholder="CPF" value="<?php echo $cliente->cliente_cpf_cnpj ?>">
                                     <?php echo form_error('cliente_cpf', '<small class="form-text text-danger">','</small>') ?>
                                <?php else: ?>
                                     <label for="cliente_cnpj">CNPJ <span style="color: red;font-weight: bold;">*</span></label>
                                     <input style="pointer-events: none;touch-action: none;" type="text" name="cliente_cnpj" readonly="" class="form-control form-control-user cnpjmask" id="cliente_cnpj" placeholder="CNPJ" value="<?php echo $cliente->cliente_cpf_cnpj ?>">
                                     <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger">','</small>') ?>
                                <?php endif; ?>                                    
                                </div>
                                <div class="form-group col-md-6">
                                <?php if ($cliente->cliente_pessoa == 1):  ?>
                                    <label for="cliente_rg_ie">RG</label>
                                <?php else: ?>
                                     <label for="cliente_rg_ie">Inscrição Estadual</label>
                                <?php endif; ?>
                                    <input style="pointer-events: none;touch-action: none;" type="cliente_rg_ie" name="cliente_rg_ie" class="form-control form-control-user" id="cliente_rg_ie" placeholder="<?php echo ($cliente->cliente_pessoa == 1 ? 'RG' : 'IE') ?>" value="<?php echo $cliente->cliente_rg_ie ?>">
                                    <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cliente_tipo">Cliente Tipo <span style="color: red;font-weight: bold;">*</span></label>
                                    <select style="pointer-events: none;touch-action: none;" name="cliente_tipo" class="form-control custom-select" id="cliente_tipo" readonly="">
                                        <option value="1" <?php echo ($cliente->cliente_tipo == 1) ? 'selected' : ''; ?>>Franqueado</option>
                                        <option value="2" <?php echo ($cliente->cliente_tipo == 2) ? 'selected' : ''; ?>>Integrador</option>
                                        <option value="0" <?php echo ($cliente->cliente_tipo == 0) ? 'selected' : ''; ?>>Cliente (Teste)</option>
                                        <option value="0" <?php echo ($cliente->cliente_tipo == 3) ? 'selected' : ''; ?>>Distribuidor</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="cliente_ativo">Ativo <span style="color: red;font-weight: bold;">*</span></label>
                                    <select style="pointer-events: none;touch-action: none;" readonly="" name="cliente_ativo" class="form-control custom-select" id="cliente_ativo">
                                        <option value="0" <?php echo ($cliente->cliente_ativo == 0) ? 'selected' : ''; ?>>Não</option>
                                        <option value="1" <?php echo ($cliente->cliente_ativo == 1) ? 'selected' : ''; ?>>Sim</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2" style="clear: both;">
                            <?php if ($cliente->cliente_pessoa == 1):  ?>
                            <legend class="font-small"><i class="fa fa-user-circle"></i> Dados Pessoais</legend>
                            <?php else: ?>
                            <legend class="font-small"><i class="fa fa-industry"></i> Dados Empresariais</legend>
                            <?php endif; ?>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                <?php if ($cliente->cliente_pessoa == 1):  ?>
                                    <label for="cliente_nome">Nome <span style="color: red;font-weight: bold;">*</span></label>
                                <?php else: ?>
                                    <label for="cliente_nome">Razão Social <span style="color: red;font-weight: bold;">*</span></label>
                                <?php endif; ?>
                                    <input type="text" name="cliente_nome" class="form-control form-control-user" id="cliente_nome" placeholder="<?php echo ($cliente->cliente_pessoa == 1 ? 'Nome' : 'Razão Social') ?>" value="<?php echo $cliente->cliente_nome ?>">
                                    <?php echo form_error('cliente_nome', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-7">
                                <?php if ($cliente->cliente_pessoa == 1):  ?>
                                    <label for="cliente_sobrenome">Sobrenome <span style="color: red;font-weight: bold;">*</span></label>
                                <?php else: ?>
                                    <label for="cliente_sobrenome">Nome Fantasia <span style="color: red;font-weight: bold;">*</span></label>
                                <?php endif; ?>
                                    <input type="text" name="cliente_sobrenome" class="form-control form-control-user" id="cliente_sobrenome" placeholder="<?php echo ($cliente->cliente_pessoa == 1 ? 'Sobrenome' : 'Nome Fantasia') ?>" value="<?php echo $cliente->cliente_sobrenome ?>">
                                    <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                <?php if ($cliente->cliente_pessoa == 1):  ?>
                                    <label for="cliente_data_nascimento">Data de Nascimento <span style="color: red;font-weight: bold;">*</span></label>
                                <?php else: ?>
                                    <label for="cliente_data_nascimento">Data de abertura <span style="color: red;font-weight: bold;">*</span></label>
                                <?php endif; ?>
                                    <input type="date" name="cliente_data_nascimento" class="form-control form-control-user" id="cliente_data_nascimento" placeholder="DN" value="<?php echo $cliente->cliente_data_nascimento ?>">
                                    <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cliente_email">E-mail <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="email" name="cliente_email" class="form-control form-control-user" id="cliente_email" placeholder="E-mail" value="<?php echo $cliente->cliente_email ?>">
                                    <?php echo form_error('cliente_email', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="cliente_telefone">Telefone Fixo <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="cliente_telefone" class="form-control form-control-user telefone" id="cliente_telefone" placeholder="Telefone Fixo" value="<?php echo $cliente->cliente_telefone ?>">
                                    <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="cliente_celular">Celular <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="cliente_celular" class="form-control form-control-user celular" id="cliente_celular" placeholder="Celular" value="<?php echo $cliente->cliente_celular ?>">
                                    <?php echo form_error('cliente_celular', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="cliente_responsavel">Responsável <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="cliente_responsavel" class="form-control form-control-user" id="cliente_responsavel" placeholder="Nome do Responsável" value="<?php echo $cliente->cliente_responsavel ?>">
                                    <?php echo form_error('cliente_responsavel', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-map-marker"></i> Informações de Endereço</legend>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="cliente_cep">CEP <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="cliente_cep" class="form-control form-control-user cep" id="cep" placeholder="CEP" value="<?php echo $cliente->cliente_cep ?>">
                                    <?php echo form_error('cliente_cep', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="cliente_endereco">Endereço <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="cliente_endereco" class="form-control form-control-user" id="rua" placeholder="Logradouro, rua, etc..." value="<?php echo $cliente->cliente_endereco ?>">
                                    <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="cliente_numero_endereco">Nº</label>
                                    <input type="text" name="cliente_numero_endereco" class="form-control form-control-user" id="numero" placeholder="nº" value="<?php echo $cliente->cliente_numero_endereco ?>">
                                    <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="cliente_complemento">Complemento</label>
                                    <input type="text" name="cliente_complemento" class="form-control form-control-user" id="complemento" placeholder="Complemento" value="<?php echo $cliente->cliente_complemento ?>">
                                    <?php echo form_error('cliente_complemento', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="cliente_bairro">Bairro <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="cliente_bairro" class="form-control form-control-user" id="bairro" placeholder="Bairro" value="<?php echo $cliente->cliente_bairro ?>">
                                    <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="cliente_cidade">Cidade <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="cliente_cidade" class="form-control form-control-user" id="cidade" placeholder="Cidade" value="<?php echo $cliente->cliente_cidade ?>">
                                    <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="cliente_estado">UF <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="cliente_estado" class="form-control custom-select" id="uf">
                                        <option value="<?php echo $cliente->cliente_estado ?>"><?php echo $cliente->cliente_estado ?></option>
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
                                    <?php echo form_error('cliente_estado', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-sticky-note"></i> Observação</legend>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea name="cliente_obs" rows="3" class="form-control form-control-user" id="cliente_obs" placeholder="Observação"><?php echo $cliente->cliente_obs ?></textarea>
                                    <?php echo form_error('cliente_obs', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <input type="hidden" name="cliente_id" value="<?php echo $cliente->cliente_id; ?>">
                        <button type="submit" class="btn btn-primary btn-sm float-right mt-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar autorizado</button>                       
                    </form>
                </div>

            </div>

        </div>
