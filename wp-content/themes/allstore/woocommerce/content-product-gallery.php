<article <?php wc_product_class('prod-i'); ?>>

    <div class="prod-i-top">
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10 (removed)
         */
        do_action( 'woocommerce_before_shop_loop_item' );

        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10 (removed)
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>

        <a href="<?php the_permalink(); ?>" class="prod-i-img<?php if ($catalog_galimg == 'carousel') echo ' prod-i-carousel'; ?>"><?php
            if ($catalog_galimg == 'carousel') {
                $attachment_ids = $product->get_gallery_image_ids();
                if (has_post_thumbnail()) {
                    $img_src = allstore_get_img_src('shop_catalog');
                    echo '<img src="'.esc_url($img_src).'" alt="'.get_the_title().'">';
                }
                if ( $attachment_ids ) {
                    foreach ( $attachment_ids as $attachment_id ) {
                        $img_src = allstore_get_img_src( 'shop_catalog', $attachment_id );
                        echo '<img src="'.esc_url($img_src).'" alt="'.get_the_title().'">';
                    }
                }
            } else {
                woocommerce_template_loop_product_thumbnail();
            }
        ?></a>

        <?php if ($catalog_galbtns == 'img') : ?>
            <div class="prod-i-info">
                <?php if (class_exists('YITH_WCWL')) {
                    echo allstore_get_wishlist_btn();
                } ?>
                <a href="#" data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" data-file="woocommerce/quickview-single-product.php" data-id="<?php the_ID(); ?>" class="qview-btn prod-i-qview"><span><?php esc_html_e('Quick View', 'allstore'); ?></span><i class="fa fa-search"></i></a>
                <?php if (defined( 'WCCM_VERISON' )) {
                    echo allstore_get_compare_btn();
                } ?>
            </div>
            <p class="prod-i-buy">
                <?php woocommerce_template_loop_add_to_cart(); ?>
            </p>
            <?php if (!empty($attributes)) : ?>
                <p class="prod-i-properties-label"><i class="fa fa-info"></i></p>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (!empty($attributes) && ($catalog_galbtns == 'img' || $catalog_galbtns == 'price')) : ?>
            <?php allstore_section_gallery_props($attributes); ?>
        <?php endif; ?>

        <?php allstore_product_badge(get_the_ID()); ?>

    </div>

    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <?php
    /**
     * woocommerce_shop_loop_item_title hook.
     *
     * @hooked woocommerce_template_loop_product_title - 10 (removed)
     */
    do_action( 'woocommerce_shop_loop_item_title' );
    ?>

    <?php if ($catalog_galbtns == 'price') : ?>
    <div class="prod-i-action">
        <div class="prod-i-info">
            <?php if (class_exists('YITH_WCWL')) {
                echo allstore_get_wishlist_btn();
            } ?>
            <?php if (defined( 'WCCM_VERISON' )) {
                echo allstore_get_compare_btn();
            } ?>
            <?php woocommerce_template_loop_add_to_cart( array('gallery_btns'=>'price_area') ); ?>
            <a href="#" data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" data-file="woocommerce/quickview-single-product.php" data-id="<?php the_ID(); ?>" class="qview-btn prod-i-qview"><span><?php esc_html_e('Quick View', 'allstore'); ?></span><i class="fa fa-search"></i></a>
            <?php if (!empty($attributes)) : ?>
                <a href="#" class="prod-i-properties-label"><span><?php esc_html_e('Information', 'allstore'); ?></span><i class="fa fa-info"></i></a>
            <?php else: ?>
                <a href="<?php the_permalink(); ?>" class="prod-i-properties-label"><span><?php esc_html_e('Read More', 'allstore'); ?></span><i class="fa fa-share"></i></a>
            <?php endif; ?>

        </div>
    <?php endif; ?>
        <?php if ( $price_html = $product->get_price_html() ) : ?>
            <p class="prod-i-price">
                <?php echo wp_kses_post($price_html); ?>
            </p>
        <?php endif; ?>
    <?php if ($catalog_galbtns == 'price') : ?>
    </div>
    <?php endif; ?>

    <?php
    /**
     * woocommerce_after_shop_loop_item_title hook.
     *
     * @hooked woocommerce_template_loop_rating - 5 (removed)
     * @hooked woocommerce_template_loop_price - 10 (removed)
     */
    do_action( 'woocommerce_after_shop_loop_item_title' );

    /**
     * woocommerce_after_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
    do_action( 'woocommerce_after_shop_loop_item' );
    ?>



</article>
