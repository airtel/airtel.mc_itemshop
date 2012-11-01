
            </div> <!-- close content -->
                
            <div class="banner_holder"><a href="http://airtel.lv" target="_blank"><img alt="airtel" src="<?php echo base_url(); ?>img/art.png"></a></div>
            <div style="clear: both;"></div>
            
        </div> <!-- close wrapper -->
        
    </div> <!-- close container -->
    
    
    <?php 
    /**
     * Remove this if you want
     */
    if($this->config->item('iframe_mode') != TRUE)
        echo '<br /><br />';
    ?>
    
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-1.8.2.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

    <!-- Chosen select -->
    <script src="<?php echo base_url(); ?>lib/chosen/chosen.jquery.js"></script>    
    
    <!-- Jquery validation -->
    <script src="<?php echo base_url(); ?>lib/validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>lib/validation/localization/messages_lv.js"></script>
    
    <!-- Smokejs -->
    <script src="<?php echo base_url(); ?>lib/smoke/smoke.js"></script>
    
    <!-- Variables -->
    <script>
        var iframe_mode = <?php echo ($this->config->item('iframe_mode')) ? 'true' : 'false'; ?>;
        var base_url = '<?php echo base_url(); ?>';
        var site_url = '<?php echo site_url(); ?>';
        var category_id = '<?php echo $this->module->active_category; ?>';
        var active_method = '<?php echo $this->module->active_method ; ?>';
    
        // Payment variables
        var short_number = '<?php echo $this->config->item('short_number'); ?>';
        var base_keyword = '<?php echo $this->config->item('base_keyword'); ?>';
        var default_prices = <?php echo json_encode($this->module->sms_prices); ?>;
        var pay_methods = <?php echo json_encode($this->config->item('minecraft_payments')); ?>;    
    
    </script>
    
    <!-- Airtel -->
    <script src="<?php echo base_url(); ?>js/airtel.init.js"></script>
    <script src="<?php echo base_url(); ?>js/airtel.validation.js"></script>
    <script src="<?php echo base_url(); ?>js/airtel.iframe.js"></script>
    
    <script>
        $(document).ready(function() {
            
            setTimeout(function() {
                $('.content, .banner_holder').hide();
                $('html').removeClass('js');
                $('.content, .banner_holder').fadeIn(400);
            }, 700);
            
        });
    </script>
    
</body>
</html>