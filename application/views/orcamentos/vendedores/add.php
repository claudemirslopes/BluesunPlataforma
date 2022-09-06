<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
    <!-- Adicionando Javascript -->
    <script>
    $(document).ready(function() {
        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#logradouro").val("");
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
                    $("#logradouro").val("carregando...");
                    $("#bairro").val("carregando...");
                    $("#cidade").val("carregando...");
                    $("#uf").val("carregando...");
                    $("#ibge").val("carregando...");
                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#logradouro").val(dados.logradouro);
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
                            <li><a href="<?php echo base_url('orcamentos/vendedores'); ?>">Vendedores</a></li>
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
                    <strong class="card-title" v-if="headerText">Cadastrar Vendedor</strong>
                    <span class="float-right" style="color: #777;font-size: .9em;">
                       <a title="Voltar" href="<?php echo base_url('orcamentos/vendedores'); ?>" class="btn btn-light btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
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
                        
                        <fieldset class="border p-2" style="margin-top: -10px;">
                            <legend class="font-small"><i class="fa fa-address-card"></i> Tipo de pessoa</legend>
                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                <input type="radio" id="pessoa_fisica" name="vend_fran_pessoa" class="custom-control-input" value="1" <?php echo set_checkbox('vend_fran_pessoa', '1') ?> checked="">
                                <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa Física</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="pessoa_juridica" name="vend_fran_pessoa" class="custom-control-input" value="2" <?php echo set_checkbox('vend_fran_pessoa', '2') ?> >
                                <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa Jurídica</label>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-cogs"></i> Configurações</legend>
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <div class="pessoa_fisica">
                                        <label for="vend_fran_cpf">CPF <span style="color: red;font-weight: bold;">*</span></label>
                                        <input type="text" name="vend_fran_cpf" class="form-control form-control-user cpfmask" id="cpf" placeholder="CPF" value="<?php echo set_value('vend_fran_cpf'); ?>">           
                                        <?php echo form_error('vend_fran_cpf', '<small class="form-text text-danger">','</small>') ?>
                                    </div>
                                    <div class="pessoa_juridica">
                                        <label for="vend_fran_cnpj">CNPJ <span style="color: red;font-weight: bold;">*</span></label>
                                        <input type="text" name="vend_fran_cnpj" class="form-control form-control-user cnpjmask" id="cnpj" placeholder="CNPJ" value="<?php echo set_value('vend_fran_cnpj'); ?>">
                                        <?php echo form_error('vend_fran_cnpj', '<small class="form-text text-danger">','</small>') ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="vend_fran_status">Ativo <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="vend_fran_status" class="form-control custom-select" id="vend_fran_status">
                                        <option value="0">Não</option>
                                        <option value="1" selected="">Sim</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-user-circle"></i> Dados Pessoais/Empresariais</legend>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="pessoa_fisica" for="vend_fran_nome">Nome <span style="color: red;font-weight: bold;">*</span></label>
                                    <label class="pessoa_juridica" for="vend_fran_nome">Razão Social <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="vend_fran_nome" class="form-control form-control-user" id="nome" placeholder="Nome/Razão Social" value="<?php echo set_value('vend_fran_nome'); ?>">
                                    <?php echo form_error('vend_fran_nome', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="vend_fran_email">E-mail <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="email" name="vend_fran_email" class="form-control form-control-user" id="email" placeholder="E-mail" value="<?php echo set_value('vend_fran_email'); ?>">
                                    <?php echo form_error('vend_fran_email', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="vend_fran_tel_cel">Telefone/Celular <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="vend_fran_tel_cel" class="form-control form-control-user celular" id="telefone" placeholder="Telefone/Celular" value="<?php echo set_value('vend_fran_tel_cel'); ?>">
                                    <?php echo form_error('vend_fran_tel_cel', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-map-marker"></i> Informações de Endereço</legend>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="vend_fran_cep">CEP <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="vend_fran_cep" class="form-control form-control-user cep" id="cep" placeholder="CEP" value="<?php echo set_value('vend_fran_cep'); ?>">
                                    <?php echo form_error('vend_fran_cep', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="vend_fran_endereco">Endereço <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="vend_fran_endereco" class="form-control form-control-user" id="logradouro" placeholder="Logradouro, rua, etc..." value="<?php echo set_value('vend_fran_endereco'); ?>">
                                    <?php echo form_error('vend_fran_endereco', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="vend_fran_numero">Nº</label>
                                    <input type="text" name="vend_fran_numero" class="form-control form-control-user" id="numero" placeholder="nº" value="<?php echo set_value('vend_fran_numero'); ?>">
                                    <?php echo form_error('vend_fran_numero', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="vend_fran_complemento">Complemento</label>
                                    <input type="text" name="vend_fran_complemento" class="form-control form-control-user" id="complemento" placeholder="Complemento" value="<?php echo set_value('vend_fran_complemento'); ?>">
                                    <?php echo form_error('vend_fran_complemento', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="vend_fran_bairro">Bairro <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="vend_fran_bairro" class="form-control form-control-user" id="bairro" placeholder="Bairro" value="<?php echo set_value('vend_fran_bairro'); ?>">
                                    <?php echo form_error('vend_fran_bairro', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="vend_fran_cidade">Cidade <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="vend_fran_cidade" class="form-control form-control-user" id="cidade" placeholder="Cidade" value="<?php echo set_value('vend_fran_cidade'); ?>">
                                    <?php echo form_error('vend_fran_cidade', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="vend_fran_estado">UF <span style="color: red;font-weight: bold;">*</span></label>
                                    <select name="vend_fran_estado" class="form-control custom-select" id="uf">
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
                                    <?php echo form_error('vend_fran_estado', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        <input type="hidden" name="vend_fran_cliente_id" value="<?php echo $this->session->userdata('userlogado')->cliente_id; ?>">
                        
                        <button type="submit" class="btn btn-primary btn-sm float-right mt-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Cadastrar vendedor</button>
                    </form>
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
                    $("#post #fantasia").val(resposta.fantasia);
                    $("#post #atividade").val(resposta.atividade_principal[0].text + " (" + resposta.atividade_principal[0].code + ")");
                    $("#post #telefone").val(resposta.telefone);
                    $("#post #email").val(resposta.email);
                    $("#post #logradouro").val(resposta.logradouro);
                    $("#post #complemento").val(resposta.complemento);
                    $("#post #bairro").val(resposta.bairro);
                    $("#post #cidade").val(resposta.municipio);
                    $("#post #uf").val(resposta.uf);
                    $("#post #cep").val(resposta.cep);
                    $("#post #numero").val(resposta.numero);
                    $("#post #data_situacao").val(resposta.data_situacao);
                }
            });
});
</script>