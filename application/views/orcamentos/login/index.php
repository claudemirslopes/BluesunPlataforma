
    <div class="sufee-login d-flex align-content-center flex-wrap" >
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <img class="align-content" src="<?php echo base_url('public/images/logo_bsum.png'); ?>" alt="">
                    </a>
                </div>
                <div class="login-form" style="background: rgba(52,58,64, 0.5);">
                    <?php
                        echo validation_errors('<div class="alert alert-danger">', '</div>');
                        echo form_open('orcamentos/usuarios/login');
                    ?>
                        <h6 class="text-right text-light">Seja bem vindo a plataforma de <strong  style="color: #dcdcdc;">orçamentos</strong>!</h6>
                        <div class="form-group">
                            <label class="text-light font-weight-bold">E-mail</label>
                            <input type="email" class="form-control" placeholder="Entre com seu usuário" name="txt-user">
                        </div>
                        <div class="form-group">
                            <label class="text-light font-weight-bold">Senha</label>
                            <input type="password" class="form-control" placeholder="Entre com a sua senha" name="txt-senha">
                        </div>
                        
                                <!-- Mensagem de erro -->
                                <?php if ($message = $this->session->flashdata('error')): ?>
                                <div class="alert  alert-danger alert-dismissible fade show " role="alert" style="font-size: 0.8em;">
                                        <span class="badge badge-pill"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
                                         <?php echo $message; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <!-- Mensagem de erro -->
                                
                                <!-- Mensagem de info -->
                                <?php if ($message = $this->session->flashdata('info')): ?>
                                <div class="alert  alert-info alert-dismissible fade show " role="alert" style="font-size: 0.8em;">
                                        <span class="badge badge-pill"><i class="fa fa-info" aria-hidden="true"></i></span>
                                         <?php echo $message; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <!-- Mensagem de info -->
                                
                                <div class="checkbox">
<!--                                    <label>
                                        <input type="checkbox"> Lembrar senha
                                    </label>-->
                                    <label class="pull-right text-light" style="font-size: .8em;">Ainda não tem cadastro?
                                        <a href="<?php echo base_url('orcamentos/cadastro'); ?>" class="text-warning">Clique aqui</a>
                                    </label>

                                </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30"><i class="fa fa-lock" aria-hidden="true"></i> Acessar</button>
                    <?php
                        echo form_close();
                    ?>
                </div>
            </div>
        </div>
    
