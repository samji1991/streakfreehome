<?php
get_template_part('inc/shortcodes/team');
get_template_part('inc/shortcodes/testimonials');
get_template_part('inc/shortcodes/pricing');
get_template_part('inc/shortcodes/iconbox');
get_template_part('inc/shortcodes/counter');
get_template_part('inc/shortcodes/posts');
get_template_part('inc/shortcodes/social');
get_template_part('inc/shortcodes/products');
get_template_part('inc/shortcodes/products_carousel');
get_template_part('inc/shortcodes/products_carousel_small');
get_template_part('inc/shortcodes/products_categories');
get_template_part('inc/shortcodes/products_brands');
get_template_part('inc/shortcodes/products_column');
get_template_part('inc/shortcodes/banners');
get_template_part('inc/shortcodes/image_half');
get_template_part('inc/shortcodes/video');
get_template_part('inc/shortcodes/images_carousel');
get_template_part('inc/shortcodes/menu');
get_template_part('inc/shortcodes/links_list');
get_template_part('inc/shortcodes/links_modal');



// VC Row
vc_remove_param( "vc_row", "full_width" );

vc_add_param( "vc_row", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Layout', 'allstore' ),
    'param_name' => 'layout',
    'value' => array(
        esc_html__( 'Container', 'allstore' )       => 'container',
        esc_html__( 'Full Width', 'allstore' )      => 'full',
    ),
    'weight' => 10
) );

vc_add_param( "vc_row", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Background Position', 'allstore' ),
    'param_name' => 'background_position',
    'value' => array(
        esc_html__( 'Top Center', 'allstore' ) => 'top_center',
        esc_html__( 'Top Right', 'allstore' ) => 'top_right',
        esc_html__( 'Top Left', 'allstore' ) => 'top_left',
        esc_html__( 'Center Center', 'allstore' ) => 'center_center',
        esc_html__( 'Center Right', 'allstore' ) => 'center_right',
        esc_html__( 'Center Left', 'allstore' ) => 'center_left',
        esc_html__( 'Bottom Center', 'allstore' ) => 'bottom_center',
        esc_html__( 'Bottom Right', 'allstore' ) => 'bottom_right',
        esc_html__( 'Bottom Left', 'allstore' ) => 'bottom_left',
    ),
    'std' => 'center_center',
    'group' => esc_html__( 'Design Options', 'allstore' ),
) );


// VC Row Inner
vc_add_param( "vc_row_inner", array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Layout', 'allstore' ),
    'param_name' => 'layout',
    'value' => array(
        esc_html__( 'Container', 'allstore' )       => 'container',
        esc_html__( 'Full Width', 'allstore' )      => 'full',
    ),
    'weight' => 10
) );


// Tour
vc_add_param( 'vc_tta_tour', array(
    'type' => 'textfield',
    'heading' => esc_html__( 'Extra class name', 'allstore' ),
    'param_name' => 'el_class',
    'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'allstore' ),
    'value' => 'allstore-tour'
) );
vc_add_param( 'vc_tta_tour', array(
    'type' => 'dropdown',
    'param_name' => 'style',
    'value' => array(
        esc_html__( 'AllStore', 'allstore' ) => 'allstore',
        esc_html__( 'Classic', 'allstore' ) => 'classic',
        esc_html__( 'Modern', 'allstore' ) => 'modern',
        esc_html__( 'Flat', 'allstore' ) => 'flat',
        esc_html__( 'Outline', 'allstore' ) => 'outline',
    ),
    'heading' => esc_html__( 'Style', 'allstore' ),
    'description' => esc_html__( 'Select tour display style.', 'allstore' ),
) );
// Tabs
vc_add_param( 'vc_tta_tabs', array(
    'type' => 'textfield',
    'heading' => esc_html__( 'Extra class name', 'allstore' ),
    'param_name' => 'el_class',
    'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'allstore' ),
    'value' => 'allstore-tabs'
) );
vc_add_param( 'vc_tta_tabs', array(
    'type' => 'dropdown',
    'param_name' => 'style',
    'value' => array(
        esc_html__( 'AllStore', 'allstore' ) => 'allstore',
        esc_html__( 'Classic', 'allstore' ) => 'classic',
        esc_html__( 'Modern', 'allstore' ) => 'modern',
        esc_html__( 'Flat', 'allstore' ) => 'flat',
        esc_html__( 'Outline', 'allstore' ) => 'outline',
    ),
    'heading' => esc_html__( 'Style', 'allstore' ),
    'description' => esc_html__( 'Select tour display style.', 'allstore' ),
) );
// Accordion
vc_add_param( 'vc_tta_accordion', array(
    'type' => 'dropdown',
    'param_name' => 'style',
    'value' => array(
        esc_html__( 'AllStore', 'allstore' ) => 'allstore',
        esc_html__( 'Classic', 'allstore' ) => 'classic',
        esc_html__( 'Modern', 'allstore' ) => 'modern',
        esc_html__( 'Flat', 'allstore' ) => 'flat',
        esc_html__( 'Outline', 'allstore' ) => 'outline',
    ),
    'heading' => esc_html__( 'Style', 'allstore' ),
    'description' => esc_html__( 'Select accordion display style.', 'allstore' ),
) );


// Custom Heading
vc_add_param( 'vc_custom_heading', array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Use theme default font family?', 'allstore' ),
    'param_name' => 'use_theme_fonts',
    'value' => array( esc_html__( 'Yes', 'allstore' ) => 'yes' ),
    'description' => esc_html__( 'Use font family from the theme.', 'allstore' ),
    'std' => 'yes'
) );
vc_add_param( 'vc_custom_heading', array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Font Style', 'allstore' ),
    'param_name' => 'heading_ft_style',
    'value' => array(
        esc_html__( 'Light', 'allstore' ) => '300',
        esc_html__( 'Light Italic', 'allstore' ) => '300i',
        esc_html__( 'Regular', 'allstore' ) => '400',
        esc_html__( 'Regular Italic', 'allstore' ) => '400i',
        esc_html__( 'Medium', 'allstore' ) => '500',
        esc_html__( 'Medium Italic', 'allstore' ) => '500i',
        esc_html__( 'Bold', 'allstore' ) => '700',
        esc_html__( 'Bold Italic', 'allstore' ) => '700i',
        esc_html__( 'Black', 'allstore' ) => '900',
        esc_html__( 'Black Italic', 'allstore' ) => '900i',
    ),
    'std' => '500',
    'dependency' => array(
        'element' => 'use_theme_fonts',
        'value' => 'yes',
    )
) );
vc_add_param( 'vc_custom_heading', array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Style', 'allstore' ),
    'param_name' => 'heading_styles',
    'value' => array(
        esc_html__( 'AllStore', 'allstore' ) => 'allstore',
        esc_html__( 'Standart', 'allstore' ) => 'standart',
    ),
    'std' => 'allstore',
    'weight' => 10
) );


// Button
vc_add_param( 'vc_btn', array(
    'type' => 'dropdown',
    'heading' => __( 'Style', 'allstore' ),
    'description' => __( 'Select button display style.', 'allstore' ),
    'param_name' => 'style',
    // partly compatible with btn2, need to be converted shape+style from btn2 and btn1
    'value' => array(
        __( 'Modern', 'allstore' ) => 'modern',
        __( 'AllStore Inline', 'allstore' ) => 'allstore_inline',
        __( 'Classic', 'allstore' ) => 'classic',
        __( 'Flat', 'allstore' ) => 'flat',
        __( 'Outline', 'allstore' ) => 'outline',
        __( '3d', 'allstore' ) => '3d',
        __( 'Custom', 'allstore' ) => 'custom',
        __( 'Outline custom', 'allstore' ) => 'outline-custom',
        __( 'Gradient', 'allstore' ) => 'gradient',
        __( 'Gradient Custom', 'allstore' ) => 'gradient-custom',
    ),
) );