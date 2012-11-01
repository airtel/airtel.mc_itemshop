<div class="row">
    <div class="span9 offset1">

        <?php
        // Print errors or info messages
        echo $this->ui->system_messages();        
        ?>
        
        <h4>Tava groza saturs:</h4>
        
        <?php
        // Cart debug
        //echo '<pre>';
        //print_r($this->cart->contents());
        //echo '</pre>';
        //$this->cart->destroy();
        ?>
        
        <div class="form-horizontal well">
            
            <fieldset>
            
                <table class="table table-bordered table-condensed table-hover table-striped cart-table">
                    <thead>
                        <tr>
                            <th style="width: 43px;">Manta</th>
                            <th>Apraksts</th>
                            <th style="width: 45px;">Daudz.</th>
                            <th style="width: 50px;">Cena</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        foreach ($this->cart->contents() as $key => $items): 
                            ?>
                        
                            <tr class="item-row" id="<?php echo $key; ?>">
                                <td>
                                    <a id="<?php echo $items['id']; ?>" class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
                                        <img class="img-polaroid shadow_select" alt="" src="<?php echo base_url(); ?>img/items/<?php echo $items['options']['image_id']; ?>.png" title="<?php echo $items['name']; ?>">
                                    </a>
                                </td>
                                <td>
                                    <?php 
                                    echo '<strong>'.$items['name'].'</strong> '; 
                                    
                                    if(isset($items['enchantments']) && count($items['enchantments']) > 0):
                                        
                                        echo ':[ ';
                                        
                                        foreach($items['enchantments'] as $e => $count):
                                            
                                            echo ucfirst($e) .': <strong>' . $count . '</strong> ';
                                        
                                        endforeach;
                                        
                                        echo ' ]';
                                        
                                    endif;
                                    ?>
                                </td>
                                
                                <td><?php echo ($items['options']['pieces'] * $items['qty']); ?></td>
                                <td><?php echo number_format(($items['price'] * $items['qty'] / 100), 2, '.', ''); ?> Ls</td>
                            </tr>
                        
                            <?php 
                        endforeach;
                        ?>

                    </tbody>
                </table>
            
                <div class="stats pull-right">
                    
                    <p>Visu mantu summa: <strong><span id="cart-total"><?php echo number_format($this->cart->total() / 100, 2, '.', ''); ?></span> Ls</strong></p>
                    
                </div>
                <div style="clear:both;">
                
                <div class="controlls pull-right">
                    
                    <button id="cart-destroy" class="btn btn-danger btn-small"><i class="icon-remove"></i> Iztirīt</button>
                    <button id="cart-checkout" class="btn btn-primary btn-small"><i class="icon-ok"></i> Uz apmaksu</button>
                    
                </div>
                <div style="clear:both;">
                    
            </fieldset>
            
        </div>
        
    </div>
</div>