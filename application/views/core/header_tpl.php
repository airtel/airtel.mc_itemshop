<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Airtel minecraft itemshop</title>
    <meta name="keywords" content="sms, premium sms, sms transport, unlock code, mobīlie maksājumi, sms keywords, ibank, paypal, mobile services, gateway, maksas sms, sms izsūtīšana, loteriju organizēšāna, loteriju norise, izlozes, aktivācijas kodi, unlock kodi, sms abonēšana, sms saņemšana un nosūtīšana, sms tarifikācija, sms tranzākcija, sms kods, sms čats, sms balsošana, sms viktorīna, konkurss, loterija, sms pakalpojumi, sms serveris, mobilais mārketings" />
    <meta name="robots" content="index, follow" />
    
    <!-- Custom header font -->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=PT+Sans&subset=latin" />
    
     <!-- Loading css styles -->
    <style type="text/css">
        /* Boostrap */
        @import url("<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css");
        /* Awesome */
        @import url("<?php echo base_url(); ?>awesome/css/font-awesome.css");
        /* Chosen */
        @import url("<?php echo base_url(); ?>lib/chosen/chosen.css");
        /* Smoke */
        @import url("<?php echo base_url(); ?>lib/smoke/themes/gebo.css");
        /* Base style */
        @import url("<?php echo base_url(); ?>css/base.css");
        /* MC items */
        @import url("<?php echo base_url(); ?>css/items.css");
        /* Default theme */
        @import url("<?php echo base_url(); ?>css/themes/theme-blue.css");
    </style>
    
    <script>document.documentElement.className += 'js';</script>
    
</head>
<body>
    
    <?php 
    /**
     * Remove this if you want
     */
    if($this->config->item('iframe_mode') != TRUE)
        echo '<br /><br />';
    ?>

    
    <!-- Basic container -->
    <div class="container" id="container">

        <!-- Basic wrapper -->
        <div class="wrapper">
        
            <div id="header">
                <div class="navbar">
                    <div class="well">
                        <div class="container">
                            
                            <a class="brand" href="#">MC itemshop</a>
                            
                            <ul class="nav">
                                
                                <?php
                                foreach($this->module->categories as $cat):
                                    ?>
                                
                                    <li <?php echo ($cat->id == $this->uri->segment(3)) ? 'class="active"' : ''; ?>><a href="<?php echo site_url('main/shop/'.$cat->id); ?>"><img src="<?php echo base_url(); ?>img/items/<?php echo $cat->icon; ?>.png" class="item-navbar" alt="" /> <?php echo $cat->name; ?></a></li><li class="divider-vertical"></li>
                                
                                    <?php
                                endforeach;
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php echo $this->ui->show_breadcrumb(); ?>

            <div id="loading_layer" style="display: none;"><img src="<?php echo base_url(); ?>img/ajax_loader.gif" alt="" /></div>
            
            <div class="content">