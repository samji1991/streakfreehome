<?php
global $product;
$img_src = allstore_get_img_src('allstore-200x200', get_post_thumbnail_id($prod_id));
$post_class = 'prod-rel';
if (empty($img_src)) {
    $post_class .= ' posts-i-noimg';
}
$product = wc_get_product( $prod_id );
?>
<div class="<?php echo esc_attr($post_class); ?>">
    <a href="<?php echo get_permalink($prod_id); ?>" class="prod-rel-img">
        <?php if (!empty($img_src)) : ?>
            <img src="<?php echo esc_html($img_src); ?>" alt="<?php echo esc_html($prod_ttl); ?>">
        <?php endif; ?>
    </a>
    <div class="prod-rel-cont">
        <h3><a href="<?php echo get_permalink($prod_id); ?>"><?php echo esc_html($prod_ttl); ?></a></h3>
        <?php
        if ( $price_html = $product->get_price_html() ) {
            echo '<p class="prod-rel-price">'.wp_kses_post($price_html).'</p>';
        }
        ?>
        <div class="prod-rel-actions">
            <?php if (class_exists('YITH_WCWL')) {
                echo allstore_get_wishlist_btn();
            } ?>
            <?php if (defined( 'WCCM_VERISON' )) {
                echo allstore_get_compare_btn($prod_id);
            } ?>
            <a href="#" data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" data-file="woocommerce/quickview-single-product.php" data-id="<?php echo intval($prod_id); ?>" class="qview-btn prod-i-qview"><span><?php esc_html_e('Quick View', 'allstore'); ?></span><i class="fa fa-search"></i></a>
            <?php woocommerce_template_loop_add_to_cart( array('gallery_btns'=>'price_area') ); ?>
        </div>
    </div>
</div>