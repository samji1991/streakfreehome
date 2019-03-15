<?php

add_action( 'vc_before_init', 'allstore_posts_integrate_vc' );
function allstore_posts_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Blog Posts', 'allstore'),
        'base' => 'allstore_posts',
        'class' => '',
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style', 'allstore'),
                'param_name' => 'style',
                'value' => array(
                    esc_html__('Title on the Hover', 'allstore') => 'style_1',
                    esc_html__('Title on the Bottom', 'allstore') => 'style_2'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Posts count', 'allstore'),
                'param_name' => 'count',
                'value' => 10
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

class WPBakeryShortCode_allstore_posts extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'style' => 'style_1',
            'count' => 10,
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();
        $posts = new WP_Query( array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $count
        ) );
        if ( $posts->have_posts() ) :

            if ($style == 'style_1') :
                ?>
                <div class="posts-list<?php echo esc_attr( $css_class ); ?>">
                    <?php
                    global $post;
                    while ( $posts->have_posts() ) : $posts->the_post();
                        get_template_part('template-parts/post/loop');
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
                <?php
                else:
                ?>
                <div class="posts-list<?php echo esc_attr( $css_class ); ?>">
                    <?php
                    global $post;
                    while ( $posts->have_posts() ) : $posts->the_post();
                        get_template_part('template-parts/post/loop-2');
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
                <?php
            endif;
        endif;

        $output = ob_get_clean();

        return $output;
    }
}