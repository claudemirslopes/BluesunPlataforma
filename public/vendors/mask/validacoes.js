    /*Função Valida Cadastro*/

    function valida_cadastro(){



        var nome = document.getElementById('nome');

        var sobrenome = document.getElementById('sobrenome');

        var email = document.getElementById('email');

        var cpf = document.getElementById('cpf');

        var senha = document.getElementById('senha');

        var senha2 = document.getElementById('senha2');

        var erro_form = '0';





        if (nome.value.length < 3) {alert('Preencha seu Nome');nome.focus();return false;}

        if (sobrenome.value.length < 3) {alert('Preencha seu Sobrenome');sobrenome.focus();return false;}

        if (is_email(email.value) == false) {alert('Digite seu E-mail corretamente');email.focus();return false;}

        //if (is_cpf(cpf.value) == false) {alert('Digite seu CPF corretamente');cpf.focus();return false;}

        if (senha.value.length < 3) {alert('Preencha sua Senha');senha.focus();return false;}

        if (senha2.value.length < 3) {alert('Repita sua Senha');senha2.focus();return false;}

        if (senha.value != senha2.value) {alert('As Senhas devem ser iguais');senha2.focus();return false;}



        else{document.form_cadastro.submit();}





    }



    function valida_cliente(modo){



        var nome = document.getElementById('nome');

        var email = document.getElementById('email');

        var telefone = document.getElementById('telefone');

        var cpf = document.getElementById('cpf');

        var cnpj = document.getElementById('cnpj');

        var unidade_consumidora = document.getElementById('unidade_consumidora');

        var endereco = document.getElementById('endereco');

        var numero = document.getElementById('numero');

        var bairro = document.getElementById('bairro');

        var cidade = document.getElementById('cidade');

        var estado = document.getElementById('estado');

        var cep = document.getElementById('cep');

        var erro_form = '0';





        if (nome.value.length < 3) {alert('Preencha o Nome do Cliente');nome.focus();return false;}

        //if (sobrenome.value.length < 3) {alert('Preencha seu Sobrenome');sobrenome.focus();return false;}

        if (is_email(email.value) == false) {alert('Digite seu E-mail corretamente');email.focus();return false;}

        

        if(cnpj.value.length > 0){

            if (is_cnpj(cnpj.value) == false) {alert('Digite o CNPJ corretamente');cnpj.focus();return false;}

        }



        if(cpf.value.length > 0){

            if (is_cpf(cpf.value) == false) {alert('Digite o CPF corretamente');cpf.focus();return false;}

        }



        if (cpf.value.length == 0 && cnpj.value.length == 0) {alert('Preencha o CPF ou CNPJ do Cliente');cpf.focus();return false;}

        

        //if (unidade_consumidora.value.length < 5 && modo == 'novo') {alert('Preencha a Unidade Consumidora');unidade_consumidora.focus();return false;}

        if (telefone.value.length < 14) {alert('Preencha o Telefone do Cliente');telefone.focus();return false;}

        if (endereco.value.length < 3) {alert('Preencha o Endereço');endereco.focus();return false;}

        if (numero.value.length < 1) {alert('Preencha o Número');numero.focus();return false;}

        if (cidade.value.length < 3) {alert('Preencha a Cidade');cidade.focus();return false;}

        if (bairro.value.length < 3) {alert('Preencha o Bairro');bairro.focus();return false;}

        if (estado.value == '0') {alert('Escolha o Estado');estado.focus();return false;}

        if (cep.value.length < 8) {alert('Digite o CEP');cep.focus();return false;}



        else{document.form_cadastro.submit();}





    }



    function valida_preco(){



        var placas = document.getElementById('placas');
        var kwp = document.getElementById('kwp');

    

        var erro_form = '0';



        if (placas.value.length < 1 && kwp.value.length < 1) {
            alert('Preencha qualquer um dos Campos');
            placas.focus();
            return false;
        } else {
            document.form_cadastro.submit();
        }
    }





    function valida_confirmacao(){



        var forma_pagamento = document.form_pesquisa.forma_pagamento.value;

        var confirma_ckecklist = document.getElementById('confirma_ckecklist').checked;

        var endereco_novo = document.form_pesquisa.mostra_endereco.checked;

        



        if (confirma_ckecklist ==false) {alert('Confirme os Ítens do Checklist');document.getElementById('confirma_ckecklist').focus();return false;}

        if (forma_pagamento == '0') {alert('Escolha uma das formas de pagamento');document.getElementById('forma_pagamento').focus();return false;}

        if (endereco_novo == true) {

                var endereco = document.form_pesquisa.endereco.value;

                var bairro = document.form_pesquisa.bairro.value;

                var cidade = document.form_pesquisa.cidade.value;

                var cep = document.form_pesquisa.cep.value;

            

            if (endereco.length < 5) {alert('Preencha o Endereço');document.getElementById('endereco').focus();return false;}

            if (bairro.length < 4) {alert('Preencha o Bairro');document.getElementById('bairro').focus();return false;}

            if (cidade.length < 3) {alert('Preencha a Cidade');document.getElementById('endereco').focus();return false;}

            if (cep.length < 9) {alert('Preencha o CEP');document.getElementById('cep').focus();return false;}

                

            else{document.form_pesquisa.submit();}

        }



        else{document.form_pesquisa.submit();}





    }



    function valida_estoque(){



        var id_prod = document.form_user.id_prod.value;

        var qtde = document.form_user.qtde.value;

        var data_estimada = document.form_user.data_estimada.value;

        



        if (id_prod == '0') {alert('Selecione o Produto a ser Inserido');document.getElementById('id_prod').focus();return false;}

        if (qtde == '') {alert('Insira a Quantidade');document.getElementById('qtde').focus();return false;}

        if (data_estimada == '') {alert('Insira a Data Estimada');document.getElementById('data_estimada').focus();return false;}

        



        else{document.form_user.submit();}





    }



    function valida_anexo(){



        var nome_documento = document.form_anexos.nome_documento.value;

        var anexo = document.form_anexos.anexo.value;

        



        if (nome_documento == '0') {alert('Selecione o tipo de documento. Ex: RG, CPF, CNH, etc');document.getElementById('nome_documento').focus();return false;}

        if (anexo == '') {alert('Anexe o Documento');document.getElementById('anexo').focus();return false;}

        



        else{document.form_anexos.submit();}





    }



            function valida_reclamacao(){



                var reclamacao = document.form_reclamacao.reclamacao.value;

                



                if (reclamacao == '') {alert('Preencha a Reclamacao');document.getElementById('reclamacao').focus();return false;}

                



                else{document.form_reclamacao.submit();}





            }



       function valida_consumo(){



        var tipo_grupo = document.getElementById('tipo_grupo');

        var consumo01 = document.getElementById('consumo01');

        var consumo02 = document.getElementById('consumo02');

        var consumo03 = document.getElementById('consumo03');

        var consumo04 = document.getElementById('consumo04');

        var consumo05 = document.getElementById('consumo05');

        var consumo06 = document.getElementById('consumo06');

        var consumo07 = document.getElementById('consumo07');

        var consumo08 = document.getElementById('consumo08');

        var consumo09 = document.getElementById('consumo09');

        var consumo10 = document.getElementById('consumo10');

        var consumo11 = document.getElementById('consumo11');

        var consumo12 = document.getElementById('consumo12');

        var consumo13 = document.getElementById('consumo13');

        var erro_form = '0';





        if (tipo_grupo.value == "0") {alert('Escolha o Grupo do Cliente');tipo_grupo.focus();return false;}

        if (consumo01.value.length < 2) {alert('Preencha o Consumo 01');consumo01.focus();return false;}

        if (consumo02.value.length < 2) {alert('Preencha o Consumo 02');consumo02.focus();return false;}

        if (consumo03.value.length < 2) {alert('Preencha o Consumo 03');consumo03.focus();return false;}

        if (consumo04.value.length < 2) {alert('Preencha o Consumo 04');consumo04.focus();return false;}

        if (consumo05.value.length < 2) {alert('Preencha o Consumo 05');consumo05.focus();return false;}

        if (consumo06.value.length < 2) {alert('Preencha o Consumo 06');consumo06.focus();return false;}

        if (consumo07.value.length < 2) {alert('Preencha o Consumo 07');consumo07.focus();return false;}

        if (consumo08.value.length < 2) {alert('Preencha o Consumo 08');consumo08.focus();return false;}

        if (consumo09.value.length < 2) {alert('Preencha o Consumo 09');consumo09.focus();return false;}

        if (consumo10.value.length < 2) {alert('Preencha o Consumo 10');consumo10.focus();return false;}

        if (consumo11.value.length < 2) {alert('Preencha o Consumo 11');consumo11.focus();return false;}

        if (consumo12.value.length < 2) {alert('Preencha o Consumo 12');consumo12.focus();return false;}

        if (consumo13.value.length < 2) {alert('Preencha o Consumo 13');consumo13.focus();return false;}





        else{document.form_cadastro.submit();}





    }



    function valida_consumob(){



        var consumo01 = document.getElementById('consumo01');

    

        var erro_form = '0';





        if (consumo01.value.length < 2) {alert('Preencha o Consumo 01');consumo01.focus();return false;}



        else{document.form_cadastro.submit();}





    }



    function valida_orcamento(){



        var assunto = document.getElementById('assunto');

        var mensagem = document.getElementById('mensagem');

    

        var erro_form = '0';





        if (assunto.value.length < 20) {alert('Preencha o Assunto');assunto.focus();return false;}

        if (mensagem.value.length < 20) {alert('Preencha a Mensagem');mensagem.focus();return false;}



        else{document.form_cadastro.submit();}





    }



       function valida_consumoa(){



        var demanda_contratada  = document.getElementById('demanda_contratada');

        var consumo_ponta       = document.getElementById('consumo_ponta');

        var consumo_fora_ponta  = document.getElementById('consumo_fora_ponta');

        var valor_kw_ponta      = document.getElementById('valor_kw_ponta');

        var valor_kw_fora_ponta = document.getElementById('valor_kw_fora_ponta');

        var valor_conta         = document.getElementById('valor_conta');

        var valor_demanda       = document.getElementById('valor_demanda');

    

        var erro_form = '0';





        if (demanda_contratada.value.length < 2) {alert('Preencha a Demanda Contratada');demanda_contratada.focus();return false;}

        if (consumo_ponta.value.length < 2) {alert('Preencha o Consumo Dentro da Ponta');consumo_ponta.focus();return false;}

        if (consumo_fora_ponta.value.length < 2) {alert('Preencha o Consumo Fora da Ponta');consumo_fora_ponta.focus();return false;}

        if (valor_kw_ponta.value.length < 3) {alert('Preencha Valor do KWh Dentro da Ponta');valor_kw_ponta.focus();return false;}

        if (valor_kw_fora_ponta.value.length < 3) {alert('Preencha o Valor do KWh Fora da Ponta');consumo_ponta.focus();return false;}

        if (valor_conta.value.length < 4) {alert('Preencha o Valor Total da Conta');valor_conta.focus();return false;}

        if (valor_demanda.value.length < 3) {alert('Preencha o Valor da Demanda Contratada');valor_demanda.focus();return false;}



        else{document.form_cadastro.submit();}





    }



    function valida_escolha(){



        var tipo_grupo = document.getElementById('tipo_grupo');

        

        var erro_form = '0';





        if (tipo_grupo.value == "0") {alert('Escolha o Grupo do Cliente');tipo_grupo.focus();return false;}





        else{document.form_cadastro.submit();}





    }



    function valida_informacoes_sistema(){



        var valor_kw_atual = document.getElementById('valor_kw_atual');

        var demanda_contratada = document.getElementById('demanda_contratada');

        var irradiacao_local_dia = document.getElementById('irradiacao_local_dia');

        var inclinacao_ideal = document.getElementById('inclinacao_ideal');

        var tipo_contrato = document.getElementById('tipo_contrato');

        var concessionaria = document.getElementById('concessionaria');





        var erro_form = '0';





        if (valor_kw_atual.value.length < 2 || valor_kw_atual.value == '0.00') {alert('Preencha o Valor do kW Atual');valor_kw_atual.focus();return false;}

        if (irradiacao_local_dia.value < 3.4 || irradiacao_local_dia.value > 6.8) {alert('A Irradiação deve estar entre 3,4 a 6,8');irradiacao_local_dia.focus();return false;}

        if (inclinacao_ideal.value.length < 1 || inclinacao_ideal.value == '0') {alert('Preencha a Inclinação Ideal');inclinacao_ideal.focus();return false;}

        if (tipo_contrato.value == "0") {alert('Escolha o Tipo do Contrato');tipo_contrato.focus();return false;}

        if (concessionaria.value == "0") {alert('Escolha a Concession&aacute;ria');concessionaria.focus();return false;}





        else{document.form_cadastro.submit();}

    }



     function valida_informacoes_sistemaa(){



        var irradiacao_local_dia = document.getElementById('irradiacao_local_dia');

        var inclinacao_ideal = document.getElementById('inclinacao_ideal');

        var concessionaria = document.getElementById('concessionaria');



        var erro_form = '0';





        if (irradiacao_local_dia.value < 3.4 || irradiacao_local_dia.value > 6.8) {alert('A Irradiação deve estar entre 3,4 a 6,8');irradiacao_local_dia.focus();return false;}

        if (inclinacao_ideal.value.length < 1 || inclinacao_ideal.value == '0') {alert('Preencha a Inclinação Ideal');inclinacao_ideal.focus();return false;}

        if (concessionaria.value == "0") {alert('Escolha a Concession&aacute;ria');concessionaria.focus();return false;}



        else{document.form_cadastro.submit();}

    }



    function salva_orcamento(){



        var sobrepreco = document.getElementById('sobrepreco');

        var desconto = document.getElementById('desconto');



        //var inclui_projeto_sim = document.form_cadastro.projeto[0].checked;

        //var inclui_projeto_nao= document.form_cadastro.projeto[1].checked;



        var erro_form = '0';





        if (sobrepreco.value.length < 1) {alert('Sua margem está sem Preencher ');sobrepreco.focus();return false;}

        //if (inclui_projeto_sim == false && inclui_projeto_nao == false ) {alert('Escolha se Deseja ou não o Projeto');projeto.focus();return false;}



        else{document.form_cadastro.submit();}

    }



     function salva_orcamentoa(){



        var sobrepreco = document.getElementById('sobrepreco');

        var desconto = document.getElementById('desconto');

        var orcamento1 = document.form_cadastro.orcamento[0].checked;

        var orcamento2 = document.form_cadastro.orcamento[1].checked;

        var orcamento3 = document.form_cadastro.orcamento[2].checked;

        //var inclui_projeto_sim = document.form_cadastro.projeto[0].checked;

        //var inclui_projeto_nao= document.form_cadastro.projeto[1].checked;



        var erro_form = '0';





        if (orcamento1 == false && orcamento2 == false && orcamento3 == false) {alert('Escolha o Orçamento que deseja Salvar');orcamento.focus();return false;}

        //if (inclui_projeto_sim == false && inclui_projeto_nao == false ) {alert('Escolha se Deseja ou não o Projeto');projeto.focus();return false;}

        if (sobrepreco.value.length < 1) {alert('Sua margem está sem Preencher ');sobrepreco.focus();return false;}



        else{document.form_cadastro.submit();}

    }



    function valida_user(){



        var nome = document.getElementById('nome');

        var user = document.getElementById('user');

        var email = document.getElementById('email');

        var senha = document.getElementById('senha');

        var senha2 = document.getElementById('senha2');

        var idUser = document.getElementById('id_user').value;

        var erro_form = '0';





        if (nome.value.length < 3) {alert('Preencha seu Nome');nome.focus();return false;}

        if (user.value.length < 3) {alert('Preencha seu User Name');user.focus();return false;}

        if (is_email(email.value) == false) {alert('Digite seu E-mail corretamente');email.focus();return false;}

        if (idUser == "" && senha.value.length < 3) {alert('Preencha sua Senha');senha.focus();return false;}

        if (idUser == "" && senha2.value.length < 3) {alert('Repita sua Senha');senha2.focus();return false;}

        if (senha.value != senha2.value) {alert('As Senhas devem ser iguais');senha2.focus();return false;}



        else{document.form_user.submit();}





    }



    function valida_user_unico(){



        var nome = document.getElementById('nome');

        var user = document.getElementById('user');

        var email = document.getElementById('email');

        var senha = document.getElementById('senha');

        var senha2 = document.getElementById('senha2');

        var idUser = document.getElementById('id_user').value;

        var erro_form = '0';





        if (nome.value.length < 3) {alert('Preencha seu Nome');nome.focus();return false;}

        if (user.value.length < 3) {alert('Preencha seu User Name');user.focus();return false;}

        if (is_email(email.value) == false) {alert('Digite seu E-mail corretamente');email.focus();return false;}

        //if (idUser == "" && senha.value.length < 3) {alert('Preencha sua Senha');senha.focus();return false;}

        //if (idUser == "" && senha2.value.length < 3) {alert('Repita sua Senha');senha2.focus();return false;}

        if (senha.value != senha2.value) {alert('As Senhas devem ser iguais');senha2.focus();return false;}



        else{document.form_user.submit();}





    }



    function valida_aula(){



        var nome = document.getElementById('nome');

        var numero = document.getElementById('num_aula');

        var link = document.getElementById('link');

        var erro_form = '0';





        if (nome.value.length < 5) {alert('Preencha o Nome da Aula');nome.focus();return false;}

        if (numero.value.length < 1) {alert('Preencha seu User Name');numero.focus();return false;}

        //if (link.value.length < 10) {alert('Cole o Link da Aula');link.focus();return false;}



        else{document.form_aula.submit();}





    }



    function valida_plano(){



        var valor = document.getElementById('valor');

        var vencimento = document.getElementById('vencimento');



        var erro_form = '0';





        if (valor.value.length < 3) {alert('Preencha o Valor do Curso');valor.focus();return false;}

        if (vencimento.value.length < 10) {alert('Preencha a Validade do Curso');vencimento.focus();return false;}



        else{document.form_plano.submit();}





    }



    function valida_modulo(){



        var nome = document.getElementById('nome');

        var num_modulo = document.getElementById('num_modulo');

        var descricao = document.getElementById('descricao');

        var erro_form = '0';





        if (nome.value.length < 5) {alert('Preencha o Nome do Módulo');nome.focus();return false;}

        if (num_modulo.value.length < 1) {alert('Preencha seu User Name');num_modulo.focus();return false;}

        if (descricao.value.length < 40) {alert('Preencha a Decrição');descricao.focus();return false;}



        else{document.form_modulo.submit();}





    }



    function filtro_pessoa(tipo){

        var tipo = tipo;

        var pesq = document.getElementById('pesq');





        if (tipo == 'pesquisa') {document.getElementById('acao').value="pesquisa"; document.form_pesquisa.submit();}

        if (tipo == 'ativo') {document.getElementById('acao').value="ativo";document.form_pesquisa.submit();}

        if (tipo == 'semplano') {document.getElementById('acao').value="semplano";document.form_pesquisa.submit();}



    }



    function filtro_pergunta(tipo){

        var tipo = tipo;

        var pesq = document.getElementById('pesq');





        if (tipo == 'pesquisa') {document.getElementById('acao').value="pesquisa"; document.form_pesquisa.submit();}

        if (tipo == 'pendente') {document.getElementById('acao').value="pendente";document.form_pesquisa.submit();}

        if (tipo == 'respondido') {document.getElementById('acao').value="respondido";document.form_pesquisa.submit();}



    }



    /*Função Valida Atualização*/

    function valida_atualizacao(){



        var autorizado = document.getElementById('autorizado');

        var empresa = document.getElementById('empresa');

        var email = document.getElementById('email');

        var celular = document.getElementById('celular');

        var login = document.getElementById('login');

        var senha = document.getElementById('senha');

        var senha2 = document.getElementById('senha2');

        var erro_form = '0';





        if (autorizado.value.length < 3) {alert('Preencha seu Nome');autorizado.focus();return false;}

        if (empresa.value.length < 3) {alert('Preencha sua Empresa');empresa.focus();return false;}

        if (is_email(email.value) == false) {alert('Digite seu E-mail corretamente');email.focus();return false;}

        if (login.value.length < 3) {alert('Digite seu Login corretamente');login.focus();return false;}

        if (celular.value.length < 14) {alert('Digite seu Celular corretamente');celular.focus();return false;}

        // (senha.value.length < 3) {alert('Preencha sua Senha');senha.focus();return false;}

        //if (senha2.value.length < 3) {alert('Repita sua Senha');senha2.focus();return false;}

        if (senha.value != senha2.value) {alert('As Senhas devem ser iguais');senha2.focus();return false;}



        else{document.form_cadastro.submit();}





    }



    function valida_cadastro_integrador(){



        var autorizado = document.getElementById('autorizado');

        var empresa = document.getElementById('empresa');

        var email = document.getElementById('email');

        var celular = document.getElementById('celular');

        var login = document.getElementById('login');

        var senha = document.getElementById('senha');

        var senha2 = document.getElementById('senha2');

        var erro_form = '0';





        if (autorizado.value.length < 3) {alert('Preencha seu Nome');autorizado.focus();return false;}

        if (empresa.value.length < 3) {alert('Preencha sua Empresa');empresa.focus();return false;}

        if (is_email(email.value) == false) {alert('Digite seu E-mail corretamente');email.focus();return false;}

        if (login.value.length < 3) {alert('Digite seu Login corretamente');login.focus();return false;}

        if (celular.value.length < 14) {alert('Digite seu Celular corretamente');celular.focus();return false;}

         if (senha.value.length < 3) {alert('Preencha sua Senha');senha.focus();return false;}

        if (senha2.value.length < 3) {alert('Repita sua Senha');senha2.focus();return false;}

        if (senha.value != senha2.value) {alert('As Senhas devem ser iguais');senha2.focus();return false;}



        else{document.form_cadastro.submit();}





    }





    /*Função Valida Resposta*/

    function valida_resposta(){



        var respsota = document.getElementById('resposta');



        var erro_form = '0';

        if (resposta.value.length < 3) {alert('Preencha sua Resposta');resposta.focus();return false;}



        else{document.form_cadastro.submit();}





    }





    /*Função Valida LOGIN*/

    function valida_login(){



        var email = document.getElementById('email');

        var senha = document.getElementById('senha');

        var erro_form = '0';



        if (is_email(email.value) == false) {alert('Digite seu E-mail corretamente');email.focus();return false;}

        if (senha.value.length < 3) {alert('Preencha sua Senha');senha.focus();return false;}



        else{document.form_login.submit();}





    }



    function is_cpf (c) {



      if((c = c.replace(/[^\d]/g,"")).length != 11)

        return false;



      if (c == "00000000000")

        return false;



      var r;

      var s = 0;



      for (i=1; i<=9; i++)

        s = s + parseInt(c[i-1]) * (11 - i);



      r = (s * 10) % 11;



      if ((r == 10) || (r == 11))

        r = 0;



      if (r != parseInt(c[9]))

        return false;



      s = 0;



      for (i = 1; i <= 10; i++)

        s = s + parseInt(c[i-1]) * (12 - i);



      r = (s * 10) % 11;



      if ((r == 10) || (r == 11))

        r = 0;



      if (r != parseInt(c[10]))

        return false;



      return true;

    }



    function is_email(email)

    {

      er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;



      if(er.exec(email))

        {

          return true;

        } else {

          return false;

        }

    }



// function marcarVisto(idPessoa,idAula){



//     new Ajax.Request('adicionar_aula_vista.php',

//     {

//         method: 'GET',

//         parameters:{

//             id_pessoa: idPessoa,

//             id_aula: idAula,



//         },

//         onSuccess: function(transport){

//             document.getElementById('corpoTexto');



//         },



//         onFailure: function(){

//             alert('Não foi possível marcar esta Aula')

//         }

//     });

// }





function is_cnpj(c) {

    var b = [6,5,4,3,2,9,8,7,6,5,4,3,2];



    if((c = c.replace(/[^\d]/g,"")).length != 14)

        return false;



    if(/0{14}/.test(c))

        return false;



    for (var i = 0, n = 0; i < 12; n += c[i] * b[++i]);

    if(c[12] != (((n %= 11) < 2) ? 0 : 11 - n))

        return false;



    for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++]);

    if(c[13] != (((n %= 11) < 2) ? 0 : 11 - n))

        return false;



    return true;

};





function marcarVisto(idPessoa,idAula){

  $.post("adicionar_aula_vista.php", "id_pessoa="+idPessoa+"&id_aula="+idAula+"", function( data ) {

      alert("Aula marcada com sucesso!");

  });

}



function enviarDuvida(idPessoa,idAula){

  var duvida = document.getElementById('duvidas').value;

  $.post("enviar_duvida.php", "id_pessoa="+idPessoa+"&id_aula="+idAula+"&duvida="+duvida+"", function( data ) {

      alert("Pergunta realizada com Sucesso! Responderemos em breve.");

      document.getElementById('duvidas').value = "";

  });

}



function calculaKits(){



            margem = document.getElementById('sobrepreco').value;

            desconto = document.getElementById('desconto').value;



            avancado_inversor = document.getElementById('soma_avancado').value;



            preco = document.getElementById('valor_originalb').value;



            stringbox_ca = document.getElementById('stringbox').value;

            custo_stringbox_saj = document.getElementById('custo_stringbox_saj').value;

            custo_stringbox_growatt = document.getElementById('custo_stringbox_gr').value;

            custo_stringbox_fronius = document.getElementById('custo_stringbox_fr').value;



            //valor_projeto = document.getElementById('valor_projeto').value;



            adicional_growatt = document.getElementById('adicional_growatt').value;

            adicional_fronius = document.getElementById('adicional_fronius').value;

           

            custo_seguro = document.getElementById('custo_seguro').value;



            custo_chapa = document.getElementById('custo_chapa').value;



            custo_engenharia = document.getElementById('custo_engenharia').value;



            valor_solargroup = document.getElementById('valor_solargroup').value;



            valor_estrutura_solo = document.getElementById('valor_estrutura_solo').value;



            valor_aterramento = document.getElementById('valor_aterramento').value;



            porcentagem_franqueado = document.getElementById('porcentagem_franqueado').value;



            kva25 = document.getElementById('kva25').value;

            kva35 = document.getElementById('kva35').value;

            kva75 = document.getElementById('kva75').value;

            kva90 = document.getElementById('kva90').value;











            custo_kva25 = 2320;

            custo_kva35 = 2680;

            custo_kva75 = 4522;

            custo_kva90 = 7145;



            metalico_presilha_lateral       = document.getElementById('metalico_presilha_lateral').value;

            metalico_presilha_superior      = document.getElementById('metalico_presilha_superior').value;

            metalico_trilhos_segmentados    = document.getElementById('metalico_trilhos_segmentados').value;

            ceramico_presilha_lateral       = document.getElementById('ceramico_presilha_lateral').value;

            ceramico_presilha_superior      = document.getElementById('ceramico_presilha_superior').value;

            ceramico_ganchos                = document.getElementById('ceramico_ganchos').value;

            ceramico_perfil_1               = document.getElementById('ceramico_perfil_1').value;

            ceramico_perfil_2               = document.getElementById('ceramico_perfil_2').value;

            ceramico_perfil_3               = document.getElementById('ceramico_perfil_3').value;

            fibro_presilha_lateral          = document.getElementById('fibro_presilha_lateral').value;

            fibro_presilha_superior         = document.getElementById('fibro_presilha_superior').value;

            fibro_haste_L                   = document.getElementById('fibro_haste_L').value;

            fibro_perfil_1                  = document.getElementById('fibro_perfil_1').value;

            fibro_perfil_2                  = document.getElementById('fibro_perfil_2').value;

            fibro_perfil_3                  = document.getElementById('fibro_perfil_3').value;



            valor_metalico_presilha_lateral = document.getElementById('valor_metalico_presilha_lateral').value;

            valor_metalico_presilha_superior = document.getElementById('valor_metalico_presilha_superior').value;

            valor_metalico_trilhos_segmentados = document.getElementById('valor_metalico_trilhos_segmentados').value;

            valor_ceramico_presilha_lateral = document.getElementById('valor_ceramico_presilha_lateral').value;

            valor_ceramico_presilha_superior = document.getElementById('valor_ceramico_presilha_superior').value;

            valor_ceramico_ganchos                = document.getElementById('valor_ceramico_ganchos').value;

            valor_ceramico_perfil_1 = document.getElementById('valor_ceramico_perfil_1').value;

            valor_ceramico_perfil_2 = document.getElementById('valor_ceramico_perfil_2').value;

            valor_ceramico_perfil_3 = document.getElementById('valor_ceramico_perfil_3').value;

            valor_fibro_presilha_lateral = document.getElementById('valor_fibro_presilha_lateral').value;

            valor_fibro_presilha_superior = document.getElementById('valor_fibro_presilha_superior').value;

            valor_fibro_haste_L                   = document.getElementById('valor_fibro_haste_L').value;

            valor_fibro_perfil_1 = document.getElementById('valor_fibro_perfil_1').value;

            valor_fibro_perfil_2 = document.getElementById('valor_fibro_perfil_2').value;

            valor_fibro_perfil_3 = document.getElementById('valor_fibro_perfil_3').value;



            // cabo_preto = parseInt(document.getElementById('cabo_preto').value);

            // cabo_vermelho = parseInt(document.getElementById('cabo_preto').value);

            // cabo_verde = parseInt(document.getElementById('cabo_verde').value);



            // valor_cabo_energia = (cabo_preto+cabo_vermelho)*7.10;

            // valor_cabo_terra = (cabo_verde)*8.98;

            // valor_cabos = (valor_cabo_energia+valor_cabo_terra);



            

            //SEGURO

             if (document.form_cadastro.seguro[0].checked == true && document.form_cadastro.seguro[1].checked == false){

                 soma_seguro = custo_seguro;

             }else{

                 soma_seguro = 0;

             }

             // FIM SEGURO



             //engenharia

             if (document.form_cadastro.engenharia[0].checked == true && document.form_cadastro.engenharia[1].checked == false){

                 soma_engenharia = custo_engenharia;

             }else{

                 soma_engenharia = 0;

            }

            // FIM engenharia



             //soma_engenharia = 0;

             //soma_seguro = 0;



            //PROJETO

            // if (document.form_cadastro.projeto[0].checked == true && document.form_cadastro.projeto[1].checked == false){

            //     soma_projeto = valor_projeto;

            // }else{

                soma_projeto = 0;

            // }

            // //FIM PROJETO







            //INVERSOR

                if (document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == true && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == false){

                        soma_inversor = adicional_growatt;

                    }else if (document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == true && document.form_cadastro.inversor[3].checked == false){

                        soma_inversor = adicional_fronius;

                    }else if(document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == true){

                        soma_inversor = avancado_inversor;

                    }else{

                        soma_inversor = 0;

                    }

                //FIM INVERSOR



                //STRINGBOX

                if (document.form_cadastro.stringbox[0].checked == true && document.form_cadastro.stringbox[1].checked == false){

                    

                    if (document.form_cadastro.inversor[0].checked == true  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == false){

                        soma_stringbox = custo_stringbox_saj;

                    }else if (document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == true && document.form_cadastro.inversor[2].checked == false ){

                        soma_stringbox = custo_stringbox_growatt;

                    }else if (document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == true ){

                        soma_stringbox = custo_stringbox_fronius;

                    }else if(document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == false ){

                        soma_stringbox = custo_stringbox_saj;

                    }else{

                        soma_stringbox = custo_stringbox_saj;

                    }



                }else{

                    soma_stringbox = 0;

                }

                //STRINGBOX



            //chapa

            if (document.form_cadastro.chapa[0].checked == true && document.form_cadastro.chapa[1].checked == false){

                soma_chapa = custo_chapa;

            }else{

                soma_chapa = 0;

            }



                //ESTRUTURA

            if (document.form_cadastro.tipo_estrutura[1].checked == true && document.form_cadastro.tipo_estrutura[2].checked == false){

                soma_estrutura = valor_solargroup;

            }else if (document.form_cadastro.tipo_estrutura[1].checked == false && document.form_cadastro.tipo_estrutura[2].checked == true){

                soma_estrutura = valor_estrutura_solo;

            }else{

                soma_estrutura = 0;

            }

            //FIM ESTRUTURA



            //ATERRAMENTO

            if (document.form_cadastro.aterramento[0].checked == true && document.form_cadastro.aterramento[1].checked == false){

                soma_aterramento = valor_aterramento;



            }else{

                soma_aterramento = 0;



            }

            //FIM ATERRAMENTO



            soma_transformador = (kva25*custo_kva25)+(kva35*custo_kva35)+(kva75*custo_kva75)+(kva90*custo_kva90);



            //ADICIONAIS TELHADO

            soma_adicionais = (metalico_presilha_lateral*valor_metalico_presilha_lateral)+(metalico_presilha_lateral*valor_metalico_presilha_lateral)+(metalico_presilha_superior*valor_metalico_presilha_superior)+(metalico_trilhos_segmentados*valor_metalico_trilhos_segmentados)+(ceramico_presilha_lateral*valor_ceramico_presilha_lateral)+(ceramico_presilha_superior*valor_ceramico_presilha_superior)+(ceramico_perfil_1*valor_ceramico_perfil_1)+(ceramico_perfil_2*valor_ceramico_perfil_2)+(ceramico_perfil_3*valor_ceramico_perfil_3)+(fibro_presilha_lateral*valor_fibro_presilha_lateral)+(fibro_presilha_superior*valor_fibro_presilha_superior)+(fibro_perfil_1*valor_fibro_perfil_1)+(fibro_perfil_2*valor_fibro_perfil_2)+(fibro_perfil_3*valor_fibro_perfil_3)+(fibro_haste_L*valor_fibro_haste_L)+(ceramico_ganchos*valor_ceramico_ganchos);

            //FIM ADICIONAL TELHADO





            //SOMA GERAL

             soma_sistema=(preco*1)+(soma_chapa*1)+(soma_seguro*1)+(soma_engenharia*1)+(soma_projeto*1)+(soma_stringbox*1)+(soma_inversor*1)+(soma_estrutura*1)+(soma_aterramento*1)+(soma_transformador*1)+(soma_adicionais*1);

             

             soma_calculada=soma_sistema-((soma_sistema*desconto)/100)+((soma_sistema*margem)/100);



             soma_franqueado=((preco*porcentagem_franqueado)*1)+(soma_chapa*1)+(soma_seguro*1)+(soma_engenharia*1)+(soma_stringbox*1)+(soma_projeto*1)+(soma_inversor*1)+(soma_estrutura*1)+(soma_aterramento*1)+(soma_transformador*1)+(soma_adicionais*1);

             

             franquia_calculada=soma_franqueado-((soma_franqueado*desconto)/100)+((soma_franqueado*margem)/100);

            

            //RETORNO NOS CAMPOS



            document.getElementById('valor_final').value = soma_calculada.toFixed(2);

            document.getElementById('valor_finald').value = soma_calculada.toFixed(2);



            document.getElementById('valor_original').value = soma_sistema.toFixed(2);

            document.getElementById('valor_originald').value = soma_sistema.toFixed(2);



            //Franqueado

            document.getElementById('valor_franqueadod').value = soma_franqueado.toFixed(2);

            document.getElementById('valor_franqueado').value = soma_franqueado.toFixed(2);



            document.getElementById('valor_franqueado_finald').value = franquia_calculada.toFixed(2);

            document.getElementById('valor_franqueado_final').value = franquia_calculada.toFixed(2);



  }





function calculaGrupoA(){



    margem = document.getElementById('sobrepreco').value;

    desconto = document.getElementById('desconto').value;



    preco01 = document.getElementById('valor_original01b').value;

    preco02 = document.getElementById('valor_original02b').value;

    preco03 = document.getElementById('valor_original03b').value;



    // valor_projeto01 = document.getElementById('valor_projeto01').value;

    // valor_projeto02 = document.getElementById('valor_projeto02').value;

    // valor_projeto03 = document.getElementById('valor_projeto03').value;



    custo_growatt01 = document.getElementById('custo_growatt01').value;

    custo_growatt02 = document.getElementById('custo_growatt02').value;

    custo_growatt03 = document.getElementById('custo_growatt03').value;



    custo_fronius01 = document.getElementById('custo_fronius01').value;

    custo_fronius02 = document.getElementById('custo_fronius02').value;

    custo_fronius03 = document.getElementById('custo_fronius03').value;



    avancado_inversor01 = document.getElementById('soma_inversor01').value;

    avancado_inversor02 = document.getElementById('soma_inversor02').value;

    avancado_inversor03 = document.getElementById('soma_inversor03').value;



    custo_seguro01 = document.getElementById('custo_seguro01').value;

    custo_seguro02 = document.getElementById('custo_seguro02').value;

    custo_seguro03 = document.getElementById('custo_seguro03').value;



    custo_engenharia01 = document.getElementById('custo_engenharia01').value;

    custo_engenharia02 = document.getElementById('custo_engenharia02').value;

    custo_engenharia03 = document.getElementById('custo_engenharia03').value;



    valor_solargroup01 = document.getElementById('valor_solargroup01').value;

    valor_solargroup02 = document.getElementById('valor_solargroup02').value;

    valor_solargroup03 = document.getElementById('valor_solargroup03').value;



    valor_estrutura_solo01 = document.getElementById('valor_estrutura_solo01').value;

    valor_estrutura_solo02 = document.getElementById('valor_estrutura_solo02').value;

    valor_estrutura_solo03 = document.getElementById('valor_estrutura_solo03').value;



    valor_aterramento01 = document.getElementById('valor_aterramento01').value;

    valor_aterramento02 = document.getElementById('valor_aterramento02').value;

    valor_aterramento03 = document.getElementById('valor_aterramento03').value;



    kva25 = document.getElementById('kva25').value;

    kva35 = document.getElementById('kva35').value;

    kva75 = document.getElementById('kva75').value;

    kva90 = document.getElementById('kva90').value;





    custo_chapa01 = document.getElementById('custo_chapa01').value;

    custo_chapa02 = document.getElementById('custo_chapa02').value;

    custo_chapa03 = document.getElementById('custo_chapa03').value;



    conector_mc4                    = document.getElementById('conector_mc4').value;

    emenda                          = document.getElementById('emenda').value;

    prensa_cabo                     = document.getElementById('prensa_cabo').value;



    valor_conector_mc4                    = document.getElementById('valor_conector_mc4').value;

    valor_emenda                          = document.getElementById('valor_emenda').value;

    valor_prensa_cabo                     = document.getElementById('valor_prensa_cabo').value;







    custo_kva25 = 2320;

    custo_kva35 = 2680;

    custo_kva75 = 4522;

    custo_kva90 = 7145;



    metalico_presilha_lateral       = document.getElementById('metalico_presilha_lateral').value;

    metalico_presilha_superior      = document.getElementById('metalico_presilha_superior').value;

    metalico_trilhos_segmentados    = document.getElementById('metalico_trilhos_segmentados').value;

    ceramico_presilha_lateral       = document.getElementById('ceramico_presilha_lateral').value;

    ceramico_presilha_superior      = document.getElementById('ceramico_presilha_superior').value;

    ceramico_ganchos                = document.getElementById('ceramico_ganchos').value;

    ceramico_perfil_1               = document.getElementById('ceramico_perfil_1').value;

    ceramico_perfil_2               = document.getElementById('ceramico_perfil_2').value;

    ceramico_perfil_3               = document.getElementById('ceramico_perfil_3').value;

    fibro_presilha_lateral          = document.getElementById('fibro_presilha_lateral').value;

    fibro_presilha_superior         = document.getElementById('fibro_presilha_superior').value;

    fibro_haste_L                   = document.getElementById('fibro_haste_L').value;

    fibro_perfil_1                  = document.getElementById('fibro_perfil_1').value;

    fibro_perfil_2                  = document.getElementById('fibro_perfil_2').value;

    fibro_perfil_3                  = document.getElementById('fibro_perfil_3').value;



    valor_metalico_presilha_lateral = document.getElementById('valor_metalico_presilha_lateral').value;

    valor_metalico_presilha_superior = document.getElementById('valor_metalico_presilha_superior').value;

    valor_metalico_trilhos_segmentados = document.getElementById('valor_metalico_trilhos_segmentados').value;

    valor_ceramico_presilha_lateral = document.getElementById('valor_ceramico_presilha_lateral').value;

    valor_ceramico_presilha_superior = document.getElementById('valor_ceramico_presilha_superior').value;

    valor_ceramico_ganchos                = document.getElementById('valor_ceramico_ganchos').value;

    valor_ceramico_perfil_1 = document.getElementById('valor_ceramico_perfil_1').value;

    valor_ceramico_perfil_2 = document.getElementById('valor_ceramico_perfil_2').value;

    valor_ceramico_perfil_3 = document.getElementById('valor_ceramico_perfil_3').value;

    valor_fibro_presilha_lateral = document.getElementById('valor_fibro_presilha_lateral').value;

    valor_fibro_presilha_superior = document.getElementById('valor_fibro_presilha_superior').value;

    valor_fibro_haste_L                   = document.getElementById('valor_fibro_haste_L').value;

    valor_fibro_perfil_1 = document.getElementById('valor_fibro_perfil_1').value;

    valor_fibro_perfil_2 = document.getElementById('valor_fibro_perfil_2').value;

    valor_fibro_perfil_3 = document.getElementById('valor_fibro_perfil_3').value;





    document.getElementById('cabo_vermelho').value = document.getElementById('cabo_preto').value;



    cabo_preto = parseInt(document.getElementById('cabo_preto').value);

    cabo_vermelho = parseInt(document.getElementById('cabo_preto').value);

    cabo_verde = parseInt(document.getElementById('cabo_verde').value);



    valor_cabo_energia = (cabo_preto+cabo_vermelho)*7.10;

    valor_cabo_terra = (cabo_verde)*8.98;

    valor_cabos = (valor_cabo_energia+valor_cabo_terra);



    if (desconto > 5){

        document.getElementById('desconto').value=5;

    }



    //SEGURO

     if (document.form_cadastro.seguro[0].checked == true && document.form_cadastro.seguro[1].checked == false){

         soma_seguro01 = custo_seguro01;

         soma_seguro02 = custo_seguro02;

         soma_seguro03 = custo_seguro03;

     }else{

         soma_seguro01 = 0;

         soma_seguro02 = 0;

         soma_seguro03 = 0;

     }

     // FIM SEGURO



     //chapa

     if (document.form_cadastro.chapa[0].checked == true && document.form_cadastro.chapa[1].checked == false){

         soma_chapa01 = custo_chapa01;

         soma_chapa02 = custo_chapa02;

         soma_chapa03 = custo_chapa03;

     }else{

         soma_chapa01 = 0;

         soma_chapa02 = 0;

         soma_chapa03 = 0;

     }



     //ENGENHARIA

     if (document.form_cadastro.engenharia[0].checked == true && document.form_cadastro.engenharia[1].checked == false){

         soma_engenharia01 = custo_engenharia01;

         soma_engenharia02 = custo_engenharia02;

         soma_engenharia03 = custo_engenharia03;

     }else{

         soma_engenharia01 = 0;

         soma_engenharia02 = 0;

         soma_engenharia03 = 0;

     }

     // FIM ENGENHARIA



    //soma_seguro01 = 0;

    //soma_seguro02 = 0;

    //soma_seguro03 = 0;



    // soma_engenharia01 = 0;

        // soma_engenharia02 = 0;

        // soma_engenharia03 = 0;



    //PROJETO

    // if (document.form_cadastro.projeto[0].checked == true && document.form_cadastro.projeto[1].checked == false){

    //     soma_projeto01 = valor_projeto01;

    //     soma_projeto02 = valor_projeto02;

    //     soma_projeto03 = valor_projeto03;

    // }else{

         soma_projeto01 = 0;

         soma_projeto02 = 0;

         soma_projeto03 = 0;

    // }

    //FIM PROJETO



    //INVERSOR

    if (document.form_cadastro.inversor[0].checked == false && document.form_cadastro.inversor[1].checked == true  && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == false){

        soma_inversor01 = custo_growatt01;

        soma_inversor02 = custo_growatt02;

        soma_inversor03 = custo_growatt03;

    }else if (document.form_cadastro.inversor[0].checked == false && document.form_cadastro.inversor[1].checked == false  && document.form_cadastro.inversor[2].checked == true && document.form_cadastro.inversor[3].checked == false){

        soma_inversor01 = custo_fronius01;

        soma_inversor02 = custo_fronius02;

        soma_inversor03 = custo_fronius03;

    }else if(document.form_cadastro.inversor[0].checked == false && document.form_cadastro.inversor[1].checked == false  && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == true){

        soma_inversor01 = avancado_inversor01;

        soma_inversor02 = avancado_inversor02;

        soma_inversor03 = avancado_inversor03;

    }else{

        soma_inversor01 = 0;

        soma_inversor02 = 0;

        soma_inversor03 = 0;

    }

    //FIM INVERSOR



        //ESTRUTURA

    if (document.form_cadastro.tipo_estrutura[1].checked == true && document.form_cadastro.tipo_estrutura[2].checked == false){

        soma_estrutura01 = valor_solargroup01;

        soma_estrutura02 = valor_solargroup02;

        soma_estrutura03 = valor_solargroup03;

    }else if (document.form_cadastro.tipo_estrutura[1].checked == false && document.form_cadastro.tipo_estrutura[2].checked == true){

        soma_estrutura01 = valor_estrutura_solo01;

        soma_estrutura02 = valor_estrutura_solo02;

        soma_estrutura03 = valor_estrutura_solo03;

    }else{

        soma_estrutura01 = 0;

        soma_estrutura02 = 0;

        soma_estrutura03 = 0;

    }

    //FIM ESTRUTURA



    //ATERRAMENTO

    if (document.form_cadastro.aterramento[0].checked == true && document.form_cadastro.aterramento[1].checked == false){

        soma_aterramento01 = valor_aterramento01;

        soma_aterramento02 = valor_aterramento02;

        soma_aterramento03 = valor_aterramento03;

    }else{

        soma_aterramento01 = 0;

        soma_aterramento02 = 0;

        soma_aterramento03 = 0;

    }

    //FIM ATERRAMENTO



    //TRANSFORMADOR

    soma_transformador = (kva25*custo_kva25)+(kva35*custo_kva35)+(kva75*custo_kva75)+(kva90*custo_kva90);

    //FIM TRANSFORMADOR



    //ADICIONAIS TELHADO

    soma_adicionais = (metalico_presilha_lateral*valor_metalico_presilha_lateral)+(metalico_presilha_lateral*valor_metalico_presilha_lateral)+(metalico_presilha_superior*valor_metalico_presilha_superior)+(metalico_trilhos_segmentados*valor_metalico_trilhos_segmentados)+(ceramico_presilha_lateral*valor_ceramico_presilha_lateral)+(ceramico_presilha_superior*valor_ceramico_presilha_superior)+(ceramico_perfil_1*valor_ceramico_perfil_1)+(ceramico_perfil_2*valor_ceramico_perfil_2)+(ceramico_perfil_3*valor_ceramico_perfil_3)+(fibro_presilha_lateral*valor_fibro_presilha_lateral)+(fibro_presilha_superior*valor_fibro_presilha_superior)+(fibro_perfil_1*valor_fibro_perfil_1)+(fibro_perfil_2*valor_fibro_perfil_2)+(fibro_perfil_3*valor_fibro_perfil_3)+(fibro_haste_L*valor_fibro_haste_L)+(ceramico_ganchos*valor_ceramico_ganchos)+(conector_mc4*valor_conector_mc4)+(emenda*valor_emenda)+(prensa_cabo*valor_prensa_cabo);

    //FIM ADICIONAL TELHADO









    //SOMA GERAL

     soma_sistema01=(preco01*1)+(soma_chapa01*1)+(soma_seguro01*1)+(soma_engenharia01*1)+(soma_projeto01*1)+(soma_inversor01*1)+(soma_estrutura01*1)+(soma_aterramento01*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1);

     soma_sistema02=(preco02*1)+(soma_chapa02*1)+(soma_seguro02*1)+(soma_engenharia02*1)+(soma_projeto02*1)+(soma_inversor02*1)+(soma_estrutura02*1)+(soma_aterramento02*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1);

     soma_sistema03=(preco03*1)+(soma_chapa03*1)+(soma_seguro03*1)+(soma_engenharia03*1)+(soma_projeto03*1)+(soma_inversor03*1)+(soma_estrutura03*1)+(soma_aterramento03*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1);



     soma_sistema01=soma_sistema01-((soma_sistema01*desconto)/100);

     soma_sistema02=soma_sistema02-((soma_sistema02*desconto)/100);

     soma_sistema03=soma_sistema03-((soma_sistema03*desconto)/100);



     soma_calculada01=soma_sistema01+((soma_sistema01*margem)/100);

     soma_calculada02=soma_sistema02+((soma_sistema02*margem)/100);

     soma_calculada03=soma_sistema03+((soma_sistema03*margem)/100);



     soma_franqueado01=((preco01-(preco01*0.04))*1)+(soma_chapa01*1)+(soma_seguro01*1)+(soma_engenharia01*1)+(soma_projeto01*1)+(soma_inversor01*1)+(soma_estrutura01*1)+(soma_aterramento01*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1);

     soma_franqueado02=((preco02-(preco02*0.04))*1)+(soma_chapa02*1)+(soma_seguro02*1)+(soma_engenharia02*1)+(soma_projeto02*1)+(soma_inversor02*1)+(soma_estrutura02*1)+(soma_aterramento02*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1);

     soma_franqueado03=((preco03-(preco03*0.04))*1)+(soma_chapa03*1)+(soma_seguro03*1)+(soma_engenharia03*1)+(soma_projeto03*1)+(soma_inversor03*1)+(soma_estrutura03*1)+(soma_aterramento03*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1);



     franquia_calculada01=soma_franqueado01-((soma_franqueado01*desconto)/100)+((soma_franqueado01*margem)/100);

     franquia_calculada02=soma_franqueado02-((soma_franqueado02*desconto)/100)+((soma_franqueado02*margem)/100);

     franquia_calculada03=soma_franqueado03-((soma_franqueado03*desconto)/100)+((soma_franqueado03*margem)/100);



    //RETORNO NOS CAMPOS



    document.getElementById('valor_final01').value = soma_calculada01.toFixed(2);

    document.getElementById('valor_final01d').value = soma_calculada01.toFixed(2);



    document.getElementById('valor_original01').value = soma_sistema01.toFixed(2);

    document.getElementById('valor_original01d').value = soma_sistema01.toFixed(2);



    document.getElementById('valor_final02').value = soma_calculada02.toFixed(2);

    document.getElementById('valor_final02d').value = soma_calculada02.toFixed(2);



    document.getElementById('valor_original02').value = soma_sistema02.toFixed(2);

    document.getElementById('valor_original02d').value = soma_sistema02.toFixed(2);



    document.getElementById('valor_final03').value = soma_calculada03.toFixed(2);

    document.getElementById('valor_final03d').value = soma_calculada03.toFixed(2);



    document.getElementById('valor_original03').value = soma_sistema03.toFixed(2);

    document.getElementById('valor_original03d').value = soma_sistema03.toFixed(2);



    //Franqueado

    document.getElementById('valor_franqueado01d').value = soma_franqueado01.toFixed(2);

    document.getElementById('valor_franqueado01').value = soma_franqueado01.toFixed(2);



    document.getElementById('valor_franqueado_final01d').value = franquia_calculada01.toFixed(2);

    document.getElementById('valor_franqueado_final01').value = franquia_calculada01.toFixed(2);



    document.getElementById('valor_franqueado02d').value = soma_franqueado02.toFixed(2);

    document.getElementById('valor_franqueado02').value = soma_franqueado02.toFixed(2);



    document.getElementById('valor_franqueado_final02d').value = franquia_calculada02.toFixed(2);

    document.getElementById('valor_franqueado_final02').value = franquia_calculada02.toFixed(2);



    document.getElementById('valor_franqueado03d').value = soma_franqueado03.toFixed(2);

    document.getElementById('valor_franqueado03').value = soma_franqueado03.toFixed(2);



    document.getElementById('valor_franqueado_final03d').value = franquia_calculada03.toFixed(2);

    document.getElementById('valor_franqueado_final03').value = franquia_calculada03.toFixed(2);



}



function calculaGrupoB(){



    margem = document.getElementById('sobrepreco').value;

    desconto = document.getElementById('desconto').value;



    preco = document.getElementById('valor_originalb').value;



    valor_projeto = document.getElementById('valor_projeto').value;



    avancado_inversor = document.getElementById('soma_avancado').value;

    adicional_growatt = document.getElementById('adicional_growatt').value;

    adicional_fronius = document.getElementById('adicional_fronius').value;



    stringbox_ca = document.getElementById('stringbox').value;

    custo_stringbox_saj = document.getElementById('custo_stringbox_saj').value;

    custo_stringbox_growatt = document.getElementById('custo_stringbox_gr').value;

    custo_stringbox_fronius = document.getElementById('custo_stringbox_fr').value;





    custo_seguro = document.getElementById('custo_seguro').value;

    custo_engenharia = document.getElementById('custo_engenharia').value;



    valor_solargroup = document.getElementById('valor_solargroup').value;



    valor_estrutura_solo = document.getElementById('valor_estrutura_solo').value;

    //valor_estrutura_solo_fotofix = document.getElementById('valor_estrutura_solo_fotofix').value;



    valor_aterramento = document.getElementById('valor_aterramento').value;



    porcentagem_franqueado = document.getElementById('porcentagem_franqueado').value;



    custo_chapa = document.getElementById('custo_chapa').value;



    kva25 = document.getElementById('kva25').value;

    kva35 = document.getElementById('kva35').value;

    kva75 = document.getElementById('kva75').value;

    kva90 = document.getElementById('kva90').value;



    conector_mc4                    = document.getElementById('conector_mc4').value;

    emenda                          = document.getElementById('emenda').value;

    prensa_cabo                     = document.getElementById('prensa_cabo').value;



    valor_conector_mc4                    = document.getElementById('valor_conector_mc4').value;

    valor_emenda                          = document.getElementById('valor_emenda').value;

    valor_prensa_cabo                     = document.getElementById('valor_prensa_cabo').value;



    custo_kva25 = 2320;

    custo_kva35 = 2680;

    custo_kva75 = 4522;

    custo_kva90 = 7145;



    metalico_presilha_lateral       = document.getElementById('metalico_presilha_lateral').value;

    metalico_presilha_superior      = document.getElementById('metalico_presilha_superior').value;

    metalico_trilhos_segmentados    = document.getElementById('metalico_trilhos_segmentados').value;

    ceramico_presilha_lateral       = document.getElementById('ceramico_presilha_lateral').value;

    ceramico_presilha_superior      = document.getElementById('ceramico_presilha_superior').value;

    ceramico_ganchos                = document.getElementById('ceramico_ganchos').value;

    ceramico_perfil_1               = document.getElementById('ceramico_perfil_1').value;

    ceramico_perfil_2               = document.getElementById('ceramico_perfil_2').value;

    ceramico_perfil_3               = document.getElementById('ceramico_perfil_3').value;

    fibro_presilha_lateral          = document.getElementById('fibro_presilha_lateral').value;

    fibro_presilha_superior         = document.getElementById('fibro_presilha_superior').value;

    fibro_haste_L                   = document.getElementById('fibro_haste_L').value;

    fibro_perfil_1                  = document.getElementById('fibro_perfil_1').value;

    fibro_perfil_2                  = document.getElementById('fibro_perfil_2').value;

    fibro_perfil_3                  = document.getElementById('fibro_perfil_3').value;



  

    valor_metalico_presilha_lateral = document.getElementById('valor_metalico_presilha_lateral').value;

    valor_metalico_presilha_superior = document.getElementById('valor_metalico_presilha_superior').value;

    valor_metalico_trilhos_segmentados = document.getElementById('valor_metalico_trilhos_segmentados').value;

    valor_ceramico_presilha_lateral = document.getElementById('valor_ceramico_presilha_lateral').value;

    valor_ceramico_presilha_superior = document.getElementById('valor_ceramico_presilha_superior').value;

    valor_ceramico_ganchos                = document.getElementById('valor_ceramico_ganchos').value;

    valor_ceramico_perfil_1 = document.getElementById('valor_ceramico_perfil_1').value;

    valor_ceramico_perfil_2 = document.getElementById('valor_ceramico_perfil_2').value;

    valor_ceramico_perfil_3 = document.getElementById('valor_ceramico_perfil_3').value;

    valor_fibro_presilha_lateral = document.getElementById('valor_fibro_presilha_lateral').value;

    valor_fibro_presilha_superior = document.getElementById('valor_fibro_presilha_superior').value;

    valor_fibro_haste_L                   = document.getElementById('valor_fibro_haste_L').value;

    valor_fibro_perfil_1 = document.getElementById('valor_fibro_perfil_1').value;

    valor_fibro_perfil_2 = document.getElementById('valor_fibro_perfil_2').value;

    valor_fibro_perfil_3 = document.getElementById('valor_fibro_perfil_3').value;





    document.getElementById('cabo_vermelho').value = document.getElementById('cabo_preto').value;



    cabo_preto = parseInt(document.getElementById('cabo_preto').value);

    cabo_vermelho = parseInt(document.getElementById('cabo_preto').value);

    cabo_verde = parseInt(document.getElementById('cabo_verde').value);



    valor_cabo_energia = (cabo_preto+cabo_vermelho)*7.10;

    valor_cabo_terra = (cabo_verde)*8.98;

    valor_cabos = (valor_cabo_energia+valor_cabo_terra);



    if (desconto > 5){

        document.getElementById('desconto').value=5;

    }



     //SEGURO

     if (document.form_cadastro.seguro[0].checked == true && document.form_cadastro.seguro[1].checked == false){

         soma_seguro = custo_seguro;

     }else{

         soma_seguro = 0;

     }

     // FIM SEGURO



     //engenharia

     if (document.form_cadastro.engenharia[0].checked == true && document.form_cadastro.engenharia[1].checked == false){

         soma_engenharia = custo_engenharia;

     }else{

         soma_engenharia = 0;

     }



     //chapa

     if (document.form_cadastro.chapa[0].checked == true && document.form_cadastro.chapa[1].checked == false){

         soma_chapa = custo_chapa;

     }else{

         soma_chapa = 0;

     }

     // FIM engenharia



    // soma_seguro = 0;

    // soma_engenharia = 0;



    //PROJETO

     // if (document.form_cadastro.projeto[0].checked == true && document.form_cadastro.projeto[1].checked == false){

     //     soma_projeto = valor_projeto;

     // }else{

          soma_projeto = 0;

     // }

    //FIM PROJETO



    //STRINGBOX

    if (document.form_cadastro.stringbox[0].checked == true && document.form_cadastro.stringbox[1].checked == false){

        

        if (document.form_cadastro.inversor[0].checked == true  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == false){

            soma_stringbox = custo_stringbox_saj;

        }else if (document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == true && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == false){

            soma_stringbox = custo_stringbox_growatt;

        }else if (document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == true && document.form_cadastro.inversor[3].checked == false){

            soma_stringbox = custo_stringbox_fronius;

        }else if(document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == true){

            soma_stringbox = custo_stringbox_saj;

        }else{

            soma_stringbox = custo_stringbox_saj;

        }



    }else{

        soma_stringbox = 0;

    }

    //STRINGBOX



    //INVERSOR

    if (document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == true && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == false){

        soma_inversor = adicional_growatt;

    }else if (document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == true && document.form_cadastro.inversor[3].checked == false){

        soma_inversor = adicional_fronius;

    }else if(document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == true){

        soma_inversor = avancado_inversor;

    }else{

        soma_inversor = 0;

    }

    //FIM INVERSOR



        //ESTRUTURA

    if (document.form_cadastro.tipo_estrutura[1].checked == true && document.form_cadastro.tipo_estrutura[2].checked == false){

        soma_estrutura = valor_solargroup;

    }else if (document.form_cadastro.tipo_estrutura[1].checked == false && document.form_cadastro.tipo_estrutura[2].checked == true){

        soma_estrutura = valor_estrutura_solo;

    // }else if (document.form_cadastro.tipo_estrutura[1].checked == false && document.form_cadastro.tipo_estrutura[2].checked == false && document.form_cadastro.tipo_estrutura[3].checked == true){

    //     soma_estrutura = valor_estrutura_solo_fotofix;

    }else{

        soma_estrutura = 0;

    }

    //FIM ESTRUTURA



    //ATERRAMENTO

    if (document.form_cadastro.aterramento[0].checked == true && document.form_cadastro.aterramento[1].checked == false){

        soma_aterramento = valor_aterramento;



    }else{

        soma_aterramento = 0;



    }

    //FIM ATERRAMENTO



    //TRANSFORMADOR

    soma_transformador = (kva25*custo_kva25)+(kva35*custo_kva35)+(kva75*custo_kva75)+(kva90*custo_kva90);

    //FIM TRANSFORMADOR



    //ADICIONAIS TELHADO

    soma_adicionais = (metalico_presilha_lateral*valor_metalico_presilha_lateral)+(metalico_presilha_lateral*valor_metalico_presilha_lateral)+(metalico_presilha_superior*valor_metalico_presilha_superior)+(metalico_trilhos_segmentados*valor_metalico_trilhos_segmentados)+(ceramico_presilha_lateral*valor_ceramico_presilha_lateral)+(ceramico_presilha_superior*valor_ceramico_presilha_superior)+(ceramico_perfil_1*valor_ceramico_perfil_1)+(ceramico_perfil_2*valor_ceramico_perfil_2)+(ceramico_perfil_3*valor_ceramico_perfil_3)+(fibro_presilha_lateral*valor_fibro_presilha_lateral)+(fibro_presilha_superior*valor_fibro_presilha_superior)+(fibro_perfil_1*valor_fibro_perfil_1)+(fibro_perfil_2*valor_fibro_perfil_2)+(fibro_perfil_3*valor_fibro_perfil_3)+(fibro_haste_L*valor_fibro_haste_L)+(ceramico_ganchos*valor_ceramico_ganchos)+(conector_mc4*valor_conector_mc4)+(emenda*valor_emenda)+(prensa_cabo*valor_prensa_cabo);

    //FIM ADICIONAL TELHADO





    //SOMA GERAL

     soma_sistema=(preco*1)+(soma_seguro*1)+(soma_chapa*1)+(soma_engenharia*1)+(soma_stringbox*1)+(soma_projeto*1)+(soma_inversor*1)+(soma_estrutura*1)+(soma_aterramento*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1);



     soma_sistema = (soma_sistema-((soma_sistema*desconto)/100))*1;

     

     soma_calculada=soma_sistema+((soma_sistema*margem)/100);



     soma_franqueado=((preco*porcentagem_franqueado)*1)+(soma_chapa*1)+(soma_engenharia*1)+(soma_stringbox*1)+(soma_seguro*1)+(soma_projeto*1)+(soma_inversor*1)+(soma_estrutura*1)+(soma_aterramento*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1);

     

     franquia_calculada=soma_franqueado-((soma_franqueado*desconto)/100)+((soma_franqueado*margem)/100);

    

    //RETORNO NOS CAMPOS



    document.getElementById('valor_final').value = soma_calculada.toFixed(2);

    document.getElementById('valor_finald').value = soma_calculada.toFixed(2);



    document.getElementById('valor_original').value = soma_sistema.toFixed(2);

    document.getElementById('valor_originald').value = soma_sistema.toFixed(2);



    //Franqueado

    document.getElementById('valor_franqueadod').value = soma_franqueado.toFixed(2);

    document.getElementById('valor_franqueado').value = soma_franqueado.toFixed(2);



    document.getElementById('valor_franqueado_finald').value = franquia_calculada.toFixed(2);

    document.getElementById('valor_franqueado_final').value = franquia_calculada.toFixed(2);



}





function calculaAlteraB(){



    margem = document.getElementById('sobrepreco').value;

    desconto = 0;//document.getElementById('desconto').value;



    preco = document.getElementById('valor_originalb').value;



    //valor_projeto = document.getElementById('valor_projeto').value;



    avancado_inversor = document.getElementById('soma_avancado').value;

    adicional_growatt = document.getElementById('adicional_growatt').value;

    adicional_fronius = document.getElementById('adicional_fronius').value;



    adicional_painel = document.getElementById('valor_painel_adicional').value;

    paineis_adicionais = document.getElementById('paineis_adicionais').value;



    stringbox_ca = document.getElementById('stringbox').value;

    custo_stringbox_saj = document.getElementById('custo_stringbox_saj').value;

    custo_stringbox_growatt = document.getElementById('custo_stringbox_gr').value;

    custo_stringbox_fronius = document.getElementById('custo_stringbox_fr').value;









    custo_seguro = document.getElementById('custo_seguro').value;

    custo_engenharia = document.getElementById('custo_engenharia').value;



    valor_solargroup = document.getElementById('valor_solargroup').value;



    valor_estrutura_solo = document.getElementById('valor_estrutura_solo').value;

    //valor_estrutura_solo_fotofix = document.getElementById('valor_estrutura_solo_fotofix').value;



    valor_aterramento = document.getElementById('valor_aterramento').value;



    porcentagem_franqueado = document.getElementById('porcentagem_franqueado').value;



    custo_chapa = document.getElementById('custo_chapa').value;



    kva25 = document.getElementById('kva25').value;

    kva35 = document.getElementById('kva35').value;

    kva75 = document.getElementById('kva75').value;

    kva90 = document.getElementById('kva90').value;



    custo_kva25 = 2320;

    custo_kva35 = 2680;

    custo_kva75 = 4522;

    custo_kva90 = 7145;



    metalico_presilha_lateral       = document.getElementById('metalico_presilha_lateral').value;

    metalico_presilha_superior      = document.getElementById('metalico_presilha_superior').value;

    metalico_trilhos_segmentados    = document.getElementById('metalico_trilhos_segmentados').value;

    ceramico_presilha_lateral       = document.getElementById('ceramico_presilha_lateral').value;

    ceramico_presilha_superior      = document.getElementById('ceramico_presilha_superior').value;

    ceramico_ganchos                = document.getElementById('ceramico_ganchos').value;

    ceramico_perfil_1               = document.getElementById('ceramico_perfil_1').value;

    ceramico_perfil_2               = document.getElementById('ceramico_perfil_2').value;

    ceramico_perfil_3               = document.getElementById('ceramico_perfil_3').value;

    fibro_presilha_lateral          = document.getElementById('fibro_presilha_lateral').value;

    fibro_presilha_superior         = document.getElementById('fibro_presilha_superior').value;

    fibro_haste_L                   = document.getElementById('fibro_haste_L').value;

    fibro_perfil_1                  = document.getElementById('fibro_perfil_1').value;

    fibro_perfil_2                  = document.getElementById('fibro_perfil_2').value;

    fibro_perfil_3                  = document.getElementById('fibro_perfil_3').value;



    conector_mc4                    = document.getElementById('conector_mc4').value;

    emenda                          = document.getElementById('emenda').value;

    prensa_cabo                     = document.getElementById('prensa_cabo').value;



    valor_conector_mc4                    = document.getElementById('valor_conector_mc4').value;

    valor_emenda                          = document.getElementById('valor_emenda').value;

    valor_prensa_cabo                     = document.getElementById('valor_prensa_cabo').value;



    valor_metalico_presilha_lateral = document.getElementById('valor_metalico_presilha_lateral').value;

    valor_metalico_presilha_superior = document.getElementById('valor_metalico_presilha_superior').value;

    valor_metalico_trilhos_segmentados = document.getElementById('valor_metalico_trilhos_segmentados').value;

    valor_ceramico_presilha_lateral = document.getElementById('valor_ceramico_presilha_lateral').value;

    valor_ceramico_presilha_superior = document.getElementById('valor_ceramico_presilha_superior').value;

    valor_ceramico_ganchos                = document.getElementById('valor_ceramico_ganchos').value;

    valor_ceramico_perfil_1 = document.getElementById('valor_ceramico_perfil_1').value;

    valor_ceramico_perfil_2 = document.getElementById('valor_ceramico_perfil_2').value;

    valor_ceramico_perfil_3 = document.getElementById('valor_ceramico_perfil_3').value;

    valor_fibro_presilha_lateral = document.getElementById('valor_fibro_presilha_lateral').value;

    valor_fibro_presilha_superior = document.getElementById('valor_fibro_presilha_superior').value;

    valor_fibro_haste_L                   = document.getElementById('valor_fibro_haste_L').value;

    valor_fibro_perfil_1 = document.getElementById('valor_fibro_perfil_1').value;

    valor_fibro_perfil_2 = document.getElementById('valor_fibro_perfil_2').value;

    valor_fibro_perfil_3 = document.getElementById('valor_fibro_perfil_3').value;





    document.getElementById('cabo_vermelho').value = document.getElementById('cabo_preto').value;



    cabo_preto = parseInt(document.getElementById('cabo_preto').value);

    cabo_vermelho = parseInt(document.getElementById('cabo_preto').value);

    cabo_verde = parseInt(document.getElementById('cabo_verde').value);



    valor_cabo_energia = (cabo_preto+cabo_vermelho)*7.10;

    valor_cabo_terra = (cabo_verde)*8.98;

    valor_cabos = (valor_cabo_energia+valor_cabo_terra);



     //SEGURO

     if (document.form_cadastro.seguro[0].checked == true && document.form_cadastro.seguro[1].checked == false){

         soma_seguro = custo_seguro;

     }else{

         soma_seguro = 0;

     }

     // FIM SEGURO



     //engenharia

     if (document.form_cadastro.engenharia[0].checked == true && document.form_cadastro.engenharia[1].checked == false){

         soma_engenharia = custo_engenharia;

     }else{

         soma_engenharia = 0;

     }





     //chapa

     if (document.form_cadastro.chapa[0].checked == true && document.form_cadastro.chapa[1].checked == false){

         soma_chapa = custo_chapa;

     }else{

         soma_chapa = 0;

     }

     // FIM engenharia



    // soma_seguro = 0;

    // soma_engenharia = 0;



    //PROJETO

    // if (document.form_cadastro.projeto[0].checked == true && document.form_cadastro.projeto[1].checked == false){

    //     soma_projeto = valor_projeto;

    // }else{

         soma_projeto = 0;

    // }

    //FIM PROJETO



    //INVERSOR

    if (document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == true && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == false){

        soma_inversor = adicional_growatt;

    }else if (document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == true && document.form_cadastro.inversor[3].checked == false){

        soma_inversor = adicional_fronius;

    }else if(document.form_cadastro.inversor[0].checked == false  && document.form_cadastro.inversor[1].checked == false && document.form_cadastro.inversor[2].checked == false && document.form_cadastro.inversor[3].checked == true){

        soma_inversor = avancado_inversor;

    }else{

        soma_inversor = 0;

    }

    //FIM INVERSOR



        //ESTRUTURA

    if (document.form_cadastro.tipo_estrutura[1].checked == true && document.form_cadastro.tipo_estrutura[2].checked == false){

        soma_estrutura = valor_solargroup;

    }else if (document.form_cadastro.tipo_estrutura[1].checked == false && document.form_cadastro.tipo_estrutura[2].checked == true){

        soma_estrutura = valor_estrutura_solo;

    // }else if (document.form_cadastro.tipo_estrutura[1].checked == false && document.form_cadastro.tipo_estrutura[2].checked == false && document.form_cadastro.tipo_estrutura[3].checked == true){

    //     soma_estrutura = valor_estrutura_solo_fotofix;

    }else{

        soma_estrutura = 0;

    }

    //FIM ESTRUTURA



    //ATERRAMENTO

    if (document.form_cadastro.aterramento[0].checked == true && document.form_cadastro.aterramento[1].checked == false){

        soma_aterramento = valor_aterramento;



    }else{

        soma_aterramento = 0;



    }

    //FIM ATERRAMENTO



    //TRANSFORMADOR

    soma_transformador = (kva25*custo_kva25)+(kva35*custo_kva35)+(kva75*custo_kva75)+(kva90*custo_kva90);

    //FIM TRANSFORMADOR



    //SOMA PAINEIS

    soma_paineis = adicional_painel*paineis_adicionais;

    //FIM TRANSFORMADOR



    //ADICIONAIS TELHADO

    soma_adicionais = (metalico_presilha_lateral*valor_metalico_presilha_lateral)+(metalico_presilha_lateral*valor_metalico_presilha_lateral)+(metalico_presilha_superior*valor_metalico_presilha_superior)+(metalico_trilhos_segmentados*valor_metalico_trilhos_segmentados)+(ceramico_presilha_lateral*valor_ceramico_presilha_lateral)+(ceramico_presilha_superior*valor_ceramico_presilha_superior)+(ceramico_perfil_1*valor_ceramico_perfil_1)+(ceramico_perfil_2*valor_ceramico_perfil_2)+(ceramico_perfil_3*valor_ceramico_perfil_3)+(fibro_presilha_lateral*valor_fibro_presilha_lateral)+(fibro_presilha_superior*valor_fibro_presilha_superior)+(fibro_perfil_1*valor_fibro_perfil_1)+(fibro_perfil_2*valor_fibro_perfil_2)+(fibro_perfil_3*valor_fibro_perfil_3)+(fibro_haste_L*valor_fibro_haste_L)+(ceramico_ganchos*valor_ceramico_ganchos)+(conector_mc4*valor_conector_mc4)+(emenda*valor_emenda)+(prensa_cabo*valor_prensa_cabo);

    //FIM ADICIONAL TELHADO





    //SOMA GERAL

     soma_sistema=(preco*1)+(soma_seguro*1)+(soma_chapa*1)+(soma_engenharia*1)+(soma_projeto*1)+(soma_inversor*1)+(soma_estrutura*1)+(soma_aterramento*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1)+(soma_paineis*1);

     

     soma_calculada=soma_sistema-((soma_sistema*desconto)/100)+((soma_sistema*margem)/100);



     soma_franqueado=((preco*porcentagem_franqueado)*1)+(soma_chapa*1)+(soma_engenharia*1)+(soma_seguro*1)+(soma_projeto*1)+(soma_inversor*1)+(soma_estrutura*1)+(soma_aterramento*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1)+(soma_paineis*1);

     

     franquia_calculada=soma_franqueado-((soma_franqueado*desconto)/100)+((soma_franqueado*margem)/100);

    

    //RETORNO NOS CAMPOS



    document.getElementById('valor_final').value = soma_calculada.toFixed(2);

    document.getElementById('valor_finald').value = soma_calculada.toFixed(2);



    document.getElementById('valor_original').value = soma_sistema.toFixed(2);

    document.getElementById('valor_originald').value = soma_sistema.toFixed(2);



    //Franqueado

    document.getElementById('valor_franqueadod').value = soma_franqueado.toFixed(2);

    document.getElementById('valor_franqueado').value = soma_franqueado.toFixed(2);



    document.getElementById('valor_franqueado_finald').value = franquia_calculada.toFixed(2);

    document.getElementById('valor_franqueado_final').value = franquia_calculada.toFixed(2);



}



function calculaAvulso(){



    preco = document.getElementById('valor_original').value;



    avancado_inversor = document.getElementById('soma_avancado').value;



    //valor_estrutura_solo_fotofix = document.getElementById('valor_estrutura_solo_fotofix').value;



    custo_chapa = document.getElementById('custo_chapa').value;



    kva25 = document.getElementById('kva25').value;

    kva35 = document.getElementById('kva35').value;

    kva75 = document.getElementById('kva75').value;

    kva90 = document.getElementById('kva90').value;



    conector_mc4                    = document.getElementById('conector_mc4').value;

    emenda                          = document.getElementById('emenda').value;

    prensa_cabo                     = document.getElementById('prensa_cabo').value;



    valor_conector_mc4                    = document.getElementById('valor_conector_mc4').value;

    valor_emenda                          = document.getElementById('valor_emenda').value;

    valor_prensa_cabo                     = document.getElementById('valor_prensa_cabo').value;



    custo_kva25 = 2320;

    custo_kva35 = 2680;

    custo_kva75 = 4522;

    custo_kva90 = 7145;



    metalico_presilha_lateral       = document.getElementById('metalico_presilha_lateral').value;

    metalico_presilha_superior      = document.getElementById('metalico_presilha_superior').value;

    metalico_trilhos_segmentados    = document.getElementById('metalico_trilhos_segmentados').value;

    ceramico_presilha_lateral       = document.getElementById('ceramico_presilha_lateral').value;

    ceramico_presilha_superior      = document.getElementById('ceramico_presilha_superior').value;

    ceramico_ganchos                = document.getElementById('ceramico_ganchos').value;

    ceramico_perfil_1               = document.getElementById('ceramico_perfil_1').value;

    ceramico_perfil_2               = document.getElementById('ceramico_perfil_2').value;

    ceramico_perfil_3               = document.getElementById('ceramico_perfil_3').value;

    fibro_presilha_lateral          = document.getElementById('fibro_presilha_lateral').value;

    fibro_presilha_superior         = document.getElementById('fibro_presilha_superior').value;

    fibro_haste_L                   = document.getElementById('fibro_haste_L').value;

    fibro_perfil_1                  = document.getElementById('fibro_perfil_1').value;

    fibro_perfil_2                  = document.getElementById('fibro_perfil_2').value;

    fibro_perfil_3                  = document.getElementById('fibro_perfil_3').value;



    valor_metalico_presilha_lateral = document.getElementById('valor_metalico_presilha_lateral').value;

    valor_metalico_presilha_superior = document.getElementById('valor_metalico_presilha_superior').value;

    valor_metalico_trilhos_segmentados = document.getElementById('valor_metalico_trilhos_segmentados').value;

    valor_ceramico_presilha_lateral = document.getElementById('valor_ceramico_presilha_lateral').value;

    valor_ceramico_presilha_superior = document.getElementById('valor_ceramico_presilha_superior').value;

    valor_ceramico_ganchos                = document.getElementById('valor_ceramico_ganchos').value;

    valor_ceramico_perfil_1 = document.getElementById('valor_ceramico_perfil_1').value;

    valor_ceramico_perfil_2 = document.getElementById('valor_ceramico_perfil_2').value;

    valor_ceramico_perfil_3 = document.getElementById('valor_ceramico_perfil_3').value;

    valor_fibro_presilha_lateral = document.getElementById('valor_fibro_presilha_lateral').value;

    valor_fibro_presilha_superior = document.getElementById('valor_fibro_presilha_superior').value;

    valor_fibro_haste_L                   = document.getElementById('valor_fibro_haste_L').value;

    valor_fibro_perfil_1 = document.getElementById('valor_fibro_perfil_1').value;

    valor_fibro_perfil_2 = document.getElementById('valor_fibro_perfil_2').value;

    valor_fibro_perfil_3 = document.getElementById('valor_fibro_perfil_3').value;





    document.getElementById('cabo_vermelho').value = document.getElementById('cabo_preto').value;



    cabo_preto = parseInt(document.getElementById('cabo_preto').value);

    cabo_vermelho = parseInt(document.getElementById('cabo_preto').value);

    cabo_verde = parseInt(document.getElementById('cabo_verde').value);



    valor_cabo_energia = (cabo_preto+cabo_vermelho)*7.10;

    valor_cabo_terra = (cabo_verde)*8.98;

    valor_cabos = (valor_cabo_energia+valor_cabo_terra);



     //chapa

     if (document.form_cadastro.chapa[0].checked == true && document.form_cadastro.chapa[1].checked == false){

         soma_chapa = custo_chapa;

     }else{

         soma_chapa = 0;

     }

 



    //TRANSFORMADOR

    soma_transformador = (kva25*custo_kva25)+(kva35*custo_kva35)+(kva75*custo_kva75)+(kva90*custo_kva90);

    //FIM TRANSFORMADOR



    //ADICIONAIS TELHADO

    soma_adicionais = (metalico_presilha_lateral*valor_metalico_presilha_lateral)+(metalico_presilha_lateral*valor_metalico_presilha_lateral)+(metalico_presilha_superior*valor_metalico_presilha_superior)+(metalico_trilhos_segmentados*valor_metalico_trilhos_segmentados)+(ceramico_presilha_lateral*valor_ceramico_presilha_lateral)+(ceramico_presilha_superior*valor_ceramico_presilha_superior)+(ceramico_perfil_1*valor_ceramico_perfil_1)+(ceramico_perfil_2*valor_ceramico_perfil_2)+(ceramico_perfil_3*valor_ceramico_perfil_3)+(fibro_presilha_lateral*valor_fibro_presilha_lateral)+(fibro_presilha_superior*valor_fibro_presilha_superior)+(fibro_perfil_1*valor_fibro_perfil_1)+(fibro_perfil_2*valor_fibro_perfil_2)+(fibro_perfil_3*valor_fibro_perfil_3)+(fibro_haste_L*valor_fibro_haste_L)+(ceramico_ganchos*valor_ceramico_ganchos)+(conector_mc4*valor_conector_mc4)+(emenda*valor_emenda)+(prensa_cabo*valor_prensa_cabo);

    //FIM ADICIONAL TELHADO





    //SOMA GERAL

     soma_sistema=(preco*1)+(soma_chapa*1)+(soma_transformador*1)+(valor_cabos*1)+(soma_adicionais*1);

     

     

     

    //RETORNO NOS CAMPOS



    document.getElementById('valor_original').value = soma_sistema.toFixed(2);



}



  function ocultaCampos(){

    if (document.form_cadastro.aterramento[0].checked == true){

        document.getElementById('cabo_verde_sem_aterramento').style.display = 'none';

        document.getElementById('incluir_cabo_03').style.display = '';



    }else if(document.form_cadastro.aterramento[1].checked == true){

        document.getElementById('cabo_verde_sem_aterramento').style.display = '';

        document.getElementById('incluir_cabo_03').style.display = 'none';

    }else{

        document.getElementById('cabo_verde_sem_aterramento').style.display = '';

        document.getElementById('incluir_cabo_03').style.display = 'none';

    }



    if (document.form_cadastro.inversor[3].checked == true) {

        document.getElementById('select_inversores').style.display = '';

    }else{

        document.getElementById('select_inversores').style.display = 'none';

    }

  

  }



  function valida_inventario(){



      var id_prod = document.form_user.id_prod.value;

      var qtde = document.form_user.qtde.value;

      var justificativa = document.form_user.justificativa.value;

      var id_orc = document.form_user.id_orc.value;

      var data_estimada = document.form_user.data_estimada.value;

      



      if (id_prod == '0') {alert('Selecione o Produto a ser Inserido');document.getElementById('id_prod').focus();return false;}

      if (qtde == '') {alert('Insira a Quantidade');document.getElementById('qtde').focus();return false;}

      if (data_estimada == '') {alert('Insira a Data Estimada');document.getElementById('data_estimada').focus();return false;}

      if (justificativa == '') {alert('Insira a Justificativa');document.getElementById('justificativa').focus();return false;}

      if (id_orc == '') {alert('Insira o ID do Orçamento');document.getElementById('id_orc').focus();return false;}

      



      else{document.form_user.submit();}





  }



  function alerta_escolha(){

    escolha = document.form_pesquisa.forma_pagamento.value;



    if (escolha == 0) {document.getElementById('boleto').style.display='none';document.getElementById('transferencia').style.display='none';document.getElementById('financiamento').style.display='none';document.getElementById('financiamento2').style.display='none';}

    if (escolha == 1  || escolha == 5 || escolha == 6) {document.getElementById('boleto').style.display='';    document.getElementById('transferencia').style.display='none';document.getElementById('financiamento').style.display='none';document.getElementById('financiamento2').style.display='none';}

    if (escolha == 2) {document.getElementById('boleto').style.display='none';document.getElementById('transferencia').style.display=''    ;document.getElementById('financiamento').style.display='none';document.getElementById('financiamento2').style.display='none';}

    if (escolha == 3) {document.getElementById('boleto').style.display='none';document.getElementById('transferencia').style.display='none';document.getElementById('financiamento').style.display='';document.getElementById('financiamento2').style.display='none';}

    if (escolha == 4) {document.getElementById('boleto').style.display='none';document.getElementById('transferencia').style.display='none';document.getElementById('financiamento').style.display='none';document.getElementById('financiamento2').style.display='';}

  }



  function mostra_div_endereco(){

        if (document.form_pesquisa.mostra_endereco.checked == true){

        document.getElementById('novo_endereco').style.display = '';



    }else{

        document.getElementById('novo_endereco').style.display = 'none';

    }

  }









//AJAX

  $(document).ready(function(){



  $(document).on('click', '#add_inversor', function(){

    var adicionar_inversor = $('#adicionar_inversor').val();

    var qtde_inversor = $('#qtde_inversor').val();

    var id_orc = $('#id_orc').val();

    var preco_individual_inversor = $('#preco_individual_inversor').val();

    var preco_inversor_qtde = ((preco_individual_inversor*1)*qtde_inversor).toFixed(2);

    var soma_inversor01 = $('#soma_inversor01').val();

    var soma_inversor02 = $('#soma_inversor02').val();

    var soma_inversor03 = $('#soma_inversor03').val();

    var res1 = parseFloat(((soma_inversor01*1)+(preco_inversor_qtde*1)).toFixed(2));

    var res2 = parseFloat(((soma_inversor02*1)+(preco_inversor_qtde*1)).toFixed(2));

    var res3 = parseFloat(((soma_inversor03*1)+(preco_inversor_qtde*1)).toFixed(2));

    if (adicionar_inversor == '0') {alert("Selecione o inversor"); return false;}

    else{



    $.ajax({

      url: 'ins_inversor.php',

      type: 'POST',

      data: {

        'save': 1,

        'adicionar_inversor': adicionar_inversor,

        'qtde_inversor': qtde_inversor,

        'id_orc': id_orc,

      },

      success: function(response){

        $('#adicionar_inversor').val('14');

        $('#qtde_inversor').val('1');

        $('#inversores_avancados').append(response);

        $('#soma_inversor01').val(res1);

        $('#soma_inversor02').val(res2);

        $('#soma_inversor03').val(res3);

        calculaGrupoA();

      }



    });}

  });





    $(document).on('click', '#add_inversorb', function(){

      var adicionar_inversor = $('#adicionar_inversor').val();

      var qtde_inversor = $('#qtde_inversor').val();

      var id_orc = $('#id_orc').val();

      var preco_individual_inversor = $('#preco_individual_inversor').val();

      var preco_inversor_qtde = ((preco_individual_inversor*1)*qtde_inversor).toFixed(2);

      var soma_inversor = $('#soma_avancado').val();

      var res = parseFloat(((soma_inversor*1)+(preco_inversor_qtde*1)).toFixed(2));

      if (adicionar_inversor == '0') {alert("Selecione o inversor"); return false;}

      else{



      $.ajax({

        url: 'ins_inversorb.php',

        type: 'POST',

        data: {

          'save': 1,

          'adicionar_inversor': adicionar_inversor,

          'qtde_inversor': qtde_inversor,

          'id_orc': id_orc,

        },

        success: function(response){

          $('#adicionar_inversor').val('14');

          $('#qtde_inversor').val('1');

          $('#inversores_avancados').append(response);

          $('#soma_avancado').val(res);



          calculaGrupoB();

        }



      });}

    });



    $(document).on('click', '#add_inversorKit', function(){

      var adicionar_inversor = $('#adicionar_inversor').val();

      var qtde_inversor = $('#qtde_inversor').val();

      var id_orc = $('#id_orc').val();

      var preco_individual_inversor = $('#preco_individual_inversor').val();

      var preco_inversor_qtde = ((preco_individual_inversor*1)*qtde_inversor).toFixed(2);

      var soma_inversor = $('#soma_avancado').val();

      var res = parseFloat(((soma_inversor*1)+(preco_inversor_qtde*1)).toFixed(2));

      if (adicionar_inversor == '0') {alert("Selecione el inversor"); return false;}

      else{



      $.ajax({

        url: 'ins_inversorKit.php',

        type: 'POST',

        data: {

          'save': 1,

          'adicionar_inversor': adicionar_inversor,

          'qtde_inversor': qtde_inversor,

          'id_orc': id_orc,

        },

        success: function(response){

          $('#adicionar_inversor').val('14');

          $('#qtde_inversor').val('1');

          $('#inversores_avancados').append(response);

          $('#soma_avancado').val(res);



          calculaKits();

        }



      });}

    });



    $(document).on('click', '#add_inversor_avulso', function(){

      var adicionar_inversor = $('#adicionar_inversor_avulso').val();

      var qtde_inversor = $('#qtde_inversor').val();

      var id_orc = $('#id_orc').val();

      var preco_individual_inversor = $('#preco_individual_inversor').val();

      var preco_inversor_qtde = ((preco_individual_inversor*1)*qtde_inversor).toFixed(2);

      var soma_inversor = $('#soma_avancado').val();

      var res = parseFloat(((soma_inversor*1)+(preco_inversor_qtde*1)).toFixed(2));

      if (adicionar_inversor == '0') {alert("Selecione o inversor"); return false;}

      else{



      $.ajax({

        url: '../ins_inversor_avulso.php',

        type: 'POST',

        data: {

          'save': 1,

          'adicionar_inversor': adicionar_inversor,

          'qtde_inversor': qtde_inversor,

          'id_orc': id_orc,

        },

        success: function(response){

          $('#adicionar_inversor').val('14');

          $('#qtde_inversor').val('1');

          $('#inversores_avancados').append(response);

          $('#soma_avancado').val(res);



          calculaAvulso();

        }



      });}

    });



  // delete from database

  $(document).on('click', '.deletar_inversor', function(){

    var id = $(this).data('id');

    var preco = $(this).data('preco');

    var soma_inversor01 = $('#soma_inversor01').val();

    var soma_inversor02 = $('#soma_inversor02').val();

    var soma_inversor03 = $('#soma_inversor03').val();

    var res1 = parseFloat((soma_inversor01*1)-(preco*1).toFixed(2));

    var res2 = parseFloat((soma_inversor02*1)-(preco*1).toFixed(2));

    var res3 = parseFloat((soma_inversor03*1)-(preco*1).toFixed(2));

    $clicked_btn = $(this);

    



    $.ajax({

      url: 'ins_inversor.php',

      type: 'GET',

      data: {

        'delete': 1,

        'id': id,

      },

      success: function(response){

        // remove the deleted comment

        $clicked_btn.parent().remove();

        $('#soma_inversor01').val(res1);

        $('#soma_inversor02').val(res2);

        $('#soma_inversor03').val(res3);

        calculaGrupoA();

      }

    });

  });



  // delete from database

  $(document).on('click', '.deletar_inversorb', function(){

    var id = $(this).data('id');

    var preco = $(this).data('preco');

    var soma_inversor = $('#soma_avancado').val();



    var res = parseFloat((soma_inversor*1)-(preco*1).toFixed(2));



    $clicked_btn = $(this);

    



    $.ajax({

      url: 'ins_inversorb.php',

      type: 'GET',

      data: {

        'delete': 1,

        'id': id,

      },

      success: function(response){

        // remove the deleted comment

        $clicked_btn.parent().remove();

        $('#soma_avancado').val(res);



        calculaGrupoB();

      }

    });

  });



  // delete from database

  $(document).on('click', '.deletar_inversorKit', function(){

    var id = $(this).data('id');

    var preco = $(this).data('preco');

    var soma_inversor = $('#soma_avancado').val();



    var res = parseFloat((soma_inversor*1)-(preco*1).toFixed(2));



    $clicked_btn = $(this);

    



    $.ajax({

      url: 'ins_inversorKit.php',

      type: 'GET',

      data: {

        'delete': 1,

        'id': id,

      },

      success: function(response){

        // remove the deleted comment

        $clicked_btn.parent().remove();

        $('#soma_avancado').val(res);



        calculaKits();

      }

    });

  });



  // delete from database

  $(document).on('click', '.deletar_inversor_avulso', function(){

    var id = $(this).data('id');

    var preco = $(this).data('preco');

    var soma_inversor = $('#soma_avancado').val();



    var res = parseFloat((soma_inversor*1)-(preco*1).toFixed(2));



    $clicked_btn = $(this);

    



    $.ajax({

      url: '../ins_inversor_avulso.php',

      type: 'GET',

      data: {

        'delete': 1,

        'id': id,

      },

      success: function(response){

        // remove the deleted comment

        $clicked_btn.parent().remove();

        $('#soma_avancado').val(res);



        calculaGrupoB();

      }

    });

  });





  var edit_id;

  var $edit_comment;

  $(document).on('click', '.edit', function(){

    edit_id = $(this).data('id');

    $edit_comment = $(this).parent();

    // grab the comment to be editted

    var name = $(this).siblings('.display_name').text();

    var comment = $(this).siblings('.comment_text').text();

    // place comment in form

    $('#name').val(name);

    $('#comment').val(comment);

    $('#submit_btn').hide();

    $('#update_btn').show();

  });

  $(document).on('click', '#update_btn', function(){

    var id = edit_id;

    var name = $('#name').val();

    var comment = $('#comment').val();

    $.ajax({

      url: 'server.php',

      type: 'POST',

      data: {

        'update': 1,

        'id': id,

        'name': name,

        'comment': comment,

      },

      success: function(response){

        $('#name').val('');

        $('#comment').val('');

        $('#submit_btn').show();

        $('#update_btn').hide();

        $edit_comment.replaceWith(response);

      }

    });     

  });



  $(document).on('change', '#adicionar_inversor', function(){

    var id_inversor = $('#adicionar_inversor').val();

    $.ajax({

      url: 'ins_inversor.php',

      type: 'POST',

      data: {

        'preco': 1,

        'id_inversor': id_inversor,

      },

      success: function(response){

        

        $('#preco_individual_inversor').val(response);

      

      }

    });

  });



      $(document).on('change', '#adicionar_inversor_avulso', function(){

        var id_inversor = $('#adicionar_inversor_avulso').val();

        $.ajax({

          url: '../ins_inversor_avulso.php',

          type: 'POST',

          data: {

            'preco': 1,

            'id_inversor': id_inversor,

          },

          success: function(response){

            

            $('#preco_individual_inversor').val(response);

          

          }

        });

      });



});





    





    var coll = document.getElementsByClassName("collapsible");

var i;



for (i = 0; i < coll.length; i++) {

  coll[i].addEventListener("click", function() {

    this.classList.toggle("active");

    var content = this.nextElementSibling;

    if (content.style.display === "block") {

      content.style.display = "none";

    } else {

      content.style.display = "block";

    }

  });

} 



