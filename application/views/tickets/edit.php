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
                            <li><a href="<?php echo base_url('tickets'); ?>">Tickets</a></li>
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
                    <strong class="card-title" v-if="headerText">Editar Ticket <small>(Chamado)</small></strong>
                    <span class="float-right" style="color: #777;font-size: .9em;">
                        <strong><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Última alteração: </strong><?php echo formata_data_banco_com_hora($ticket->ticket_data_alteracao); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="Voltar" href="<?php echo base_url('tickets'); ?>" class="btn btn-light btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
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
                            <legend class="font-small"><i class="fa fa-th-list"></i> Dados do ticket</legend>
                            
                            <div class="form-row">
                                <div class="form-group col-md-1">
                                    <label for="ticket_codigo">Ticket <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="ticket_codigo" class="form-control form-control-user bg-dark text-light" id="ticket_codigo" value="<?php echo $ticket->ticket_codigo; ?>" readonly="">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="ticket_user_id">Colaborador <span style="color: red;font-weight: bold;">*</span></label> 
                                    <select style="pointer-events: none;touch-action: none;" name="ticket_user_id" class="form-control custom-select bg-light" id="ticket_user_id">
                                        <?php foreach($users as $user): ?>
                                        <option value="<?php echo $user->id ?>" <?php echo ($user->id == $ticket->ticket_user_id ? 'selected' : ''); ?>><?php echo $user->first_name.' '.$user->last_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="ticket_assunto">Assunto <span style="color: red;font-weight: bold;">*</span></label> 
                                    <input type="text" name="ticket_assunto" class="form-control form-control-user" id="ticket_assunto" placeholder="Assunto" value="<?php echo $ticket->ticket_assunto; ?>">
                                    <?php echo form_error('servico_nome', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="ticket_status">Prioridade <span style="color: red;font-weight: bold;">*</span></label>
                                    
                                    <?php if($ticket->ticket_prioridade == 0): ?>
                                        <select name="ticket_prioridade" class="form-control form-control-user-date bg-secondary text-light font-weight-bold" id="ticket_prioridade">
                                            <option value="0" <?php echo ($ticket->ticket_prioridade == 0) ? 'selected' : ''; ?>>Baixa</option>
                                            <option value="1" <?php echo ($ticket->ticket_prioridade == 1) ? 'selected' : ''; ?>>Média</option>
                                            <option value="2" <?php echo ($ticket->ticket_prioridade == 2) ? 'selected' : ''; ?>>Alta</option>
                                        </select>
                                    <?php endif; ?>
                                    <?php if($ticket->ticket_prioridade == 1): ?>
                                        <select name="ticket_prioridade" class="form-control form-control-user-date bg-warning text-dark font-weight-bold" id="ticket_prioridade">
                                            <option value="0" <?php echo ($ticket->ticket_prioridade == 0) ? 'selected' : ''; ?>>Baixa</option>
                                            <option value="1" <?php echo ($ticket->ticket_prioridade == 1) ? 'selected' : ''; ?>>Média</option>
                                            <option value="2" <?php echo ($ticket->ticket_prioridade == 2) ? 'selected' : ''; ?>>Alta</option>
                                        </select>
                                    <?php endif; ?>  
                                    <?php if($ticket->ticket_prioridade == 2): ?>
                                        <select name="ticket_prioridade" class="form-control form-control-user-date bg-danger text-light font-weight-bold" id="ticket_prioridade">
                                            <option value="0" <?php echo ($ticket->ticket_prioridade == 0) ? 'selected' : ''; ?>>Baixa</option>
                                            <option value="1" <?php echo ($ticket->ticket_prioridade == 1) ? 'selected' : ''; ?>>Média</option>
                                            <option value="2" <?php echo ($ticket->ticket_prioridade == 2) ? 'selected' : ''; ?>>Alta</option>
                                        </select>
                                    <?php endif; ?> 
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="ticket_status">Situação <span style="color: red;font-weight: bold;">*</span></label>
                                    
                                    <?php if($ticket->ticket_status == 0): ?>
                                        <select name="ticket_status" class="form-control form-control-user-date bg-warning text-dark font-weight-bold" id="ticket_status">
                                            <option value="0" <?php echo ($ticket->ticket_status == 0) ? 'selected' : ''; ?>>Pendente</option>
                                            <option value="1" <?php echo ($ticket->ticket_status == 1) ? 'selected' : ''; ?>>Resolvido</option>
                                        </select>
                                    <?php endif; ?>
                                    <?php if($ticket->ticket_status == 1): ?>
                                        <select name="ticket_status" class="form-control form-control-user-date bg-success text-light font-weight-bold" id="ticket_status">
                                            <option value="0" <?php echo ($ticket->ticket_status == 0) ? 'selected' : ''; ?>>Pendente</option>
                                            <option value="1" <?php echo ($ticket->ticket_status == 1) ? 'selected' : ''; ?>>Resolvido</option>
                                        </select>
                                    <?php endif; ?>  
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-bullhorn"></i> Mensagem do chamado</legend>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea name="ticket_mensagem" rows="3" class="form-control form-control-user bg-light" id="ticket_mensagem" readonly=""><?php echo $ticket->ticket_mensagem; ?></textarea>
                                    <?php echo form_error('ticket_mensagem', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="mt-2 border p-2">
                            <legend class="font-small"><i class="fa fa-comments"></i> Responder chamado <span class="text-danger font-weight-bold">*</span></legend>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea name="ticket_resposta" rows="3" class="form-control form-control-user" id="ticket_resposta" placeholder="Responder ticket"><?php echo $ticket->ticket_resposta; ?></textarea>
                                    <?php echo form_error('ticket_resposta', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <input type="hidden" name="ticket_id" value="<?php echo $ticket->ticket_id; ?>">
                        
                        <?php echo ($ticket->ticket_status == 1 ? '<button type="submit" class="btn btn-primary btn-sm float-right mt-1" style="display:none;" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Enviar resposta</button><span class="badge badge-light float-right mt-1"><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;&nbsp;ESTE TICKET <b>(CHAMADO)</b> JÁ FOI RESOLVIDO NO DIA&nbsp;'.formata_data_banco_com_hora($ticket->ticket_data_alteracao).'</span>' : '<button type="submit" class="btn btn-primary btn-sm float-right mt-1"><i class="fa fa-ticket" aria-hidden="true"></i> Enviar resposta</button>'); ?>
                    </form>
                </div>

            </div>

        </div>
