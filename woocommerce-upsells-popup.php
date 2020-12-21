<?php
/**
 * Plugin Name: WooCommerce UpSells Popup
 * Plugin URI: https://github.com/oh4d/woocommerce-upsells-popup
 * Description:
 * Version: 1.0.0
 * Author: Ohad Goldstein
 * Author URI: https://www.ohadg.com
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * WC tested up to: 4.8.0
 * Text Domain: woocommerce-upsells-popup
 * Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (!defined( 'WC_UPSELLS_POPUP_PLUGIN_FILE')) {
    define('WC_UPSELLS_POPUP_PLUGIN_FILE', __FILE__ );
}

if (!class_exists( 'WC_UpSells_Popup')) {
    include_once dirname( __FILE__ ) . '/includes/class-wc-upsells-popup.php';
}

if (!function_exists('woocommerce_upsells_popup')) {
    function woocommerce_upsells_popup()
    {
        return WC_UpSells_Popup::instance();
    }
    $GLOBALS['wc_upsells_popup'] = woocommerce_upsells_popup();
}
