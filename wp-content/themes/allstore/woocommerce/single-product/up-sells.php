<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : 

$prod_related_pos = allstore_option('product_related', true);
$product_type = allstore_option('product_type', true);

if ( ($prod_related_pos == 'bottom' || $product_type == 'type_2') && $columns == 'top' ) {
	return;
}
?>

	<?php if ($columns !== 'top') echo '<div class="container prod-upsells-wrap">'; ?>

	<div class="prod-related<?php
	if ($columns == 'top') {
		$int_count = 4;
		echo ' prod-related-top';
	} else {
		$int_count = 6;
		echo ' prod2-related';
	}
	?>">

		<h2><?php esc_html_e( 'You may also like', 'allstore' ) ?></h2>
		<div class="prod-related-car" id="prod-related-car<?php
		if ($columns == 'top') {
			echo '-top';
		} ?>">
			<ul class="slides">

				<?php
				$items_count = count($upsells);
				$int_key = 0;
				foreach ( $upsells as $upsell ) :
					if ($int_key % $int_count == 0) {
						echo '<li class="prod-rel-wrap">';
					}

				 	$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );
					
					$prod_id = get_the_id();
					$prod_ttl = get_the_title();

					include(locate_template('woocommerce/content-product-small.php'));

					if ($int_key % $int_count == ($int_count-1) || ($int_key + 1) >= $items_count) {
						echo "</li>";
					}
					$int_key++;

				endforeach; ?>

			</ul>
		</div>

	</div>

	<?php if ($columns !== 'top') echo '</div>'; ?>

<?php endif;

wp_reset_postdata();
