<?php

// Less Css Variables
require_once( trailingslashit( get_template_directory() ) . 'inc/less/less-vars.php' );

$allstore_options['header_logo'] = get_theme_mod('header_logo', '');
$allstore_options['header_search'] = get_theme_mod('header_search', 'ajax');
$allstore_options['header_before'] = get_theme_mod('header_before', '');
$allstore_options['header_after'] = get_theme_mod('header_after', '');
$allstore_options['header_sticky'] = get_theme_mod('header_sticky', '');
$allstore_options['footer_template'] = get_theme_mod('footer_template', '');
$allstore_options['catalog_sidebar'] = get_theme_mod('catalog_sidebar', 'show');
$allstore_options['catalog_viewmode'] = get_theme_mod('catalog_viewmode', 'gallery');
$allstore_options['catalog_qviewtabs'] = get_theme_mod('catalog_qviewtabs', 'hide');
$allstore_options['catalog_galimg'] = get_theme_mod('catalog_galimg', 'single');
$allstore_options['catalog_galbtns'] = get_theme_mod('catalog_galbtns', 'img');
$allstore_options['catalog_listimg'] = get_theme_mod('catalog_listimg', 'single');
$allstore_options['catalog_listactions'] = get_theme_mod('catalog_listactions', 'bottom');
$allstore_options['catalog_listatts'] = get_theme_mod('catalog_listatts', 'bottom');
$allstore_options['catalog_listadd2cart'] = get_theme_mod('catalog_listadd2cart', 'advanced');
$allstore_options['catalog_tbimg'] = get_theme_mod('catalog_tbimg', 'single');
$allstore_options['catalog_tbadd2cart'] = get_theme_mod('catalog_tbadd2cart', 'advanced');
$allstore_options['product_type'] = get_theme_mod('product_type', 'type_1');
$allstore_options['product_tabs'] = get_theme_mod('product_tabs', 'bottom');
$allstore_options['product_info'] = get_theme_mod('product_info', 'table');
$allstore_options['product_propscount'] = get_theme_mod('product_propscount', '10');
$allstore_options['product_related'] = get_theme_mod('product_related', 'bottom');
$allstore_options['post_sidebar'] = get_theme_mod('post_sidebar', 'hide');
$allstore_options['single_post_sidebar'] = get_theme_mod('single_post_sidebar', 'hide');
$allstore_options['post_type'] = get_theme_mod('post_type', 'type_2');
$allstore_options['post_related'] = get_theme_mod('post_related', 'right');
$allstore_options['other_share'] = get_theme_mod('other_share', array('facebook', 'twitter', 'vk', 'pinterest', 'gplus', 'linkedin', 'tumblr'));
$allstore_options['color_hover'] = get_theme_mod('color_hover', '#48c1e8');
$allstore_options['color_main'] = get_theme_mod('color_main', '#373d54');
$allstore_options['color_text'] = get_theme_mod('color_text', '#616161');



$custom_vc_styles = array();
if (!empty($allstore_options['header_before'])) {
    $custom_vc_styles[] = $allstore_options['header_before'];
}
if (!empty($allstore_options['header_after'])) {
    $custom_vc_styles[] = $allstore_options['header_after'];
}
if (!empty($allstore_options['footer_template'])) {
    $custom_vc_styles[] = $allstore_options['footer_template'];
}
allstore_include_vc_custom_styles($custom_vc_styles);



global $allstore_options;
if ( class_exists( 'YITH_WCWL' ) ) {
    $wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) );
    $allstore_options['wishlist']['id'] = $wishlist_page_id;
    if (!empty($wishlist_page_id)) {
        $allstore_options['wishlist']['url'] = get_permalink($wishlist_page_id);
    }
}

if (defined( 'WCCM_VERISON' )) {
    $compare_list = wccm_get_compare_list();
    $compare_page_id = get_option('wccm_compare_page');

    $allstore_options['compare']['id'] = $compare_page_id;
    $allstore_options['compare']['list'] = $compare_list;
    $allstore_options['compare']['count'] = count($compare_list);
    if (!empty($compare_page_id)) {
        $allstore_options['compare']['url'] = get_permalink($compare_page_id);
    }
}

if ( class_exists( 'WooCommerce' ) ) {
    $allstore_options['cart']['id'] = get_option('woocommerce_cart_page_id');
    $allstore_options['cart']['url'] = wc_get_cart_url();

    $account_page_id = get_option('woocommerce_myaccount_page_id');
    $allstore_options['account']['id'] = $account_page_id;
    if (!empty($account_page_id)) {
        $allstore_options['account']['url'] = get_permalink($account_page_id);
    }

    $shop_page_id = get_option('woocommerce_shop_page_id');
    $allstore_options['shop']['id'] = $shop_page_id;
    if (!empty($shop_page_id)) {
        $allstore_options['shop']['url'] = get_permalink($shop_page_id);
    }

}