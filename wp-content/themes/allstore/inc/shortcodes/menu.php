<?php
add_action( 'vc_before_init', 'allstore_menu_integrate_vc' );
function allstore_menu_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Menu', 'allstore'),
        'base' => 'allstore_menu',
        'class' => '',
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'allstore'),
                'param_name' => 'title',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Style', 'allstore' ),
                'param_name' => 'style',
                'value' => array(
                    esc_html__( 'Border', 'allstore' ) => 'border',
                    esc_html__( 'Marker', 'allstore' ) => 'marker',
                ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 1', 'allstore'),
                'param_name' => 'link_1',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link 1 Badge', 'allstore'),
                'param_name' => 'link_badge_1',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Link 1 Color', 'allstore'),
                'param_name' => 'link_color_1',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 2', 'allstore'),
                'param_name' => 'link_2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link 2 Badge', 'allstore'),
                'param_name' => 'link_badge_2',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Link 2 Color', 'allstore'),
                'param_name' => 'link_color_2',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 3', 'allstore'),
                'param_name' => 'link_3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link 3 Badge', 'allstore'),
                'param_name' => 'link_badge_3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Link 3 Color', 'allstore'),
                'param_name' => 'link_color_3',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 4', 'allstore'),
                'param_name' => 'link_4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link 4 Badge', 'allstore'),
                'param_name' => 'link_badge_4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Link 4 Color', 'allstore'),
                'param_name' => 'link_color_4',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 5', 'allstore'),
                'param_name' => 'link_5',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link 5 Badge', 'allstore'),
                'param_name' => 'link_badge_5',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Link 5 Color', 'allstore'),
                'param_name' => 'link_color_5',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 6', 'allstore'),
                'param_name' => 'link_6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link 6 Badge', 'allstore'),
                'param_name' => 'link_badge_6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Link 6 Color', 'allstore'),
                'param_name' => 'link_color_6',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 7', 'allstore'),
                'param_name' => 'link_7',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link 7 Badge', 'allstore'),
                'param_name' => 'link_badge_7',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Link 7 Color', 'allstore'),
                'param_name' => 'link_color_7',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 8', 'allstore'),
                'param_name' => 'link_8',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link 8 Badge', 'allstore'),
                'param_name' => 'link_badge_8',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Link 8 Color', 'allstore'),
                'param_name' => 'link_color_8',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 9', 'allstore'),
                'param_name' => 'link_9',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link 9 Badge', 'allstore'),
                'param_name' => 'link_badge_9',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Link 9 Color', 'allstore'),
                'param_name' => 'link_color_9',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link 10', 'allstore'),
                'param_name' => 'link_10',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Link 10 Badge', 'allstore'),
                'param_name' => 'link_badge_10',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Link 10 Color', 'allstore'),
                'param_name' => 'link_color_10',
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

class WPBakeryShortCode_allstore_menu extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'title' => '',
            'style' => 'border',
            'link_1' => '',
            'link_badge_1' => '',
            'link_color_1' => '',
            'link_2' => '',
            'link_badge_2' => '',
            'link_color_2' => '',
            'link_3' => '',
            'link_badge_3' => '',
            'link_color_3' => '',
            'link_4' => '',
            'link_badge_4' => '',
            'link_color_4' => '',
            'link_5' => '',
            'link_badge_5' => '',
            'link_color_5' => '',
            'link_6' => '',
            'link_badge_6' => '',
            'link_color_6' => '',
            'link_7' => '',
            'link_badge_7' => '',
            'link_color_7' => '',
            'link_8' => '',
            'link_badge_8' => '',
            'link_color_8' => '',
            'link_9' => '',
            'link_badge_9' => '',
            'link_color_9' => '',
            'link_10' => '',
            'link_badge_10' => '',
            'link_color_10' => '',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();
        ?>
        <div class="menu-i<?php echo esc_attr( $css_class ); ?><?php if ($style == 'marker') echo ' menu-i-marker'; ?>">
            <?php if (!empty($title)) : ?>
                <p class="menu-i-ttl"><?php echo $title; ?></p>
            <?php endif; ?>
            <ul class="menu-i-list">
                <?php for ($i=1; $i <= 10; $i++) :
                    $link = 'link_'.$i;
                    $link_badge = 'link_badge_'.$i;
                    $link_color = 'link_color_'.$i;
                    ?>
                    <?php if (!empty(${$link})) :
                    ${$link} = vc_build_link(${$link});
                    if (!empty(${$link}['title']) && ${$link}['url']) :
                        ?>
                        <li<?php if (!empty(${$link_badge})) : ?> class="menu-i-badge-exist"<?php endif; ?>>
                            <a href="<?php echo esc_url(${$link}['url']); ?>"<?php if (!empty(${$link}['target'])) echo ' target="'.esc_attr(${$link}['target']).'"'; ?><?php if (!empty(${$link}['rel'])) echo ' rel="'.esc_attr(${$link}['rel']).'"'; ?>>
                                <?php echo ${$link}['title']; ?>
                                <?php if (!empty(${$link_badge})) : ?>
                                    <span class="menu-i-badge"<?php if (!empty(${$link_color})) echo ' style="background-color: '.${$link_color}.';"'; ?>><?php echo ${$link_badge}; ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </div>
        <?php
        $output = ob_get_clean();

        return $output;
    }
}