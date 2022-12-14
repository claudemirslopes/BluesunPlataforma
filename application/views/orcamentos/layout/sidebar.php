    <!-- PAINEL ESQUERDO - LATERAL -->
    <style>
        .h3tit {
            color: #dfdfdf; 
         }
         .embed-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
            height: auto;
            margin-top: 30px;
            margin-bottom: 30px;
        }
           .embed-container iframe, .embed-container object, .embed-container embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .instrucoes {
            font-size: 1em;
            line-height: 16px;
            text-align: justify;
        }
    </style>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <?php if($this->session->userdata('userlogado')->cliente_logo == 0) { ?>
                <a class="navbar-brand" href="<?php echo base_url('orcamentos/home'); ?>"><img src="<?php echo base_url('public/images/logobordabranca.png'); ?>" alt="Bluesum" style="max-width: 80% !important;margin-bottom: 5px;margin-top: 5px;"></a>
                <?php } else { ?>
                <a class="navbar-brand" href="<?php echo base_url('orcamentos/home'); ?>"><img src="<?php echo base_url('public/images/orcamentos/'.$this->session->userdata('userlogado')->cliente_id.'.png'); ?>" alt="Bluesum" style="max-width: 80% !important;margin-bottom: 5px;margin-top: 5px;"></a>
                <?php } ?>
                <a class="navbar-brand hidden" href="<?php echo base_url('orcamentos/home'); ?>"><img src="<?php echo base_url('public/images/logo_bsum02.png'); ?>" alt="Bluesum"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav" style="margin-top: 10px;">
                    <li class="active">
                        <a href="<?php echo base_url('orcamentos/home'); ?>"> <i class="menu-icon fa fa-home" title="In??cio"></i>Home</a>
                    </li>
                    
                    <li>
                        <a href="" data-toggle="modal" data-target="#expediente"> <i class="menu-icon fa fa-clock-o" title="Expediente"></i>Expediente</a>
                    </li>
                    
                    <!--<h3 class="menu-title" style="margin-top: -15px;"></h3> /.menu-title -->
                    <li style="background: #FF9400;padding-left: 5px;margin-top: 10px;padding-right: 5px;border-radius: 3px;border: 1px solid #fff;">
                        <a href="" data-toggle="modal" data-target="#instrucoes"> <i class="menu-icon fa fa-desktop" title="Instru????es"></i>Instru????es</a>
                    </li>
                    
                    <h3 class="menu-title" style="margin-top: -15px;"><a class="h3tit" href="">Or??amentos</a></h3><!-- /.menu-title -->

                    <li>
                        <a href="<?php echo base_url('orcamentos/orcamentos'); ?>"><i class="menu-icon fa fa-flag-checkered" title="Or??amentos Realizados"></i>Realizados</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('orcamentos/orcamentos/add_p1'); ?>"><i class="menu-icon fa fa-plus-square" title="Novo Or??amento"></i>Criar novo</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('orcamentos/orcamentos'); ?>"><i class="menu-icon fa fa-ban" title="Or??amentos Cancelados"></i>Cancelados</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('orcamentos/orcamentos'); ?>"><i class="menu-icon fa fa-check-square" title="Or??amentos Conclu??dos"></i>Pedidos <small>Conclu??dos</small></a>
                    </li>
                    
                    <h3 class="menu-title" style="margin-top: -15px;"><a class="h3tit" href="">Financiamento</a></h3><!-- /.menu-title -->
                    
                    <li>
                        <a href="<?php echo base_url('orcamentos/financiamentos'); ?>" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-list" title="OS"></i>Simular</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('orcamentos/preco_kit'); ?>" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money" title="OS"></i>Pre??o <small>de Kits</small></a>
                    </li>

                    <h3 class="menu-title" style="margin-top: -15px;"><a class="h3tit" href="">Ferramentas</a></h3><!-- /.menu-title -->
                    <li style="background: #FE2E2E;padding-left: 5px;margin-top: 10px;padding-right: 5px;border-radius: 3px;">
                        <a href="<?php echo base_url('orcamentos/kb'); ?>"><i class="menu-icon fa fa-database text-light" title="Base do conhecimento"></i>Base <small>de conhecimento</small></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('orcamentos/empresa/'); ?>" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs" title="Configura????o"></i>Configura????o <small>da empresa</small></a>
                    </li>
                    
                    <h3 class="menu-title" style="margin-top: -15px;"></h3><!-- /.menu-title -->
                    <li style="background: #383d44;padding-left: 5px;margin-top: 10px;padding-right: 5px;border-radius: 3px;">
                        <a href="#" data-toggle="modal" data-target="#staticModal" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-sign-out text-light" title="Sair"></i><span>Sair</span></a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->
    
    <div class="modal fade" id="expediente" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-light">
                    <h5 class="modal-title" id="mediumModalLabel">Expediente Bluesun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>A Bluesun atende de:</p>
                    <ul style="">
                        <li style="list-style-type: none;"><b>Segunda-Feira - </b>das 8h ??s 17h30</li>
                        <li style="list-style-type: none;"><b>Ter??a-Feira - </b>das 8h ??s 17h30</li>
                        <li style="list-style-type: none;"><b>Quarta-Feira - </b>das 8h ??s 17h30</li>
                        <li style="list-style-type: none;"><b>Quinta-Feira - </b>das 8h ??s 17h30</li>
                        <li style="list-style-type: none;"><b>Sexta-Feira - </b>das 8h ??s 17h30</li><hr/>
                        <li style="list-style-type: none;"><b>S??bado - </b>N??o h?? expediente</li>
                        <li style="list-style-type: none;"><b>Domingo - </b>N??o h?? expediente</li>
                    </ul><hr/>
                    <div>
                        <p class=" float-left">N??o h?? Expediente aos Feriados</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="instrucoes" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-light">
                    <h5 class="modal-title" id="mediumModalLabel">Instru????es de uso da nova plataforma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="instrucoes">A Bluesun do Brasil desenvolveu esta nova plataforma afim de facilitar o dia a dia de nossos integradores e franqueados.</p>
                    <p class="instrucoes">Esta completa plataforma tem muitas fun????es complexas e autom??ticas com interface intuitiva para que, na hora de gerar um or??amento, voc?? n??o precise sequer de uma calculadora ao seu lado.</p>
                    <p class="instrucoes">Para que voc?? conhe??a todas as ferramentas desta plataforma, criamos um v??deo tutorial dividido em 4 cap??tulos.</p>
                    <p class="instrucoes">Aproveite!</p>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body" style="border: 1px solid #B5B5B5;">
                                <div class="embed-container mb-0" style="margin-top: -10px;">
                                    <iframe src="https://player.vimeo.com/video/403305600" width="900" height="506" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body" style="border: 1px solid #B5B5B5;">
                                <div class="embed-container mb-0" style="margin-top: -10px;">
                                    <iframe src="https://player.vimeo.com/video/403310197" width="900" height="506" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body" style="border: 1px solid #B5B5B5;">
                                <div class="embed-container mb-0" style="margin-top: -10px;">
                                    <iframe src="https://player.vimeo.com/video/403309404" width="900" height="506" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body" style="border: 1px solid #B5B5B5;">
                                <div class="embed-container mb-0" style="margin-top: -10px;">
                                    <iframe src="https://player.vimeo.com/video/403309019" width="900" height="506" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p><a href="./datasheets/documento_tecnico.pdf" target="_blank">Baixe o Documento T??cnico da Bluesun do Brasil</a></p>
                </div>
            </div>
        </div>
    </div>