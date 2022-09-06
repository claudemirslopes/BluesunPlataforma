        <!-- content -->
        <!-- MAIN CONTENT - CONTEÚDO PRINCIPAL -->
        
        <!-- SESSÃO COPYRIGHT -->
        <?php $this->load->view('layout/copyright') ?>
        <!-- SESSÃO COPYRIGHT -->
        
    </div><!-- /#right-panel -->

    <!-- BARRA DIREITA --> 
    
    <script src="https://kit.fontawesome.com/a8568f4b07.js" crossorigin="anonymous"></script>
    <!--<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>-->
    <script src="<?php echo base_url('public/vendors/jquery/dist/jquery-3.0.0.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/vendors/popper.js/dist/umd/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/util.js'); ?>"></script>
    <script src="<?php echo base_url('public/assets/js/main.js'); ?>"></script>
    
    <?php if (isset($scripts)): ?>
    
        <?php foreach ($scripts as $script): ?>
    
            <script src="<?php echo base_url('public/'.$script); ?>"></script>
    
        <?php endforeach; ?>
    
    <?php endif; ?>

</body>

</html>