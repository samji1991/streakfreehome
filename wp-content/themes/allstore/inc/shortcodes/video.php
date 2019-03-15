<?php
add_action( 'vc_before_init', 'allstore_video_integrate_vc' );
function allstore_video_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Video Modal', 'allstore'),
        'base' => 'allstore_video',
        'class' => '',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Video URL', 'allstore'),
                'param_name' => 'video_url',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'allstore'),
                'param_name' => 'image',
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

class WPBakeryShortCode_allstore_video extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'video_url' => '',
            'image' => '',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();
        if (!empty($video_url)) :
        ?>
        <p class="video-i<?php echo esc_attr( $css_class ); ?>">
            <a href="<?php echo esc_url($video_url); ?>" class="video-i-url">
            <?php
            if (!empty($image)) {
                $image_src = wp_get_attachment_image_src($image, 'allstore-1140x1140');
                echo '<img src="'.esc_attr($image_src[0]).'" alt="">';
            }
            ?>
            </a>
        </p>
        <?php
        endif;
        $output = ob_get_clean();

        return $output;
    }
}