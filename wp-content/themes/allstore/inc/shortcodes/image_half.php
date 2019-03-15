<?php
add_action( 'vc_before_init', 'allstore_image_half_integrate_vc' );
function allstore_image_half_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Image with Content', 'allstore'),
        'base' => 'allstore_image_half',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'as_parent' => array('except' => ''),
        'content_element' => true,
        'js_view' => 'VcColumnView',
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                "type" => "attach_image",
                "heading" => esc_html__("Image", 'allstore'),
                "param_name" => "image"
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Image Align", 'allstore'),
                "param_name" => "layout",
                "value" => array(
                    'Left' => 'left',
                    'Right' => 'right',
                )
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Content Width", 'allstore'),
                "param_name" => "width",
                "std" => "full",
                "value" => array(
                    'Full' => 'full',
                    'Container' => 'container',
                )
            ),
        ),
    ) );
}

class WPBakeryShortCode_allstore_image_half extends WPBakeryShortCodesContainer {
    protected function content( $atts, $content = null ) {
        extract(
            shortcode_atts(
                array(
                    'image' => '',
                    'width' => 'full',
                    'layout' => 'left'
                ), $atts
            )
        );

        $image_src = wp_get_attachment_image_src( $image, 'full' );
        if (!empty($image_src)) {
            $image_bg = ' style="background-image: url('.$image_src[0].');"';
        } else {
            $image_bg = '';
        }

        if ($width == 'full') {
            $width_class = 'cont-full ';
        } else {
            $width_class = 'cont ';
        }
        ob_start();
        ?>
        <section class="image-half image-half-<?php echo esc_html($layout); ?>">
            <div class="image-half-img"<?php echo wp_kses_post($image_bg); ?>><?php echo wp_get_attachment_image( $image, 'full' ); ?></div>
            <div class="<?php echo esc_html($width_class); ?>image-half-cont">
                <div class="image-half-inner">
                    <?php echo do_shortcode($content); ?>
                </div>
            </div>
        </section>
        <?php
        $output = ob_get_clean();

        return $output;
    }
}
