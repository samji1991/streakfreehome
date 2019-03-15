<?php
add_action( 'vc_before_init', 'allstore_products_integrate_vc' );
function allstore_products_integrate_vc () {
    vc_map( array(
        'name' => esc_html__( 'Products', 'allstore' ),
        'base' => 'allstore_products',
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'description' => esc_html__( 'Show multiple products by ID (custom order) or by another order.', 'allstore' ),
        'params' => array(
            array(
                'type' => 'autocomplete',
                'heading' => esc_html__( 'Products', 'allstore' ),
                'param_name' => 'ids',
                'settings' => array(
                    'multiple' => true,
                    'sortable' => true,
                    'unique_values' => true,
                    // In UI show results except selected. NB! You should manually check values in backend
                ),
                'save_always' => true,
                'description' => esc_html__( 'To choose custom ordering please set Order by to the Custom OR you can also leave empty this field and show products automatically by Order by field', 'allstore' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Order by', 'allstore' ),
                'param_name' => 'orderby',
                'value' => array(
                    esc_html__( 'Custom', 'allstore' ) => 'post__in',
                    esc_html__( 'Date', 'allstore' ) => 'date',
                    esc_html__( 'ID', 'allstore' ) => 'ID',
                    esc_html__( 'Author', 'allstore' ) => 'author',
                    esc_html__( 'Title', 'allstore' ) => 'title',
                    esc_html__( 'Modified', 'allstore' ) => 'modified',
                    esc_html__( 'Random', 'allstore' ) => 'rand',
                    esc_html__( 'Comment count', 'allstore' ) => 'comment_count',
                    esc_html__( 'Menu order', 'allstore' ) => 'menu_order',
                ),
                'std' => 'title',
                'save_always' => true,
                'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s. Default by Title', 'allstore' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Sort order', 'allstore' ),
                'param_name' => 'order',
                'value' => array(
                    '',
                    esc_html__( 'Descending', 'allstore' ) => 'DESC',
                    esc_html__( 'Ascending', 'allstore' ) => 'ASC',
                ),
                'save_always' => true,
                'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s. Default by ASC', 'allstore' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Items per page', 'allstore' ),
                'param_name' => 'items_per_page',
                'description' => esc_html__( 'Number of items to show per page. Enter -1 to display all', 'allstore' ),
                'value' => '8',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Show "Load more"', 'allstore' ),
                'param_name' => 'load_more',
                'value' => array(
                    esc_html__( 'Show', 'allstore' ) => 'show',
                    esc_html__( 'Hide', 'allstore' ) => 'hide',
                ),
                'std' => 'show',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'View mode', 'allstore' ),
                'param_name' => 'viewmode',
                'value' => array(
                    esc_html__( 'Gallery', 'allstore' ) => 'gallery',
                    esc_html__( 'List', 'allstore' ) => 'list',
                    esc_html__( 'Table', 'allstore' ) => 'table',
                ),
                'std' => 'gallery',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Gallery Mode Image', 'allstore' ),
                'param_name' => 'catalog_galimg',
                'value' => array(
                    esc_html__( 'Single Image', 'allstore' ) => 'single',
                    esc_html__( 'Carousel', 'allstore' ) => 'carousel',
                ),
                'std' => 'single',
                'dependency' => array(
                    'element' => 'viewmode',
                    'value' => 'gallery',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Gallery Mode Buttons', 'allstore' ),
                'param_name' => 'catalog_galbtns',
                'value' => array(
                    esc_html__( 'Image Area', 'allstore' ) => 'img',
                    esc_html__( 'Price Area', 'allstore' ) => 'price',
                    esc_html__( 'Hide', 'allstore' ) => 'hide',
                ),
                'std' => 'img',
                'dependency' => array(
                    'element' => 'viewmode',
                    'value' => 'gallery',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'List Mode Image', 'allstore' ),
                'param_name' => 'catalog_listimg',
                'value' => array(
                    esc_html__( 'Single Image', 'allstore' ) => 'single',
                    esc_html__( 'Carousel', 'allstore' ) => 'carousel',
                ),
                'std' => 'single',
                'dependency' => array(
                    'element' => 'viewmode',
                    'value' => 'list',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'List Mode Wishlist/Compare/Quick view', 'allstore' ),
                'param_name' => 'catalog_listactions',
                'value' => array(
                    esc_html__( 'Bottom', 'allstore' ) => 'bottom',
                    esc_html__( 'Top', 'allstore' ) => 'top',
                    esc_html__( 'Hide', 'allstore' ) => 'hide',
                ),
                'std' => 'bottom',
                'dependency' => array(
                    'element' => 'viewmode',
                    'value' => 'list',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'List Mode Attributes', 'allstore' ),
                'param_name' => 'catalog_listatts',
                'value' => array(
                    esc_html__( 'Bottom', 'allstore' ) => 'bottom',
                    esc_html__( 'Right', 'allstore' ) => 'right',
                    esc_html__( 'Hide', 'allstore' ) => 'hide',
                ),
                'std' => 'bottom',
                'dependency' => array(
                    'element' => 'viewmode',
                    'value' => 'list',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'List Mode Add to Cart', 'allstore' ),
                'param_name' => 'catalog_listadd2cart',
                'value' => array(
                    esc_html__( 'Advanced', 'allstore' ) => 'advanced',
                    esc_html__( 'Simple', 'allstore' ) => 'simple',
                    esc_html__( 'Hide', 'allstore' ) => 'hide',
                ),
                'std' => 'advanced',
                'dependency' => array(
                    'element' => 'viewmode',
                    'value' => 'list',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Table Mode Image', 'allstore' ),
                'param_name' => 'catalog_tbimg',
                'value' => array(
                    esc_html__( 'Single Image', 'allstore' ) => 'single',
                    esc_html__( 'Carousel', 'allstore' ) => 'carousel',
                ),
                'std' => 'single',
                'dependency' => array(
                    'element' => 'viewmode',
                    'value' => 'table',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Table Mode Add to Cart', 'allstore' ),
                'param_name' => 'catalog_tbadd2cart',
                'value' => array(
                    esc_html__( 'Advanced', 'allstore' ) => 'advanced',
                    esc_html__( 'Simple', 'allstore' ) => 'simple',
                    esc_html__( 'Hide', 'allstore' ) => 'hide',
                ),
                'std' => 'advanced',
                'dependency' => array(
                    'element' => 'viewmode',
                    'value' => 'table',
                ),
            ),
            array(
                'type' => 'hidden',
                'param_name' => 'skus',
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'Css', 'allstore' ),
                'param_name' => 'css',
                'group' => esc_html__( 'Design options', 'allstore' ),
            ),
        ),
    ) );
}



//Filters For autocomplete param:
//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
add_filter( 'vc_autocomplete_allstore_products_ids_callback', 'allstore_productIdAutocompleteSuggester', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_allstore_products_ids_render', 'allstore_productIdAutocompleteRender', 10, 1 ); // Render exact product. Must return an array (label,value)
//For param: ID default value filter
add_filter( 'vc_form_fields_render_field_allstore_products_ids_param_value', 'allstore_productsIdsDefaultValue', 10, 4 ); // Defines default value for param if not provided. Takes from other param value.



/**
 * Suggester for autocomplete by id/name/title/sku
 * @since 4.4
 *
 * @param $query
 *
 * @return array - id's from products with title/sku.
 */
function allstore_productIdAutocompleteSuggester( $query ) {
    global $wpdb;
    $product_id = (int) $query;
    $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.ID AS id, a.post_title AS title, b.meta_value AS sku
					FROM {$wpdb->posts} AS a
					LEFT JOIN ( SELECT meta_value, post_id  FROM {$wpdb->postmeta} WHERE `meta_key` = '_sku' ) AS b ON b.post_id = a.ID
					WHERE a.post_type = 'product' AND ( a.ID = '%d' OR b.meta_value LIKE '%%%s%%' OR a.post_title LIKE '%%%s%%' )", $product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

    $results = array();
    if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
        foreach ( $post_meta_infos as $value ) {
            $data = array();
            $data['value'] = $value['id'];
            $data['label'] = esc_html__( 'Id', 'allstore' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'allstore' ) . ': ' . $value['title'] : '' ) . ( ( strlen( $value['sku'] ) > 0 ) ? ' - ' . esc_html__( 'Sku', 'allstore' ) . ': ' . $value['sku'] : '' );
            $results[] = $data;
        }
    }

    return $results;
}




/**
 * Find product by id
 * @since 4.4
 *
 * @param $query
 *
 * @return bool|array
 */
function allstore_productIdAutocompleteRender( $query ) {
    $query = trim( $query['value'] ); // get value from requested
    if ( ! empty( $query ) ) {
        // get product
        $product_object = wc_get_product( (int) $query );
        if ( is_object( $product_object ) ) {
            $product_sku = $product_object->get_sku();
            $product_title = $product_object->get_title();
            $product_id = $product_object->id;

            $product_sku_display = '';
            if ( ! empty( $product_sku ) ) {
                $product_sku_display = ' - ' . esc_html__( 'Sku', 'allstore' ) . ': ' . $product_sku;
            }

            $product_title_display = '';
            if ( ! empty( $product_title ) ) {
                $product_title_display = ' - ' . esc_html__( 'Title', 'allstore' ) . ': ' . $product_title;
            }

            $product_id_display = esc_html__( 'Id', 'allstore' ) . ': ' . $product_id;

            $data = array();
            $data['value'] = $product_id;
            $data['label'] = $product_id_display . $product_title_display . $product_sku_display;

            return ! empty( $data ) ? $data : false;
        }

        return false;
    }

    return false;
}



/**
 * Replaces product skus to id's.
 * @since 4.4
 *
 * @param $current_value
 * @param $param_settings
 * @param $map_settings
 * @param $atts
 *
 * @return string
 */
function allstore_productsIdsDefaultValue( $current_value, $param_settings, $map_settings, $atts ) {
    $value = trim( $current_value );
    if ( strlen( trim( $value ) ) === 0 && isset( $atts['skus'] ) && strlen( $atts['skus'] ) > 0 ) {
        $data = array();
        $skus = $atts['skus'];
        $skus_array = explode( ',', $skus );
        foreach ( $skus_array as $sku ) {
            $id = $this->productIdDefaultValueFromSkuToId( trim( $sku ) );
            if ( is_numeric( $id ) ) {
                $data[] = $id;
            }
        }
        if ( ! empty( $data ) ) {
            $values = explode( ',', $value );
            $values = array_merge( $values, $data );
            $value = implode( ',', $values );
        }
    }

    return $value;
}




class WPBakeryShortCode_allstore_products extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'orderby' => 'date',
            'order' => 'DESC',
            'ids' => '',
            'items_per_page' => 8,
            'load_more' => 'show',
            'viewmode' => 'gallery',
            'catalog_galimg' => 'single',
            'catalog_galbtns' => 'img',
            'catalog_listimg' => 'single',
            'catalog_listactions' => 'bottom',
            'catalog_listatts' => 'bottom',
            'catalog_listadd2cart' => 'advanced',
            'catalog_tbimg' => 'single',
            'catalog_tbadd2cart' => 'advanced',
            'skus' => '',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();
        ?>

        <?php
        get_template_part('inc/shortcodes/products-content');
        ?>

        <?php
        $output = ob_get_clean();

        return $output;
    }
}