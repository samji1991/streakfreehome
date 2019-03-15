<?php
$page_num = (isset($_POST['page_num'])) ? $_POST['page_num'] : 1;
$items_per_page = (isset($_POST['posts_per_page'])) ? $_POST['posts_per_page'] : $items_per_page;

$order = (isset($_POST['order'])) ? $_POST['order'] : $order;
$orderby = (isset($_POST['orderby'])) ? $_POST['orderby'] : $orderby;

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
    $btn_exists = false;
    if (!empty($description) || !empty($link)) {
        $btn_exists = true;
    }
    ?>
    <div class="discounts-wrap<?php if (!$btn_exists) echo ' discounts-wrap-nobtn'; ?><?php echo esc_attr( $css_class ); ?>">
        <div class="flexslider discounts-list">
            <div class="slides">

                <?php
                while ($products_carousel_query->have_posts()) : $products_carousel_query->the_post();

                    global $product;

                    // Ensure visibility
                    if ( empty( $product ) || ! $product->is_visible() ) {
                        return;
                    }

                    $prod_id = get_the_ID();
                    $prod_ttl = get_the_title();

                    include(locate_template('woocommerce/content-product-small.php'));

                endwhile;
                ?>

            </div>
        </div>
        <?php if ($btn_exists) : ?>
        <div class="discounts-info">
            <?php if (!empty($description)) : ?>
            <p><?php echo wp_kses_post($description); ?></p>
            <?php endif; ?>
            <?php if (!empty($link)) :
                $link = vc_build_link($link);
                ?>
                <a href="<?php echo esc_url($link['url']); ?>"<?php if (!empty($link['target'])) echo ' target="'.esc_attr($link['target']).'"'; ?>><?php if (!empty($link['title'])) echo esc_attr($link['title']); ?></a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
<?php endif; wp_reset_postdata(); ?>