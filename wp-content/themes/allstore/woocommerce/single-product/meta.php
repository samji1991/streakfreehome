<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
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

global $post, $product, $allstore_options;

$cat_count = count( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = count( get_the_terms( $post->ID, 'product_tag' ) );
if (taxonomy_exists('product_brands')) {
	$brands_count = count( get_the_terms( $post->ID, 'product_brands' ) );
}

$props_count = 0;
$props_count_max = allstore_option('product_propscount');
if ($props_count < $props_count_max && $props_count_max !== 0) :
?>
<ul class="prod-i-props product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) && $props_count < $props_count_max ) : ?>

		<li class="sku_wrapper"><b><?php esc_html_e( 'SKU:', 'allstore' ); ?></b> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'allstore' ); ?></span></li>

		<?php
		$props_count++;
	endif; ?>

	<?php
	if ($props_count < $props_count_max) {
		$categories = wc_get_product_category_list( $product->get_id(), ', ', '<li><b>' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'allstore' ) . '</b> ', '</li>' );
		if ($cat_count > 0 && !empty($categories)) {
			echo wp_kses_post($categories);
			$props_count++;
		}
	}
	?>

	<?php
	if ($props_count < $props_count_max && taxonomy_exists('product_brands')) {
		$brands = get_the_terms( $post->ID, 'product_brands' );
		if ($brands_count > 0 && !empty($brands)) {
			echo "<li><b>".esc_html__('Brand: ', 'allstore')."</b>";
			foreach ($brands as $key=>$brand) {
				echo '<a href="'.get_term_link($brand->term_id).'">'.$brand->name.'</a>';
				if (($key+1) < count($brands)) {
					echo ', ';
				}
			}
			echo "</li>";
			$props_count++;
		}
	}
	?>

	<?php
	if ($props_count < $props_count_max) {
		$tags = wc_get_product_tag_list( $product->get_id(), ', ', '<li><b>' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'allstore' ) . '</b> ', '</li>' );
		if ($tag_count > 0 && !empty($tags)) {
			echo wp_kses_post($tags);
			$props_count++;
		}
	}
	?>

	<?php if ( $product->has_weight() && $props_count < $props_count_max ) : ?>
		<li><b><?php esc_html_e( 'Weight', 'allstore' ) ?></b> <?php echo esc_html( wc_format_weight( $product->get_weight() ) ); ?></li>
		<?php $props_count++; ?>
	<?php endif; ?>

	<?php if ( $product->has_dimensions() && $props_count < $props_count_max ) : ?>
		<li><b><?php esc_html_e( 'Dimensions', 'allstore' ) ?></b> <?php echo esc_html( wc_format_dimensions( $product->get_dimensions( false ) ) ); ?></li>
		<?php $props_count++; ?>
	<?php endif; ?>

	<?php
	$all_props_showed = false;
	if ($props_count < $props_count_max) : ?>
		<?php
		$attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );

		if (!empty($attributes)) :
			$int_key = 0;
			foreach ( $attributes as $attribute ) :

				if ($props_count >= $props_count_max) {
					break;
				}
				?>
				<li>
					<b><?php echo wp_kses_post(wc_attribute_label( $attribute->get_name() )); ?>: </b>
					<?php
					$values = array();

					if ( $attribute->is_taxonomy() ) {
						$attribute_taxonomy = $attribute->get_taxonomy_object();
						$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

						foreach ( $attribute_values as $attribute_value ) {
							$value_name = esc_html( $attribute_value->name );

							if ( $attribute_taxonomy->attribute_public ) {
								$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
							} else {
								$values[] = $value_name;
							}
						}
					} else {
						$values = $attribute->get_options();

						foreach ( $values as &$value ) {
							$value = esc_html( $value );
						}
					}

					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
					?>
				</li>
				<?php
				if ($int_key + 1 == count($attributes)) {
					$all_props_showed = true;
				}
				$props_count++;
				$int_key++;
			endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($props_count > 0 && !$all_props_showed) : ?>
		<li><a href="#" class="prod-showprops"><?php esc_html_e('All additional information', 'allstore'); ?></a></li>
	<?php endif; ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</ul>
<?php
endif;