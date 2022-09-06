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
<!--                            <li><a href="#">Cadastros</a></li>
                            <li><a href="#">Estoque</a></li>-->
                            <li><a href="<?php echo base_url('reclamacoes'); ?>">Reclamações</a></li>
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
                    <strong class="card-title" v-if="headerText">Editar Reclamação</strong>
                    <span class="float-right" style="color: #777;font-size: .9em;">
                        <strong><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Última alteração: </strong><?php echo formata_data_banco_com_hora($reclama->reclama_data_alteracao); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="Voltar" href="<?php echo base_url('reclamacoes'); ?>" class="btn btn-light btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
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
                
                
                    <form method="post" name="form_edit" class="user">
                        
                        <fieldset class="border p-2" style="margin-top: -10px;">
                            <legend class="font-small"><i class="fa fa-th-list"></i> Dados do cliente e pedido</legend>
                            
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="reclama_orc_id">Orcamento <span style="color: red;font-weight: bold;">*</span></label>
                                    <select style="pointer-events: none;touch-action: none;font-size: .9em;" name="reclama_orc_id" class="form-control form-control-user-date bg-dark text-light font-weight-bold" id="reclama_orc_id">
                                        <?php foreach($orcamentos as $orcamento): ?>
                                        <option value="<?php echo $orcamento->orc_id ?>" <?php echo ($orcamento->orc_id == $reclama->reclama_orc_id ? 'selected' : ''); ?>><?php echo $orcamento->orc_codigo ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="reclama_cli_id">Autorizado <span style="color: red;font-weight: bold;">*</span></label> 
                                    <select style="pointer-events: none;touch-action: none;" name="reclama_cli_id" class="form-control custom-select bg-light" id="reclama_cli_id">
                                        <?php foreach($clientes as $cliente): ?>
                                        <option value="<?php echo $cliente->cliente_id ?>" <?php echo ($cliente->cliente_id == $reclama->reclama_cli_id ? 'selected' : ''); ?>><?php echo $cliente->cliente_nome ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="reclama_orc_id">Cliente <span style="color: red;font-weight: bold;">*</span></label> 
                                    <select style="pointer-events: none;touch-action: none;" name="" class="form-control custom-select" id="reclama_orc_id" disabled="">
                                        <?php foreach($orcamentos as $orcamento): ?>
                                        <option <?php echo ($orcamento->orc_id == $reclama->reclama_orc_id ? 'selected' : ''); ?>><?php echo $orcamento->orc_cli_nome ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="reclama_status">Ativo <span style="color: red;font-weight: bold;">*</span></label>
                                    <?php if($reclama->reclama_status == 0): ?>
                                        <select name="reclama_status" class="form-control form-control-user-date bg-danger text-light font-weight-bold" id="produto_ativo">
                                            <option value="0" <?php echo ($reclama->reclama_status == 0) ? 'selected' : ''; ?>>Pendente</option>
                                            <option value="1" <?php echo ($reclama->reclama_status == 1) ? 'selected' : ''; ?>>Resolvido</option>
                                        </select>
                                    <?php endif; ?>
                                    <?php if($reclama->reclama_status == 1): ?>
                                        <select name="reclama_status" class="form-control form-control-user-date bg-info text-light font-weight-bold" id="produto_ativo">
                                            <option value="0" <?php echo ($reclama->reclama_status == 0) ? 'selected' : ''; ?>>Pendente</option>
                                            <option value="1" <?php echo ($reclama->reclama_status == 1) ? 'selected' : ''; ?>>Resolvido</option>
                                        </select>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="reclama_status">Ativo <span style="color: red;font-weight: bold;">*</span></label>                                  
                                    <?php if($reclama->reclama_tipo == 'R'): ?>
                                        <select name="reclama_tipo" class="form-control form-control-user-date text-light font-weight-bold" id="produto_ativo" style="background: #610B0B;">
                                            <option value="R" <?php echo ($reclama->reclama_tipo == 'R') ? 'selected' : ''; ?>>Reclamação</option>
                                            <option value="S" <?php echo ($reclama->reclama_tipo == 'S') ? 'selected' : ''; ?>>Sugestão</option>
                                            <option value="E" <?php echo ($reclama->reclama_tipo == 'E') ? 'selected' : ''; ?>>Elogio</option>
                                        </select>
                                    <?php endif; ?>
                                    <?php if($reclama->reclama_tipo == 'S'): ?>
                                        <select name="reclama_tipo" class="form-control form-control-user-date text-light font-weight-bold" id="produto_ativo" style="background: #0B243B;">
                                            <option value="R" <?php echo ($reclama->reclama_tipo == 'R') ? 'selected' : ''; ?>>Reclamação</option>
                                            <option value="S" <?php echo ($reclama->reclama_tipo == 'S') ? 'selected' : ''; ?>>Sugestão</option>
                                            <option value="E" <?php echo ($reclama->reclama_tipo == 'E') ? 'selected' : ''; ?>>Elogio</option>
                                        </select>
                                    <?php endif; ?>
                                    <?php if($reclama->reclama_tipo == 'E'): ?>
                                        <select name="reclama_tipo" class="form-control form-control-user-date text-light font-weight-bold" id="produto_ativo" style="background: #0B3B24;">
                                            <option value="R" <?php echo ($reclama->reclama_tipo == 'R') ? 'selected' : ''; ?>>Reclamação</option>
                                            <option value="S" <?php echo ($reclama->reclama_tipo == 'S') ? 'selected' : ''; ?>>Sugestão</option>
                                            <option value="E" <?php echo ($reclama->reclama_tipo == 'E') ? 'selected' : ''; ?>>Elogio</option>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-bullhorn"></i> Reclamação</legend>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea name="reclama_obs" rows="3" class="form-control form-control-user bg-light" id="reclama_obs" readonly=""><?php echo $reclama->reclama_obs; ?></textarea>
                                    <?php echo form_error('reclama_obs', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-comments"></i> Responder reclamação <span class="text-danger font-weight-bold">*</span></legend>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea name="reclama_retorno_obs" rows="3" class="form-control form-control-user" id="reclama_obs" placeholder="Responder reclamação"><?php echo $reclama->reclama_retorno_obs; ?></textarea>
                                    <?php echo form_error('reclama_retorno_obs', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <input type="hidden" name="reclama_id" value="<?php echo $reclama->reclama_id; ?>">
                        
                        <?php echo ($reclama->reclama_status == 1 ? '<button type="submit" class="btn btn-primary btn-sm float-right mt-1" style="display:none;" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Enviar resposta</button><span class="badge badge-light float-right mt-1"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;&nbsp;ESTA RECLAMAÇÃO JÁ FOI RESOLVIDA NO DIA&nbsp;'.formata_data_banco_com_hora($reclama->reclama_data_alteracao).'</span>' : '<button type="submit" class="btn btn-primary btn-sm float-right mt-1"><i class="fa fa-comments" aria-hidden="true"></i> Enviar resposta</button>'); ?>
                    </form>
                </div>

            </div>

        </div>
