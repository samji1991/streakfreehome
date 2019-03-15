<?php
// Links Color
$color_hover = get_theme_mod('color_hover', '#3a89cf');
add_less_var( 'color_hover', $color_hover );

// Main Color
$color_main = get_theme_mod('color_main', '#373d54');
add_less_var( 'color_main', $color_main );

// Text Color
$color_text = get_theme_mod('color_text', '#616161');
add_less_var( 'color_text', $color_text );



// Main Font
$fonts_main = get_theme_mod('fonts_main', '');
if (empty($fonts_main)) {
    $fonts_main = array();
}
if (empty($fonts_main['font-family'])) {
    $fonts_main['font-family'] = 'Roboto';
}

if (empty($fonts_main['variant'])) {
    $fonts_main['variant'] = '400';
} elseif ($fonts_main['variant'] == 'regular' || $fonts_main['variant'] == 'italic') {
    $fonts_main['variant'] = '400';
} elseif ($fonts_main['variant'] == '100italic') {
    $fonts_main['variant'] = '100';
} elseif ($fonts_main['variant'] == '200italic') {
    $fonts_main['variant'] = '200';
} elseif ($fonts_main['variant'] == '300italic') {
    $fonts_main['variant'] = '300';
} elseif ($fonts_main['variant'] == '500italic') {
    $fonts_main['variant'] = '500';
} elseif ($fonts_main['variant'] == '600italic') {
    $fonts_main['variant'] = '600';
} elseif ($fonts_main['variant'] == '700italic') {
    $fonts_main['variant'] = '700';
} elseif ($fonts_main['variant'] == '800italic') {
    $fonts_main['variant'] = '800';
} elseif ($fonts_main['variant'] == '900italic') {
    $fonts_main['variant'] = '900';
}

if (empty($fonts_main['font-size'])) {
    $fonts_main['font-size'] = '14px';
}
if (empty($fonts_main['line-height'])) {
    $fonts_main['line-height'] = '1.7';
}
if (empty($fonts_main['letter-spacing'])) {
    $fonts_main['letter-spacing'] = '0px';
}
if (empty($fonts_main['text-align'])) {
    $fonts_main['text-align'] = 'left';
}
if (empty($fonts_main['color'])) {
    $fonts_main['color'] = $color_main;
}
if (empty($fonts_main['text-transform'])) {
    $fonts_main['text-transform'] = 'none';
}
add_less_var( 'fonts_main', $fonts_main['font-family'] );
add_less_var( 'fonts_main_variant', $fonts_main['variant'] );
add_less_var( 'fonts_main_size', $fonts_main['font-size'] );
add_less_var( 'fonts_main_lh', $fonts_main['line-height'] );
add_less_var( 'fonts_main_ls', $fonts_main['letter-spacing'] );
add_less_var( 'fonts_main_align', $fonts_main['text-align'] );
add_less_var( 'fonts_main_color', $fonts_main['color'] );
add_less_var( 'fonts_main_tt', $fonts_main['text-transform'] );



// Blog Title Font
$fonts_blog_ttl = get_theme_mod('fonts_blog_ttl', '');
if (empty($fonts_blog_ttl)) {
    $fonts_blog_ttl = array();
}
if (empty($fonts_blog_ttl['font-family'])) {
    $fonts_blog_ttl['font-family'] = 'PT Serif';
}

if (empty($fonts_blog_ttl['variant'])) {
    $fonts_blog_ttl['variant'] = '700';
} elseif ($fonts_blog_ttl['variant'] == 'regular' || $fonts_blog_ttl['variant'] == 'italic') {
    $fonts_blog_ttl['variant'] = '400';
} elseif ($fonts_blog_ttl['variant'] == '100italic') {
    $fonts_blog_ttl['variant'] = '100';
} elseif ($fonts_blog_ttl['variant'] == '200italic') {
    $fonts_blog_ttl['variant'] = '200';
} elseif ($fonts_blog_ttl['variant'] == '300italic') {
    $fonts_blog_ttl['variant'] = '300';
} elseif ($fonts_blog_ttl['variant'] == '500italic') {
    $fonts_blog_ttl['variant'] = '500';
} elseif ($fonts_blog_ttl['variant'] == '600italic') {
    $fonts_blog_ttl['variant'] = '600';
} elseif ($fonts_blog_ttl['variant'] == '700italic') {
    $fonts_blog_ttl['variant'] = '700';
} elseif ($fonts_blog_ttl['variant'] == '800italic') {
    $fonts_blog_ttl['variant'] = '800';
} elseif ($fonts_blog_ttl['variant'] == '900italic') {
    $fonts_blog_ttl['variant'] = '900';
}

if (empty($fonts_blog_ttl['font-size'])) {
    $fonts_blog_ttl['font-size'] = '19px';
}
if (empty($fonts_blog_ttl['line-height'])) {
    $fonts_blog_ttl['line-height'] = '1.2';
}
if (empty($fonts_blog_ttl['letter-spacing'])) {
    $fonts_blog_ttl['letter-spacing'] = '0px';
}
if (empty($fonts_blog_ttl['text-align'])) {
    $fonts_blog_ttl['text-align'] = 'left';
}
if (empty($fonts_blog_ttl['color'])) {
    $fonts_blog_ttl['color'] = $color_main;
}
if (empty($fonts_blog_ttl['text-transform'])) {
    $fonts_blog_ttl['text-transform'] = 'none';
}
add_less_var( 'fonts_blog_ttl', $fonts_blog_ttl['font-family'] );
add_less_var( 'fonts_blog_ttl_variant', $fonts_blog_ttl['variant'] );
add_less_var( 'fonts_blog_ttl_size', $fonts_blog_ttl['font-size'] );
add_less_var( 'fonts_blog_ttl_lh', $fonts_blog_ttl['line-height'] );
add_less_var( 'fonts_blog_ttl_ls', $fonts_blog_ttl['letter-spacing'] );
add_less_var( 'fonts_blog_ttl_align', $fonts_blog_ttl['text-align'] );
add_less_var( 'fonts_blog_ttl_color', $fonts_blog_ttl['color'] );
add_less_var( 'fonts_blog_ttl_tt', $fonts_blog_ttl['text-transform'] );



// Page Title Font
$fonts_page_ttl = get_theme_mod('fonts_page_ttl', '');
if (empty($fonts_page_ttl)) {
    $fonts_page_ttl = array();
}
if (empty($fonts_page_ttl['font-family'])) {
    $fonts_page_ttl['font-family'] = 'Roboto';
}

if (empty($fonts_page_ttl['variant'])) {
    $fonts_page_ttl['variant'] = '900';
} elseif ($fonts_page_ttl['variant'] == 'regular' || $fonts_page_ttl['variant'] == 'italic') {
    $fonts_page_ttl['variant'] = '400';
} elseif ($fonts_page_ttl['variant'] == '100italic') {
    $fonts_page_ttl['variant'] = '100';
} elseif ($fonts_page_ttl['variant'] == '200italic') {
    $fonts_page_ttl['variant'] = '200';
} elseif ($fonts_page_ttl['variant'] == '300italic') {
    $fonts_page_ttl['variant'] = '300';
} elseif ($fonts_page_ttl['variant'] == '500italic') {
    $fonts_page_ttl['variant'] = '500';
} elseif ($fonts_page_ttl['variant'] == '600italic') {
    $fonts_page_ttl['variant'] = '600';
} elseif ($fonts_page_ttl['variant'] == '700italic') {
    $fonts_page_ttl['variant'] = '700';
} elseif ($fonts_page_ttl['variant'] == '800italic') {
    $fonts_page_ttl['variant'] = '800';
} elseif ($fonts_page_ttl['variant'] == '900italic') {
    $fonts_page_ttl['variant'] = '900';
}

if (empty($fonts_page_ttl['font-size'])) {
    $fonts_page_ttl['font-size'] = '22px';
}
if (empty($fonts_page_ttl['line-height'])) {
    $fonts_page_ttl['line-height'] = '1.4';
}
if (empty($fonts_page_ttl['letter-spacing'])) {
    $fonts_page_ttl['letter-spacing'] = '2px';
}
if (empty($fonts_page_ttl['text-align'])) {
    $fonts_page_ttl['text-align'] = 'left';
}
if (empty($fonts_page_ttl['color'])) {
    $fonts_page_ttl['color'] = $color_main;
}
if (empty($fonts_page_ttl['text-transform'])) {
    $fonts_page_ttl['text-transform'] = 'uppercase';
}
add_less_var( 'fonts_page_ttl', $fonts_page_ttl['font-family'] );
add_less_var( 'fonts_page_ttl_variant', $fonts_page_ttl['variant'] );
add_less_var( 'fonts_page_ttl_size', $fonts_page_ttl['font-size'] );
add_less_var( 'fonts_page_ttl_lh', $fonts_page_ttl['line-height'] );
add_less_var( 'fonts_page_ttl_ls', $fonts_page_ttl['letter-spacing'] );
add_less_var( 'fonts_page_ttl_align', $fonts_page_ttl['text-align'] );
add_less_var( 'fonts_page_ttl_color', $fonts_page_ttl['color'] );
add_less_var( 'fonts_page_ttl_tt', $fonts_page_ttl['text-transform'] );



// Products Gallery Title Font
$fonts_gallery_ttl = get_theme_mod('fonts_gallery_ttl', '');
if (empty($fonts_gallery_ttl)) {
    $fonts_gallery_ttl = array();
}
if (empty($fonts_gallery_ttl['font-family'])) {
    $fonts_gallery_ttl['font-family'] = 'Roboto';
}

if (empty($fonts_gallery_ttl['variant'])) {
    $fonts_gallery_ttl['variant'] = '700';
} elseif ($fonts_gallery_ttl['variant'] == 'regular' || $fonts_gallery_ttl['variant'] == 'italic') {
    $fonts_gallery_ttl['variant'] = '400';
} elseif ($fonts_gallery_ttl['variant'] == '100italic') {
    $fonts_gallery_ttl['variant'] = '100';
} elseif ($fonts_gallery_ttl['variant'] == '200italic') {
    $fonts_gallery_ttl['variant'] = '200';
} elseif ($fonts_gallery_ttl['variant'] == '300italic') {
    $fonts_gallery_ttl['variant'] = '300';
} elseif ($fonts_gallery_ttl['variant'] == '500italic') {
    $fonts_gallery_ttl['variant'] = '500';
} elseif ($fonts_gallery_ttl['variant'] == '600italic') {
    $fonts_gallery_ttl['variant'] = '600';
} elseif ($fonts_gallery_ttl['variant'] == '700italic') {
    $fonts_gallery_ttl['variant'] = '700';
} elseif ($fonts_gallery_ttl['variant'] == '800italic') {
    $fonts_gallery_ttl['variant'] = '800';
} elseif ($fonts_gallery_ttl['variant'] == '900italic') {
    $fonts_gallery_ttl['variant'] = '900';
}

if (empty($fonts_gallery_ttl['font-size'])) {
    $fonts_gallery_ttl['font-size'] = '15px';
}
if (empty($fonts_gallery_ttl['line-height'])) {
    $fonts_gallery_ttl['line-height'] = '1.4';
}
if (empty($fonts_gallery_ttl['letter-spacing'])) {
    $fonts_gallery_ttl['letter-spacing'] = '0.02em';
}
if (empty($fonts_gallery_ttl['text-align'])) {
    $fonts_gallery_ttl['text-align'] = 'center';
}
if (empty($fonts_gallery_ttl['color'])) {
    $fonts_gallery_ttl['color'] = $color_main;
}
if (empty($fonts_gallery_ttl['text-transform'])) {
    $fonts_gallery_ttl['text-transform'] = 'none';
}
add_less_var( 'fonts_gallery_ttl', $fonts_gallery_ttl['font-family'] );
add_less_var( 'fonts_gallery_ttl_variant', $fonts_gallery_ttl['variant'] );
add_less_var( 'fonts_gallery_ttl_size', $fonts_gallery_ttl['font-size'] );
add_less_var( 'fonts_gallery_ttl_lh', $fonts_gallery_ttl['line-height'] );
add_less_var( 'fonts_gallery_ttl_ls', $fonts_gallery_ttl['letter-spacing'] );
add_less_var( 'fonts_gallery_ttl_align', $fonts_gallery_ttl['text-align'] );
add_less_var( 'fonts_gallery_ttl_color', $fonts_gallery_ttl['color'] );
add_less_var( 'fonts_gallery_ttl_tt', $fonts_gallery_ttl['text-transform'] );



// Products List Title Font
$fonts_list_ttl = get_theme_mod('fonts_list_ttl', '');
if (empty($fonts_list_ttl)) {
    $fonts_list_ttl = array();
}
if (empty($fonts_list_ttl['font-family'])) {
    $fonts_list_ttl['font-family'] = 'Roboto';
}

if (empty($fonts_list_ttl['variant'])) {
    $fonts_list_ttl['variant'] = '500';
} elseif ($fonts_list_ttl['variant'] == 'regular' || $fonts_list_ttl['variant'] == 'italic') {
    $fonts_list_ttl['variant'] = '400';
} elseif ($fonts_list_ttl['variant'] == '100italic') {
    $fonts_list_ttl['variant'] = '100';
} elseif ($fonts_list_ttl['variant'] == '200italic') {
    $fonts_list_ttl['variant'] = '200';
} elseif ($fonts_list_ttl['variant'] == '300italic') {
    $fonts_list_ttl['variant'] = '300';
} elseif ($fonts_list_ttl['variant'] == '500italic') {
    $fonts_list_ttl['variant'] = '500';
} elseif ($fonts_list_ttl['variant'] == '600italic') {
    $fonts_list_ttl['variant'] = '600';
} elseif ($fonts_list_ttl['variant'] == '700italic') {
    $fonts_list_ttl['variant'] = '700';
} elseif ($fonts_list_ttl['variant'] == '800italic') {
    $fonts_list_ttl['variant'] = '800';
} elseif ($fonts_list_ttl['variant'] == '900italic') {
    $fonts_list_ttl['variant'] = '900';
}

if (empty($fonts_list_ttl['font-size'])) {
    $fonts_list_ttl['font-size'] = '20px';
}
if (empty($fonts_list_ttl['line-height'])) {
    $fonts_list_ttl['line-height'] = '1.4';
}
if (empty($fonts_list_ttl['letter-spacing'])) {
    $fonts_list_ttl['letter-spacing'] = '0px';
}
if (empty($fonts_list_ttl['text-align'])) {
    $fonts_list_ttl['text-align'] = 'left';
}
if (empty($fonts_list_ttl['color'])) {
    $fonts_list_ttl['color'] = $color_main;
}
if (empty($fonts_list_ttl['text-transform'])) {
    $fonts_list_ttl['text-transform'] = 'uppercase';
}
add_less_var( 'fonts_list_ttl', $fonts_list_ttl['font-family'] );
add_less_var( 'fonts_list_ttl_variant', $fonts_list_ttl['variant'] );
add_less_var( 'fonts_list_ttl_size', $fonts_list_ttl['font-size'] );
add_less_var( 'fonts_list_ttl_lh', $fonts_list_ttl['line-height'] );
add_less_var( 'fonts_list_ttl_ls', $fonts_list_ttl['letter-spacing'] );
add_less_var( 'fonts_list_ttl_align', $fonts_list_ttl['text-align'] );
add_less_var( 'fonts_list_ttl_color', $fonts_list_ttl['color'] );
add_less_var( 'fonts_list_ttl_tt', $fonts_list_ttl['text-transform'] );



// Products Table Title Font
$fonts_table_ttl = get_theme_mod('fonts_table_ttl', '');
if (empty($fonts_table_ttl)) {
    $fonts_table_ttl = array();
}
if (empty($fonts_table_ttl['font-family'])) {
    $fonts_table_ttl['font-family'] = 'Roboto';
}

if (empty($fonts_table_ttl['variant'])) {
    $fonts_table_ttl['variant'] = '500';
} elseif ($fonts_table_ttl['variant'] == 'regular' || $fonts_table_ttl['variant'] == 'italic') {
    $fonts_table_ttl['variant'] = '400';
} elseif ($fonts_table_ttl['variant'] == '100italic') {
    $fonts_table_ttl['variant'] = '100';
} elseif ($fonts_table_ttl['variant'] == '200italic') {
    $fonts_table_ttl['variant'] = '200';
} elseif ($fonts_table_ttl['variant'] == '300italic') {
    $fonts_table_ttl['variant'] = '300';
} elseif ($fonts_table_ttl['variant'] == '500italic') {
    $fonts_table_ttl['variant'] = '500';
} elseif ($fonts_table_ttl['variant'] == '600italic') {
    $fonts_table_ttl['variant'] = '600';
} elseif ($fonts_table_ttl['variant'] == '700italic') {
    $fonts_table_ttl['variant'] = '700';
} elseif ($fonts_table_ttl['variant'] == '800italic') {
    $fonts_table_ttl['variant'] = '800';
} elseif ($fonts_table_ttl['variant'] == '900italic') {
    $fonts_table_ttl['variant'] = '900';
}

if (empty($fonts_table_ttl['font-size'])) {
    $fonts_table_ttl['font-size'] = '15px';
}
if (empty($fonts_table_ttl['line-height'])) {
    $fonts_table_ttl['line-height'] = '1.15';
}
if (empty($fonts_table_ttl['letter-spacing'])) {
    $fonts_table_ttl['letter-spacing'] = '0px';
}
if (empty($fonts_table_ttl['text-align'])) {
    $fonts_table_ttl['text-align'] = 'left';
}
if (empty($fonts_table_ttl['color'])) {
    $fonts_table_ttl['color'] = $color_main;
}
if (empty($fonts_table_ttl['text-transform'])) {
    $fonts_table_ttl['text-transform'] = 'none';
}
add_less_var( 'fonts_table_ttl', $fonts_table_ttl['font-family'] );
add_less_var( 'fonts_table_ttl_variant', $fonts_table_ttl['variant'] );
add_less_var( 'fonts_table_ttl_size', $fonts_table_ttl['font-size'] );
add_less_var( 'fonts_table_ttl_lh', $fonts_table_ttl['line-height'] );
add_less_var( 'fonts_table_ttl_ls', $fonts_table_ttl['letter-spacing'] );
add_less_var( 'fonts_table_ttl_align', $fonts_table_ttl['text-align'] );
add_less_var( 'fonts_table_ttl_color', $fonts_table_ttl['color'] );
add_less_var( 'fonts_table_ttl_tt', $fonts_table_ttl['text-transform'] );



// Text Font
/*$fonts_text = get_theme_mod('fonts_text', '');
if (empty($fonts_text['font-family'])) {
	$fonts_text['font-family'] = 'Roboto';
}

if (empty($fonts_text['variant'])) {
	$fonts_text['variant'] = '400';
} elseif ($fonts_text['variant'] == 'regular' || $fonts_text['variant'] == 'italic') {
	$fonts_text['variant'] = '400';
} elseif ($fonts_text['variant'] == '100italic') {
	$fonts_text['variant'] = '100';
} elseif ($fonts_text['variant'] == '200italic') {
	$fonts_text['variant'] = '200'; 
} elseif ($fonts_text['variant'] == '300italic') {
	$fonts_text['variant'] = '300';
} elseif ($fonts_text['variant'] == '500italic') {
	$fonts_text['variant'] = '500';
} elseif ($fonts_text['variant'] == '600italic') {
	$fonts_text['variant'] = '600';
} elseif ($fonts_text['variant'] == '700italic') {
	$fonts_text['variant'] = '700';
} elseif ($fonts_text['variant'] == '800italic') {
	$fonts_text['variant'] = '800';
} elseif ($fonts_text['variant'] == '900italic') {
	$fonts_text['variant'] = '900';
}

if (empty($fonts_text['font-size'])) {
	$fonts_text['font-size'] = '14px';
}
if (empty($fonts_text['line-height'])) {
	$fonts_text['line-height'] = '1.7';
}
if (empty($fonts_text['letter-spacing'])) {
	$fonts_text['letter-spacing'] = '0px';
}
if (empty($fonts_text['text-align'])) {
	$fonts_text['text-align'] = 'left';
}
if (empty($fonts_text['color'])) {
	$fonts_text['color'] = $color_text;
}
if (empty($fonts_text['text-transform'])) {
	$fonts_text['text-transform'] = 'none';
}
add_less_var( 'fonts_text', $fonts_text['font-family'] );
add_less_var( 'fonts_text_variant', $fonts_text['variant'] );
add_less_var( 'fonts_text_size', $fonts_text['font-size'] );
add_less_var( 'fonts_text_lh', $fonts_text['line-height'] );
add_less_var( 'fonts_text_ls', $fonts_text['letter-spacing'] );
add_less_var( 'fonts_text_align', $fonts_text['text-align'] );
add_less_var( 'fonts_text_color', $fonts_text['color'] );
add_less_var( 'fonts_text_tt', $fonts_text['text-transform'] );*/