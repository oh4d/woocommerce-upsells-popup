<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WC_UpSells_Popup_Admin_Meta_Boxes
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_boxes'), 1, 2);
    }

    public function add_meta_boxes()
    {
        add_meta_box( 'upsells-popup-data', __( 'Product data', 'woocommerce' ), array($this, 'upsells_popup_data_output'), 'upsells_popup', 'normal', 'high');
    }

    public function upsells_popup_data_output($post)
    {
        global $postId;

        $postId = $post->ID;

        wp_nonce_field('wc_upsells_popup_save_data', 'wc_upsells_popup_meta_nonce');

        include __DIR__ . '/meta-boxes/upsells-popup-data-panel.php';
    }

    public function save_meta_boxes($post_id, $post)
    {
        $post_id = absint($post_id);

        if (empty($post_id) || empty($post)) {
            return;
        }

        if (empty( $_POST['wc_upsells_popup_meta_nonce'] ) || !wp_verify_nonce(wp_unslash($_POST['wc_upsells_popup_meta_nonce']), 'wc_upsells_popup_save_data')) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        update_post_meta(
            $post_id,
            '_upsells_products',
            array_map( 'sanitize_text_field', $_POST['products'])
        );
    }
}

new WC_UpSells_Popup_Admin_Meta_Boxes();
