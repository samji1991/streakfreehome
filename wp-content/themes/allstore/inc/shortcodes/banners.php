<?php
add_action( 'vc_before_init', 'allstore_banners_integrate_vc' );
function allstore_banners_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Banners', 'allstore'),
        'base' => 'allstore_banners',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'as_parent' => array('only' => 'allstore_banners_item'),
        'js_view' => 'VcColumnView',
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Layout', 'allstore'),
                'param_name' => 'layout',
                'value' => array(
                    esc_html__('1 Item | 100%', 'allstore') => 'col_1',
                    esc_html__('2 Items | 50%-50%', 'allstore') => 'col_2',
                    esc_html__('3 Items | 50%-25%-25%', 'allstore') => 'col_3_1',
                    esc_html__('3 Items | 25%-50%-25%', 'allstore') => 'col_3_2',
                    esc_html__('3 Items | 25%-25%-50%', 'allstore') => 'col_3_3',
                    esc_html__('4 Items | 25%-25%-25%-25%', 'allstore') => 'col_4',
                ),
                'std' => 'col_2'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Banners Height', 'allstore'),
                'param_name' => 'height',
                'value' => '360',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Gap', 'allstore'),
                'param_name' => 'gap',
                'value' => array(
                    esc_html__('0px', 'allstore') => '0',
                    esc_html__('1px', 'allstore') => '1',
                    esc_html__('2px', 'allstore') => '2',
                    esc_html__('3px', 'allstore') => '3',
                    esc_html__('4px', 'allstore') => '4',
                    esc_html__('5px', 'allstore') => '5',
                    esc_html__('6px', 'allstore') => '6',
                    esc_html__('7px', 'allstore') => '7',
                    esc_html__('8px', 'allstore') => '8',
                    esc_html__('9px', 'allstore') => '9',
                    esc_html__('10px', 'allstore') => '10',
                    esc_html__('11px', 'allstore') => '11',
                    esc_html__('12px', 'allstore') => '12',
                    esc_html__('13px', 'allstore') => '13',
                    esc_html__('14px', 'allstore') => '14',
                    esc_html__('15px', 'allstore') => '15',
                ),
                'std' => '15'
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

class WPBakeryShortCode_allstore_banners extends WPBakeryShortCodesContainer {
    protected function content( $atts, $content = null ) {
        $css = '';
        extract( shortcode_atts( array (
            'layout' => 'col_2',
            'height' => '360',
            'gap' => '15',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();

        if (!empty($height)) : ?>
        <style>
            body .banners-list-<?php echo intval($height); ?> {
                height: <?php echo intval($height); ?>px;
            }
            @media only screen and (max-width : 1200px) {
                body .banners-list-<?php echo intval($height); ?> {
                    height: <?php echo intval($height)*0.825; ?>px;
                }
            }
            @media only screen and (max-width : 992px) {
                body .banners-list-<?php echo intval($height); ?> {
                    height: <?php echo (intval($height)*4*0.632+20); ?>px;
                    padding-bottom: <?php echo (intval($gap)*2); ?>px;
                }
            }
        </style>
        <?php endif; ?>
        <div class="banners-list banners-list-<?php echo intval($height); ?><?php if (!empty($layout)) echo ' banners-'.esc_html($layout); ?><?php if (!empty($gap)) echo ' banners-gap'.intval($gap); ?><?php echo esc_attr( $css_class ); ?>">
            <?php echo do_shortcode( $content ); ?>
        </div>
        <?php
        $output = ob_get_clean();

        return $output;
    }
}




add_action( 'vc_before_init', 'allstore_banners_item_integrate_vc' );
function allstore_banners_item_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Banner', 'allstore'),
        'base' => 'allstore_banners_item',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'as_child' => array('only' => 'allstore_banners'),
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'allstore'),
                'param_name' => 'image',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'allstore'),
                'param_name' => 'title',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle', 'allstore'),
                'param_name' => 'subtitle',
            ),
            array(
                'type' => 'textarea_html',
                'heading' => esc_html__('Content', 'allstore'),
                'param_name' => 'content',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Position', 'allstore'),
                'param_name' => 'position',
                'value' => array(
                    esc_html__('Top', 'allstore') => 'pos-top',
                    esc_html__('Bottom', 'allstore') => 'pos-bot',
                    esc_html__('Left', 'allstore') => 'pos-left',
                    esc_html__('Right', 'allstore') => 'pos-right',
                ),
                'std' => 'pos-bot'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Content with Overlay', 'allstore'),
                'param_name' => 'with_bg',
                'value' => array(
                    esc_html__('Yes', 'allstore') => 'true',
                ),
                'std'=>'true'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Text align', 'allstore'),
                'param_name' => 'align',
                'value' => array(
                    esc_html__('Center', 'allstore') => 'center',
                ),
                'std'=>'center'
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link', 'allstore'),
                'param_name' => 'link',
            ),
        )
    ) );
}

class WPBakeryShortCode_allstore_banners_item extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array (
            'image' => '',
            'title' => '',
            'subtitle' => '',
            'link' => '',
            'position' => 'pos-bot',
            'with_bg' => 'true',
            'align' => 'center',
        ), $atts ) );

        ob_start();
        if (!empty($image)) :
            $link = vc_build_link($link);
            ?>
            <div class="banner-i <?php echo esc_html($position); ?><?php if ($with_bg == 'true') echo ' with-bg'; ?>">


                <?php if (!empty($link) && empty($link['title'])) : ?>
                <a href="<?php echo esc_url($link['url']); ?>"<?php if (!empty($link['target'])) echo ' target="'.esc_attr($link['target']).'"'; ?>>
                <?php endif; ?>

                <span class="banner-i-bg" style="background-image: url(<?php
                    $image_arr = wp_get_attachment_image_src( $image, 'allstore-1140x1140' );
                    echo esc_attr($image_arr[0]);
                    ?>);"></span>

                <?php if (!empty($link) && empty($link['title'])) : ?>
                </a>
                <?php endif; ?>

                <?php if (!empty($subtitle) || !empty($title) || !empty($content) || (!empty($link) && !empty($link['title']))) : ?>

                <?php if (!empty($link)) : ?>
                <a class="banner-i-wrap" href="<?php echo esc_url($link['url']); ?>"<?php if (!empty($link['target'])) echo ' target="'.esc_attr($link['target']).'"'; ?>>
                <?php else: ?>
                <div class="banner-i-wrap">
                <?php endif; ?>

                <div class="banner-i-cont">
                    <div class="banner-i-cont-inner<?php if ($align == 'center') echo ' align-center'; ?>">
                    <?php
                    if (!empty($subtitle)) {
                        echo '<p class="banner-i-subttl">'.esc_attr($subtitle).'</p>';
                    }
                    if (!empty($title)) {
                        echo '<h3 class="banner-i-ttl">'.wp_kses_post($title).'</h3>';
                    }
                    if (!empty($content)) {
                        echo wpautop($content);
                    }
                    if (!empty($link) && !empty($link['title'])) {
                        ?>
                        <p class="banner-i-link"><button><?php if (!empty($link['title'])) echo esc_attr($link['title']); ?></button></p>
                        <?php
                    }
                    ?>
                    </div>
                </div>

                <?php if (!empty($link)) : ?>
                </a>
                <?php else: ?>
                </div>
                <?php endif; ?>

                <?php endif; ?>
            </div>
            <?php
        endif;
        $output = ob_get_clean();

        return $output;

    }
}