    <!-- PAINEL ESQUERDO - LATERAL -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header mt-1">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('home'); ?>"><img src="<?php echo base_url('public/images/logo_bsum2a.png'); ?>" alt="Bluesum" style="max-width: 100% !important;"></a>
                <a class="navbar-brand hidden" href="<?php echo base_url('home'); ?>"><img src="<?php echo base_url('public/images/logo_bsum02.png'); ?>" alt="Bluesum"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav" style="margin-top: 10px;">
                    <li class="active">
                        <a href="<?php echo base_url('/'); ?>"> <i class="menu-icon fa fa-home" title="Início"></i>Home</a>
                    </li>
                    <h3 class="menu-title" style="margin-top: -15px;"><a class="h3tit" href="">Cadastros</a></h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users" title="Realizados"></i>Pessoas</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-user-circle-o" title="Autorizados"></i><a href="<?php echo base_url('clientes'); ?>" class="pop">Autorizados</a></li>
                            <li><i class="fa fa-user-secret" title="Vendedores"></i><a href="<?php echo base_url('vendedores'); ?>">Vendedores</a></li>
                            <?php $group = array(1, 3); if ($this->ion_auth->in_group($group)): ?>
                            <li><i class="fa fa-thumb-tack" title="Fornecedores"></i><a href="<?php echo base_url('fornecedores'); ?>">Fornecedores</a></li>
                            <li><i class="fa fa-user-plus" title="Colaboradores"></i><a href="<?php echo base_url('usuarios'); ?>">Colaboradores</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php $group = array(1, 3); if ($this->ion_auth->in_group($group)): ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive" title="Concluídos"></i>Estoque</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-cart-plus" title="Produtos"></i><a href="<?php echo base_url('produtos'); ?>">Produtos</a></li>
                            <li><i class="fa fa-copyright" title="Marcas"></i><a href="<?php echo base_url('marcas'); ?>">Marcas</a></li>
                            <li><i class="fa fa-list-alt" title="Categorias"></i><a href="<?php echo base_url('categorias'); ?>">Categorias</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo base_url('servicos'); ?>" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-server" title="Serviços"></i>Serviços</a>
                    </li>
                    
                    <?php if ($this->ion_auth->is_admin()): ?>
                    <h3 class="menu-title" style="margin-top: -15px;"><a class="h3tit" href="">Financeiro</a></h3><!-- /.menu-title -->

                    <li>
                        <a href="<?php echo base_url('contas_pagar'); ?>"><i class="menu-icon fa fa-credit-card" title="Contas a pagar"></i>Contas <small>a pagar</small></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('contas_receber'); ?>"><i class="menu-icon fa fa-credit-card-alt" title="Contas a receber"></i>Contas <small>a receber</small></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('modulo'); ?>"><i class="menu-icon fa fa-money" title="Projetos"></i>Formas <small>de pagamentos</small></a>
                    </li>
                    <?php endif; ?>
                    
                    <h3 class="menu-title" style="margin-top: -15px;"><a class="h3tit" href="">Orçamentos</a></h3><!-- /.menu-title -->
                    
                    <li>
                        <a href="<?php echo base_url('os'); ?>" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-list" title="OS"></i>Pedidos</a>
                    </li>

                    <li>
                        <a href="<?php echo base_url('vendas'); ?>" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cart-arrow-down" title="Vendas"></i>Vendas</a>
                    </li>

                    <h3 class="menu-title" style="margin-top: -15px;"><a class="h3tit" href="">Ferramentas</a></h3><!-- /.menu-title -->
                    <li style="background: #FE2E2E;padding-left: 5px;margin-top: 10px;padding-right: 5px;border-radius: 3px;">
                        <a href="<?php echo base_url('kb'); ?>" style="color: #fff !important;"> <i class="menu-icon fa fa-database text-light" title="Base do conhecimento"></i>Base <small>de conhecimento</small></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('tickets'); ?>" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-ticket" title="Tickets"></i>Tickets <small>(chamados)</small></a>
                    </li>
                    <?php $group = array(1, 3); if ($this->ion_auth->in_group($group)): ?>
                    <li>
                        <a href="<?php echo base_url('sistema'); ?>" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs" title="Configuração"></i>Configuração <small>da empresa</small></a>
                    </li>
                    <?php endif; ?>
                    
                    <h3 class="menu-title" style="margin-top: -15px;"></h3><!-- /.menu-title -->
                    <li style="background: #383d44;padding-left: 5px;margin-top: 10px;padding-right: 5px;border-radius: 3px;">
                        <a  href="#" data-toggle="modal" style="color: #fff !important;" data-target="#staticModal" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-sign-out text-light" title="Sair"></i>Sair</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->