<?php

/*
 * Products List Actions
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_shop_loop', 'wccm_register_add_compare_button_hook' );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );


/*
 * Single Product Actions
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 5 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 4 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_single_product_summary', 'wccm_add_single_product_compare_buttton', 35 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

add_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );

// Compare List
remove_action( 'woocommerce_before_shop_loop', 'wccm_render_catalog_compare_info' );



if ( ! function_exists( 'woocommerce_taxonomy_archive_description' ) ) {

    /**
     * Show an archive description on taxonomy archives.
     *
     * @subpackage  Archives
     */
    function woocommerce_taxonomy_archive_description() {
        if ( is_tax( array( 'product_cat', 'product_tag', 'product_brands', 'product_badges' ) ) && 0 === absint( get_query_var( 'paged' ) ) ) {
            $description = wc_format_content( term_description() );
            if ( $description ) {
                echo '<div class="term-description stylization">' . wp_kses_post($description) . '</div>';
            }
        }
    }
}
if ( ! function_exists( 'woocommerce_product_archive_description' ) ) {

    /**
     * Show a shop page description on product archives.
     *
     * @subpackage  Archives
     */
    function woocommerce_product_archive_description() {
        if ( is_post_type_archive( 'product' ) && 0 === absint( get_query_var( 'paged' ) ) ) {
            $shop_page   = get_post( wc_get_page_id( 'shop' ) );
            if ( $shop_page ) {
                $description = wc_format_content( $shop_page->post_content );
                if ( $description ) {
                    echo '<div class="page-description stylization">' . wp_kses_post($description) . '</div>';
                }
            }
        }
    }
}





/*
 * Show Product Additional Information
 * Gallery Mode
 */
if (!function_exists('allstore_section_gallery_props')) {
    function allstore_section_gallery_props($attributes) {
        global $product;
        if (!empty($attributes)) :
            ?>
            <div class="prod-i-properties">
                <dl>
                    <?php
                    foreach ( $attributes as $attribute ) :

                        if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) {
                            continue;
                        }
                        ?>
                            <dt>
                                <?php echo wp_kses_post(wc_attribute_label( $attribute['name'] )); ?>
                            </dt>
                            <dd>
                                <?php
                                if ( $attribute['is_taxonomy'] ) {

                                    $values = wc_get_product_terms( $product->get_id(), $attribute['name'], array( 'fields' => 'names' ) );
                                    echo apply_filters( 'woocommerce_attribute', wptexturize( implode( ', ', $values ) ), $attribute, $values );

                                } else {

                                    // Convert pipes to commas and display values
                                    $values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
                                    echo apply_filters( 'woocommerce_attribute', wptexturize( implode( ', ', $values ) ), $attribute, $values );

                                }
                                ?>
                                <br>
                            </dd>
                        <?php
                    endforeach; ?>
                </dl>
            </div>
        <?php endif;

    }
}


/*
 * Show Product Additional Information
 * List Mode
 */
if (!function_exists('allstore_section_list_props')) {
    function allstore_section_list_props($attributes, $position = 'bottom') {
        global $product;
        if (!empty($attributes)) :
            ?>

            <?php if ($position == 'right') : ?>
            <div class="prodlist-i-props-wrap">
                <ul class="prodlist-i-props">
            <?php else: ?>
            <ul class="prodlist-i-props2">
            <?php endif; ?>

                    <?php
                    foreach ( $attributes as $attribute ) :

                        if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) {
                            continue;
                        }
                        ?>
                        <li>

                            <?php if ($position == 'right') : ?>
                            <b><?php echo wp_kses_post(wc_attribute_label( $attribute['name'] )); ?></b>
                            <?php else: ?>
                            <span class="prodlist-i-propttl"><span><?php echo wp_kses_post(wc_attribute_label( $attribute['name'] )); ?></span></span>
                            <?php endif; ?>


                            <?php if ($position !== 'right') : ?>
                            <span class="prodlist-i-propval">
                            <?php endif; ?>

                            <?php
                            if ( $attribute['is_taxonomy'] ) {

                                $values = wc_get_product_terms( $product->get_id(), $attribute['name'], array( 'fields' => 'names' ) );
                                echo apply_filters( 'woocommerce_attribute', wptexturize( implode( ', ', $values ) ), $attribute, $values );

                            } else {

                                // Convert pipes to commas and display values
                                $values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
                                echo apply_filters( 'woocommerce_attribute', wptexturize( implode( ', ', $values ) ), $attribute, $values );

                            }
                            ?>

                            <?php if ($position !== 'right') : ?>
                            </span>
                            <?php endif; ?>

                        </li>
                        <?php
                    endforeach; ?>

            <?php if ($position == 'right') : ?>
                </ul>
            </div>
            <?php else: ?>
            </ul>
            <?php endif; ?>

        <?php endif;
    }
}


/*
 * View Mode HTML
 */
if (!function_exists('allstore_viewmode')) {
    function allstore_viewmode() {
        global $wp;
        $viewmode = allstore_option('catalog_viewmode', true);
        //$current_url = esc_url(home_url(add_query_arg(array(), $wp->request)));
        $current_url = get_permalink(get_option('woocommerce_shop_page_id'));
        $viewmode_types = array(
            array(
                'id' => 'gallery',
                'name' => esc_html__('Gallery View', 'allstore'),
            ),
            array(
                'id' => 'list',
                'name' => esc_html__('List View', 'allstore'),
            ),
            array(
                'id' => 'table',
                'name' => esc_html__('Table View', 'allstore'),
            ),
        );
        if (!empty($viewmode_types)) :
            ?>
            <ul class="section-mode" id="section-mode">
                <?php foreach ($viewmode_types as $viewmode_type) : ?>
                    <li class="section-mode-<?php
                    if (!empty($viewmode_type['id'])) { echo esc_html($viewmode_type['id']); }
                    if ($viewmode_type['id'] == $viewmode) { echo ' active'; }
                    ?>">
                        <a<?php /*data-viewmode="<?php if (!empty($viewmode_type['id'])) { echo esc_html($viewmode_type['id']); } ?>"*/ ?> href="<?php echo esc_url($current_url.'?catalog_viewmode='.$viewmode_type['id']); ?>">
                            <span><?php if (!empty($viewmode_type['name'])) { echo esc_html($viewmode_type['name']); } ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif;
    }
}

add_action( 'woocommerce_before_shop_loop', 'allstore_viewmode', 15 );



/*
 * Get Wishlist button
 */
if (!function_exists('allstore_get_wishlist_btn')) {
    function allstore_get_wishlist_btn() {
        if (class_exists('YITH_WCWL') && shortcode_exists('yith_wcwl_add_to_wishlist')) {
            return do_shortcode('[yith_wcwl_add_to_wishlist]');
        } else {
            return '';
        }
    }
}



/*
 * Get Compare button
 */
if (!function_exists('allstore_get_compare_btn')) {
    function allstore_get_compare_btn($id = '') {
        if (!defined( 'WCCM_VERISON' )) {
            return '';
        }

        global $allstore_options;

        if (empty($id)) {
            $id = get_the_ID();
        }
        
        if ( in_array( $id, wccm_get_compare_list() ) ) {
            $url = wccm_get_compare_link( $id, 'add-to-list' );
            $remove_url = wccm_get_compare_link( $id, 'remove-from-list' );
            $text = esc_html__( 'Remove', 'allstore' );
            $button = '<a data-id="'.$id.'" data-text="'.esc_html__( 'Compare', 'allstore' ). '" data-url="'. esc_url( $url ). '" href="'. wccm_get_compare_page_link( wccm_get_compare_list() ). '" class="compare-btn compare-added"><i class="fa fa-bar-chart"></i> <span class="compare-btn-text">'.esc_html__( 'View Compare', 'allstore' ). '</span></a>';
            if ( is_single() ) {
                $button .= '<a href="'. esc_url( $remove_url ). '" class="compare-btn compare-del">('.esc_html( $text ). ')</a>';
            }
        } else {
            $url = wccm_get_compare_link( $id, 'add-to-list' );
            $text = esc_html__( 'Compare', 'allstore' );
            $button = '<a data-id="'.intval($id).'" data-text="'.esc_html__( 'View Compare', 'allstore' ). '" data-url="'.esc_url($allstore_options['compare']['url']).'" href="'. esc_url( $url ). '" class="compare-btn">'. '<i class="fa fa-bar-chart"></i> <span class="compare-btn-text">'.esc_html( $text ). '</span></a>';
        }
        
        return $button;
    }
}



if (!function_exists('allstore_validate_gravatar')) {
    /**
     * Utility function to check if a gravatar exists for a given email or id
     * @param int|string|object $id_or_email A user ID,  email address, or comment object
     * @return bool if the gravatar exists or not
     */
    function allstore_validate_gravatar ($id_or_email) {
        //id or email code borrowed from wp-includes/pluggable.php
        $email = '';
        if ( is_numeric($id_or_email) ) {
            $id = (int) $id_or_email;
            $user = get_userdata($id);
            if ( $user )
                $email = $user->user_email;
        } elseif ( is_object($id_or_email) ) {
            // No avatar for pingbacks or trackbacks
            $allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
            if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
                return false;
    
            if ( !empty($id_or_email->user_id) ) {
                $id = (int) $id_or_email->user_id;
                $user = get_userdata($id);
                if ( $user)
                    $email = $user->user_email;
            } elseif ( !empty($id_or_email->comment_author_email) ) {
                $email = $id_or_email->comment_author_email;
            }
        } else {
            $email = $id_or_email;
        }
    
        $hashkey = md5(strtolower(trim($email)));
        $uri = 'http://www.gravatar.com/avatar/' . $hashkey . '?d=404';
    
        $data = wp_cache_get($hashkey);
        if (false === $data) {
            $response = wp_remote_head($uri);
            if( is_wp_error($response) ) {
                $data = 'not200';
            } else {
                $data = $response['response']['code'];
            }
            wp_cache_set($hashkey, $data, $group = '', $expire = 60*5);
    
        }
        if ($data == '200'){
            return true;
        } else {
            return false;
        }
    }
}



/*
 * Quick View Ajax
 */
add_action('wp_ajax_nopriv_allstore_quick_view', 'allstore_quick_view');
add_action('wp_ajax_allstore_quick_view', 'allstore_quick_view');
function allstore_quick_view () {

    if ( ! isset( $_REQUEST['product_id'] ) ) {
        die();
    }

    $product_id = intval( $_REQUEST['product_id'] );

    wp( 'p=' . $product_id . '&post_type=product' );

    if (isset($_POST['file'])) {
        include( trailingslashit( get_template_directory() ) . $_POST['file'] );
    }
    die();
}


/*
 * Footer Block Ajax
 */
add_action('wp_ajax_nopriv_allstore_footer_block', 'allstore_footer_block');
add_action('wp_ajax_allstore_footer_block', 'allstore_footer_block');
function allstore_footer_block () {

    if ( ! isset( $_REQUEST['block_id'] ) ) {
        die();
    }

    $id = $_REQUEST['block_id'];
    $allstore_options['footer_blocks'] = get_theme_mod('footer_blocks', '');

    if (!empty($allstore_options['footer_blocks']) && !empty($allstore_options['footer_blocks'][$id])) { ?>
        <div class="stylization f-block-modal f-block-modal-content">
            <?php
            if (!empty($allstore_options['footer_blocks'][$id]['block_text'])) {
                echo do_shortcode($allstore_options['footer_blocks'][$id]['block_text']);
            }
            ?>
        </div>
        <?php
    }

    die();
}



/*
 * Walker for Header categories list
 */
class Walker_Allstore_Allcatalog extends Walker_Category {

    /**
     * Starts the list before the elements are added.
     *
     * @since 2.1.0
     * @access public
     *
     * @see Walker::start_lvl()
     *
     * @param string $output Used to append additional content. Passed by reference.
     * @param int    $depth  Optional. Depth of category. Used for tab indentation. Default 0.
     * @param array  $args   Optional. An array of arguments. Will only append content if style argument
     *                       value is 'list'. See wp_list_categories(). Default empty array.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( 'list' != $args['style'] )
            return;

        $indent = str_repeat("\t", $depth);
        $output .= "$indent<i class='fa fa-angle-right'></i><ul class='children'>\n";
    }


    /**
     * Starts the element output.
     *
     * @since 2.1.0
     * @access public
     *
     * @see Walker::start_el()
     *
     * @param string $output   Passed by reference. Used to append additional content.
     * @param object $category Category data object.
     * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
     * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
     * @param int    $id       Optional. ID of the current category. Default 0.
     */
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );

        // Don't generate an element if the category name is empty.
        if ( ! $cat_name ) {
            return;
        }

        $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
        if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
            /**
             * Filters the category description for display.
             *
             * @since 1.2.0
             *
             * @param string $description Category description.
             * @param object $category    Category object.
             */
            $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
        }

        $link .= '>';
        $link .= $cat_name;
        if ( ! empty( $args['show_count'] ) ) {
            $link .= ' <span class="count">(' . number_format_i18n( $category->count ) . ')</span>';
        }
        $link .= '</a>';

        if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
            $link .= ' ';

            if ( empty( $args['feed_image'] ) ) {
                $link .= '(';
            }

            $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';

            if ( empty( $args['feed'] ) ) {
                $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'allstore' ), $cat_name ) . '"';
            } else {
                $alt = ' alt="' . $args['feed'] . '"';
                $name = $args['feed'];
                $link .= empty( $args['title'] ) ? '' : $args['title'];
            }

            $link .= '>';

            if ( empty( $args['feed_image'] ) ) {
                $link .= $name;
            } else {
                $link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
            }
            $link .= '</a>';

            if ( empty( $args['feed_image'] ) ) {
                $link .= ')';
            }
        }

        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $css_classes = array(
                'cat-item',
                'cat-item-' . $category->term_id,
            );

            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms( $category->taxonomy, array(
                    'include' => $args['current_category'],
                    'hide_empty' => false,
                ) );

                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] =  'current-cat-ancestor';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }

            /**
             * Filters the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );

            $output .=  ' class="' . $css_classes . '"';
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }
}



/*
 * Walker for Header categories list
 */
class Walker_Allstore_Categories_Widget extends Walker_Category {

    /**
     * Starts the element output.
     *
     * @since 2.1.0
     * @access public
     *
     * @see Walker::start_el()
     *
     * @param string $output   Passed by reference. Used to append additional content.
     * @param object $category Category data object.
     * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
     * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
     * @param int    $id       Optional. ID of the current category. Default 0.
     */
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );

        // Don't generate an element if the category name is empty.
        if ( ! $cat_name ) {
            return;
        }

        $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
        if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
            /**
             * Filters the category description for display.
             *
             * @since 1.2.0
             *
             * @param string $description Category description.
             * @param object $category    Category object.
             */
            $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
        }

        $link .= '>';
        $link .= '<span class="section-sb-label">'.$cat_name;
        if ( ! empty( $args['show_count'] ) ) {
            $link .= ' <span class="count">(' . number_format_i18n( $category->count ) . ')</span>';
        }
        $link .= '</span>';
        if ($this->has_children) {
            $link .= '<span class="section-sb-toggle"><span class="section-sb-ico"></span></span>';
        }
        $link .= '</a>';

        if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
            $link .= ' ';

            if ( empty( $args['feed_image'] ) ) {
                $link .= '(';
            }

            $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';

            if ( empty( $args['feed'] ) ) {
                $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s', 'allstore' ), $cat_name ) . '"';
            } else {
                $alt = ' alt="' . $args['feed'] . '"';
                $name = $args['feed'];
                $link .= empty( $args['title'] ) ? '' : $args['title'];
            }

            $link .= '>';

            if ( empty( $args['feed_image'] ) ) {
                $link .= $name;
            } else {
                $link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
            }
            $link .= '</a>';

            if ( empty( $args['feed_image'] ) ) {
                $link .= ')';
            }
        }

        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $css_classes = array(
                'cat-item',
                'cat-item-' . $category->term_id,
            );
            if ($this->has_children) {
                $css_classes[] = 'has_child';
            }

            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms( $category->taxonomy, array(
                    'include' => $args['current_category'],
                    'hide_empty' => false,
                ) );

                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] =  'current-cat-ancestor';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }

            /**
             * Filters the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );

            $output .=  ' class="' . $css_classes . '"';
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }


}



/*
 Woocommerce Add to cart Ajax for variable products
 http://www.rcreators.com/woocommerce-ajax-add-to-cart-variable-products
 Ajax based add to cart for varialbe products in woocommerce.
 Rishi Mehta - Rcreators Websolutions
 http://rcreators.com
 */
add_action( 'wp_ajax_woocommerce_add_to_cart_variable_rc', 'allstore_add_to_cart_variable_rc_callback' );
add_action( 'wp_ajax_nopriv_woocommerce_add_to_cart_variable_rc', 'allstore_add_to_cart_variable_rc_callback' );

function allstore_add_to_cart_variable_rc_callback() {

    ob_start();

    $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
    $quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
    $variation_id = $_POST['variation_id'];
    $variation  = $_POST['variation'];
    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

    if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation  ) ) {
        do_action( 'woocommerce_ajax_added_to_cart', $product_id );
        if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
            wc_add_to_cart_message( $product_id );
        }

        // Return fragments
        WC_AJAX::get_refreshed_fragments();
    } else {
        $this->json_headers();

        // If there was an error adding to the cart, redirect to the product page to show any errors
        $data = array(
            'error' => true,
            'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
        );
        echo json_encode( $data );
    }
    die();
}





/*
 * Product Badge HTML
 */
function allstore_product_badge($product_id, $class='') {
    if (!taxonomy_exists('product_badges')) {
        return true;
    }

    $product_badges = get_the_terms( $product_id, 'product_badges' );
    if (!empty($product_badges)) {
        foreach ($product_badges as $badge) {
            $badge_color = get_option("taxonomy_badges_".$badge->term_id);
            $badge->color = $badge_color['color'];
        }
    }

    if (!empty($product_badges)) : ?>
    <div class="prod-sticker<?php if (!empty($class)) echo ' '.esc_html($class); ?>">
        <?php foreach ($product_badges as $badge) : ?>
            <p<?php if (!empty($badge->color)) echo ' style="background-color: '.esc_html($badge->color).';"'; ?>><?php echo esc_html($badge->name); ?></p>
        <?php endforeach; ?>
    </div>
    <?php endif;
}







if ( ! function_exists( 'allstore_cart_link_fragment' ) ) {
    /**
     * Cart Fragments
     * Ensure cart contents update when products are added to the cart via AJAX
     *
     * @param  array $fragments Fragments to refresh via AJAX.
     * @return array            Fragments to refresh via AJAX
     */
    function allstore_cart_link_fragment( $fragments ) {
        global $woocommerce;

        ob_start();
        allstore_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'allstore_cart_link_fragment' );

if ( ! function_exists( 'allstore_cart_link' ) ) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     *
     * @return void
     * @since  1.0.0
     */
    function allstore_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
            <i class="fa fa-shopping-cart"></i>
            <span class="shop-menu-ttl"><?php esc_html_e('Cart', 'allstore'); ?></span>
            (<b><?php echo intval(WC()->cart->get_cart_contents_count()); ?></b>)
        </a>
        <?php
    }
}




function allstore_maybe_show_product_subcategories() {
    remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
    $display_type = woocommerce_get_loop_display_mode();
    // If displaying categories, append to the loop.
    if ( 'subcategories' === $display_type || 'both' === $display_type ) {
        ob_start();
        woocommerce_output_product_categories(array('before'=>'<ul class="categs-list">', 'after'=>'</ul>', 'parent_id' => is_product_category() ? get_queried_object_id() : 0));
        if ( 'subcategories' === $display_type ) {
            wc_set_loop_prop( 'total', 0 );
            // This removes pagination and products from display for themes not using wc_get_loop_prop in their product loops.  @todo Remove in future major version.
            global $wp_query;
            if ( $wp_query->is_main_query() ) {
                $wp_query->post_count    = 0;
                $wp_query->max_num_pages = 0;
            }
        }
    }
}

