<?php
/**
 * Wishlist page template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.12
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly

$catalog_galimg = allstore_option('catalog_galimg', true);
$catalog_galbtns = allstore_option('catalog_galbtns', true);
?>

<?php do_action( 'yith_wcwl_before_wishlist_form', $wishlist_meta ); ?>

<form id="yith-wcwl-form" action="<?php echo esc_url( YITH_WCWL()->get_wishlist_url( 'view' . ( $wishlist_meta['is_default'] != 1 ? '/' . $wishlist_meta['wishlist_token'] : '' ) ) ) ?>" method="post" class="woocommerce">

    <?php wp_nonce_field( 'yith-wcwl-form', 'yith_wcwl_form_nonce' ) ?>

    <!-- TITLE -->
    <?php
    do_action( 'yith_wcwl_before_wishlist_title' );

    if( ! empty( $page_title ) ) :
    ?>
        
        <?php if( $wishlist_meta['is_default'] != 1 && $is_user_owner ): ?>
            <div class="hidden-title-form">
                <input type="text" value="<?php echo esc_html($page_title); ?>" name="wishlist_name"/>
                <button>
                    <?php echo apply_filters( 'yith_wcwl_save_wishlist_title_icon', '<i class="fa fa-check"></i>' )?>
                    <?php esc_html_e( 'Save', 'allstore' )?>
                </button>
                <a class="hide-title-form btn button">
                    <?php echo apply_filters( 'yith_wcwl_cancel_wishlist_title_icon', '<i class="fa fa-remove"></i>' )?>
                    <?php esc_html_e( 'Cancel', 'allstore' )?>
                </a>
            </div>
        <?php endif; ?>
    <?php
    endif;

    do_action( 'yith_wcwl_before_wishlist' ); ?>

<?php
if( count( $wishlist_items ) > 0 ) :
    ?>

    <div class="section-cont-full">
        <div class="prod-items section-items" data-pagination="<?php echo esc_attr( $pagination )?>" data-per-page="<?php echo esc_attr( $per_page )?>" data-page="<?php echo esc_attr( $current_page )?>" data-id="<?php echo ( is_user_logged_in() ) ? esc_attr( $wishlist_meta['ID'] ) : '' ?>" data-token="<?php echo ( ! empty( $wishlist_meta['wishlist_token'] ) && is_user_logged_in() ) ? esc_attr( $wishlist_meta['wishlist_token'] ) : '' ?>">


            <?php
            foreach( $wishlist_items as $item ) :
                global $product;

                //$attributes = $product->get_attributes();

                if (function_exists('wc_get_product')) {
                    $product = wc_get_product($item['prod_id']);
                } else {
                    $product = get_product($item['prod_id']);
                }

                if ($product !== false && $product->exists()) :
                    $availability = $product->get_availability();
                    $stock_status = $availability['class'];
                    ?>
                    <article <?php wc_product_class('prod-i'); ?> id="yith-wcwl-row-<?php echo intval($item['prod_id']); ?>" data-row-id="<?php echo intval($item['prod_id']); ?>">

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

                            <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>" class="prod-i-img<?php if ($catalog_galimg == 'carousel') echo ' prod-i-carousel'; ?>"><?php
                                if ($catalog_galimg == 'carousel') {
                                    $attachment_ids = $product->get_gallery_image_ids();
                                    if (get_post_thumbnail_id($product->get_id())) {
                                        $img_src = allstore_get_img_src('shop_catalog', get_post_thumbnail_id($product->get_id()));
                                        echo '<img src="'.esc_url($img_src).'" alt="">';
                                    }
                                    if ( $attachment_ids ) {
                                        foreach ( $attachment_ids as $attachment_id ) {
                                            $img_src = allstore_get_img_src( 'shop_catalog', $attachment_id );
                                            echo '<img src="'.esc_url($img_src).'" alt="">';
                                        }
                                    }
                                } elseif (get_post_thumbnail_id($product->get_id())) {
                                    $img_src = allstore_get_img_src('shop_catalog', get_post_thumbnail_id($product->get_id()));
                                    echo '<img src="'.esc_url($img_src).'" alt="">';
                                }
                                ?></a>

                            <?php if ($catalog_galbtns == 'img') : ?>
                                <div class="prod-i-info">
                                    <?php if ($is_user_owner) { ?>
                                        <a class="wishlist-btn" href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>" rel="nofollow">
                                            <i class="fa fa-remove"></i>
                                            <span class="wishlist-btn-label"><?php esc_html_e( 'Remove from Wishlist', 'allstore' ) ?></span>
                                        </a>
                                    <?php } ?>
                                    <a href="#" data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" data-file="woocommerce/quickview-single-product.php" data-id="<?php echo intval($product->get_id()); ?>" class="qview-btn prod-i-qview"><span><?php esc_html_e('Quick View', 'allstore'); ?></span><i class="fa fa-search"></i></a>
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

                            <?php allstore_product_badge($product->get_id()); ?>
                            
                        </div>

                        <h3><a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>"><?php echo apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ?></a></h3>
                        <?php do_action( 'yith_wcwl_table_after_product_name', $item ); ?>

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
                                <?php if ($is_user_owner) { ?>
                                    <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item['prod_id'] ) ) ?>" class="wishlist-btn" title="<?php esc_html_e( 'Remove this product', 'allstore' ) ?>"><i class="fa fa-remove"></i> <span class="wishlist-btn-label"><?php esc_html_e( 'Remove from Wishlist', 'allstore' ) ?></span></a>
                                <?php } ?>
                                <?php if (defined( 'WCCM_VERISON' )) {
                                    echo allstore_get_compare_btn();
                                } ?>
                                <?php echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s prod-add-btn">%s%s%s</a>',
                                    esc_url( $product->add_to_cart_url() ),
                                    esc_attr( isset( $quantity ) ? $quantity : 1 ),
                                    esc_attr( $product->get_id() ),
                                    esc_attr( $product->get_sku() ),
                                    esc_attr( isset( $class ) ? $class : 'button' ),
                                    '<span>',
                                    esc_html( $product->add_to_cart_text() ),
                                    '</span><i class="fa fa-shopping-basket"></i>'
                                ); ?>
                                <a href="#" data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" data-file="woocommerce/quickview-single-product.php" data-id="<?php the_ID(); ?>" class="qview-btn prod-i-qview"><span><?php esc_html_e('Quick View', 'allstore'); ?></span><i class="fa fa-search"></i></a>
                                <?php if (!empty($attributes)) : ?>
                                    <a href="#" class="prod-i-properties-label"><span><?php esc_html_e('Information', 'allstore'); ?></span><i class="fa fa-info"></i></a>
                                <?php else: ?>
                                    <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item['prod_id'] ) ) ) ?>" class="prod-i-properties-label"><span><?php esc_html_e('Read More', 'allstore'); ?></span><i class="fa fa-share"></i></a>
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


                <?php
                endif;
            endforeach;

            if( ! empty( $page_links ) ) : ?>
                <tr class="pagination-row">
                    <td colspan="<?php echo esc_attr( $column_count ) ?>"><?php echo wp_kses_post($page_links); ?></td>
                </tr>
            <?php endif ?>

        </div>

        
        <?php if( $show_cb ) : ?>
            <div class="custom-add-to-cart-button-cotaniner">
                <a href="<?php echo esc_url( add_query_arg( array( 'wishlist_products_to_add_to_cart' => '', 'wishlist_token' => $wishlist_meta['wishlist_token'] ) ) ) ?>" class="button alt" id="custom_add_to_cart"><?php echo apply_filters( 'yith_wcwl_custom_add_to_cart_text', esc_html__( 'Add the selected products to the cart', 'allstore' ) ) ?></a>
            </div>
        <?php endif; ?>

        <?php if ( is_user_logged_in() && $is_user_owner && $show_ask_estimate_button && $count > 0 ): ?>
            <div class="ask-an-estimate-button-container">
                <a href="<?php echo ( $additional_info ) ? '#ask_an_estimate_popup' : esc_url($ask_estimate_url); ?>" class="btn button ask-an-estimate-button" <?php echo ( $additional_info ) ? 'data-rel="prettyPhoto[ask_an_estimate]"' : '' ?> >
                    <?php echo apply_filters( 'yith_wcwl_ask_an_estimate_icon', '<i class="fa fa-shopping-cart"></i>' )?>
                    <?php echo apply_filters( 'yith_wcwl_ask_an_estimate_text', esc_html__( 'Ask for an estimate', 'allstore' ) ) ?>
                </a>
            </div>
        <?php endif; ?>

        <?php
        do_action( 'yith_wcwl_before_wishlist_share' );

        if ( is_user_logged_in() && $is_user_owner && $wishlist_meta['wishlist_privacy'] != 2 && $share_enabled ){
            yith_wcwl_get_template( 'share.php', $share_atts );
        }

        do_action( 'yith_wcwl_after_wishlist_share' );
        ?>
        
    </div>

<?php else: ?>
    <div class="page-cont">
        <p class="wishlist-empty"><?php esc_html_e( 'No products were added to the wishlist', 'allstore' ) ?></p>
    </div>
    <?php
endif;
?>

    <?php wp_nonce_field( 'yith_wcwl_edit_wishlist_action', 'yith_wcwl_edit_wishlist' ); ?>

    <?php if( $wishlist_meta['is_default'] != 1 ): ?>
        <input type="hidden" value="<?php echo esc_html($wishlist_meta['wishlist_token']); ?>" name="wishlist_id" id="wishlist_id">
    <?php endif; ?>

    <?php do_action( 'yith_wcwl_after_wishlist' ); ?>

</form>

<?php do_action( 'yith_wcwl_after_wishlist_form', $wishlist_meta ); ?>

<?php if( $additional_info ): ?>
	<div id="ask_an_estimate_popup">
		<form action="<?php echo esc_url($ask_estimate_url); ?>" method="post" class="wishlist-ask-an-estimate-popup">
			<?php if( ! empty( $additional_info_label ) ):?>
				<label for="additional_notes"><?php echo esc_html( $additional_info_label ) ?></label>
			<?php endif; ?>
			<textarea id="additional_notes" name="additional_notes"></textarea>

			<button class="btn button ask-an-estimate-button ask-an-estimate-button-popup" >
				<?php echo apply_filters( 'yith_wcwl_ask_an_estimate_icon', '<i class="fa fa-shopping-cart"></i>' )?>
				<?php esc_html_e( 'Ask for an estimate', 'allstore' ) ?>
			</button>
		</form>
	</div>
<?php endif; ?>