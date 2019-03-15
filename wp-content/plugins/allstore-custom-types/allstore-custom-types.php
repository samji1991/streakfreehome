<?php
/*
Plugin Name: AllStore Custom Types
Description: A plugin that will create custom post types.
Version: 1.1
Author: Real Web
Author URI: http://themeforest.net/user/real-web
License: GNU General Public License
*/


load_plugin_textdomain('allstore-custom-types');


function allstore_admin_scripts_styles() {
    wp_enqueue_script('allstore-admin-js', plugin_dir_url(__FILE__).'/js/admin-js.js', array( 'jquery' ), null, true);
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'allstore_admin_scripts_styles' );


function allstore_product_brands_taxonomy()
{

    $labels = array(
        'name' => esc_html__('Brands', 'allstore-custom-types'),
        'singular_name' => esc_html__('Brand', 'allstore-custom-types'),
        'menu_name' => esc_html__('Brands', 'allstore-custom-types'),
        'add_new' => esc_html__('Add New Brand', 'allstore-custom-types'),
        'add_new_item' => esc_html__('Add New Brand', 'allstore-custom-types'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => null,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'update_count_callback' => '',
        'rewrite' => true,
        'query_var' => true,
        'capabilities' => array(),
        'meta_box_cb' => null,
        'show_admin_column' => false,
        '_builtin' => false,
        'show_in_quick_edit' => null,
    );
    register_taxonomy('product_brands', array('product'), $args);
}

add_action('init', 'allstore_product_brands_taxonomy');

// New Image Field to Brands Taxonomy
function allstore_brands_fields($tag)
{
    //check for existing taxonomy meta for term ID
    if (!empty($tag->term_id)) {
        $t_id = $tag->term_id;
        $term_brands_meta = get_option( "taxonomy_brands_$t_id");
    }
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_brands_meta[img]"><?php esc_html_e('Brand Image', 'allstore-custom-types'); ?></label></th>
        <td class="brands-field">
            <input name="term_brands_meta[img]" type="hidden" class="brands-upload-img" value="<?php if (!empty($term_brands_meta['img'])) echo $term_brands_meta['img']; ?>">
            <div class="brands-field-img">
                <?php if (!empty($term_brands_meta['img'])) : ?>
                    <img src="<?php echo $term_brands_meta['img']; ?>" width="48" alt="">
                <?php endif; ?>
            </div>
            <input class="button brands-field-upload-btn" type="button" value="<?php esc_html_e('Choose Image', 'allstore-custom-types'); ?>">
            <br><a href="#" class="brands-field-remove-btn"<?php if (empty($term_brands_meta['img'])) : ?> style="display: none;"<?php endif; ?>><?php esc_html_e('Remove Image', 'allstore-custom-types'); ?></a><br>
        </td>
    </tr>
    <?php
}
add_action( 'product_brands_add_form_fields', 'allstore_brands_fields', 10, 2);
add_action( 'product_brands_edit_form_fields', 'allstore_brands_fields', 10, 2);


function save_allstore_brands_fields($term_id)
{
    if ( isset( $_POST['term_brands_meta'] ) ) {
        $t_id = $term_id;
        $term_brands_meta = get_option( "taxonomy_brands_$t_id");
        $cat_keys = array_keys($_POST['term_brands_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_brands_meta'][$key])){
                $term_brands_meta[$key] = $_POST['term_brands_meta'][$key];
            }
        }
        //save the option array
        update_option( "taxonomy_brands_$t_id", $term_brands_meta );
    }
}
add_action( 'edited_product_brands', 'save_allstore_brands_fields', 10, 2);
add_action('created_product_brands','save_allstore_brands_fields', 10, 2);




function allstore_product_badges_taxonomy()
{

    $labels = array(
        'name' => esc_html__('Badges', 'allstore-custom-types'),
        'singular_name' => esc_html__('Badge', 'allstore-custom-types'),
        'menu_name' => esc_html__('Badges', 'allstore-custom-types'),
        'add_new' => esc_html__('Add New Badge', 'allstore-custom-types'),
        'add_new_item' => esc_html__('Add New Badge', 'allstore-custom-types'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => null,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'hierarchical' => true,
        'update_count_callback' => '',
        'rewrite' => true,
        'query_var' => true,
        'capabilities' => array(),
        'meta_box_cb' => null,
        'show_admin_column' => false,
        '_builtin' => false,
        'show_in_quick_edit' => null,
    );
    register_taxonomy('product_badges', array('product'), $args);
}

add_action('init', 'allstore_product_badges_taxonomy');

// New Text Field to Badges Taxonomy
function allstore_badges_fields($tag)
{
    if (!empty($tag->term_id)) {
        $t_id = $tag->term_id;
        $term_badges_meta = get_option( "taxonomy_badges_$t_id");
    }
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_badges_meta[color]"><?php esc_html_e('Badge Color', 'allstore-custom-types'); ?></label></th>
        <td class="badges-field">
            <input name="term_badges_meta[color]" type="text" value="<?php if (!empty($term_badges_meta['color'])) echo $term_badges_meta['color']; ?>">
            <br><p class="description"><?php esc_html_e('Hex Color Codes, e.g. #ff3100', 'allstore-custom-types'); ?></p><br>
        </td>
    </tr>
    <?php
}
add_action( 'product_badges_add_form_fields', 'allstore_badges_fields', 10, 2);
add_action( 'product_badges_edit_form_fields', 'allstore_badges_fields', 10, 2);


function save_allstore_badges_fields($term_id)
{
    if ( isset( $_POST['term_badges_meta'] ) ) {
        $t_id = $term_id;
        $term_badges_meta = get_option( "taxonomy_badges_$t_id");
        $cat_keys = array_keys($_POST['term_badges_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_badges_meta'][$key])){
                $term_badges_meta[$key] = $_POST['term_badges_meta'][$key];
            }
        }
        //save the option array
        update_option( "taxonomy_badges_$t_id", $term_badges_meta );
    }
}
add_action( 'edited_product_badges', 'save_allstore_badges_fields', 10, 2);
add_action('created_product_badges','save_allstore_badges_fields', 10, 2);



include('widgets/widget-brands.php');
include('widgets/widget-badges.php');
include('widgets/widget-categories.php');
include('plugins/woocommerce-products-per-page/woocommerce-products-per-page.php');
//include('plugins/woocommerce-ajax-cart/wooajaxcart.php');
