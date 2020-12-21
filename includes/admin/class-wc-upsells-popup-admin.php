<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_UpSells_Popup_Admin
{
    public function __construct()
    {
        add_action('init', array($this, 'includes'));
    }

    public function includes()
    {
        include_once __DIR__ . '/class-wc-upsells-popup-admin-menus.php';
        include_once __DIR__ . '/class-wc-upsells-popup-admin-meta-boxes.php';

        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
    }

    public function admin_scripts()
    {
        wp_register_script( 'wc-upsells-popup-admin-meta-boxes', plugins_url('assets/js/admin/meta-boxes.js', WC_UPSELLS_POPUP_PLUGIN_FILE ), array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable', 'wc-enhanced-select' ));

        $screen       = get_current_screen();
        $screen_id    = $screen ? $screen->id : '';

        if (in_array( $screen_id, array('upsells_popup'))) {
            wp_enqueue_script('wc-upsells-popup-admin-meta-boxes');
        }
    }
}

return new WC_UpSells_Popup_Admin();
