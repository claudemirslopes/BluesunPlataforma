<style>
    .form-control {
        border: 1px solid #A4A4A4;
    }
    .border {
        border: 1px solid #848484 !important;
    }
    td:hover {
        background: #F5DA81;
        font-weight: bold;
    }
    .port {
        background: #D8D8D8;
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
                    <strong class="card-title" v-if="headerText">Financiamento</strong>
                    <!--<a title="Cadastrar novo vendedor" href="<?php echo base_url('orcamentos/vendedores/add'); ?>" class="btn btn-light btn-sm float-right"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Novo vendedor</a>-->
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
                       <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body card-block">
                                    <form action="<?php $PHP_SELF; ?>" method="post" name="form_simulacao" id="form_simulacao" class="form-horizontal">
                                        <div class="row form-group">
                                            <div class="col col-md-12">
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success">
                                                            R$
                                                        </button>
                                                    </div>
                                                    <input type="text" name="valor" id="valor" value="" placeholder="Digite o valor do financiamento" onKeyPress="Mascara(this,ValorVirgula);" onKeyDown="Mascara(this,ValorVirgula);" onKeyUp="Mascara(this,ValorVirgula);" maxlength="14" class="form-control">
                                                    <div class="input-group-btn">
                                                        <input type="button" class="btn btn-danger" value="Simular" onclick="document.form_simulacao.submit();">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <?php 
                                
                                    if (isset($_POST['valor'])) {
                                        if ($_POST['valor'] != "") {

                                            $valor = addslashes($_POST['valor']);
                                            $valor = (int)$valor+350;//TAC
                                            $valor_puro = $_POST['valor'];//TAC
                                            $valor = str_replace(',', '.', $valor);
                                            $valor_puro = str_replace(',', '.', $valor_puro);

                                            //SEM ENTRADA 90 dias
                                            $parcela12x = calcParcelaJuros($valor, 12, 1.78);
                                            $parcela24x = calcParcelaJuros($valor, 24, 1.56);
                                            $parcela36x = calcParcelaJuros($valor, 36, 1.58);
                                            $parcela48x = calcParcelaJuros($valor, 48, 1.61);
                                            $parcela60x = calcParcelaJuros($valor, 60, 1.62);

                                            //SEM ENTRADA 30 dias
                                            $parcela12x_30 = calcParcelaJuros($valor, 12, 1.61);
                                            $parcela24x_30 = calcParcelaJuros($valor, 24, 1.44);
                                            $parcela36x_30 = calcParcelaJuros($valor, 36, 1.40);
                                            $parcela48x_30 = calcParcelaJuros($valor, 48, 1.44);
                                            $parcela60x_30 = calcParcelaJuros($valor, 60, 1.45);

                                            //COM ENTRADA 12x
                                            $valor_entrada12_01     = (3.91/100)*$valor_puro;
                                            $parcela_entrada12_01   = calcParcelaJuros($valor, 12, 1.31);

                                            $valor_entrada12_02     = (9.97/100)*$valor_puro;
                                            $parcela_entrada12_02   = calcParcelaJuros($valor, 12, 0.02);

                                            //COM ENTRADA 24x
                                            $valor_entrada24_01     = (16.48/100)*$valor_puro;
                                            $parcela_entrada24_01   = calcParcelaJuros($valor, 24, 0);

                                            $valor_entrada24_02     = (5.33/100)*$valor_puro;
                                            $parcela_entrada24_02   = calcParcelaJuros($valor, 24, 1.16);

                                            $valor_entrada24_03     = (8.57/100)*$valor_puro;
                                            $parcela_entrada24_03   = calcParcelaJuros($valor, 24, 0.84);

                                            //COM ENTRADA 36x
                                            $valor_entrada36_01     = (22.62/100)*$valor_puro;
                                            $parcela_entrada36_01   = calcParcelaJuros($valor, 36, 0);

                                            $valor_entrada36_02     = (6.97/100)*$valor_puro;
                                            $parcela_entrada36_02   = calcParcelaJuros($valor, 36, 1.11);

                                            $valor_entrada36_03     = (6.14/100)*$valor_puro;
                                            $parcela_entrada36_03   = calcParcelaJuros($valor, 36, 1.17);

                                            //COM ENTRADA 48x
                                            $valor_entrada48_01     = (17.90/100)*$valor_puro;
                                            $parcela_entrada48_01   = calcParcelaJuros($valor, 48, 0.65);

                                            $valor_entrada48_02     = (9.73/100)*$valor_puro;
                                            $parcela_entrada48_02   = calcParcelaJuros($valor, 48, 1.08);

                                            $valor_entrada48_03     = (5.04/100)*$valor_puro;
                                            $parcela_entrada48_03   = calcParcelaJuros($valor, 48, 1.33);

                                            //COM ENTRADA 60x
                                            $valor_entrada60_01     = (16.83/100)*$valor_puro;
                                            $parcela_entrada60_01   = calcParcelaJuros($valor, 60, 0.85);

                                            $valor_entrada60_02     = (11.91/100)*$valor_puro;
                                            $parcela_entrada60_02   = calcParcelaJuros($valor, 60, 1.07);

                                            $valor_entrada60_03     = (4.24/100)*$valor_puro;
                                            $parcela_entrada60_03   = calcParcelaJuros($valor, 60, 1.39);

                                            $mostra = 1;



                                        } else{
                                            $this->session->set_flashdata('error', 'O campo "VALOR DO FINANCIAMENTO" está vazio!');
                                            redirect('orcamentos/financiamentos');
                                            $mostra = 0;
                                        }
                                    } else{
                                        $mostra = 0;
                                    }
                                    function calcParcelaJuros($valor_total,$parcelas,$juros=0) {
                                        if($juros==0){
                                           $string = 'PARCELA - VALOR <br />';
                                           for($i=1;$i<($parcelas+1);$i++){
                                              $string = number_format($valor_total/$parcelas, 2, ",", ".");
                                           }
                                           return $string;
                                        }else{
                                           $string = 'PARCELA - VALOR <br />';
                                           for($i=1;$i<($parcelas+1);$i++){
                                              $I =$juros/100.00;
                                              $valor_parcela = $valor_total*$I*pow((1+$I),$parcelas)/(pow((1+$I),$parcelas)-1);
                                              $string = number_format($valor_parcela, 2, ",", ".");
                                           }
                                           return $string;
                                        }
                                     }
                                    if ($mostra == 1): 
                                ?>
                                <div class="card-footer">
                                    <h4>Fianciamento sem entrada <span class="bg-warning text-light font-weight-bold p-1">(30 dias de carência)</span></h4>
                                    <p>Simulações pela BV Financeira</p>
                                    <table class="table table-striped">
                                        <thead>
                                          <tr class="bg-info text-light">
                                            <th scope="col" class="text-center border">Parcelas</th>
                                            <th scope="col" class="text-center border">12x</th>
                                            <th scope="col" class="text-center border">24x</th>
                                            <th scope="col" class="text-center border">36x</th>
                                            <th scope="col" class="text-center border">48x</th>
                                            <th scope="col" class="text-center border">60x</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row"></th>
                                            <td class="text-center border"><?php echo 'R$ '.$parcela12x_30 ?></td>
                                            <td class="text-center border"><?php echo 'R$ '.$parcela24x_30; ?></td>
                                            <td class="text-center border"><?php echo 'R$ '.$parcela36x_30; ?></td>
                                            <td class="text-center border"><?php echo 'R$ '.$parcela48x_30; ?></td>
                                            <td class="text-center border"><?php echo 'R$ '.$parcela60x_30; ?></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    <hr/>
                                    <h4>Fianciamento sem entrada <span class="bg-warning text-light font-weight-bold p-1">(90 dias de carência)</span></h4>
                                    <p>Simulações pela BV Financeira</p>
                                    <table class="table table-striped">
                                        <thead>
                                          <tr class="bg-primary text-light">
                                            <th scope="col" class="text-center border">Parcelas</th>
                                            <th scope="col" class="text-center border">12x</th>
                                            <th scope="col" class="text-center border">24x</th>
                                            <th scope="col" class="text-center border">36x</th>
                                            <th scope="col" class="text-center border">48x</th>
                                            <th scope="col" class="text-center border">60x</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row"></th>
                                            <td class="text-center border"><?php echo 'R$ '.$parcela12x; ?></td>
                                            <td class="text-center border"><?php echo 'R$ '.$parcela12x; ?></td>
                                            <td class="text-center border"><?php echo 'R$ '.$parcela12x; ?></td>
                                            <td class="text-center border"><?php echo 'R$ '.$parcela12x; ?></td>
                                            <td class="text-center border"><?php echo 'R$ '.$parcela12x; ?></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    <hr/>
                                    <h4>Fianciamento com entrada <span class="bg-warning text-light font-weight-bold p-1">(90 dias de carência)</span></h4>
                                    <p>Simulações pela BV Financeira</p>
                                    <table class="table table-striped">
                                        <thead>
                                          <tr class="bg-dark text-light text-center">
                                            <td class="bg-light"></td>
                                            <th class="bg-secondary border">Entrada</th>
                                            <th class="bg-secondary border">Parcela</th>
                                            <th class="bg-dark border">Entrada</th>
                                            <th class="bg-dark border">Parcela</th>
                                            <th class="bg-secondary border">Entrada</th>
                                            <th class="bg-secondary border">Parcela</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="col" class="bg-dark text-light text-center">12x</th>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada12_01,2,',','.')."<br>(3,91%)"; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada12_01; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada12_02,2,',','.')."<br>(9,97%)"; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada12_02; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;">Indisponível</td>
                                                <td class="border text-center" style="vertical-align: middle;">Indisponível</td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="bg-dark text-light text-center">24x</th>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada24_01,2,',','.')."<br>(16,48%)"; ?></td>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada24_01; ?></td>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada24_02,2,',','.')."<br>(5,33%)"; ?></td>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada24_02; ?></td>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada24_03,2,',','.')."<br>(8,57%)"; ?></td>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada24_03; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="bg-dark text-light text-center">36x</th>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada36_01,2,',','.')."<br>(22,62%)"; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada36_01; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada36_02,2,',','.')."<br>(6,97%)"; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada36_02; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada36_03,2,',','.')."<br>(6,14%)"; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada36_03; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="bg-dark text-light text-center">48x</th>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada48_01,2,',','.')."<br>(17,90%)"; ?></td>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada48_01; ?></td>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada48_02,2,',','.')."<br>(9,73%)"; ?></td>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada48_02; ?></td>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada48_03,2,',','.')."<br>(5,04%)"; ?></td>
                                                <td class="border text-center port" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada48_03; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="bg-dark text-light text-center">60x</th>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada60_01,2,',','.')."<br>(16,83%)"; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada60_01; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada60_02,2,',','.')."<br>(11,91%)"; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada60_02; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.number_format($valor_entrada60_03,2,',','.')."<br>(4,24%)"; ?></td>
                                                <td class="border text-center" style="vertical-align: middle;"><?php echo 'R$ '.$parcela_entrada60_03; ?></td>
                                            </tr>
                                        </tbody>
                                      </table>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
