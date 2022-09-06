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
                            <li><a href="#">Orçamentos</a></li>
                            <li><a href="<?php echo base_url('servicos'); ?>">Vendas</a></li>
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
                    <strong class="card-title" v-if="headerText">Cadastrar Venda</strong>
                    <span class="float-right" style="color: #777;font-size: .9em;">
                        <!--<strong><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Última alteração: </strong><?php echo formata_data_banco_com_hora($venda->venda_data_alteracao); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                        <a title="Voltar" href="<?php echo base_url('vendas'); ?>" class="btn btn-light btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
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
                
                
                    <form class="user" action="" id="form" name="form_add" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                        <fieldset id="vendas" class="border p-2" style="margin-top: -10px;">

                            <legend class="font-small"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Escolha os produtos</legend>

                            <div class="form-group row">
                                <div class="ui-widget col-lg-12 mb-1 mt-1">
                                    <input id="buscar_produtos" class="search form-control form-control-lg col-lg-12" placeholder="Que produto você está buscando?">
                                </div>
                            </div>


                            <div class="table-responsive">
                                <table id="table_produtos" class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="" style="width: 55%">Produto</th>
                                            <th class="text-right pr-2" style="width: 12%">Valor unitário</th>
                                            <th class="text-center" style="width: 8%">Qty</th>
                                            <th class="" style="width: 8%">% Desc</th>
                                            <th class="text-right pr-2" style="width: 15%">Total</th>
                                            <th class="" style="width: 25%"></th>
                                            <th class="" style="width: 25%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="lista_produtos" class="">

                                    </tbody>
                                    <tfoot >
                                        <tr class="">
                                            <td colspan="5" class="text-right border-0">
                                                <label class="font-weight-bold pt-1" for="total">Valor de desconto:</label>
                                            </td>
                                            <td class="text-right border-0">
                                                <input type="text" name="venda_valor_desconto" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="L1" data-formula="SUM(H1:H5)" readonly="">
                                            </td>
                                            <td class="border-0">&nbsp;</td>
                                        </tr>
                                        <tr class="">
                                            <td colspan="5" class="text-right border-0">
                                                <label class="font-weight-bold pt-1" for="total">Total a pagar:</label>
                                            </td>
                                            <td class="text-right border-0">
                                                <input type="text" name="venda_valor_total" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="G2" data-formula="SUM(F1:F5)" readonly="">
                                            </td>
                                            <td class="border-0">&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </fieldset>   

                        <fieldset class="mt-4 border p-2">

                            <legend class="font-small"><i class="fa fa-money"></i>&nbsp;&nbsp;Dados da venda</legend>

                            <div class="">
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-1 mb-sm-0">
                                        <label class="small my-0">Escolha o cliente <span class="text-danger">*</span></label>
                                        <select class="custom-select contas_receber" id="venda_cliente_id" name="venda_cliente_id" required="">
                                            <option value="">Escolha</option>
                                            <?php foreach ($clientes as $cliente): ?>
                                                <option value="<?php echo $cliente->cliente_id; ?>"><?php echo $cliente->cliente_nome . ' ' . $cliente->cliente_sobrenome . ' | CPF ou CNPJ: ' . $cliente->cliente_cpf_cnpj; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('venda_cliente_id', '<div class="text-danger small">', '</div>') ?>
                                    </div>


                                    <div class="col-sm-6 mb-1 mb-sm-0">
                                        <label class="small my-0">Tipo da venda<span class="text-danger">*</span></label>
                                        <select class="custom-select" id="venda_tipo" name="venda_tipo" required="">
                                            <option value="">Escolha...</option>
                                            <option value="1">Venda à vista</option>
                                            <option value="2">Venda à prazo</option>
                                        </select>
                                        <?php echo form_error('venda_tipo', '<div class="text-danger small">', '</div>') ?>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="small my-0">Forma de pagamento <span class="text-danger">*</span></label>
                                        <select id="id_pagamento" class="custom-select forma-pagamento" id="venda_forma_pagamento_id" name="venda_forma_pagamento_id" required="">
                                            <option value="">Escolha</option>
                                            <?php foreach ($formas_pagamentos as $forma_pagamento): ?>
                                                <option value="<?php echo $forma_pagamento->forma_pagamento_id; ?>"><?php echo $forma_pagamento->forma_pagamento_nome; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('venda_forma_pagamento_id', '<div class="text-danger small">', '</div>') ?>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="small my-0">Escolha o vendedor <span class="text-danger">*</span></label>
                                        <select id="id_vendedor" class="custom-select vendedor" id="venda_vendedor_id" name="venda_vendedor_id" required="">
                                            <option value="">Escolha</option>
                                            <?php foreach ($vendedores as $vendedor): ?>
                                                <option value="<?php echo $vendedor->vendedor_id; ?>"><?php echo $vendedor->vendedor_nome_completo . ' | ' . $vendedor->vendedor_codigo; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('venda_vendedor_id', '<div class="text-danger small">', '</div>') ?>
                                    </div>


                                </div>

                            </div>

                        </fieldset>


                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm mr-2" id="btn-cadastrar-venda" form="form">Cadastrar</button>
                            <!--<a href="<?php echo base_url('vendas'); ?>" class="btn btn-secondary btn-sm">Voltar</a>-->
                        </div>

                    </form>
                </div>

            </div>

        </div>
