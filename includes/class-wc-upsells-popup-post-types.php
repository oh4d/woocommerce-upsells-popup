<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_UpSells_Popup_Post_Types
{
    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        add_action( 'init', array( $this, 'register_post_types' ), 5 );
    }

    public function register_post_types()
    {
        register_post_type('upsells_popup', array(
            'labels'              => array(
                'name'                  => __( 'Upsell Popups', 'woocommerce-upsells-popup' ),
                'singular_name'         => __( 'Upsell Popup', 'woocommerce-upsells-popup' ),
                'all_items'             => __( 'All Upsell Popups', 'woocommerce-upsells-popup' ),
                'menu_name'             => _x( 'Upsell Popups', 'Admin menu name', 'woocommerce-upsells-popup' ),
                'add_new'               => __( 'Add New', 'woocommerce-upsells-popup' ),
                'add_new_item'          => __( 'Add new upsell popup', 'woocommerce-upsells-popup' ),
                'edit'                  => __( 'Edit', 'woocommerce-upsells-popup' ),
                'edit_item'             => __( 'Edit upsell popup', 'woocommerce-upsells-popup' ),
                'new_item'              => __( 'New upsell popup', 'woocommerce-upsells-popup' ),
                'view_item'             => __( 'View upsell popup', 'woocommerce-upsells-popup' ),
                'view_items'            => __( 'View upsell popups', 'woocommerce-upsells-popup' ),
                'search_items'          => __( 'Search upsell popups', 'woocommerce-upsells-popup' ),
                'not_found'             => __( 'No products found', 'woocommerce-upsells-popup' ),
                'not_found_in_trash'    => __( 'No products found in trash', 'woocommerce-upsells-popup' ),
                'parent'                => __( 'Parent upsell popup', 'woocommerce-upsells-popup' ),
                'featured_image'        => __( 'Upsell Popup image', 'woocommerce-upsells-popup' ),
                'set_featured_image'    => __( 'Set upsell popup image', 'woocommerce-upsells-popup' ),
                'remove_featured_image' => __( 'Remove upsell popup image', 'woocommerce-upsells-popup' ),
                'use_featured_image'    => __( 'Use as upsell popup image', 'woocommerce-upsells-popup' ),
                'insert_into_item'      => __( 'Insert into upsell popup', 'woocommerce-upsells-popup' ),
                'uploaded_to_this_item' => __( 'Uploaded to this upsell popup', 'woocommerce-upsells-popup' ),
                'filter_items_list'     => __( 'Filter upsell popups', 'woocommerce-upsells-popup' ),
                'items_list_navigation' => __( 'Upsell Popups navigation', 'woocommerce-upsells-popup' ),
                'items_list'            => __( 'Upsell Popups list', 'woocommerce-upsells-popup' ),
            ),
            'public' => true,
            'show_in_menu' => 'wc-upsells-popup'
        ));
    }
}
