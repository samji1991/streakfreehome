<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$viewmode = allstore_option('catalog_viewmode', true);
$attributes = $product->get_attributes();

$catalog_galimg = allstore_option('catalog_galimg', true);
$catalog_galbtns = allstore_option('catalog_galbtns', true);

$catalog_listimg = allstore_option('catalog_listimg', true);
$catalog_listactions = allstore_option('catalog_listactions', true);
$catalog_listadd2cart = allstore_option('catalog_listadd2cart', true);
$catalog_listatts = allstore_option('catalog_listatts', true);
$has_attributes = false;
if (!empty($attributes) && $catalog_listatts !== 'hide') {
	$has_attributes = true;
}

$catalog_tbimg = allstore_option('catalog_tbimg', true);
$catalog_tbadd2cart = allstore_option('catalog_tbadd2cart', true);

if ($viewmode == 'table') {
	include(locate_template('woocommerce/content-product-table.php'));
} elseif ($viewmode == 'list') {
	include(locate_template('woocommerce/content-product-list.php'));
} else {
	include(locate_template('woocommerce/content-product-gallery.php'));
}
