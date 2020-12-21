<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_UpSells_Popup_Post_Types
{
    public static function register_post_types()
    {
        register_post_type('upsells_popup', array(
            'labels'              => array(
                'name'                  => __( 'Products', 'woocommerce' ),
                'singular_name'         => __( 'Product', 'woocommerce' ),
                'all_items'             => __( 'All Products', 'woocommerce' ),
                'menu_name'             => _x( 'Products', 'Admin menu name', 'woocommerce' ),
                'add_new'               => __( 'Add New', 'woocommerce' ),
                'add_new_item'          => __( 'Add new product', 'woocommerce' ),
                'edit'                  => __( 'Edit', 'woocommerce' ),
                'edit_item'             => __( 'Edit product', 'woocommerce' ),
                'new_item'              => __( 'New product', 'woocommerce' ),
                'view_item'             => __( 'View product', 'woocommerce' ),
                'view_items'            => __( 'View products', 'woocommerce' ),
                'search_items'          => __( 'Search products', 'woocommerce' ),
                'not_found'             => __( 'No products found', 'woocommerce' ),
                'not_found_in_trash'    => __( 'No products found in trash', 'woocommerce' ),
                'parent'                => __( 'Parent product', 'woocommerce' ),
                'featured_image'        => __( 'Product image', 'woocommerce' ),
                'set_featured_image'    => __( 'Set product image', 'woocommerce' ),
                'remove_featured_image' => __( 'Remove product image', 'woocommerce' ),
                'use_featured_image'    => __( 'Use as product image', 'woocommerce' ),
                'insert_into_item'      => __( 'Insert into product', 'woocommerce' ),
                'uploaded_to_this_item' => __( 'Uploaded to this product', 'woocommerce' ),
                'filter_items_list'     => __( 'Filter products', 'woocommerce' ),
                'items_list_navigation' => __( 'Products navigation', 'woocommerce' ),
                'items_list'            => __( 'Products list', 'woocommerce' ),
            ),
            'public' => true,
            'show_in_menu' => 'wc-upsells-popup'
        ));
    }

    public static function init()
    {
        add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
    }
}

WC_UpSells_Popup_Post_Types::init();
