<div class="row">
    <div class="span8 offset2">

        <?php if($this->uri->segment(4) == 'error'):

            $output = $this->ui->system_messages();

            if(! empty($output))
            {
                echo $output;
            }
            else
            {
                redirect($this->module->active_module.'/shop/'.$this->module->active_category);
            }

        else:
            
            // Print errors or info messages
            echo $this->ui->system_messages();
        
            if($this->module->active_category == 1):
                ?>

                <div class="row">
                    
                    <?php
                    // Divide page into two columns
                    foreach(array('weapon', 'armor') as $group):
                        ?>
                        
                        <!-- {Group} div -->
                        <div class="span4 responsive">
                            
                            <h4>Izvēlies <?php echo $group; ?> tipu:</h4>
                            
                            <?php
                            // With each of 5 item groups
                            foreach($this->config->item('sub_materials_'.$group) as $type):
                                
                                // Print each group name
                                echo '<h5>'.ucfirst($type).'</h5>';
                                $i = 1;
                                
                                // Print all items in current group
                                foreach(${'items_'.$group} as $item):

                                    // Print item only if its group is equal to current foreach group 
                                    if($item->sub_material == $type):
                                        
                                        if($i == 1) echo '<div>Cenas sākot ar: <strong>'.$this->module->sms_prices[$item->price_sms_lv].' LVL</strong></div>';
                                        ?>
                                            <img id="item-<?php echo $item->id; ?>" data-item-id="<?php echo $item->id; ?>" src="<?php echo base_url(); ?>img/items/<?php echo $item->image_id; ?>.png" class="img-polaroid shadow_select" alt="" title="<?php echo $item->item_name; ?>" />
                                        <?php
                                        $i++;
                                        
                                    endif;
                                    
                                endforeach;
                                
                            endforeach;
                            ?>

                        </div>
                    
                        <?php
                    endforeach;
                    ?>
                    
                </div>
        
        
                <!-- Modal for enchantments -->
                <div class="modal hide" id="enchantments-modal" tabindex="-1" role="dialog" aria-labelledby="enchantments-modalLabel" aria-hidden="true">
                    
                    <form class="form-horizontal" id="enchform" accept-charset="utf-8" method="post" action="">
                    
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="enchantments-modalLabel">Varbūt vēlies kādu papildus opciju?</h3>
                        </div>
                        <div class="modal-body" id="modal-body">
                            <!-- modal body -->
                        </div>
                        <div class="modal-footer">
                            <!-- <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="checkout"><i class="icon-ok"></i> Pirkšu uzreiz</button> -->
                            <button class="btn btn-success" data-dismiss="modal" aria-hidden="true" id="cart-add-enhanced" data-item-id=""><i class="icon-shopping-cart"></i> Likt grozā</button>
                            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Atcelt</button>
                        </div>
                    
                    </form>
                    
                </div>
        
        
                <?php
                
            // For other categories
            else:
                
                if(count($items) > 0):
                    ?>

                    <h4>Izvēlies mantu:</h4>
                    <ul class="item-gallery">

                        <?php
                        foreach($items as $item): 
                            ?>

                            <li class="dropdown">
                                <a id="item-<?php echo $item->id; ?>" class="dropdown-toggle" href="#" data-toggle="dropdown" role="button">
                                    <img src="<?php echo base_url(); ?>img/items/<?php echo $item->image_id; ?>.png" class="img-polaroid shadow_select" alt="" title="<?php echo $item->item_name; ?> ( <?php echo $item->pieces; ?> gab. )" />
                                </a>
                                <ul id="menu-<?php echo $item->id; ?>" class="dropdown-menu" aria-labelledby="menu-<?php echo $item->id; ?>" role="menu">
                                    <li><a class="cart-add" data-item-id="<?php echo $item->id; ?>" tabindex="-1" href="#" style="line-height: 1;"><i class="icon-shopping-cart icon-large"></i> Pievienot grozam</a></li>
                                </ul>
                            </li>

                            <?php
                        endforeach;
                        ?>

                    </ul>

                    <?php
                    
                endif;
                
            endif;

        endif;
        
        ?>
                
    </div>
</div>