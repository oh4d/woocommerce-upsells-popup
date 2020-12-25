<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post;

setup_postdata($post);

?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><?php the_title(); ?></h5>
            <div class="wc-checkout-btns">
                <?php do_action('woocommerce_widget_shopping_cart_buttons'); ?>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="upsell-popup-content">
                <?php the_content(); ?>
            </div>

            <?php $product_ids = get_post_meta($post->ID, '_upsells_products', true); ?>

            <?php if (function_exists('fastshop_get_option')) : ?>

                <?php
                    $fastshop_woo_product_style = fastshop_get_option( 'fastshop_shop_product_style', 1 );
                    $template_style = 'style-' . $fastshop_woo_product_style;
                    $classes = array();
                    $classes[] = 'product-item style-' . $fastshop_woo_product_style;
                ?>
                <div class="product-list-owl owl-carousel owl-products nav2" data-margin="30"
                     data-nav="true" data-dots="false" data-loop="false" data-autoplay="true">
                    <?php foreach ( $product_ids as $product_id ) : ?>
                        <div <?php post_class( $classes ) ?>>
                            <?php
                            $post_object = get_post($product_id);
                            setup_postdata( $GLOBALS['post'] =& $post_object );
                            wc_get_template_part( 'product-styles/content-product', $template_style ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php else : ?>

                <?php woocommerce_product_loop_start(); ?>

                <?php foreach ( $product_ids as $product_id ) : ?>

                <?php
                    $post_object = get_post($product_id);

                    setup_postdata($GLOBALS['post'] =& $post_object);

                    wc_get_template_part( 'content', 'product' );
                ?>

                <?php endforeach; ?>

                <?php woocommerce_product_loop_end(); ?>

            <?php endif; ?>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>

<?php

wp_reset_postdata();

?>
