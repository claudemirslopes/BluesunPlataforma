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
                            <li><a href="#">Estoque</a></li>-->
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
                    <strong class="card-title" v-if="headerText">Orçamentos realizados</strong>
                    <a title="Cadastrar novo orçamento" href="<?php echo base_url('orcamentos/orcamentos/add_p1'); ?>" class="btn btn-light btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Novo orçamento</a>
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
                
                   <table class="bootstrap-data-table-export table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="display: none;">#</th>
                                <th class="text-center">Orç. nº</th>
                                <th>Cliente</th>
                                <th class="text-center">CPF/CNPJ</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Situação</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orcamentos as $orcamento): ?>
                            <?php if ($orcamento->orc_cli_cliente_id == $this->session->userdata('userlogado')->cliente_id): ?>
                            <tr>
                                <td class="text-center" style="display: none;"><?php echo $orcamento->orc_id; ?></td>
                                <td class="text-center"><?php echo $orcamento->orc_codigo; ?></td>
                                <td><?php echo $orcamento->orc_cli_nome; ?></td>
                                <td class="text-center"><?php echo $orcamento->orc_cli_cpf_cnpj; ?></td>
                                <td class="text-center"><?php echo formata_data_banco_com_hora($orcamento->orc_data_alteracao); ?></td>
                                <td class="text-center pr-4">
                                    <?php if ($orcamento->orc_situacao == 0) {
                                            echo '<span class="badge badge-secondary btn-sm">Em aberto</span>';
                                        } elseif ($orcamento->orc_situacao == 1) {
                                            echo '<span class="badge badge-warning btn-sm">Em negociação</span>';
                                        } elseif ($orcamento->orc_situacao == 2) {
                                            echo '<span class="badge badge-success btn-sm">Concluír pedido</span>';
                                        } else {
                                            echo '<span class="badge badge-danger btn-sm">Cancelado</span>';
                                        }
                                    ?>
                                </td>
                                <style>
                                    .btn-danger {
                                        background: #B40404;
                                        border: solid 1px #B40404;
                                    }
                                    .btn-primary {
                                        background: #0B3861;
                                        border: solid 1px #0B3861;
                                    }
                                </style>
                                <td class="text-right">
                                    <a href="<?php echo base_url('orcamentos/orcamentos/add_p2/'.$orcamento->orc_id); ?>" class="btn btn-sm btn-primary" title="Editar"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript(void)" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#orcamento-<?php // echo $orcamento->orc_id; ?>" title="Excluír"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            
                            <div class="modal fade" id="orcamento-<?php echo $orcamento->orc_id; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticModalLabel">Excluír orcamento</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                Deseja mesmo excluír esta orcamento?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                            <a href="<?php echo base_url('orcamentos/orcamentos/del/'.$orcamento->orc_id); ?>" class="btn btn-danger btn-sm">Confirmar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
