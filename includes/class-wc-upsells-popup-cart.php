<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_UpSells_Popup_Cart
{
    protected static $upsell_popup;

    public static function init()
    {
        add_filter('woocommerce_add_to_cart_fragments', array(__CLASS__, 'add_to_cart_fragments'));
    }

    public static function add_to_cart_fragments($fragments)
    {
        if (isset($_POST['upsell_popup']) && $_POST['upsell_popup']) {
            $fragments['div.upsells-popup-checkout'] = wc_get_checkout_url();
            return $fragments;
        }

        if (isset($_COOKIE['upsells_popup_viewed']) && $_COOKIE['upsells_popup_viewed']) {
            return $fragments;
        }

        $popups = get_posts(array(
            'post_type' => 'upsells_popup',
            'posts_per_page' => 1
        ));

        if (!$popups || !count($popups)) {
            return $fragments;
        }

        global $post;

        $post = $popups[0];
        self::$upsell_popup = $post;

        add_filter('woocommerce_loop_add_to_cart_args', array(__CLASS__, 'woocommerce_loop_add_to_cart_args'));
        add_filter('woocommerce_loop_product_link', array(__CLASS__, 'woocommerce_template_loop_product_link_open'));

        ob_start();

        include WC_UPSELLS_POPUP_ABSPATH . '/templates/upsells-popup.php';

        remove_action('woocommerce_loop_add_to_cart_args', array(__CLASS__, 'woocommerce_loop_add_to_cart_args'));
        remove_action('woocommerce_loop_product_link', array(__CLASS__, 'woocommerce_template_loop_product_link_open'));

        $popup = ob_get_clean();

        $fragments['div.upsells-popup'] = '<div class="upsells-popup modal fade" id="upsellsPopup" role="dialog">' . $popup . '</div>';

        self::set_upsells_popup_viewed_cookie();
        return $fragments;
    }

    public static function woocommerce_template_loop_product_link_open($link)
    {
        $link .= '?upsell-popup=' . self::$upsell_popup->ID;
        return $link;
    }

    public static function woocommerce_loop_add_to_cart_args($args)
    {
        $args['attributes']['data-upsell_popup'] = self::$upsell_popup->ID;
        return $args;
    }

    public static function set_upsells_popup_viewed_cookie()
    {
        setcookie('upsells_popup_viewed', self::$upsell_popup->ID, time()+(3600 * 12));
    }

}

WC_UpSells_Popup_Cart::init();
