<?php
$cache=$this->getDi()->getShared('cache');
if ($cache->has('dch_messages')) {
    $messages=$cache->get('dch_messages');
} else {
    $messages = [
        'setting_title' => 'Standaardinstellingen bijwerken',
        'product_title' => 'Product toevoegen',
        'signup_title' => 'Aanmelden',
        'component_title' => 'Componenten toevoegen',
        'role_title' => 'Rol toevoegen',
        'order_title' => 'Bestelling toevoegen',
        'access' => 'toegang geweigerd',
        'token' => 'Drager niet gevonden!!!!!'
    ];
    $cache->set('dch_messages', $messages);
}
