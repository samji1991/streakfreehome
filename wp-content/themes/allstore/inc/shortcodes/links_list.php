<?php
add_action( 'vc_before_init', 'allstore_links_list_integrate_vc' );
function allstore_links_list_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Links List', 'allstore'),
        'base' => 'allstore_links_list',
        'class' => '',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Include Icon library', 'allstore' ),
                'value' => array(
                    esc_html__( 'Font Awesome', 'allstore' ) => 'fontawesome',
                    esc_html__( 'Open Iconic', 'allstore' ) => 'openiconic',
                    esc_html__( 'Typicons', 'allstore' ) => 'typicons',
                    esc_html__( 'Entypo', 'allstore' ) => 'entypo',
                    esc_html__( 'Linecons', 'allstore' ) => 'linecons',
                    esc_html__( 'Mono Social', 'allstore' ) => 'monosocial',
                ),
                'admin_label' => true,
                'std' => 'fontawesome',
                'param_name' => 'type',
                'description' => esc_html__( 'For "Link Title" you can paste icon code, e.g. for Font Awesome - "&lt;i class="fa fa-facebook"&gt;&lt;/i&gt;". Also if you do not need a link, but just title, leave empty "URL" field', 'allstore' ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Title 1', 'allstore'),
                'param_name' => 'title_1',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 1', 'allstore'),
                'param_name' => 'link_1',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Title 2', 'allstore'),
                'param_name' => 'title_2',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 2', 'allstore'),
                'param_name' => 'link_2',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Title 3', 'allstore'),
                'param_name' => 'title_3',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 3', 'allstore'),
                'param_name' => 'link_3',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Title 4', 'allstore'),
                'param_name' => 'title_4',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 4', 'allstore'),
                'param_name' => 'link_4',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Title 5', 'allstore'),
                'param_name' => 'title_5',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 5', 'allstore'),
                'param_name' => 'link_5',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Title 6', 'allstore'),
                'param_name' => 'title_6',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 6', 'allstore'),
                'param_name' => 'link_6',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Title 7', 'allstore'),
                'param_name' => 'title_7',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 7', 'allstore'),
                'param_name' => 'link_7',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Labels Font Size', 'allstore'),
                'description' => esc_html__('Number in px', 'allstore'),
                'param_name' => 'label_font_size',
                'group' => esc_html__( 'Style', 'allstore' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Values Font Size', 'allstore'),
                'description' => esc_html__('Number in px', 'allstore'),
                'param_name' => 'value_font_size',
                'group' => esc_html__( 'Style', 'allstore' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Labels Font Color', 'allstore'),
                'param_name' => 'label_color',
                'group' => esc_html__( 'Style', 'allstore' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Values Font Color', 'allstore'),
                'param_name' => 'value_color',
                'group' => esc_html__( 'Style', 'allstore' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Align', 'allstore'),
                'param_name' => 'align',
                'value' => array(
                    esc_html__( 'Left', 'allstore' ) => 'left',
                    esc_html__( 'Center', 'allstore' ) => 'center',
                    esc_html__( 'Right', 'allstore' ) => 'right',
                ),
                'std' => 'left',
                'group' => esc_html__( 'Style', 'allstore' ),
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'Css', 'allstore' ),
                'param_name' => 'css',
                'group' => esc_html__( 'Design options', 'allstore' ),
            ),
        )
    ) );
}

class WPBakeryShortCode_allstore_links_list extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'type' => 'fontawesome',
            'title_1' => '',
            'title_2' => '',
            'title_3' => '',
            'title_4' => '',
            'title_5' => '',
            'title_6' => '',
            'title_7' => '',
            'link_1' => '',
            'link_2' => '',
            'link_3' => '',
            'link_4' => '',
            'link_5' => '',
            'link_6' => '',
            'link_7' => '',
            'label_font_size' => '',
            'value_font_size' => '',
            'label_color' => '',
            'value_color' => '',
            'align' => 'left',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        vc_icon_element_fonts_enqueue($type);

        ob_start();
        ?>
        <ul class="links_list<?php if (!empty($align)) echo ' links_list-align-'.$align; ?><?php echo esc_attr( $css_class ); ?>">
            <?php for ($i = 1; $i <= 7; $i++) : 
                $title_name = 'title_'.$i;
                $title = ${$title_name};
                $title = vc_build_link($title);
                $link_name = 'link_'.$i;
                $link = ${$link_name};
                $link = vc_build_link($link);
                if (!empty($title['url']) || !empty($title['title']) || !empty($link['url']) || !empty($link['title'])) :
                ?>
                <li>
                    <?php
                    if (!empty($title['url']) || !empty($title['title'])) :
                    ?>
                    <p class="links_list-label"<?php 
                        if (!empty($label_font_size) || !empty($label_color)) {
                            echo ' style="';
                            if (!empty($label_font_size)) {
                                echo 'font-size: '.$label_font_size.'px;';
                            }
                            if (!empty($label_color)) {
                                echo 'color: '.$label_color.';';
                            }
                            echo '"';
                        }
                        ?>>
                        <?php if (!empty($title['url'])) : ?>
                        <a href="<?php echo esc_url($title['url']); ?>"<?php if (!empty($title['target'])) echo ' target="'.esc_attr($title['target']).'"'; ?><?php if (!empty($title['rel'])) echo ' rel="'.esc_attr($title['rel']).'"'; ?>>
                        <?php endif; ?>
                            <?php if (!empty($title['title'])) echo wp_kses_post($title['title']); ?>
                        <?php if (!empty($title['url'])) : ?>
                        </a>
                        <?php endif; ?>
                    </p>
                    <?php endif; ?>

                    <?php
                    if (!empty($link['url']) || !empty($link['title'])) :
                    ?>
                    <p class="links_list-value"<?php 
                        if (!empty($value_font_size) || !empty($value_color)) {
                            echo ' style="';
                            if (!empty($value_font_size)) {
                                echo 'font-size: '.$value_font_size.'px;';
                            }
                            if (!empty($value_color)) {
                                echo 'color: '.$value_color.';';
                            }
                            echo '"';
                        }
                        ?>>
                        <?php if (!empty($link['url'])) : ?>
                        <a href="<?php echo esc_url($link['url']); ?>"<?php if (!empty($link['target'])) echo ' target="'.esc_attr($link['target']).'"'; ?><?php if (!empty($link['rel'])) echo ' rel="'.esc_attr($link['rel']).'"'; ?>>
                        <?php endif; ?>
                            <?php if (!empty($link['title'])) echo wp_kses_post($link['title']); ?>
                        <?php if (!empty($link['url'])) : ?>
                        </a>
                        <?php endif; ?>
                    </p>
                    <?php endif; ?>
                </li>
                <?php endif; ?>
            <?php endfor; ?>
        </ul>
        <?php
        $output = ob_get_clean();

        return $output;
    }
}