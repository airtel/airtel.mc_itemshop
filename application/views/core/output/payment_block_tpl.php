<?php
echo form_open(current_url(), array('id' => 'checkout-payment', 'class' => 'form-horizontal well', 'autocomplete' => 'off'));
    ?>

    <fieldset>

        <?php
        $form_error = form_error('mc_username');
        ?>
        
        <div class="control-group <?php echo ( ! empty($form_error)) ? 'error f_error' : ''; ?>" style="padding-left: 21px;">
            <label class="control-label"><?php echo $fields['mc_username']['label']; ?>:</label>
            <div class="controls">

                <?php echo form_dropdown('mc_username', $fields['mc_username']['data'], $fields['mc_username']['value'], $fields['mc_username']['options']); ?>

                <?php
                
                echo ( ! empty($form_error)) ? '<label class="error f_error" for="mc_username" generated="true">'.$form_error.'</label>' : ''; 
                ?>
                
            </div>
        </div>

        <?php
        foreach($this->module->pay_methods as $pay_method)
        {
            // Calc end price
            $end_price[$pay_method] = 15;
            
            $end_price = $this->shop->calc_end_price();
        }
        ?>
        
        <div class="tabbable tabbable-bordered">
            <ul id="pay_tabs" class="nav nav-tabs">

                <?php
                $i = 1;
                foreach($this->module->pay_methods as $pay_method):
                    
                    //$payment_limits = $this->config->item($pay_method, 'payment_limits');
                    
                    ?>
                    <li class="<?php echo ($i == 1) ? 'active' : ''; ?>">
                        <a href="#tab_br<?php echo $i; ?>" <?php echo ($end_price['price_'.$pay_method] >= $this->module->pay_options[$pay_method]['limits']['min'] && $end_price['price_'.$pay_method] <= $this->module->pay_options[$pay_method]['limits']['max']) ? 'data-toggle="tab"' : 'class="disabled" title="Piedod, bet pirkuma summa ir pārāk maza, lai izmantotu šo apmaksas metodi. Izmanto grozu un paņem vairāk!"'?>>
                            <i class="payment <?php echo $pay_method; ?>"></i><?php echo $this->module->pay_options[$pay_method]['name']; ?>
                        </a>
                    </li>
                    <?php
                    $i++;
                endforeach;
                ?>

            </ul>
            
            <div class="tab-content">
                
                <?php
                $i = 1;
                foreach($this->module->pay_methods as $pay_method):
                    ?>
                    <div class="tab-pane <?php echo ($i == 1) ? 'active' : ''; ?>" id="tab_br<?php echo $i; ?>" style="min-height: 290px;">

                        <?php
                        foreach($this->config->item('fields_'.$pay_method) as $field => $options):

                            $form_error = form_error($field);
                            ?>

                            <div class="control-group <?php echo ( ! empty($form_error)) ? 'error f_error' : ''; ?>">
                                <label class="control-label"><?php echo $options['label']; ?>:</label>
                                <div class="controls">

                                    <?php

                                    if($options['type'] == 'input')
                                    {
                                        $options['options']['class'] = $options['ajax_validation'];
                                        echo form_input($options['options']);
                                    }

                                    elseif($options['type'] == 'text')
                                    {
                                        echo '<label class="input-label"><strong>';
                                        if($pay_method == 'sms')
                                        {
                                            echo $this->module->sms_prices[$end_price['price_sms']].' '.$this->config->item('lv', 'currency') .' <i class="icon-comment-alt blue icon-large" title="Maksājot ar SMS cena var atšķirties no groza cenas, jo tiek sameklēts tuvākais augstākais SMS cenas kods."></i>';
                                        }
                                        else
                                        {
                                            echo '<span id="'.$pay_method.'_key">' .$end_price['price_'.$pay_method] . '</span> ' . $this->module->pay_options[$pay_method]['currency'];
                                        }
                                        echo '</strong></label>';
                                    }

                                    elseif($options['type'] == 'dropdown')
                                    {

                                        if($field == 'prices_'.$pay_method)
                                        {
                                            $options['data'] = array();
                                        }
                                        elseif($field == 'countries')
                                        {
                                            $options['data'] = $this->config->item('countries');
                                        }

                                        echo form_dropdown($field, $options['data'], $options['value'], $options['options']);
                                    }

                                    // CI error reporting
                                    echo ( ! empty($form_error)) ? '<label class="error" for="'.$field.'" generated="true">'.$form_error.'</label>' : ''; 

                                    ?>

                                </div>
                            </div>

                            <?php

                        endforeach;

                        if($pay_method == 'sms'):

                            echo $this->ui->sms_sendto($end_price['price_sms'], $this->module->sms_prices); 

                        else:
                            
                            ?>
                        
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                    <strong><a rel="tooltip" title="Ātrais apmaksas veids. <?php echo $pay_method; ?> kods ir pieejams uzreiz pēc apmaksas." id="airtel_<?php echo $pay_method; ?>_system" href="#">Iegādāties airtel <?php echo $pay_method; ?> kodu <i class="icon-external-link"></i></a></strong>
                                </div>
                            </div>
                        
                            <?php

                        endif;

                        ?>
                        
                        <div class="control-group">
                            <label class="control-label"></label>
                            <div class="controls">
                                
                                <a class="btn btn-primary form-submit" href="#"><i class="icon-unlock"></i> Apstiprināt pirkumu</a>
                                
                            </div>
                        </div>

                        
                    </div>
                    <?php
                    $i++;
                endforeach;
                ?>
                
            </div>

        </div>
        
        
        <!-- notification -->
        <div class="modal hide" id="payment-window-notification">
            <div class="modal-header">
                <h3>Notification</h3>
            </div>
            <div class="modal-body">
                
                <p>Pašlaik ir atvērts airtel koda apmaksas popup logs. Lūdzu veiciet tajā visas nepieciešamās darbības koda iegādei un pēc darbību veikšanas aizveriet apmaksas logu.
                Tad šim paziņojumam vajadzētu pazust.</p>
                
                <div class="progress progress-striped active">
                    <div class="bar" style="width: 100%;"></div>
                </div>
                
            </div>
        </div>

    </fieldset>

    <?php
    echo form_hidden('submit_form', 'submit_form');
echo form_close()
?>