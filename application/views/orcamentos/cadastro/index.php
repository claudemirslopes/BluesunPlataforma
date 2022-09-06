<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" href="<?php echo base_url('public/images/logo_bsum01.png'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('public/images/favicon.ico'); ?>">

    <?php echo (isset($titulo) ? '<title>Bluesun do Brasil | '.$titulo.'</title>' : '<title>Bluesum Solar do Brasil | Administrativo</title>'); ?>

    <!-- Principal CSS do Bootstrap -->
    <link href="https://getbootstrap.com.br/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos customizados para esse template -->
    <link href="https://getbootstrap.com.br/docs/4.1/examples/checkout/form-validation.css" rel="stylesheet">
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
  </head>

  <body class="bg-dark text-light">

    <div class="container">
        <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="<?php echo base_url('public/images/logo_bsum2.png'); ?>" alt="Bluesun" width="30%">
        <h2>Cadastre-se na nova Plataforma</h2>
        <p class="lead">Preencha os dados abixo e cadastre-se para entrar na nossa nova plataforma de orçamentos.</p>
      </div>

      <div class="row">
        <div class="col-md-12 order-md-1">
            <form method="post" name="form_edit" class="user" autocomplete="no">
                <fieldset class="border p-2" style="padding-bottom: 25px !important;">
                    <legend class="font-small text-center">&nbsp;&nbsp;<i class="fa fa-address-card"></i> Tipo de pessoa&nbsp;&nbsp;</legend>
                    <center><div class="custom-control custom-radio custom-control-inline mt-2">
                          <input type="radio" id="pessoa_fisica" name="cliente_pessoa" class="custom-control-input" value="1" <?php echo set_checkbox('cliente_pessoa', '1') ?> checked="">
                          <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa Física</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="pessoa_juridica" name="cliente_pessoa" class="custom-control-input" value="2" <?php echo set_checkbox('cliente_pessoa', '2') ?> >
                          <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa Jurídica</label>
                      </div></center>
                </fieldset>
                <fieldset class="border p-2" style="padding-bottom: 25px !important;">
                    <legend class="font-small text-center">&nbsp;&nbsp;<i class="fa fa-id-card"></i> Documentos&nbsp;&nbsp;</legend>
                    <div class="form-row">   
                        <div class="form-group col-md-6">
                            <div class="pessoa_fisica">
                                <label for="cliente_cpf">CPF <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="cliente_cpf" class="form-control form-control-user cpfmask" id="cpf" placeholder="CPF" value="<?php echo set_value('cliente_cpf'); ?>">           
                                <?php echo form_error('cliente_cpf', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="pessoa_juridica">
                                <label for="cliente_cnpj">CNPJ <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="cliente_cnpj" class="form-control form-control-user cnpjmask" id="cnpj" placeholder="CNPJ" value="<?php echo set_value('cliente_cnpj'); ?>">
                                <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="pessoa_fisica" for="cliente_rg_ie">RG</label>
                            <label class="pessoa_juridica" for="cliente_rg_ie">Inscrição Estadual</label>
                            <input type="cliente_rg_ie" name="cliente_rg_ie" class="form-control form-control-user" id="cliente_rg_ie" placeholder="RG/Inscrição Estadual" value="<?php echo set_value('cliente_rg_ie'); ?>">
                            <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">','</small>') ?>
                        </div>
                            <input type="hidden" name="cliente_tipo" value="0" class="form-control custom-select" id="cliente_tipo">
                            <input type="hidden" value="1" name="cliente_ativo" class="form-control custom-select" id="cliente_ativo">
                    </div>
            </fieldset>
            <fieldset class="mt-2 border p-2">
                <legend class="font-small text-center">&nbsp;&nbsp;<i class="fa fa-user-circle"></i> Dados Pessoais/Empresariais&nbsp;&nbsp;</legend>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label class="pessoa_fisica" for="cliente_nome">Nome <span style="color: red;font-weight: bold;">*</span></label>
                        <label class="pessoa_juridica" for="cliente_nome">Razão Social <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="text" name="cliente_nome" class="form-control form-control-user" id="nome" placeholder="Nome/Razão Social" value="<?php echo set_value('cliente_nome'); ?>">
                        <?php echo form_error('cliente_nome', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                    <div class="form-group col-md-7">
                        <label class="pessoa_fisica" for="cliente_sobrenome">Sobrenome <span style="color: red;font-weight: bold;">*</span></label>
                        <label class="pessoa_juridica" for="cliente_sobrenome">Nome Fantasia <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="text" name="cliente_sobrenome" class="form-control form-control-user" id="fantasia" placeholder="Sobrenome/Nome Fantasia" value="<?php echo set_value('cliente_sobrenome'); ?>">
                        <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="pessoa_fisica" for="cliente_data_nascimento">Data de Nascimento <span style="color: red;font-weight: bold;">*</span></label>
                        <label class="pessoa_juridica" for="cliente_data_nascimento">Data de Abertura <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="date" name="cliente_data_nascimento" class="form-control form-control-user" id="data_situacao" value="<?php echo set_value('cliente_data_nascimento'); ?>">
                        <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="cliente_email">E-mail <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="email" name="cliente_email" class="form-control form-control-user" id="email" placeholder="E-mail" value="<?php echo set_value('cliente_email'); ?>">
                        <?php echo form_error('cliente_email', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cliente_telefone">Telefone Fixo <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="text" name="cliente_telefone" class="form-control form-control-user telefone" id="telefone" placeholder="Telefone Fixo" value="<?php echo set_value('cliente_telefone'); ?>">
                        <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cliente_celular">Celular <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="text" name="cliente_celular" class="form-control form-control-user celular" id="cliente_celular" placeholder="Celular" value="<?php echo set_value('cliente_celular'); ?>">
                        <?php echo form_error('cliente_celular', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cliente_responsavel">Responsável <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="text" name="cliente_responsavel" class="form-control form-control-user" id="cliente_responsavel" placeholder="Nome do Responsável" value="<?php echo set_value('cliente_responsavel'); ?>">
                        <?php echo form_error('cliente_responsavel', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                </div>
            </fieldset>

            <fieldset class="mt-2 border p-2">
                <legend class="font-small text-center">&nbsp;&nbsp;<i class="fa fa-map-marker"></i> Endereço&nbsp;&nbsp;</legend>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="cliente_cep">CEP <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="text" name="cliente_cep" class="form-control form-control-user cep" id="cep" placeholder="CEP" value="<?php echo set_value('cliente_cep'); ?>">
                        <?php echo form_error('cliente_cep', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="cliente_endereco">Endereço <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="text" name="cliente_endereco" class="form-control form-control-user" id="logradouro" placeholder="Logradouro, rua, etc..." value="<?php echo set_value('cliente_endereco'); ?>">
                        <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="cliente_numero_endereco">Nº</label>
                        <input type="text" name="cliente_numero_endereco" class="form-control form-control-user" id="numero" placeholder="nº" value="<?php echo set_value('cliente_numero_endereco'); ?>">
                        <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cliente_complemento">Complemento</label>
                        <input type="text" name="cliente_complemento" class="form-control form-control-user" id="complemento" placeholder="Complemento" value="<?php echo set_value('cliente_complemento'); ?>">
                        <?php echo form_error('cliente_complemento', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cliente_bairro">Bairro <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="text" name="cliente_bairro" class="form-control form-control-user" id="bairro" placeholder="Bairro" value="<?php echo set_value('cliente_bairro'); ?>">
                        <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cliente_cidade">Cidade <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="text" name="cliente_cidade" class="form-control form-control-user" id="cidade" placeholder="Cidade" value="<?php echo set_value('cliente_cidade'); ?>">
                        <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="cliente_estado">UF <span style="color: red;font-weight: bold;">*</span></label>
                        <select name="cliente_estado" class="form-control custom-select" id="uf">
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
                        <?php echo form_error('cliente_estado', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                </div>
            </fieldset>

            <fieldset class="mt-2 border p-2">
                <legend class="font-small text-center">&nbsp;&nbsp;<i class="fa fa-unlock"></i> Dados de acesso&nbsp;&nbsp;</legend>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cliente_user">Usuário <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="text" name="cliente_user" class="form-control form-control-user" id="cliente_user" value="<?php echo set_value('cliente_user'); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cliente_senha">Senha <span style="color: red;font-weight: bold;">*</span></label>
                        <input type="password" name="cliente_senha" class="form-control form-control-user" id="cliente_senha">
                        <?php echo form_error('cliente_senha', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cliente_senha_repete">Confirmar Senha</label>
                        <input type="password" name="cliente_senha_repete" class="form-control form-control-user" id="cliente_senha_repete">
                        <?php echo form_error('cliente_senha_repete', '<small class="form-text text-danger">','</small>') ?>
                    </div>
                </div>
            </fieldset>
                <hr class="mb-4">
                <button class="btn btn-warning btn-lg btn-block" type="submit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Cadastrar</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <div class="card-header text-center bg-light">
            <span style="font-size: .8em;color: #555;">
                Copyright &copy; <?php echo date('Y'); ?> |
            </span>
            <span style="color: #41A80C;font-size: 1.0em;">Desenvolvido por <a class="navbar-brand" href="./">
                <img src="<?php echo base_url('public/images/logo_bsum.png'); ?>" alt="Bluesum" style="width: 100px;margin-top: -8px;"></a><sup>
                    <span style="font-size: 1.4em;color: #555;">
                        <style>
                            .copyright {
                                background: #FF8900;
                            }
                        </style>
                        <span class="badge badge-pill badge-warning copyright">
                            <strong>Versão:</strong> 1.0.0.0 (BETA)
                        </span>
                    </span></sup>
            </span>                        
        </div>
      </footer>
    </div>

    <!-- Principal JavaScript do Bootstrap
    ================================================== -->
    <!-- Foi colocado no final para a página carregar mais rápido -->
    <script src="https://kit.fontawesome.com/a8568f4b07.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://getbootstrap.com.br/docs/4.1/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com.br/docs/4.1/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com.br/docs/4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com.br/docs/4.1/assets/js/vendor/holder.min.js"></script>
    <script src="<?php echo base_url('public/vendors/mask/jquery_3.2.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/vendors/mask/jquery.maskedinput.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/clientes.js'); ?>"></script>
    <script>
      // Exemplo de JavaScript para desativar o envio do formulário, se tiver algum campo inválido.
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Selecione todos os campos que nós queremos aplicar estilos Bootstrap de validação customizados.
          var forms = document.getElementsByClassName('needs-validation');

          // Faz um loop neles e previne envio
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
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
                }
            });
});
</script>
  </body>
</html>
