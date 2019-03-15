<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.8
 */

if ( ! defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly

global $product;
?>

<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id ) )?>" rel="nofollow" data-product-id="<?php echo intval($product_id); ?>" data-product-type="<?php echo esc_html($product_type); ?>" class="<?php echo esc_html($link_classes); ?>" >
    <i class="fa fa-heart"></i>
    <span class="wishlist-btn-label"><?php echo esc_html($label); ?></span>
</a>
<i style="visibility:hidden" class="ajax-loading fa fa-spinner fa-pulse"></i>