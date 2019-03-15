<?php
/*
 * AllStore Theme Customizer.
 */


/*
 * Add the theme configuration
 */
allstore_options::add_config( 'allstore', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );


$pages = array();
$color_main = '';
if (current_user_can( 'manage_options' )) {
	$color_main = get_theme_mod('color_main', '#373d54');

	$pages = Kirki_Helper::get_posts( array( 'posts_per_page' => -1, 'post_type' => 'page', 'post_status'=>'any' ));
	$pages[0] = '';
}


/*
 * Header
 */

allstore_options::add_section( 'allstore_header', array(
	'title'      => esc_attr__( 'Header', 'allstore' ),
	'priority'   => 1,
	'capability' => 'edit_theme_options',
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'image',
	'settings'    => 'header_logo',
	'label'       => esc_html__( 'Logotype', 'allstore' ),
	'default'     => '',
	'section'     => 'allstore_header',
	'priority'    => 10,
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'header_search',
	'label'       => esc_html__( 'Search Type', 'allstore' ),
	'section'     => 'allstore_header',
	'default'     => 'ajax',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'ajax' => esc_attr__( 'AJAX Search', 'allstore' ),
		'simple' => esc_attr__( 'Simple Search', 'allstore' ),
		'hide' => esc_attr__( 'Hide', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'checkbox',
	'settings'    => 'header_sticky',
	'label'       => esc_html__( 'Sticky Menu', 'allstore' ),
	'section'     => 'allstore_header',
	'default'     => '',
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'select',
	'settings'    => 'header_before',
	'label'       => esc_attr__( 'Before Header Template', 'allstore' ),
	'section'     => 'allstore_header',
	'default'     => '0',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => $pages,
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'select',
	'settings'    => 'header_after',
	'label'       => esc_attr__( 'After Header Template', 'allstore' ),
	'section'     => 'allstore_header',
	'default'     => '0',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => $pages,
) );


/*
 * Footer
 */
allstore_options::add_section( 'allstore_footer', array(
	'title'      => esc_attr__( 'Footer', 'allstore' ),
	'priority'   => 3,
	'capability' => 'edit_theme_options',
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'select',
	'settings'    => 'footer_template',
	'label'       => esc_attr__( 'Footer Template', 'allstore' ),
	'section'     => 'allstore_footer',
	'default'     => '',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => $pages,
) );



/*
 * Catalog
 */
allstore_options::add_section( 'allstore_catalog', array(
	'title'      => esc_attr__( 'Catalog', 'allstore' ),
	'priority'   => 3,
	'capability' => 'edit_theme_options',
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_sidebar',
	'label'       => esc_html__( 'Sidebar', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'show',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'show' => esc_attr__( 'Show', 'allstore' ),
		'sticky' => esc_attr__( 'Sticky', 'allstore' ),
		'hide' => esc_attr__( 'Hide', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_viewmode',
	'label'       => esc_html__( 'Default View Mode', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'gallery',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'gallery' => esc_attr__( 'Gallery', 'allstore' ),
		'list' => esc_attr__( 'List', 'allstore' ),
		'table' => esc_attr__( 'Table', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_qviewtabs',
	'label'       => esc_html__( 'Tabs in Quick view', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'hide',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'show' => esc_attr__( 'Show', 'allstore' ),
		'hide' => esc_attr__( 'Hide', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_galimg',
	'label'       => esc_html__( 'Gallery Mode Image', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'single',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'single' => esc_attr__( 'Single Image', 'allstore' ),
		'carousel' => esc_attr__( 'Carousel', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_galbtns',
	'label'       => esc_html__( 'Gallery Mode Buttons', 'allstore' ),
	'description' => esc_html__( 'Add to cart, wishlist, compare, additional features buttons', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'img',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'img' => esc_attr__( 'Image Area', 'allstore' ),
		'price' => esc_attr__( 'Price Area', 'allstore' ),
		'hide' => esc_attr__( 'Hide', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_listimg',
	'label'       => esc_html__( 'List Mode Image', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'single',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'single' => esc_attr__( 'Single Image', 'allstore' ),
		'carousel' => esc_attr__( 'Carousel', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_listactions',
	'label'       => esc_html__( 'List Mode Wishlist/Compare/Quick view', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'bottom',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'bottom' => esc_attr__( 'Bottom', 'allstore' ),
		'top' => esc_attr__( 'Top', 'allstore' ),
		'hide' => esc_attr__( 'Hide', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_listatts',
	'label'       => esc_html__( 'List Mode Attributes', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'bottom',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'bottom' => esc_attr__( 'Bottom', 'allstore' ),
		'right' => esc_attr__( 'Right', 'allstore' ),
		'hide' => esc_attr__( 'Hide', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_listadd2cart',
	'label'       => esc_html__( 'List Mode Add to Cart', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'advanced',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'advanced' => esc_attr__( 'Advanced', 'allstore' ),
		'simple' => esc_attr__( 'Simple', 'allstore' ),
		'hide' => esc_attr__( 'Hide', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_tbimg',
	'label'       => esc_html__( 'Table Mode Image', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'single',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'single' => esc_attr__( 'Single Image', 'allstore' ),
		'carousel' => esc_attr__( 'Carousel', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'catalog_tbadd2cart',
	'label'       => esc_html__( 'Table Mode Add to Cart', 'allstore' ),
	'section'     => 'allstore_catalog',
	'default'     => 'advanced',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'advanced' => esc_attr__( 'Advanced', 'allstore' ),
		'simple' => esc_attr__( 'Simple', 'allstore' ),
		'hide' => esc_attr__( 'Hide', 'allstore' ),
	),
) );


/*
 * Single Product
 */
allstore_options::add_section( 'allstore_product', array(
	'title'      => esc_attr__( 'Single Product', 'allstore' ),
	'priority'   => 3,
	'capability' => 'edit_theme_options',
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'product_type',
	'label'       => esc_html__( 'Product View Mode', 'allstore' ),
	'section'     => 'allstore_product',
	'default'     => 'type_1',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'type_1' => esc_attr__( 'Type 1 (Slider)', 'allstore' ),
		'type_2' => esc_attr__( 'Type 2 (Scroll)', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'product_related',
	'label'       => esc_html__( 'Related Products Position', 'allstore' ),
	'description'       => esc_html__( 'For Product View Mode 1', 'allstore' ),
	'section'     => 'allstore_product',
	'default'     => 'bottom',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'right' => esc_attr__( 'Right', 'allstore' ),
		'bottom' => esc_attr__( 'Bottom', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'product_tabs',
	'label'       => esc_html__( 'Tabs Position for Product Type 2', 'allstore' ),
	'section'     => 'allstore_product',
	'default'     => 'content',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'content' => esc_attr__( 'Content area', 'allstore' ),
		'bottom' => esc_attr__( 'Bottom', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'product_info',
	'label'       => esc_html__( 'Additional Information Style', 'allstore' ),
	'section'     => 'allstore_product',
	'default'     => 'table',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'table' => esc_attr__( 'Table', 'allstore' ),
		'dots' => esc_attr__( 'Dots', 'allstore' ),
	),
) );
allstore_options::add_field( 'allstore', array(
	'type'     => 'text',
	'settings' => 'product_propscount',
	'label'    => esc_html__( 'Short Additional Information Rows', 'allstore' ),
	'description'    => esc_html__( 'Short additional information rows count', 'allstore' ),
	'section'  => 'allstore_product',
	'priority' => 10,
) );


/*
 * Blog
 */
allstore_options::add_section( 'allstore_post', array(
	'title'      => esc_attr__( 'Blog', 'allstore' ),
	'priority'   => 3,
	'capability' => 'edit_theme_options',
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'post_sidebar',
	'label'       => esc_html__( 'Sidebar', 'allstore' ),
	'section'     => 'allstore_post',
	'default'     => 'hide',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'hide' => esc_attr__( 'Hide', 'allstore' ),
		'sticky' => esc_attr__( 'Sticky', 'allstore' ),
		'show' => esc_attr__( 'Show', 'allstore' ),
	),
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'single_post_sidebar',
	'label'       => esc_html__( 'Sidebar Post', 'allstore' ),
	'section'     => 'allstore_post',
	'default'     => 'hide',
	'choices'     => array(
		'hide' => esc_attr__( 'Hide', 'allstore' ),
		'show' => esc_attr__( 'Show', 'allstore' ),
	),
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'post_type',
	'label'       => esc_html__( 'Blog Posts Styles', 'allstore' ),
	'section'     => 'allstore_post',
	'default'     => 'type_2',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'type_1' => esc_attr__( 'Style 1', 'allstore' ),
		'type_2' => esc_attr__( 'Style 2', 'allstore' ),
	),
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'radio',
	'settings'    => 'post_related',
	'label'       => esc_html__( 'Blog Post - Related Products', 'allstore' ),
	'section'     => 'allstore_post',
	'default'     => 'right',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => array(
		'right' => esc_attr__( 'Right', 'allstore' ),
		'bottom' => esc_attr__( 'Bottom', 'allstore' ),
	),
) );


/*
 * Other
 */
allstore_options::add_section( 'allstore_other', array(
	'title'      => esc_attr__( 'Other', 'allstore' ),
	'priority'   => 3,
	'capability' => 'edit_theme_options',
) );

allstore_options::add_field( 'allstore', array(
	'type'     => 'multicheck',
	'settings' => 'other_share',
	'label'    => esc_html__( 'Social Share', 'allstore' ),
	'section'  => 'allstore_other',
	'priority' => 10,
	'default'     => array(
		'facebook',
		'twitter',
		'vk',
		'pinterest',
		'gplus',
		'linkedin',
		'tumblr',
	),
	'choices'     => array(
		'facebook' => esc_html__('Facebook', 'allstore'),
		'twitter' => esc_html__('Twitter', 'allstore'),
		'vk' => esc_html__('Vkontakte', 'allstore'),
		'pinterest' => esc_html__('Pinterest', 'allstore'),
		'gplus' => esc_html__('Google Plus', 'allstore'),
		'linkedin' => esc_html__('Linkedin', 'allstore'),
		'tumblr' => esc_html__('Tumblr', 'allstore'),
	)
) );



/*
 * COLORS
 */
allstore_options::add_section( 'allstore_color', array(
	'title'      => esc_attr__( 'Colors', 'allstore' ),
	'priority'   => 4,
	'capability' => 'edit_theme_options',
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'color',
	'settings'    => 'color_hover',
	'label'       => esc_html__( 'Links color', 'allstore' ),
	'description' => esc_html__( 'Default color: #3a89cf', 'allstore' ),
	'section'     => 'allstore_color',
	'default'     => '#3a89cf',
	'priority'    => 10,
	'choices' => array(
		'alpha'       => true,
	)
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'color',
	'settings'    => 'color_main',
	'label'       => esc_html__( 'Main color', 'allstore' ),
	'description' => esc_html__( 'Default color: #373d54', 'allstore' ),
	'section'     => 'allstore_color',
	'default'     => '#373d54',
	'priority'    => 10,
	'choices' => array(
		'alpha'       => true,
	)
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'color',
	'settings'    => 'color_text',
	'label'       => esc_html__( 'Text color', 'allstore' ),
	'description' => esc_html__( 'Default color: #616161', 'allstore' ),
	'section'     => 'allstore_color',
	'default'     => '#616161',
	'priority'    => 10,
	'choices' => array(
		'alpha'       => true,
	)
) );





/*
 * FONTS
 */
allstore_options::add_section( 'allstore_fonts', array(
	'title'      => esc_attr__( 'Fonts', 'allstore' ),
	'priority'   => 4,
	'capability' => 'edit_theme_options',
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'typography',
	'settings'    => 'fonts_main',
	'label'       => esc_html__( 'Main Font', 'allstore' ),
	'description'       => esc_html__( 'Default: Roboto', 'allstore' ),
	'section'     => 'allstore_fonts',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '400',
		'font-size'      => '14px',
		'line-height'    => '1.7',
		'letter-spacing' => '0px',
		'text-transform' => 'none',
		'text-align'     => 'left',
		'color'          => $color_main,
		'subsets'        => array(),
	),
	'priority'    => 10,
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'typography',
	'settings'    => 'fonts_page_ttl',
	'label'       => esc_html__( 'Page Title Font', 'allstore' ),
	'description'       => esc_html__( 'Default: "Roboto", 22px, Weight 900, #373d54, Line Height 1.4, Text-transform "Uppercase", Letter-spacing 2', 'allstore' ),
	'section'     => 'allstore_fonts',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '900',
		'font-size'      => '22px',
		'line-height'    => '1.4',
		'letter-spacing' => '2px',
		'subsets'        => array(),
		'text-transform' => 'uppercase',
		'color'          => $color_main,
		'text-align'     => 'left'
	),
	'priority'    => 10,
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'typography',
	'settings'    => 'fonts_gallery_ttl',
	'label'       => esc_html__( 'Products Gallery Title Font', 'allstore' ),
	'description'       => esc_html__( 'Default: "Roboto", 15px, Weight 700, #373d54, Line Height 1.4, Letter-spacing 0.02em', 'allstore' ),
	'section'     => 'allstore_fonts',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '700',
		'font-size'      => '15px',
		'line-height'    => '1.4',
		'letter-spacing' => '0.02em',
		'subsets'        => array(),
		'text-transform' => 'none',
		'color'          => $color_main,
		'text-align'     => 'center'
	),
	'priority'    => 10,
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'typography',
	'settings'    => 'fonts_list_ttl',
	'label'       => esc_html__( 'Products List Title Font', 'allstore' ),
	'description'       => esc_html__( 'Default: "Roboto", 20px, Weight 500, #373d54, Line Height 1.4, Text-transform "Uppercase"', 'allstore' ),
	'section'     => 'allstore_fonts',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '500',
		'font-size'      => '20px',
		'line-height'    => '1.4',
		'letter-spacing' => '0px',
		'subsets'        => array(),
		'text-transform' => 'uppercase',
		'color'          => $color_main,
		'text-align'     => 'left'
	),
	'priority'    => 10,
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'typography',
	'settings'    => 'fonts_table_ttl',
	'label'       => esc_html__( 'Products Table Title Font', 'allstore' ),
	'description'       => esc_html__( 'Default: "Roboto", 15px, Weight 500, #373d54, Line Height 1.15', 'allstore' ),
	'section'     => 'allstore_fonts',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '500',
		'font-size'      => '15px',
		'line-height'    => '1.15',
		'letter-spacing' => '0px',
		'subsets'        => array(),
		'text-transform' => 'none',
		'color'          => $color_main,
		'text-align'     => 'left'
	),
	'priority'    => 10,
) );

allstore_options::add_field( 'allstore', array(
	'type'        => 'typography',
	'settings'    => 'fonts_blog_ttl',
	'label'       => esc_html__( 'Blog List Title Font', 'allstore' ),
	'description'       => esc_html__( 'Default: "PT Serif", 19px, Weight 700, #373d54, Line Height 1.2', 'allstore' ),
	'section'     => 'allstore_fonts',
	'default'     => array(
		'font-family'    => 'PT Serif',
		'variant'        => '700',
		'font-size'      => '19px',
		'line-height'    => '1.2',
		'letter-spacing' => '0px',
		'subsets'        => array(),
		'text-transform' => 'none',
		'color'          => $color_main,
		'text-align'     => 'left'
	),
	'priority'    => 10,
) );

/*allstore_options::add_field( 'allstore', array(
	'type'        => 'typography',
	'settings'    => 'fonts_text',
	'label'       => esc_html__( 'Text Font', 'allstore' ),
	'description'       => esc_html__( 'Default: Roboto', 'allstore' ),
	'section'     => 'allstore_fonts',
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '400',
		'font-size'      => '14px',
		'line-height'    => '1.7',
		'letter-spacing' => '0px',
		'color'          => $color_text,
		'text-transform' => 'none',
		'text-align'     => 'left',
		'subsets'        => array(),
	),
	'priority'    => 10,
) );*/