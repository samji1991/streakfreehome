<?php
$page_num = (isset($_POST['page_num'])) ? $_POST['page_num'] : 1;
$items_per_page = (isset($_POST['posts_per_page'])) ? $_POST['posts_per_page'] : $items_per_page;

$order = (isset($_POST['order'])) ? $_POST['order'] : $order;
$orderby = (isset($_POST['orderby'])) ? $_POST['orderby'] : $orderby;

$viewmode = (isset($_POST['viewmode'])) ? $_POST['viewmode'] : $viewmode;

$catalog_galimg = (isset($_POST['catalog_galimg'])) ? $_POST['catalog_galimg'] : $catalog_galimg;
$catalog_galbtns = (isset($_POST['catalog_galbtns'])) ? $_POST['catalog_galbtns'] : $catalog_galbtns;
$catalog_listimg = (isset($_POST['catalog_listimg'])) ? $_POST['catalog_listimg'] : $catalog_listimg;
$catalog_listactions = (isset($_POST['catalog_listactions'])) ? $_POST['catalog_listactions'] : $catalog_listactions;
$catalog_listatts = (isset($_POST['catalog_listatts'])) ? $_POST['catalog_listatts'] : $catalog_listatts;
$catalog_listadd2cart = (isset($_POST['catalog_listadd2cart'])) ? $_POST['catalog_listadd2cart'] : $catalog_listadd2cart;
$catalog_tbimg = (isset($_POST['catalog_tbimg'])) ? $_POST['catalog_tbimg'] : $catalog_tbimg;
$catalog_tbadd2cart = (isset($_POST['catalog_tbadd2cart'])) ? $_POST['catalog_tbadd2cart'] : $catalog_tbadd2cart;

$ids = (isset($_POST['ids'])) ? $_POST['ids'] : $ids;
if (!empty($ids)) {
	$ids_arr = explode(', ', $ids);
} else {
	$ids_arr = array();
}

$products_query = new WP_Query( array(
	'post__in' => $ids_arr,
	'post_type'   => 'product',
	'post_status' => 'publish',
	'order'          => $order,
	'orderby'        => $orderby,
	'posts_per_page' => $items_per_page,
	'paged'          => $page_num,
) );

if ($products_query->have_posts()) :
	?>
	<div class="woocommerce section-cont-full<?php echo esc_attr( $css_class ); ?>">
	<div class="prod-items section-items">

		<?php
		while ($products_query->have_posts()) : $products_query->the_post();

			global $product;

			// Ensure visibility
			if ( empty( $product ) || ! $product->is_visible() ) {
				return;
			}

			$attributes = $product->get_attributes();
			$has_attributes = false;
			if (!empty($attributes) && $catalog_listatts !== 'hide') {
				foreach ($attributes as $attr) {
					if (!empty($attr['value'])) {
						$has_attributes = true;
						break;
					}
				}
			}

			if ($viewmode == 'table') {
				include(locate_template('woocommerce/content-product-table.php'));
			} elseif ($viewmode == 'list') {
				include(locate_template('woocommerce/content-product-list.php'));
			} else {
				include(locate_template('woocommerce/content-product-gallery.php'));
			}

		endwhile;
		?>

	</div>
	<?php if (!empty($load_more) && $load_more !== 'hide') : ?>
	<p class="prod-items-loadmore">
		<a
			class="prod-items-loadmore-btn"
			href="#"
			data-container=".section-items"
			data-url="<?php echo admin_url('admin-ajax.php'); ?>"
			data-page-num="<?php echo esc_attr($page_num); ?>"
			data-max-num-pages="<?php echo esc_attr($products_query->max_num_pages); ?>"
			data-file="inc/shortcodes/products-content.php"
			data-order="<?php echo esc_attr($order); ?>"
			data-orderby="<?php echo esc_attr($orderby); ?>"
			data-posts_per_page="<?php echo esc_attr($items_per_page); ?>"
			data-item="<?php if ($viewmode == 'table') echo '.prodtb-i'; elseif ($viewmode == 'list') echo '.prodlist-i'; else echo '.prod-i'; ?>"
			data-viewmode="<?php echo esc_html($viewmode); ?>"
			data-catalog_galimg="<?php echo esc_html($catalog_galimg); ?>"
			data-catalog_galbtns="<?php echo esc_html($catalog_galbtns); ?>"
			data-catalog_listimg="<?php echo esc_html($catalog_listimg); ?>"
			data-catalog_listactions="<?php echo esc_html($catalog_listactions); ?>"
			data-catalog_listatts="<?php echo esc_html($catalog_listatts); ?>"
			data-catalog_listadd2cart="<?php echo esc_html($catalog_listadd2cart); ?>"
			data-catalog_tbimg="<?php echo esc_html($catalog_tbimg); ?>"
			data-catalog_tbadd2cart="<?php echo esc_html($catalog_tbadd2cart); ?>"
			data-ids="<?php echo esc_attr($ids); ?>"
		><?php echo esc_html__('load more', 'allstore'); ?></a>
	</p>
	<?php endif; ?>
	</div>
<?php endif; wp_reset_postdata(); ?>