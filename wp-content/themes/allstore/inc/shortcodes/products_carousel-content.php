<?php
$page_num = (isset($_POST['page_num'])) ? $_POST['page_num'] : 1;
$items_per_page = (isset($_POST['posts_per_page'])) ? $_POST['posts_per_page'] : $items_per_page;

$order = (isset($_POST['order'])) ? $_POST['order'] : $order;
$orderby = (isset($_POST['orderby'])) ? $_POST['orderby'] : $orderby;

$catalog_galimg = (isset($_POST['catalog_galimg'])) ? $_POST['catalog_galimg'] : $catalog_galimg;
$catalog_galbtns = (isset($_POST['catalog_galbtns'])) ? $_POST['catalog_galbtns'] : $catalog_galbtns;

$ids = (isset($_POST['ids'])) ? $_POST['ids'] : $ids;
if (!empty($ids)) {
    $ids_arr = explode(', ', $ids);
} else {
    $ids_arr = array();
}

$products_carousel_query = new WP_Query( array(
    'post__in' => $ids_arr,
    'post_type'   => 'product',
    'post_status' => 'publish',
    'order'          => $order,
    'orderby'        => $orderby,
    'posts_per_page' => $items_per_page,
    'paged'          => $page_num,
) );

if ($products_carousel_query->have_posts()) :
    ?>

    <div class="woocommerce flexslider prod-items products_carousel<?php echo esc_attr( $css_class ); ?>">
        <div class="slides">

            <?php
            while ($products_carousel_query->have_posts()) : $products_carousel_query->the_post();

                global $product;

                // Ensure visibility
                if ( empty( $product ) || ! $product->is_visible() ) {
                    return;
                }

                $attributes = $product->get_attributes();
                $has_attributes = false;
                if (!empty($attributes)) {
                    foreach ($attributes as $attr) {
                        if (!empty($attr['value'])) {
                            $has_attributes = true;
                            break;
                        }
                    }
                }

                include(locate_template('woocommerce/content-product-gallery.php'));

            endwhile;
            ?>

        </div>
    </div>
<?php endif; wp_reset_postdata(); ?>