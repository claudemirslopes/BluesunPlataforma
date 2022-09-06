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
                    <strong class="card-title" v-if="headerText">Perfil de acesso</strong>
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
                        <fieldset class="border p-2 col-md-2 float-left" style="margin-top: -10px;margin-bottom: 15px;">
                            <legend class="font-small"><i class="fa fa-picture-o"></i> Foto do perfil</legend>
                            <div class="form-row">
                                <div class="form-group col-md-12" style="height: 55px;">
                                    <div class="text-center" style="width: 100%;height: 100%;">
                                        <?php if($cliente->cliente_img == 0) { ?>
                                            <a href="" data-toggle="modal" data-target="#foto">
                                            <figure id="container">
                                                <img src="<?php echo base_url('public/images/perfil/semFoto2.png'); ?>" alt="Logo" width="100%" height="100%" style="background-color: #cdcdcd;margin-top: -8px;"/>
                                                <figcaption>ADD FOTO</figcaption>
                                            </figure></a>
                                        <?php } else { ?>
                                        <a href="" data-toggle="modal" data-target="#foto">
                                        <figure id="container">
                                            <img class="imagem1" src="<?php echo base_url('public/images/perfil/'.$cliente->cliente_id.'.jpg'); ?>" class="text-center" alt="Logo" width="40%" height="60px" style="background-color: #cdcdcd;border-radius: 30px;"/>
                                            <figcaption>ALTERAR</figcaption>
                                        </figure></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        
                    <div class="modal fade swing" id="foto" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mediumModalLabel">Foto do Perfil</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <div style="width: 100%;height: 100%;">
                                    <?php if($cliente->cliente_img == 0) { ?>
                                        <img src="<?php echo base_url('public/images/perfil/semFoto2.png'); ?>" alt="Logo" width="100%" height="100%" style="background-color: #cdcdcd;"/>
                                    <?php } else { ?>
                                    <figure id="container">
                                        <img class="imagem1" src="<?php echo base_url('public/images/perfil/'.$cliente->cliente_id.'.jpg'); ?>" alt="Foto" width="50%" height="auto" style="background-color: #cdcdcd;"/>
                                    </figure>
                                    <?php } ?>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <?php
                                        $divopen = '<div class="form-group col-md-12">';
                                        $divclose = '</div>';
                                        echo form_open_multipart('orcamentos/clientes/foto_perfil');
                                        echo form_hidden('cliente_id', $cliente->cliente_id);
                                        echo $divopen;
                                        $imagem = array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control');
                                        echo form_upload($imagem);
                                        echo $divclose;
                                    ?>
                                    <small class="form-text text-danger text-center"><b>Formato aceito:</b> Somente JPG | <b>Medida:</b> 200x200</small>
                                </div>
                                <div class="modal-footer">
                                    <?php
                                        echo $divopen;
                                    ?>                                            
                                    <div class="float-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <?php
                                            $botao = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'class' => 'btn btn-info', 'value' => 'Add/Alterar Foto');
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
                        
                        <fieldset class="border p-2 col-md-10 float-right" style="margin-top: -10px;">
                            <legend class="font-small"><i class="fa fa-user-circle"></i> Dados Pessoais</legend>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="cliente_nome">Nome do Responsável <span style="color: red;font-weight: bold;">*</span></label>
                                    <input type="text" name="cliente_responsavel" class="form-control form-control-user" id="cliente_responsavel" placeholder="Nome do Responsável" value="<?php echo $cliente->cliente_responsavel ?>">
                                    <?php echo form_error('cliente_responsavel', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="border p-2" style="margin-top: 5px;clear: both;">
                            <legend class="font-small"><i class="fa fa-unlock-alt"></i> Dados de acesso</legend>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cliente_user">Usuário</label>
                                    <input type="text" name="cliente_user" class="form-control form-control-user" id="cliente_user" value="<?php echo $cliente->cliente_user ?>" readonly="">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cliente_senha">Senha</label>
                                    <input type="password" name="cliente_senha" class="form-control form-control-user" id="cliente_senha">
                                    <small class="form-text text-info font-weight-bold">Deixe este campo em branco caso não queira trocar a senha</small>
                                    <?php echo form_error('cliente_senha', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cliente_senha_repete">Confirmar Senha</label>
                                    <input type="password" name="cliente_senha_repete" class="form-control form-control-user" id="cliente_senha_repete">
                                    <?php echo form_error('cliente_senha_repete', '<small class="form-text text-danger">','</small>') ?>
                                </div>
                            </div>
                        </fieldset>
                        
                        <input type="hidden" name="cliente_id" value="<?php echo $cliente->cliente_id; ?>">
                        <button type="submit" class="btn btn-primary btn-sm float-right mt-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar perfil</button>                       
                    </form>
                </div>

            </div>

        </div>
