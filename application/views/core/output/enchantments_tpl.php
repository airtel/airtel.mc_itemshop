<div class="preview">
    <img src="<?php echo base_url(); ?>img/items/<?php echo $item->image_id; ?>.png" class="img-polaroid shadow_select" alt="" title="<?php echo $item->item_name; ?>" />
    <strong>Nosaukums:</strong> <?php echo $item->item_name; ?>; <strong>Daudzums:</strong> <?php echo $item->pieces; ?> gab.
    
    <br />
    
    Mantas vērtība: <strong><span id="item-price"><?php echo $this->module->sms_prices[$item->price_sms_lv]; ?></span> Ls</strong><br />
    Kopā ar uzlabojumiem: <strong><span id="item-upgraded"><?php echo $this->module->sms_prices[$item->price_sms_lv]; ?></span> Ls</strong><br />
    Maksājot ar SMS: <strong><span id="total-smsprice"><?php echo $this->module->sms_prices[$item->price_sms_lv]; ?></span> Ls</strong> <i class="icon-comment-alt blue icon-large" title="Maksājot ar SMS cena var atšķirties no groza cenas, jo tiek sameklēts tuvākais augstākais SMS cenas kods."></i>
    
</div>



<h5>Papildus uzlabojumi.</h5>

<?php
foreach($enchantments as $e):
    ?>

    <div class="control-group <?php echo ( ! empty($form_error)) ? 'error f_error' : ''; ?>">
        <label class="control-label" title="<?php echo $e->desc; ?>"><span class="label label-info"><?php echo $e->name; ?>:</span></label>
        <div class="controls">

            <select id="<?php echo $e->cmd; ?>" name="<?php echo $e->cmd; ?>" class="chosen enchantment-menu">
                <option value="0">Bez uzlabojumiem</option>

                <?php
                for ($i = 1; $i <= $e->level_limit; $i++):

                    echo '<option value="'.$i.'">+ '.$i.' level ( + '. number_format($e->levelprice_sms_lv * $i / 100, 2, '.', '') .' Ls )</option>';

                endfor;
                ?>
            </select>

        </div>
    </div>

    <?php
endforeach;
?>


<!-- Chosen select -->
<script>

    $('[title]').tooltip({placement: 'right'});
    
    var total = Number(<?php echo $item->price_sms_lv; ?>);
    
    // Calculate price
    $(".enchantment-menu").chosen({disable_search_threshold: 25}).change(function(){

        var calculatedPrice = airtel_misc.calcPrice(total, 15);
        var totalSmsPrice = default_prices[airtel_misc.getNextClosest(default_prices, calculatedPrice)];

        // Calculated price with item upgrades
        $('#item-upgraded').text(parseFloat(Number(calculatedPrice) / 100).toFixed(2));
        
        // Total sms price
        $('#total-smsprice').text(totalSmsPrice);

    });
    
</script>