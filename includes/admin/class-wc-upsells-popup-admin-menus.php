<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_UpSells_Popup_Admin_Menus
{
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
    }

    public function admin_menu()
    {
        add_menu_page( 'upsellsPopup', 'upsellsPopup', 'manage_options', 'wc-upsells-popup', null, null, '55.5' );
        add_submenu_page( 'wc-upsells-popup', 'upsellsPopup Dashboard', 'Dashboard', 'manage_options', 'wc-upsells-popup', array($this, 'settings_page'));
    }

    public function settings_page()
    {
        echo 'test';
    }
}

return new WC_UpSells_Popup_Admin_Menus();
