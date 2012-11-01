<ul class="breadcrumb">

    <li><a href="<?php echo site_url($this->module->active_module); ?>"><?php echo ucfirst($this->module->active_module); ?></a> <span class="divider">/</span></li>
    
    <?php
    if(isset($category)):
        
        echo '<li><a href=""></a>'.$category->name.' <span class="divider">/</span></li>';
        
    endif;
    ?>
    
    <!-- Cart display -->
    <li class="pull-right" style="line-height: 1;">
        <a href="<?php echo site_url('cart/view_contents'); ?>" style="text-decoration: none;">
            <i class="icon-shopping-cart icon-large" style="font-size: 19px;"></i> <span id="cart_stats">[ Mantas kopā: <strong><span id="total-items"><?php echo $this->cart->total_items(); ?></span></strong>; Summa: <strong><span id="total"><?php echo number_format($this->cart->total() / 100, 2, '.', ''); ?></span> Ls</strong> ]</span>
        </a>
    </li>

</ul>