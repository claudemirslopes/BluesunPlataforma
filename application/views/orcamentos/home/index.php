
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
                            <li class="active" style="color: #47AA0B;">Home</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .notifica {
                color: #ffffff;
                text-align: justify;
                float: left;
            }
            .notifica a {
                color: #FFFF00;
            }
            .notifica a:hover {
                color: #fff;
            }
            #cortexto p {
                color: #fff !important;
                font-size: 1.1em !important;
            }
        </style>
                    
        <!-- Início do lado A | Avisos para os clientes franqueados ou integradores -->
        <div class="content mt-1 col-lg-8">
            <div class="card">
                <div class="card-header bg-danger text-light">
                    <strong class="card-title" v-if="headerText">Avisos da Plataforma de Orçamentos</strong>
                </div>
                <div class="card-body" style="border: 1px solid #A4A4A4;border-top: none;">
                    <!-- Mensagem de sucesso -->
                    <?php if ($message = $this->session->flashdata('sucesso')): ?>
                        <div class="alert alert-success alert-dismissible fade show " role="alert">
                            <span class="badge badge-pill badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Sucesso</span>&nbsp;&nbsp;
                             <?php echo $message; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <!-- Mensagem de sucesso -->
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
                    
                    <?php foreach ($avisos_home as $avisado): ?>
                    <?php if($avisado->avisado_tipo == 1 && $avisado->avisado_ativa == 1 || $avisado->avisado_tipo == 2 && $avisado->avisado_ativa == 1): ?>
                    <!-- Condição para mensagem em formato de vídeo -->
                    <?php if($avisado->avisado_formato == 1) { ?>
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="card">
                           <div class="card-header bg-secondary text-light">
                               <h4 style="font-size: 1.1em;"><?php echo $avisado->avisado_assunto; ?></h4>                            
                           </div> 
                            <div class="card-body" style="border: 1px solid #B5B5B5;">
                                <div class="embed-container mb-0" style="margin-top: -10px;">
                                    <?php echo htmlspecialchars_decode($avisado->avisado_mensagem); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Condição para mensagem em texto -->
                    <?php } elseif($avisado->avisado_formato == 0) { ?>
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="card">
                           <div class="card-header bg-secondary text-light">
                               <h4 style="font-size: 1.1em;"><?php echo $avisado->avisado_assunto; ?></h4>                          
                           </div> 
                            <div class="card-body" style="border: 1px solid #B5B5B5;">
                                <span id=""><?php echo word_limiter($avisado->avisado_mensagem, 100) ?><br/> <a class="btn btn-info btn-sm float-right" href="javascript(void)" data-toggle="modal" data-target="#avisoModal-<?php echo $avisado->avisado_id; ?>">LER AVISO COMPLETO</a></span>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                    <!-- Condição para mensagem de imagem -->
                    <div class="col-md-12 pl-0 pr-0">
                        <div class="card">
                           <div class="card-header bg-secondary text-light">
                               <h4 style="font-size: 1.1em;"><?php echo $avisado->avisado_assunto; ?></h4>                          
                           </div> 
                            <div class="card-body" style="border: 1px solid #B5B5B5;">
                                <a href="javascript(void)" data-toggle="modal" data-target="#avisoModal2-<?php echo $avisado->avisado_id; ?>"><span id=""><?php echo $avisado->avisado_mensagem; ?></span></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php endif; ?>
                    <?php endforeach; ?>
                    
                </div>
            </div>
            <?php foreach ($avisos_home as $avisado): ?>
            <div class="modal fade" style="background: rgba(52,58,64, 0.7);" id="avisoModal-<?php echo $avisado->avisado_id; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content bg-light">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title text-light" id="staticModalLabel" style="font-size: 1.2em;"><?php echo $avisado->avisado_assunto; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php echo $avisado->avisado_mensagem; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php foreach ($avisos_home as $avisado): ?>
            <div class="modal fade" id="avisoModal2-<?php echo $avisado->avisado_id; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <?php echo $avisado->avisado_mensagem; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- Fim do lado A | Avisos para os clientes franqueados ou integradores -->
        
        <!-- Início do lado B | Dashboard para os franqueados e integradores -->
        <div class="content mt-1 col-lg-4 pl-0">
            <div class="card">
                <div class="card-header" style="background: #cdcdcd;">
                    <strong class="card-title" v-if="headerText">Dashboard</strong>
                </div>
                <div class="card-body" style="border: 1px solid #A4A4A4;">
                    <div class="col-sm-12">
                        <div class="card">
                            <a href="orcamentos/add_p1" class="btn btn-primary btn-sm" style="font-weight: bold"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;CRIAR ORÇAMENTO</a>
                        </div>
                    </div>
                    
                    <!-- Contador para verificar orçamentos realizados pelo franqueado -->
                   <div class="col-sm-12">
                        <div class="card text-white bg-flat-color-8 imagem3">
                            <div class="card-body pb-0">
                                <div class="dropdown float-right">
                                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                                        <i class="fa fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <div class="dropdown-menu-content" style="color: #FF6900;">
                                            <a class="dropdown-item" href="">Ver Todos</a>
                                            <a class="dropdown-item" href="">Adicionar</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-0">
                                    <span style="font-size: .8em;"><i class="fa fa-list-alt" aria-hidden="true"></i> Orçamentos</span><hr/>
                                    <center><span class="count">0</span></center>
                                </h4>
                                <p class="text-light" style="text-align: center;">realizados</p>
                            </div>
                        </div>
                    </div>
                    <!-- Contador para verificar orçamentos concluídos -->
                    <div class="col-sm-12">
                        <div class="card text-white bg-flat-color-7 imagem3">
                            <div class="card-body pb-0">
                                <div class="dropdown float-right">
                                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                                        <i class="fa fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <div class="dropdown-menu-content">
                                            <a class="dropdown-item" href="">Ver todos</a>
                                            <a class="dropdown-item" href="">Adicionar</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-0">
                                    <span style="font-size: .8em;"><i class="fa fa-money" aria-hidden="true"></i> Pedidos</span><hr/>
                                    <center><span class="count">0</span></center>
                                </h4>
                                <p class="text-light" style="text-align: center;">concluídos</p>
                            </div>
                        </div>
                    </div>
                    <!-- Contador para verificar clientes cadastrados na área do franqueado -->
                    <div class="col-sm-12">
                        <div class="card text-white bg-flat-color-6 imagem3">
                            <div class="card-body pb-0">
                                <div class="dropdown float-right">
                                    <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                                        <i class="fa fa-cog"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <div class="dropdown-menu-content">
                                            <a class="dropdown-item" href="">Ver Todos</a>
                                            <a class="dropdown-item" href="">Adicionar</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mb-0">
                                    <span style="font-size: .8em;"><i class="fa fa-users" aria-hidden="true"></i> Clientes</span><hr/>
                                    <center><span class="count"></span>5</center>
                                </h4>
                                <p class="text-light" style="text-align: center;">cadastrados</p>
                            </div>
                        </div>
                    </div>
                    
                </div>  
            </div>
        </div>
        <!-- Início do lado B | Dashboard para os franqueados e integradores -->
        