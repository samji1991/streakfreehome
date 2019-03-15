<?php
add_action( 'vc_before_init', 'allstore_links_modal_integrate_vc' );
function allstore_links_modal_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Links Modal', 'allstore'),
        'base' => 'allstore_links_modal',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'as_parent' => array('only' => 'allstore_links_modal_item'),
        'js_view' => 'VcColumnView',
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Columns', 'allstore' ),
                'value' => array(
                    esc_html__( 'Columns 1', 'allstore' ) => 'col_1',
                    esc_html__( 'Columns 2', 'allstore' ) => 'col_2',
                    esc_html__( 'Columns 3', 'allstore' ) => 'col_3',
                    esc_html__( 'Columns 4', 'allstore' ) => 'col_4',
                    esc_html__( 'Columns 6', 'allstore' ) => 'col_5',
                ),
                'std' => 'col_4',
                'param_name' => 'columns',
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

class WPBakeryShortCode_allstore_links_modal extends WPBakeryShortCodesContainer {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'columns' => 'col_4',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
        
        ob_start();
        ?>
        <div class="f-block-list <?php echo $columns; echo esc_attr( $css_class ); ?>">
            <?php echo do_shortcode( $content ); ?>
        </div>
        <?php
        $output = ob_get_clean();

        return $output;
    }
}




add_action( 'vc_before_init', 'allstore_links_modal_item_integrate_vc' );
function allstore_links_modal_item_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Links Modal - Item', 'allstore'),
        'base' => 'allstore_links_modal_item',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'as_child' => array('only' => 'allstore_links_modal'),
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'allstore'),
                'param_name' => 'title',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Description', 'allstore'),
                'param_name' => 'description',
            ),
            array(
                'type' => 'textarea_html',
                'heading' => esc_html__('Content', 'allstore'),
                'param_name' => 'content',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'allstore'),
                'param_name' => 'image',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icon library', 'allstore' ),
                'value' => array(
                    esc_html__( 'Font Awesome', 'allstore' ) => 'fontawesome',
                    esc_html__( 'Open Iconic', 'allstore' ) => 'openiconic',
                    esc_html__( 'Typicons', 'allstore' ) => 'typicons',
                    esc_html__( 'Entypo', 'allstore' ) => 'entypo',
                    esc_html__( 'Linecons', 'allstore' ) => 'linecons',
                    esc_html__( 'Mono Social', 'allstore' ) => 'monosocial',
                ),
                'admin_label' => true,
                'param_name' => 'type',
                'description' => esc_html__( 'Select icon library.', 'allstore' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'fontawesome',
                ),
                'description' => esc_html__( 'Select icon from library.', 'allstore' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_openiconic',
                'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'openiconic',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'openiconic',
                ),
                'description' => esc_html__( 'Select icon from library.', 'allstore' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_typicons',
                'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'typicons',
                ),
                'description' => esc_html__( 'Select icon from library.', 'allstore' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'entypo',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_linecons',
                'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'linecons',
                ),
                'description' => esc_html__( 'Select icon from library.', 'allstore' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_monosocial',
                'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'monosocial',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'monosocial',
                ),
                'description' => esc_html__( 'Select icon from library.', 'allstore' ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link', 'allstore'),
                'description' => esc_html__('If Content field is not used', 'allstore'),
                'param_name' => 'm_link',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'allstore' ),
                'param_name' => 'title_font_size',
                'group' => esc_html__( 'Style', 'allstore' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Description Font Size', 'allstore' ),
                'param_name' => 'description_font_size',
                'group' => esc_html__( 'Style', 'allstore' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Font Color', 'allstore'),
                'param_name' => 'title_color',
                'group' => esc_html__( 'Style', 'allstore' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Description Font Color', 'allstore'),
                'param_name' => 'description_color',
                'group' => esc_html__( 'Style', 'allstore' ),
            ),
        )
    ) );
}

class WPBakeryShortCode_allstore_links_modal_item extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array (
            'title' => '',
            'description' => '',
            'image' => '',
            'type' => '',
            'icon_fontawesome' => '',
            'icon_openiconic' => '',
            'icon_typicons' => '',
            'icon_entypo' => '',
            'icon_linecons' => '',
            'icon_monosocial' => '',
            'm_link' => '',
            'title_font_size' => '',
            'description_font_size' => '',
            'title_color' => '',
            'description_color' => '',
        ), $atts ) );

        ob_start();

        // Enqueue needed icon font.
        vc_icon_element_fonts_enqueue($type);

        if (!empty($title) || !empty($description) || !empty($image)) :
            ?>
            <div class="f-block-wrap">
                <div class="f-block">
                    <?php if (empty($content) && !empty($m_link)) : 
                    $link = vc_build_link($m_link);
                    ?>
                    <a href="<?php echo esc_url($link['url']); ?>" class="f-block-link"<?php if (!empty($link['target'])) echo ' target="'.esc_attr($link['target']).'"'; ?><?php if (!empty($link['rel'])) echo ' rel="'.esc_attr($link['rel']).'"'; ?>>
                    <?php else : ?>
                    <a href="#" class="f-block-btn">
                    <?php endif; ?>

                        <?php
                        if (!empty($image)) {
                            $image_arr = wp_get_attachment_image_src( $image, 'allstore-360x280-c' );
                            ?>
                            <div class="iframe-img">
                                <img src="<?php echo esc_attr($image_arr[0]); ?>" alt="<?php echo esc_attr($title); ?>">
                            </div>
                            <?php
                        }
                        ?>
                        <?php if (!empty($item['icon'])) : ?>
                        <div class="overlay-icon">
                            <?php echo wp_kses_post($item['icon']); ?>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($icon_fontawesome) || !empty($icon_openiconic) || !empty($icon_typicons) || !empty($icon_entypo) || !empty($icon_linecons) || !empty($icon_linecons) || !empty($icon_monosocial)) :  ?>
                        <div class="overlay-icon">
                            <?php
                            if (!empty($icon_fontawesome)) {
                                echo '<i class="'.esc_attr($icon_fontawesome).'"></i>';
                            } elseif (!empty($icon_openiconic)) {
                                echo '<i class="'.esc_attr($icon_openiconic).'"></i>';
                            } elseif (!empty($icon_typicons)) {
                                echo '<i class="'.esc_attr($icon_typicons).'"></i>';
                            } elseif (!empty($icon_entypo)) {
                                echo '<i class="'.esc_attr($icon_entypo).'"></i>';
                            } elseif (!empty($icon_linecons)) {
                                echo '<i class="'.esc_attr($icon_linecons).'"></i>';
                            } elseif (!empty($icon_monosocial)) {
                                echo '<i class="'.esc_attr($icon_monosocial).'"></i>';
                            }
                            ?>
                        </div>
                        <?php endif; ?>
                    </a>
                    <?php if (!empty($title)) : ?>
                        <p class="f-info-ttl"<?php 
                        if (!empty($title_font_size) || !empty($title_color)) {
                            echo ' style="';
                            if (!empty($title_font_size)) {
                                echo 'font-size: '.$title_font_size.'px;';
                            }
                            if (!empty($title_color)) {
                                echo 'color: '.$title_color.';';
                            }
                            echo '"';
                        }
                        ?>><?php echo esc_html($title); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($description)) : ?>
                        <p class="f-info-desc"<?php 
                        if (!empty($description_font_size) || !empty($description_color)) {
                            echo ' style="';
                            if (!empty($description_font_size)) {
                                echo 'font-size: '.$description_font_size.'px;';
                            }
                            if (!empty($description_color)) {
                                echo 'color: '.$description_color.';';
                            }
                            echo '"';
                        }
                        ?>><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($content)) : ?>
                        <div class="f-block-cont">
                            <div class="stylization f-block-modal f-block-modal-content">
                            <?php echo $content; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        endif;
        $output = ob_get_clean();

        return $output;

    }
}