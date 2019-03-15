<?php
/*
Name: Woo AJAX Cart
URI: http://ragob.com/wooajaxcart
Description: Change the default behavior of WooCommerce Cart page, making AJAX requests when quantity field changes
Version: 1.2
Author: Moises Heberle
Author URI: http://codecanyon.net/user/moiseh
*/



// on submit AJAX form of the cart
// after calculate cart form items
add_action('woocommerce_cart_updated', 'wac_update');
function wac_update() {
    // is_wac_ajax: flag defined on wooajaxcart.js
    
    if ( !empty($_POST['is_wac_ajax'])) {
        $resp = array();
        $resp['update_label'] = __( 'Update Cart', 'allstore-custom-types' );
        $resp['checkout_label'] = __( 'Proceed to Checkout', 'allstore-custom-types' );
        $resp['price'] = 0;
        
        // render the cart totals (cart-totals.php)
        ob_start();
        do_action( 'woocommerce_after_cart_table' );
        do_action( 'woocommerce_cart_collaterals' );
        do_action( 'woocommerce_after_cart' );
        $resp['html'] = ob_get_clean();
        $resp['price'] = 0;
        
        // calculate the item price
        if ( !empty($_POST['cart_item_key']) ) {
            $items = WC()->cart->get_cart();
            $cart_item_key = $_POST['cart_item_key'];
            
            if ( array_key_exists($cart_item_key, $items)) {
                $cart_item = $items[$cart_item_key];
                $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $price = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                $resp['price'] = $price;
            }
        }

        echo json_encode($resp);
        exit;
    }
}



add_action('init', 'wac_init');

function wac_init() {
    // force to make is_cart() returns true, to make right calculations on class-wc-cart.php (WC_Cart::calculate_totals())

    // this define fix a bug that not show Shipping calculator when is WAC ajax request

    if ( !empty($_POST['is_wac_ajax']) && !defined( 'WOOCOMMERCE_CART' ) ) {
        define( 'WOOCOMMERCE_CART', true );
    }

    wac_enqueue_cart_js();
}

// this is custom code to cart page ajax work in pages like "Woocommerce Shop page"
function wac_enqueue_cart_js() {
    $path = 'assets/js/frontend/cart.js';
    $src = str_replace( array( 'http:', 'https:' ), '', plugins_url( $path, WC_PLUGIN_FILE ) );

    $deps = array( 'jquery', 'wc-country-select', 'wc-address-i18n');
    wp_enqueue_script( 'wc-cart', $src, $deps, WC_VERSION, true );
}
