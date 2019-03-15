<?php
add_action( 'vc_before_init', 'allstore_images_carousel_integrate_vc' );
function allstore_images_carousel_integrate_vc () {
    vc_map( array(
        'name' => esc_html__( 'Image Carousel', 'allstore' ),
        'base' => 'allstore_images_carousel',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'attach_images',
                'heading' => esc_html__( 'Images', 'allstore' ),
                'param_name' => 'images',
                'value' => '',
                'description' => esc_html__( 'Select images from media library.', 'allstore' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Images size', 'allstore' ),
                'param_name' => 'img_size',
                'value' => 'medium',
                'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size. If used slides per view, this will be used to define carousel wrapper size.', 'allstore' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'On click action', 'allstore' ),
                'param_name' => 'onclick',
                'value' => array(
                    esc_html__( 'Open prettyPhoto', 'allstore' ) => 'link_image',
                    esc_html__( 'None', 'allstore' ) => 'link_no',
                    esc_html__( 'Open custom links', 'allstore' ) => 'custom_link',
                ),
                'description' => esc_html__( 'Select action for click event.', 'allstore' ),
            ),
            array(
                'type' => 'exploded_textarea_safe',
                'heading' => esc_html__( 'Custom links', 'allstore' ),
                'param_name' => 'custom_links',
                'description' => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'allstore' ),
                'dependency' => array(
                    'element' => 'onclick',
                    'value' => array( 'custom_link' ),
                ),
            ),

            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Loop', 'allstore' ),
                'param_name' => 'loop',
                'description' => esc_html__( 'Set to true to enable continuous loop mode. If you use it along with slidesPerView: "auto" then you need to specify loopedSlides parameter with amount of slides to loop (duplicate)', 'allstore' ),
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'std' => 'false'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Carousel Height (number or "auto")', 'allstore' ),
                'param_name' => 'height',
                'value' => 'auto',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Auto Height (if "Height" is auto)', 'allstore' ),
                'description' => esc_html__( 'Set to true and slider wrapper will adopt its height to the height of the currently active slide', 'allstore' ),
                'param_name' => 'auto_height',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'std' => 'false'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Show Navigation Buttons', 'allstore' ),
                'param_name' => 'nav_buttons',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'std' => 'false'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Show Pagination', 'allstore' ),
                'param_name' => 'pagination',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'std' => 'false'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Pagination Type', 'allstore' ),
                'param_name' => 'pagination_type',
                'value' => array(
                    esc_html__( 'bullets', 'allstore' ) => 'bullets',
                    esc_html__( 'fraction', 'allstore' ) => 'fraction',
                    esc_html__( 'progress', 'allstore' ) => 'progress',
                ),
                'std' => 'bullets'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Scrollbar', 'allstore' ),
                'param_name' => 'scrollbar',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'std' => 'false'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Scrollbar Hide', 'allstore' ),
                'param_name' => 'scrollbar_hide',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Scrollbar Draggable', 'allstore' ),
                'param_name' => 'scrollbar_draggable',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'std' => 'false'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Speed', 'allstore' ),
                'param_name' => 'speed',
                'value' => '300',
                'description' => esc_html__( 'Duration of transition between slides (in ms)', 'allstore' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Autoplay', 'allstore' ),
                'param_name' => 'autoplay',
                'value' => '',
                'description' => esc_html__( 'Delay between transitions (in ms). If this parameter is not specified, auto play will be disabled', 'allstore' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Autoplay Stop on Last', 'allstore' ),
                'param_name' => 'autoplay_stop_on_last',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'description' => esc_html__( 'Enable this parameter and autoplay will be stopped when it reaches last slide (has no effect in loop mode)', 'allstore' ),
                'std' => 'false'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Autoplay Disable on Interaction', 'allstore' ),
                'param_name' => 'autoplay_disable_on_interaction',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'description' => esc_html__( 'Set to false and autoplay will not be disabled after user interactions (swipes), it will be restarted every time after interaction', 'allstore' ),
                'std' => 'true'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Free Mode', 'allstore' ),
                'param_name' => 'free_mode',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'description' => esc_html__( 'If true then slides will not have fixed positions', 'allstore' ),
                'std' => 'false'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Free Mode Momentum', 'allstore' ),
                'param_name' => 'free_mode_momentum',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'description' => esc_html__( 'If true, then slide will keep moving for a while after you release it', 'allstore' ),
                'std' => 'true'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Free Mode Sticky', 'allstore' ),
                'param_name' => 'free_mode_sticky',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'description' => esc_html__( 'Set to true to enable snap to slides positions in free mode', 'allstore' ),
                'std' => 'false'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Space Between', 'allstore' ),
                'param_name' => 'space_between',
                'value' => '0',
                'description' => esc_html__( 'Distance between slides in px.', 'allstore' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides Per View (number or "auto")', 'allstore' ),
                'param_name' => 'slides_per_view',
                'value' => '1',
                'description' => esc_html__( 'Number of slides per view (slides visible at the same time on slider\'s container). If you use it with "auto" value and along with loop: true then you need to specify loopedSlides parameter with amount of slides to loop (duplicate)', 'allstore' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides Per Group', 'allstore' ),
                'param_name' => 'slides_per_group',
                'value' => '1',
                'description' => esc_html__( 'Set numbers of slides to define and enable group sliding. Useful to use with slidesPerView > 1', 'allstore' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Centered Slides', 'allstore' ),
                'param_name' => 'centered_slides',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'description' => esc_html__( 'If true, then active slide will be centered, not always on the left side.', 'allstore' ),
                'std' => 'false'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Grab Cursor', 'allstore' ),
                'param_name' => 'grab_cursor',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'description' => esc_html__( 'This option may a little improve desktop usability. If true, user will see the "grab" cursor when hover on Carousel', 'allstore' ),
                'std' => 'false'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Direction', 'allstore' ),
                'param_name' => 'direction',
                'value' => array(
                    esc_html__( 'horizontal', 'allstore' ) => 'horizontal',
                    esc_html__( 'vertical', 'allstore' ) => 'vertical',
                ),
                'std' => 'horizontal'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Keyboard Control', 'allstore' ),
                'param_name' => 'keyboard_control',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'std' => 'false'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Mousewheel Control', 'allstore' ),
                'param_name' => 'mousewheel_control',
                'value' => array(
                    esc_html__( 'true', 'allstore' ) => 'true',
                    esc_html__( 'false', 'allstore' ) => 'false',
                ),
                'std' => 'false'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Effect', 'allstore' ),
                'param_name' => 'effect',
                'value' => array(
                    esc_html__( 'slide', 'allstore' ) => 'slide',
                    esc_html__( 'fade', 'allstore' ) => 'fade',
                    esc_html__( 'cube', 'allstore' ) => 'cube',
                    esc_html__( 'coverflow', 'allstore' ) => 'coverflow',
                    esc_html__( 'flip', 'allstore' ) => 'flip',
                ),
                'std' => 'slide'
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'CSS box', 'allstore' ),
                'param_name' => 'css',
                'group' => esc_html__( 'Design Options', 'allstore' ),
            )
        ),
    ) );
}

class WPBakeryShortCode_allstore_images_carousel extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        // TODO: Breakpoints
        extract( shortcode_atts( array (
            'images' => '',
            'img_size' => 'medium',
            'height' => 'auto',
            'onclick' => '',
            'custom_links' => '',
            'loop' => 'false',
            'auto_height' => 'false',
            'nav_buttons' => 'false',
            'pagination' => 'false',
            'pagination_type' => 'bullets',
            'scrollbar' => 'false',
            'scrollbar_hide' => 'true',
            'scrollbar_draggable' => 'false',
            'speed' => '300',
            'autoplay' => '',
            'autoplay_stop_on_last' => 'false',
            'autoplay_disable_on_interaction' => 'true',
            'free_mode' => 'false',
            'free_mode_momentum' => 'true',
            'free_mode_sticky' => 'false',
            'space_between' => '0',
            'slides_per_view' => '1',
            'slides_per_group' => '1',
            'centered_slides' => 'false',
            'grab_cursor' => 'false',
            'direction' => 'horizontal',
            'keyboard_control' => 'false',
            'mousewheel_control' => 'false',
            'effect' => 'slide',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();
        $images = explode( ',', $images );
        if (!empty($images)) {
        ?>
        <div
            class="swiper-container images-carousel<?php if (!empty($height) && $height !== 'auto') echo ' images-carousel-ht'; ?><?php echo esc_attr( $css_class ); ?>"
            <?php if (!empty($height) && $height !== 'auto') echo ' style="height: '.intval($height).'px"'; ?>

            data-pagination_type="<?php echo esc_html($pagination_type); ?>"
            data-auto_height="<?php echo esc_html($auto_height); ?>"
            data-loop="<?php echo esc_html($loop); ?>"
            data-speed="<?php echo esc_html($speed); ?>"
            data-scrollbar_hide="<?php echo esc_html($scrollbar_hide); ?>"
            data-scrollbar_draggable="<?php echo esc_html($scrollbar_draggable); ?>"
            data-autoplay="<?php echo esc_html($autoplay); ?>"
            data-autoplay_stop_on_last="<?php echo esc_html($autoplay_stop_on_last); ?>"
            data-autoplay_disable_on_interaction="<?php echo esc_html($autoplay_disable_on_interaction); ?>"
            data-free_mode="<?php echo esc_html($free_mode); ?>"
            data-free_mode_momentum="<?php echo esc_html($free_mode_momentum); ?>"
            data-free_mode_sticky="<?php echo esc_html($free_mode_sticky); ?>"
            data-space_between="<?php echo esc_html($space_between); ?>"
            data-slides_per_view="<?php echo esc_html($slides_per_view); ?>"
            data-slides_per_group="<?php echo esc_html($slides_per_group); ?>"
            data-centered_slides="<?php echo esc_html($centered_slides); ?>"
            data-grab_cursor="<?php echo esc_html($grab_cursor); ?>"
            data-direction="<?php echo esc_html($direction); ?>"
            data-mousewheel_control="<?php echo esc_html($mousewheel_control); ?>"
            data-keyboard_control="<?php echo esc_html($keyboard_control); ?>"
            data-effect="<?php echo esc_html($effect); ?>"
        >
            <div class="swiper-wrapper images-carousel-wrapper">
                <?php foreach ($images as $img) :
                    $img_src = wp_get_attachment_image_src($img, $img_size);
                    ?>
                    <div class="swiper-slide images-carousel-slide"><img src="<?php echo esc_attr($img_src[0]); ?>" alt=""></div>
                <?php endforeach; ?>
            </div>
            <?php if ($pagination == 'true') : ?>
            <div class="swiper-pagination"></div>
            <?php endif; ?>
            <?php if ($nav_buttons == 'true') : ?>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <?php endif; ?>
            <?php if ($scrollbar == 'true') : ?>
            <div class="swiper-scrollbar"></div>
            <?php endif; ?>
        </div>
        <?php
        }
        $output = ob_get_clean();

        return $output;
    }
}