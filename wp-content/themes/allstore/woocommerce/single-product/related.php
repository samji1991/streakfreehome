<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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

if ( $related_products ) : ?>
	<div class="container prod-related-wrap">
	<div class="prod-related prod2-related">

		<h2><?php esc_html_e( 'Related Products', 'allstore' ) ?></h2>
		<div class="prod-related-car" id="prod-related-car2">
			<ul class="slides">

				<?php
				$int_count = 6;
				$items_count = count($related_products);
				$int_key = 0;
				foreach ( $related_products as $related_product ) :
					if ($int_key % $int_count == 0) {
						echo '<li class="prod-rel-wrap">';
					}

				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					$prod_id = $related_product->get_id();
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
	</div>

<?php endif;

wp_reset_postdata();
