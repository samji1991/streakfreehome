<?php
$prod_class = array('prodlist-i');
if (empty($attributes) || !$has_attributes || $catalog_listatts == 'bottom') {
    $prod_class[] = 'prodlist-i-attsnort';
}
?>
<article <?php wc_product_class($prod_class); ?>>
    <?php
    /**
     * woocommerce_before_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10 (removed)
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>
    <a class="prodlist-i-img<?php if ($catalog_listimg == 'carousel') echo ' prodlist-i-carousel'; ?>" href="<?php the_permalink(); ?>"><?php
        if ($catalog_listimg == 'carousel') {
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
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php
        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_rating - 5 (removed)
         * @hooked woocommerce_template_loop_price - 10 (removed)
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>

        <?php if ($catalog_listactions == 'top') {
            include(locate_template('woocommerce/loop/list-actions.php'));
        } ?>
        
        <?php if (has_excerpt()) : ?>
        <div class="prodlist-i-txt">
            <?php the_excerpt(); ?>
        </div>
        <?php endif; ?>
        
        <div class="prodlist-i-action">
            <?php if ( $price_html = $product->get_price_html() ) : ?>
                <p class="prodlist-i-price">
                    <?php echo wp_kses_post($price_html); ?>
                </p>
            <?php endif; ?>
            <?php if ($catalog_listadd2cart !== 'hide') : ?>
            <div class="prodlist-i-addwrap">
                <?php
                if ($catalog_listadd2cart == 'advanced') {
                    woocommerce_template_single_add_to_cart();
                } elseif ($catalog_listadd2cart == 'simple') {
                    woocommerce_template_loop_add_to_cart();
                }
                ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if ($catalog_listactions == 'bottom') {
            include(locate_template('woocommerce/loop/list-actions.php'));
        } ?>

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
    if (!empty($attributes) && $catalog_listatts !== 'hide') {
        allstore_section_list_props($attributes, $catalog_listatts);
    }
    ?>

    <?php allstore_product_badge(get_the_ID()); ?>
    
</article>
