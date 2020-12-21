<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_UpSells_Popup_Frontend
{
    public static function init()
    {
        add_action( 'wp_enqueue_scripts', array(__CLASS__, 'load_scripts'));
    }

    public static function load_scripts()
    {
        wp_register_script('wc-upsells-popup', plugins_url( 'assets/js/frontend/wc-upsells-popup.js', WC_UPSELLS_POPUP_PLUGIN_FILE ), array('jquery'));
        wp_enqueue_script('wc-upsells-popup');
    }
}

WC_UpSells_Popup_Frontend::init();
