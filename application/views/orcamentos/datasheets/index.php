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
                    
        <!-- content -->
        <div class="content mt-1">
            <div class="card">
                <div class="card-header bg-secondary text-light">
                    <strong class="card-title" v-if="headerText">Datasheets</strong>
                    <!--<a title="Cadastrar datasheet" href="<?php echo base_url('orcamentos/datasheets/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Novo datasheet</a>-->
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

                    <div id="accordion">
                        <div class="card" style="border: 1px solid #B5B5B5;">
                            <div class="card-header" id="headingOne" style="padding: 0;">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Datasheets dos Painéis ULICA
                              </button>
                            </h5>
                          </div>
                          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                              <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nome</th>
                                        <th class="text-center">Ativo</th>
                                        <th class="text-right" style="padding-right: 10px;">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datasheets as $datasheet): ?>
                                    <?php if ($datasheet->datasheet_tipo == 'ULICA'): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $datasheet->datasheet_id; ?></td>
                                        <td><?php echo '<a href="" target="" class="text-dark">'.$datasheet->datasheet_nome.'</a>'; ?></td>
                                        <td class="text-center">
                                            <?php echo $datasheet->datasheet_ativo == 1 ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>' ?>
                                        </td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url('datasheets/edit/'.$datasheet->datasheet_id); ?>" class="btn btn-sm btn-danger" title="Baixar PDF"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Baixar PDF</a>
                                            
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="datasheet-<?php echo $datasheet->datasheet_id; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticModalLabel">Excluír arquivo datasheet</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Deseja mesmo excluír este arquivo?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <a href="<?php echo base_url('datasheets/del/'.$datasheet->datasheet_id); ?>" class="btn btn-danger btn-sm">Confirmar</a>
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
                        <div class="card" style="border: 1px solid #B5B5B5;">
                          <div class="card-header" id="headingTwo" style="padding: 0;">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Datasheets dos Painéis Canadian Hiku
                              </button>
                            </h5>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                              <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nome</th>
                                        <th class="text-center">Ativo</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datasheets as $datasheet): ?>
                                    <?php if ($datasheet->datasheet_tipo == 'CANADIAN'): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $datasheet->datasheet_id; ?></td>
                                        <td><?php echo $datasheet->datasheet_nome; ?></td>
                                        <td class="text-center">
                                            <?php echo $datasheet->datasheet_ativo == 1 ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>' ?>
                                        </td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url('datasheets/edit/'.$datasheet->datasheet_id); ?>" class="btn btn-sm btn-secondary" title="Baixar PDF"><i class="fa fa-file-pdf-o"></i></a>
                                            
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="datasheet-<?php echo $datasheet->datasheet_id; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticModalLabel">Excluír arquivo datasheet</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Deseja mesmo excluír este arquivo?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <a href="<?php echo base_url('datasheets/del/'.$datasheet->datasheet_id); ?>" class="btn btn-danger btn-sm">Confirmar</a>
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
                        <div class="card" style="border: 1px solid #B5B5B5;">
                          <div class="card-header" id="headingThree" style="padding: 0;">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Datasheets dos Painéis ZNShine Solar
                              </button>
                            </h5>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                              <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nome</th>
                                        <th class="text-center">Ativo</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datasheets as $datasheet): ?>
                                    <?php if ($datasheet->datasheet_tipo == 'ZNSHINE'): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $datasheet->datasheet_id; ?></td>
                                        <td><?php echo $datasheet->datasheet_nome; ?></td>
                                        <td class="text-center">
                                            <?php echo $datasheet->datasheet_ativo == 1 ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>' ?>
                                        </td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url('datasheets/edit/'.$datasheet->datasheet_id); ?>" class="btn btn-sm btn-secondary" title="Baixar PDF"><i class="fa fa-file-pdf-o"></i></a>
                                            
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="datasheet-<?php echo $datasheet->datasheet_id; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticModalLabel">Excluír arquivo datasheet</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Deseja mesmo excluír este arquivo?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <a href="<?php echo base_url('datasheets/del/'.$datasheet->datasheet_id); ?>" class="btn btn-danger btn-sm">Confirmar</a>
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
                        <div class="card" style="border: 1px solid #B5B5B5;">
                          <div class="card-header" id="headingFour" style="padding: 0;">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Inversores Fronius
                              </button>
                            </h5>
                          </div>
                          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                              <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nome</th>
                                        <th class="text-center">Ativo</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datasheets as $datasheet): ?>
                                    <?php if ($datasheet->datasheet_tipo == 'FRONIUS'): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $datasheet->datasheet_id; ?></td>
                                        <td><?php echo $datasheet->datasheet_nome; ?></td>
                                        <td class="text-center">
                                            <?php echo $datasheet->datasheet_ativo == 1 ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>' ?>
                                        </td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url('datasheets/edit/'.$datasheet->datasheet_id); ?>" class="btn btn-sm btn-secondary" title="Baixar PDF"><i class="fa fa-file-pdf-o"></i></a>
                                            
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="datasheet-<?php echo $datasheet->datasheet_id; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticModalLabel">Excluír arquivo datasheet</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Deseja mesmo excluír este arquivo?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <a href="<?php echo base_url('datasheets/del/'.$datasheet->datasheet_id); ?>" class="btn btn-danger btn-sm">Confirmar</a>
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
                        <div class="card" style="border: 1px solid #B5B5B5;">
                          <div class="card-header" id="headingFive" style="padding: 0;">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Inversores SAJ
                              </button>
                            </h5>
                          </div>
                          <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                              <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nome</th>
                                        <th class="text-center">Ativo</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datasheets as $datasheet): ?>
                                    <?php if ($datasheet->datasheet_tipo == 'SAJ'): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $datasheet->datasheet_id; ?></td>
                                        <td><?php echo $datasheet->datasheet_nome; ?></td>
                                        <td class="text-center">
                                            <?php echo $datasheet->datasheet_ativo == 1 ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>' ?>
                                        </td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url('datasheets/edit/'.$datasheet->datasheet_id); ?>" class="btn btn-sm btn-secondary" title="Baixar PDF"><i class="fa fa-file-pdf-o"></i></a>
                                            
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="datasheet-<?php echo $datasheet->datasheet_id; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticModalLabel">Excluír arquivo datasheet</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Deseja mesmo excluír este arquivo?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <a href="<?php echo base_url('datasheets/del/'.$datasheet->datasheet_id); ?>" class="btn btn-danger btn-sm">Confirmar</a>
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
                        <div class="card" style="border: 1px solid #B5B5B5;">
                          <div class="card-header" id="headingSix" style="padding: 0;">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Catálogo da FotoFix
                              </button>
                            </h5>
                          </div>
                          <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body">
                              <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nome</th>
                                        <th class="text-center">Ativo</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datasheets as $datasheet): ?>
                                    <?php if ($datasheet->datasheet_tipo == 'FOTOFIX'): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $datasheet->datasheet_id; ?></td>
                                        <td><?php echo $datasheet->datasheet_nome; ?></td>
                                        <td class="text-center">
                                            <?php echo $datasheet->datasheet_ativo == 1 ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>' ?>
                                        </td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url('datasheets/edit/'.$datasheet->datasheet_id); ?>" class="btn btn-sm btn-secondary" title="Baixar PDF"><i class="fa fa-file-pdf-o"></i></a>
                                            
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            </div>
                          </div>
                        </div>
                        <div class="card" style="border: 1px solid #B5B5B5;">
                          <div class="card-header" id="headingSeven" style="padding: 0;">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                String Box ProAuto
                              </button>
                            </h5>
                          </div>
                          <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                            <div class="card-body">
                              <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nome</th>
                                        <th class="text-center">Ativo</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datasheets as $datasheet): ?>
                                    <?php if ($datasheet->datasheet_tipo == 'PROAUTO'): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $datasheet->datasheet_id; ?></td>
                                        <td><?php echo $datasheet->datasheet_nome; ?></td>
                                        <td class="text-center">
                                            <?php echo $datasheet->datasheet_ativo == 1 ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>' ?>
                                        </td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url('datasheets/edit/'.$datasheet->datasheet_id); ?>" class="btn btn-sm btn-secondary" title="Baixar PDF"><i class="fa fa-file-pdf-o"></i></a>
                                            
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="datasheet-<?php echo $datasheet->datasheet_id; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticModalLabel">Excluír arquivo datasheet</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Deseja mesmo excluír este arquivo?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <a href="<?php echo base_url('datasheets/del/'.$datasheet->datasheet_id); ?>" class="btn btn-danger btn-sm">Confirmar</a>
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
                        <div class="card" style="border: 1px solid #B5B5B5;">
                          <div class="card-header" id="headingEight" style="padding: 0;">
                            <h5 class="mb-0">
                              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                  Catálogo MetalLight <small>Estrutura de solo monoposte em aço galvanizado</small>
                              </button>
                            </h5>
                          </div>
                          <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                            <div class="card-body">
                              <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nome</th>
                                        <th class="text-center">Ativo</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($datasheets as $datasheet): ?>
                                    <?php if ($datasheet->datasheet_tipo == 'METALLIGHT'): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $datasheet->datasheet_id; ?></td>
                                        <td><?php echo $datasheet->datasheet_nome; ?></td>
                                        <td class="text-center">
                                            <?php echo $datasheet->datasheet_ativo == 1 ? '<span class="badge badge-success btn-sm">Sim</span>' : '<span class="badge badge-danger btn-sm">Não</span>' ?>
                                        </td>
                                        <td class="text-right">
                                            <a href="<?php echo base_url('datasheets/edit/'.$datasheet->datasheet_id); ?>" class="btn btn-sm btn-secondary" title="Baixar PDF"><i class="fa fa-file-pdf-o"></i></a>
                                            
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="datasheet-<?php echo $datasheet->datasheet_id; ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticModalLabel">Excluír arquivo datasheet</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Deseja mesmo excluír este arquivo?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                                    <a href="<?php echo base_url('datasheets/del/'.$datasheet->datasheet_id); ?>" class="btn btn-danger btn-sm">Confirmar</a>
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
                      </div>
                </div>

            </div>

        </div>
        