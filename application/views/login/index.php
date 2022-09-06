
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <img class="align-content" src="<?php echo base_url('public/images/logo_bsum2.png'); ?>" alt="">
                    </a>
                </div>
                <div class="login-form" style="background-image: linear-gradient(135deg, #FF6000 0, #FF8D00 25%, #FDC100 50%, #FF9400 75%, #FCB801 100%);">
                    <form method="POST" accept-charset="utf-8" class="form-signin" action="<?php echo base_url('login/autentica'); ?>" id="login" name="form_autentica">
                        <h6 class="text-right" style="color: #656565;">Seja bem vindo a plataforma <strong>administrativa</strong>!</h6>
                        <div class="form-group">
                            <label class="text-secondary font-weight-bold">E-mail</label>
                            <input type="email" class="form-control" placeholder="Entre com seu e-mail" name="email">
                        </div>
                        <div class="form-group">
                                <label class="text-secondary font-weight-bold">Senha</label>
                                <input type="password" class="form-control" placeholder="Entre com a sua senha" name="password">
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
                                <div class="alert  alert-warning alert-dismissible fade show " role="alert" style="font-size: 0.8em;">
                                        <span class="badge badge-pill"><i class="fa fa-info" aria-hidden="true"></i></span>
                                         <?php echo $message; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <!-- Mensagem de info -->
                                
                                <div class="checkbox">
                                    <!--<label>
                                <input type="checkbox"> Lembrar senha
                            </label>-->
<!--                            <label class="pull-right" style="font-size: .8em;">Esqueceu a sua senha?
                                <a href="login_reset.php">Clique aqui</a>
                            </label>-->

                                </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30"><i class="fa fa-lock" aria-hidden="true"></i> Acessar</button>
                    </form>
                </div>
            </div>
        </div>
    
