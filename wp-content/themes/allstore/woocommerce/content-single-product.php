<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

$prod_related_pos = allstore_option('product_related', true);
$product_type = allstore_option('product_type', true);
$product_tabs = allstore_option('product_tabs', true);

$prod_class = array('prod-wrap');
$upsells = $product->get_upsell_ids();
if (empty($upsells) || $prod_related_pos == 'bottom' || $product_type == 'type_2') {
	$prod_class[] = 'prod-wrap-full';
}
if ($product_type == 'type_2') {
	$prod_class[] = 'prod2-wrap';

	if ($product_tabs == 'content') {
		remove_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 100 );
	}
}
?>

<section id="content" class="container site-content<?php echo ' site-content-'.esc_html($prod_related_pos); echo ' site-content-'.esc_html($product_type); ?>">

<?php
/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>

<article id="product-<?php the_ID(); ?>" <?php wc_product_class($prod_class); ?>>

	<?php woocommerce_template_single_title(); ?>

	<?php
	/**
	 * woocommerce_before_single_product_summary hook.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary stylization prod-cont">

		<?php
		if ($product_type == 'type_2') {
			echo '<div class="prod-cont-inner">';
		}
		?>

		<?php
		/**
		 * woocommerce_single_product_summary hook.
		 *
		 * @hooked woocommerce_template_single_title - 5 (remove_action)
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20 (priority 5, compare and wishlist buttons)
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
	* @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>

		<?php
		if ($product_type == 'type_2') {
			echo '</div>';
		}
		?>

	</div><!-- .summary -->

	<?php
	/**
	 * woocommerce_after_single_product_summary hook.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10 (removed)
	 * @hooked woocommerce_upsell_display - 15 (removed)
	 * @hooked woocommerce_output_related_products - 20 (removed)
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>


</article>

<?php woocommerce_upsell_display('-1', 'top'); ?>

</section>

<?php
/**
 * woocommerce_after_single_product hook.
 *
 * @hooked woocommerce_output_product_data_tabs - 10 (added)
 * @hooked woocommerce_upsell_display - 15 (added)
 * @hooked woocommerce_output_related_products - 20 (added)
 */
do_action( 'woocommerce_after_single_product' );
?>
