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
                            <li><a href="#">Cadastros</a></li>
                            <li><a href="#">Pessoas</a></li>
                            <li><a href="<?php echo base_url('usuarios'); ?>">Colaboradores</a></li>
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
                    <strong class="card-title" v-if="headerText">Adicionar Colaborador</strong>
                    <a title="Voltar" href="<?php echo base_url('usuarios'); ?>" class="btn btn-light btn-sm float-right"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Voltar</a>
                </div>
                
                <div class="card-body" style="border: 1px solid #A4A4A4;">
                    <form method="post" name="form_add" class="user">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="nome">Nome <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="first_name" class="form-control form-control-user" id="nome" placeholder="Nome" value="<?php echo set_value('first_name'); ?>">
                                <?php echo form_error('first_name', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="sobrenome">Sobrenome <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="last_name" class="form-control form-control-user" id="sobrenome" placeholder="Sobrenome" value="<?php echo set_value('last_name'); ?>">
                                <?php echo form_error('last_name', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="sobrenome">Telefone <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="phone" class="form-control form-control-user celular" id="phone" placeholder="Telefone/Celular" value="<?php echo set_value('phone'); ?>">
                                <?php echo form_error('phone', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="email">E-mail <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="E-mail" value="<?php echo set_value('email'); ?>">
                                <?php echo form_error('email', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="username">Usuário <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="text" name="username" class="form-control form-control-user" id="username" placeholder="Nome de usuário" value="<?php echo set_value('username'); ?>">
                                <?php echo form_error('username', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="active">Ativo <span style="color: red;font-weight: bold;">*</span></label>
                                <select name="active" class="form-control custom-select" id="active">
                                    <option value="0">Não</option>
                                    <option value="1" selected="">Sim</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="perfil_usuario">Perfil de acesso <span style="color: red;font-weight: bold;">*</span></label>
                                <select name="perfil_usuario" class="form-control custom-select" id="perfil_usuario">
                                    <option value="1">Administrador</option>
                                    <option value="2" selected="">Comercial</option>
                                    <option value="3">Gerência</option>
                                    <option value="4">Logística</option>
                                    <option value="5">Franquia</option>
                                    <option value="6">Qualidade</option>
                                    <option value="7">Financeiro</option>
                                    <option value="8">Projeto</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="senha">Senha <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="password" name="password" class="form-control form-control-user" id="senha" placeholder="Senha">
                                <?php echo form_error('password', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="recsenha">Confirme a senha <span style="color: red;font-weight: bold;">*</span></label>
                                <input type="password" name="senha" class="form-control form-control-user" id="recsenha" placeholder="Repita a senha">
                                <?php echo form_error('confirm_password', '<small class="form-text text-danger">','</small>') ?>
                            </div>
                        </div>
                        
                        <input type="hidden" name="id_nivacesso" value="1">

                        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fa fa-user-plus" aria-hidden="true"></i> Adicionar colaborador</button>
                    </form>
                </div>

            </div>

        </div>
