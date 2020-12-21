<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>

<div class="">
    <select class="wc-product-search" multiple="multiple" style="width: 50%;" id="grouped_products" name="products[]" data-sortable="true" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'woocommerce' ); ?>" data-action="woocommerce_json_search_products">
        <?php
        $product_ids = get_post_meta($postId, '_upsells_products', true);

        if ($product_ids && count($product_ids)) {
            foreach ($product_ids as $product_id) {
                $product = wc_get_product( $product_id );
                if ( is_object( $product ) ) {
                    echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . htmlspecialchars( wp_kses_post( $product->get_formatted_name() ) ) . '</option>';
                }
            }
        }
        ?>
    </select>
</div>
