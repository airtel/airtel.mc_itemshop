<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * Jūsu ID no statistikas sistēmas, var redzēt statistikas augšdaļā, vai Profila
 * sadaļā
 */
$config['user_id'] = '1';


/**
 * Jūsu passkey no statistikas sistemas, var atrast Profila sadaļā
 */
$config['passkey'] = '';


/**
 * Jūsu atslēgas vārds, ja neesat pasūtījuši atsevišķu, tad šim jāpaliek tādam
 * kāds tas ir. 
 */
$config['base_keyword'] = 'ART';


/**
 * Īsais numurs uz kuru sūtam SMS.
 * ART atslēgas vārdam tas ir 159
 */
$config['short_number'] = '1800';


/**
 * Minecraft servera uzstādījumi
 */
$config['minecraft_server_settings'] = array(
    
    /**
     * Servera ip adrese vai hostname
     */
    'server_hostname' => '192.168.0.1',
    
    /**
     * Servera rcon ports
     */
    'server_port' => '25575',
    
    
    /**
     * Servera query ports
     * Jābut ieslēgtam enable-query=true
     */
    'query_port' => '25565',
    
    /**
     * Servera rcon parole
     */    
    'server_rcon' => 'myrconpassword',
    
    /**
     * Šo mainīgo nav nepieciešams mainīt
     */
    'throw_errors' => TRUE,
);


/**
 * Pieejamie apmaksas veidi
 */
$config['minecraft_payments'] = array('sms', 'ibank', 'paypal');

/**
 * Jābut FALSE ja vēlaties pelnīt naudu. Citādak kodi netiek realizēti, bet tikai pārbaudīti.
 * Atbilde tiek saņemta nevis code_charged_ok bet code_test_ok.
 * Varam slēgt iekšā ja vēlamies tikai pārbaudīt skripta darbību.
 */
$config['testing'] = FALSE;


/**
 * Aplikācijai ir iepsēja ieslēgt iframe mode, tas nozīmē, ka veikals tiks pieladēts bez lieka koda.
 * Nebūs header, footer atstarpju, kā arī shop tiks maksimāli nobīdīts pie augšējā kreisā stūra.
 * Tiks pieslēgts jQuery kods, kurš atbild par atsaucīgu veikala reaģēšanu uz augstuma izmaiņām.
 */
$config['iframe_mode'] = FALSE;


/**
 * Bruņu grupas kas parādīsies pirmajā kategorijā.
 * Nevelamoes var nokomentēt ciet.
 */
$config['sub_materials_armor'] = array(
    'leather', 
    'chainmail', 
    'iron', 
    'gold', 
    'diamond'
);


/**
 * Ieroču grupas kas parādīsies pirmajā kategorijā.
 * Nevelamoes var nokomentēt ciet.
 */
$config['sub_materials_weapon'] = array(
    'wooden', 
    'stone', 
    'iron', 
    'gold', 
    'diamond'
);