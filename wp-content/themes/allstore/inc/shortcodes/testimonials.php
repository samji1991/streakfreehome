<?php
add_action( 'vc_before_init', 'allstore_testimonials_integrate_vc' );
function allstore_testimonials_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Testimonials', 'allstore'),
        'base' => 'allstore_testimonials',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'as_parent' => array('only' => 'allstore_testimonials_item'),
        'js_view' => 'VcColumnView',
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Testimonials Container Max Width', 'allstore'),
                'description' => esc_html__( 'Number (px) or just leave empty for 100%', 'allstore' ),
                'param_name' => 'text_width',
                'value' => '800',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Thumbnails Container Max Width', 'allstore'),
                'description' => esc_html__( 'Number (px) or just leave empty for 100%', 'allstore' ),
                'param_name' => 'thumbs_width',
                'value' => '800',
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

class WPBakeryShortCode_allstore_testimonials extends WPBakeryShortCodesContainer {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'text_width' => '800',
            'thumbs_width' => '800',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
        
        $text_width = intval($text_width);
        $thumbs_width = intval($thumbs_width);

        ob_start();
        ?>
        <div class="reviews-wrap<?php echo esc_attr( $css_class ); ?>">
            <div class="reviewscar-wrap">
                <div class="swiper-container reviewscar"<?php if (!empty($text_width)) echo ' style="max-width: '.intval($text_width).'px"'; ?>>
                    <div class="swiper-wrapper">
                        <?php echo do_shortcode( $content ); ?>
                    </div>
                </div>
                <div class="swiper-container reviewscar-thumbs"<?php if (!empty($thumbs_width)) echo ' style="max-width: '.intval($thumbs_width).'px"'; ?>>
                    <div class="swiper-wrapper">
                        <?php echo do_shortcode( $content ); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $output = ob_get_clean();

        return $output;
    }
}




add_action( 'vc_before_init', 'allstore_testimonials_item_integrate_vc' );
function allstore_testimonials_item_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Testimonials Item', 'allstore'),
        'base' => 'allstore_testimonials_item',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'as_child' => array('only' => 'allstore_testimonials'),
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Name', 'allstore'),
                'param_name' => 'name',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Position', 'allstore'),
                'param_name' => 'position',
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
        )
    ) );
}

class WPBakeryShortCode_allstore_testimonials_item extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        extract( shortcode_atts( array (
            'name' => '',
            'position' => '',
            'image' => '',
        ), $atts ) );

        ob_start();
        if (!empty($content)) :
            ?>
            <div class="swiper-slide">
                <?php if (!empty($content)) : ?>
                    <div class="reviewscar-cont">
                        <?php echo wpautop($content); ?>
                    </div>
                <?php endif; ?>
                <?php
                if (!empty($image)) {
                    $image_arr = wp_get_attachment_image_src( $image, 'thumbnail' );
                    ?>
                    <img src="<?php echo esc_attr($image_arr[0]); ?>" alt="<?php echo esc_attr($name); ?>">
                    <?php
                } else {
                    ?>
                    <p class="reviewscar-imgno"></p>
                    <?php
                }
                if (!empty($name)) {
                    echo '<h3 class="reviewscar-ttl">'.esc_attr($name).'</h3>';
                }
                if (!empty($position)) {
                    echo '<p class="reviewscar-post">'.esc_attr($position).'</p>';
                }
                ?>
            </div>
            <?php
        endif;
        $output = ob_get_clean();

        return $output;

    }
}