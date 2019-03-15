<?php
add_action( 'vc_before_init', 'allstore_product_brands_integrate_vc' );
function allstore_product_brands_integrate_vc () {
    vc_map( array(
        'name' => esc_html__( 'Products brands', 'allstore' ),
        'base' => 'allstore_product_brands',
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'description' => esc_html__( 'Display products brands loop', 'allstore' ),
        'params' => array(
            array(
                'type' => 'autocomplete',
                'heading' => esc_html__( 'Brands', 'allstore' ),
                'param_name' => 'ids',
                'settings' => array(
                    'multiple' => true,
                    'sortable' => true,
                ),
                'save_always' => true,
                'description' => esc_html__( 'List of product brands', 'allstore' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Number', 'allstore' ),
                'param_name' => 'number',
                'description' => esc_html__( 'The `number` field is used to display the number of products.', 'allstore' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Order by', 'allstore' ),
                'param_name' => 'orderby',
                'value' => array(
                    esc_html__( 'Custom', 'allstore' ) => 'include',
                    esc_html__( 'ID', 'allstore' ) => 'ID',
                    esc_html__( 'Name', 'allstore' ) => 'name',
                    esc_html__( 'Count', 'allstore' ) => 'count',
                    esc_html__( 'Slug', 'allstore' ) => 'slug',
                    esc_html__( 'Description', 'allstore' ) => 'description',
                ),
                'save_always' => true,
                'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'allstore' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
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
                'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'allstore' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Name', 'allstore' ),
                'param_name' => 'name_show',
                'value' => array(
                    '',
                    esc_html__( 'Show', 'allstore' ) => 'show',
                    esc_html__( 'Hide', 'allstore' ) => 'hide',
                ),
                'std' => 'show'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Hide empty', 'allstore' ),
                'param_name' => 'hide_empty',
                'value' => array(
                    '',
                    esc_html__( 'Yes', 'allstore' ) => 'true',
                    esc_html__( 'No', 'allstore' ) => 'false',
                ),
                'std' => 'false'
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
add_filter( 'vc_autocomplete_allstore_product_brands_ids_callback', 'allstore_productBrandAutocompleteSuggester', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_allstore_product_brands_ids_render', 'allstore_productBrandRenderByIdExact', 10, 1 ); // Render exact category by id. Must return an array (label,value)


function allstore_productBrandAutocompleteSuggester( $query, $slug = false ) {
    global $wpdb;
    $cat_id = (int) $query;
    $query = trim( $query );
    $post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.term_id AS id, b.name as name, b.slug AS slug
						FROM {$wpdb->term_taxonomy} AS a
						INNER JOIN {$wpdb->terms} AS b ON b.term_id = a.term_id
						WHERE a.taxonomy = 'product_brands' AND (a.term_id = '%d' OR b.slug LIKE '%%%s%%' OR b.name LIKE '%%%s%%' )", $cat_id > 0 ? $cat_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

    $result = array();
    if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
        foreach ( $post_meta_infos as $value ) {
            $data = array();
            $data['value'] = $slug ? $value['slug'] : $value['id'];
            $data['label'] = esc_html__( 'Id', 'allstore' ) . ': ' . $value['id'] . ( ( strlen( $value['name'] ) > 0 ) ? ' - ' . esc_html__( 'Name', 'allstore' ) . ': ' . $value['name'] : '' ) . ( ( strlen( $value['slug'] ) > 0 ) ? ' - ' . esc_html__( 'Slug', 'allstore' ) . ': ' . $value['slug'] : '' );
            $result[] = $data;
        }
    }

    return $result;
}


function allstore_productBrandRenderByIdExact( $query ) {
    $query = $query['value'];
    $cat_id = (int) $query;
    $term = get_term( $cat_id, 'product_brands' );

    return allstore_productBrandTermOutput( $term );
}


function allstore_productBrandTermOutput( $term ) {
    $term_slug = $term->slug;
    $term_title = $term->name;
    $term_id = $term->term_id;

    $term_slug_display = '';
    if ( ! empty( $term_slug ) ) {
        $term_slug_display = ' - ' . esc_html__( 'Sku', 'allstore' ) . ': ' . $term_slug;
    }

    $term_title_display = '';
    if ( ! empty( $term_title ) ) {
        $term_title_display = ' - ' . esc_html__( 'Title', 'allstore' ) . ': ' . $term_title;
    }

    $term_id_display = esc_html__( 'Id', 'allstore' ) . ': ' . $term_id;

    $data = array();
    $data['value'] = $term_id;
    $data['label'] = $term_id_display . $term_title_display . $term_slug_display;

    return ! empty( $data ) ? $data : false;
}



class WPBakeryShortCode_allstore_product_brands extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'number' => 0,
            'orderby' => 'name',
            'order' => 'DESC',
            'hide_empty' => 'false',
            'ids' => '',
            'name_show' => '',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();

        $include_ids = explode( ', ', $ids );

        if ($hide_empty == 'true') {
            $hide_empty = 1;
        } else {
            $hide_empty = 0;
        }

        $product_brands = get_terms( 'product_brands', array(
            'number' => $number,
            'order' => $order,
            'orderby' => $orderby,
            'hide_empty' => $hide_empty,
            'include' => $include_ids
        ) );
        if ( $product_brands ) :
            ?>
            <div class="flexslider brands-list<?php echo esc_attr( $css_class ); ?>">
                <ul class="slides">
                    <?php foreach ($product_brands as $brand) :
                        $brand_img = get_option("taxonomy_brands_".$brand->term_id);
                        ?>
                        <li class="brands-i">
                            <a class="brands-i-link" href="<?php echo get_term_link($brand->term_id); ?>">
								<span class="brands-i-img">
									<?php if (!empty($brand_img['img'])) : ?>
                                        <img src="<?php echo esc_html($brand_img['img']); ?>" alt="<?php echo esc_attr($brand->name); ?>">
                                    <?php endif; ?>
								</span>
                                <?php if ($name_show !== 'hide') : ?>
                                <p class="brands-i-ttl"><?php echo esc_attr($brand->name); ?> <span class="brands-i-count">(<?php echo esc_attr($brand->count); ?>)</span></p>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php
        endif;

        $output = ob_get_clean();

        return $output;
    }
}