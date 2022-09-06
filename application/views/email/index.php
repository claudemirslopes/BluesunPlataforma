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
                    <strong class="card-title" v-if="headerText"><i class="fa fa-envelope"></i> E-mail Box <small>Bluesun (Caixa de Entrada)</small></strong>
<!--                    <a title="Cadastrar novo KB" href="<?php echo base_url('email/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Adicionar KB</a>-->
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
                
                
                    <div class="row">
                        <div class="col-md-2">
                            <!-- BEGIN INBOX MENU -->
                            <a class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#compose-modal" style="color: #fff;"><i class="fa fa-envelope-open" aria-hidden="true"></i>&nbsp;&nbsp;Nova Mensagem</a>

                            <hr>
                            <div>
                                <ul style="list-style:none;">
                                    <li class="header">Folders</li>
                                    <li class="active"><a href="#"><i class="fa fa-inbox" style="color: #0B3861;"></i> Entrada (3)</a></li>
                                    <li><a href="#"><i class="fa fa-star" style="color: #F39C12;"></i> Favoritas</a></li>
                                    <li><a href="#"><i class="fa fa-bookmark" style="color: #E74C3C;"></i> Importante</a></li>
                                    <li><a href="#"><i class="fa fa-mail-forward" style="color: #21610B;"></i> Enviadas</a></li>
                                    <li><a href="#"><i class="fa fa-pencil-square-o" style="color: #B45F04;"></i> Lixeira</a></li>
                                    <li><a href="#"><i class="fa fa-folder" style="color: #DF0101;"></i> Spam (5)</a></li>
                                    <li><hr/></li>
                                    <li><a href="#" style="color: #656565;"><i class="fa fa-sliders" style="color: #151515;"></i> Configurações</a></li>
                                    <li><hr/></li>
                                </ul>
                            </div>
                            <!-- END INBOX MENU -->
                        </div>
                        <div class="col-md-10">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    Ação <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" style="font-size: .8em;">
                                    <li style="padding: 5px;"><a href="#">Marcar como lida</a></li>
                                    <li style="padding: 5px;"><a href="#">Desmarcar como lida</a></li>
                                    <li style="padding: 5px;"><a href="#">Marcar como importante</a></li>
                                    <li style="padding: 5px;color: #333;"><hr/></li>
                                    <li style="padding: 5px;"><a href="#">Reportar spam</a></li>
                                    <li style="padding: 5px;"><a href="#">Apagar</a></li>
                                </ul>
                            </div>
                            <table  class="bootstrap-data-table-export table table-striped table-bordered">
                                <thead class="thead-light" style="display: none;">
                                    <tr>
                                        <th scope="col" style="font-size: .8em;" class="text-center"></th>
                                        <th scope="col" style="font-size: .8em;"></th>
                                        <th scope="col" style="font-size: .8em;"></th>
                                        <th scope="col" style="font-size: .8em;" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center action"><i class="fa fa-star-o"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-bookmark text-danger"></i></td>
                                        <td class="text-secondary"><a href="#">Claudemir da Silva Lopes</a></td>
                                        <td class="text-secondary">Pagamento de fatura em atraso</td>
                                        <td class="text-center text-secondary">20/04/2021 14:00:05</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center action"><i class="fa fa-star text-warning"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-bookmark text-danger"></i></td>
                                        <td class="text-secondary"><a href="#">Eliane Rocha de Freitas Lopes</a></td>
                                        <td class="text-secondary">Erro ao imprimir relatório</td>
                                        <td class="text-center text-secondary">20/04/2021 08:55:02</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center action"><i class="fa fa-star text-warning"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-bookmark"></i></td>
                                        <td class="text-secondary"><a href="#">Almir Rogério Lopes</a></td>
                                        <td class="text-secondary">Problema ao logar no sistema</td>
                                        <td class="text-center text-secondary">20/04/2021 06:32:02</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- BEGIN COMPOSE MESSAGE -->
                <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-wrapper">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-blue">
                                    <h4 class="modal-title"><i class="fa fa-envelope"></i> Novo e-mail</h4>
                                    <button type="button" class="close text-left" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <form action="#" method="post" class="user">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input name="to" type="email" class="form-control form-control-user" placeholder="Para">
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                              <input name="cc" type="email" class="form-control form-control-user" placeholder="Cc">
                                            </div>
                                            <div class="form-group col-md-6">
                                              <input name="bcc" type="email" class="form-control form-control-user" placeholder="Cco">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="subject" type="email" class="form-control form-control-user" placeholder="Assunto">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="message" id="txtMsg" class="form-control form-control-user" placeholder="Mensagem" style="height: 120px;"></textarea>
                                            <script src="vendors/ckeditor/ckeditor.js"></script>
                                              <script>
                                                CKEDITOR.replace( 'txtMsg' );
                                              </script>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-default bg-secondary text-light" type="button" id="loadFileXml" value="Anexar arquivo" onclick="document.getElementById('file').click();" style="width: 100%" ><i class="fa fa-paperclip" aria-hidden="true"></i> Anexar arquivo</button>

                                            <input type="file" style="display:none;" id="file" name="file"/>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Descartar</button>
                                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-envelope"></i> Enviar mensagem</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END COMPOSE MESSAGE -->
            </div>

        </div>
