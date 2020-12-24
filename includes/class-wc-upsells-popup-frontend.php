<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_UpSells_Popup_Frontend
{
    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        add_action( 'wp_enqueue_scripts', array($this, 'load_scripts'));
    }

    public function load_scripts()
    {
        wp_register_script('wc-upsells-popup', plugins_url( 'assets/js/frontend/wc-upsells-popup.js', WC_UPSELLS_POPUP_PLUGIN_FILE ), array('jquery'));
        wp_enqueue_script('wc-upsells-popup');
    }
}
