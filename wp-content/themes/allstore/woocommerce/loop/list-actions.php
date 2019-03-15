<div class="prodlist-i-info">
    <?php if (class_exists('YITH_WCWL')) {
        echo allstore_get_wishlist_btn();
    } ?>
    <a href="#" data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" data-file="woocommerce/quickview-single-product.php" data-id="<?php the_ID(); ?>" class="qview-btn prodlist-i-qview"><i class="fa fa-search"></i> <?php esc_html_e('Quick view', 'allstore'); ?></a>
    <?php if (defined( 'WCCM_VERISON' )) {
        echo allstore_get_compare_btn();
    } ?>
</div>