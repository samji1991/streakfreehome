<?php
$prod_class = array('prodtb-i');
?>
<article <?php wc_product_class($prod_class); ?>>
    <div class="prodtb-i-top">
        <button class="prodtb-i-toggle" type="button"></button>
        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10 (removed)
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>
        <?php
        /**
         * woocommerce_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_product_title - 10 (removed)
         */
        do_action( 'woocommerce_shop_loop_item_title' );
        ?>
        <h3 class="prodtb-i-ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php
        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_rating - 5 (removed)
         * @hooked woocommerce_template_loop_price - 10 (removed)
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>
        <div class="prodtb-i-info">
            <?php if ( $price_html = $product->get_price_html() ) : ?>
                <span class="prodtb-i-price">
                    <b><?php echo wp_kses_post($price_html); ?></b>
                </span>
            <?php endif; ?>
            <?php if ($product->is_type('simple') || $product->is_type('variable')) : ?>
            <p class="prodtb-i-qnt">
                <input value="1" type="text">
                <a href="#" data-qnt="plus" class="prodtb-i-plus"><i class="fa fa-angle-up"></i></a>
                <a href="#" data-qnt="minus" class="prodtb-i-minus"><i class="fa fa-angle-down"></i></a>
            </p>
            <?php endif; ?>
        </div>
        <div class="prodtb-i-action">
            <?php if (class_exists('YITH_WCWL')) {
                echo allstore_get_wishlist_btn();
            } ?>
            <?php if (defined( 'WCCM_VERISON' )) {
                echo allstore_get_compare_btn();
            } ?>
            <a href="#" data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" data-file="woocommerce/quickview-single-product.php" data-id="<?php the_ID(); ?>" class="qview-btn prodtb-i-qview"><span><?php esc_html_e('Quick view', 'allstore'); ?></span><i class="fa fa-search"></i></a>
            <?php
            if ($product->is_type('simple') && $catalog_tbadd2cart !== 'hide') {
                woocommerce_template_loop_add_to_cart( array('gallery_btns'=>'price_area') );
            } else {
                echo '<a rel="nofollow" href="#" class="prod-add-btn prodtb-i-toggle-rt"><span>'.esc_html__('Show More', 'allstore').'</span><i class="fa fa-angle-double-down"></i></a>';
            }
            ?>
        </div>
    </div>
    <div class="prodlist-i">
        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10 (removed)
         */
        do_action( 'woocommerce_before_shop_loop_item' );
        ?>
        <a class="prodlist-i-img<?php if ($catalog_tbimg == 'carousel') echo ' prodlist-i-carousel'; ?>" href="<?php the_permalink(); ?>"><?php
            if ($catalog_tbimg == 'carousel') {
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
        <div class="prodlist-i-cont">
            <?php if (has_excerpt()) : ?>
                <div class="prodlist-i-txt">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>
            <?php if (!$product->is_type('simple')) : ?>
            <div class="prodlist-i-action">
                <?php if ($catalog_tbadd2cart !== 'hide') : ?>
                    <div class="prodlist-i-addwrap">
                        <?php
                        if ($catalog_tbadd2cart == 'advanced') {
                            woocommerce_template_single_add_to_cart();
                        } elseif ($catalog_tbadd2cart == 'simple') {
                            woocommerce_template_loop_add_to_cart();
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php
            /**
             * woocommerce_after_shop_loop_item hook.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>
        </div>

        <?php
        if (!empty($attributes) && $has_attributes) {
            allstore_section_list_props($attributes, 'bottom');
        }
        ?>

        <?php allstore_product_badge(get_the_ID()); ?>
    </div>
</article>