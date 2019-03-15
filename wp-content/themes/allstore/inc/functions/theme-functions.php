<?php

// Excerpt More from "[...]" to "..."
function allstore_excerpt_more () {
    return "...";
}
add_filter("excerpt_more", "allstore_excerpt_more");


// New Excerpt Length
function allstore_new_excerpt_length($length) {
    global $post;
    if ($post->post_type == 'post') {
        return 20;
    }
    return 55;
}
add_filter('excerpt_length', 'allstore_new_excerpt_length');


// Comment Template
function allstore_comment($comment, $args, $depth){
    $GLOBALS['comment'] = $comment;
    $comment_class = array('reviews-i');
    $ava_exist = allstore_validate_gravatar($comment->comment_author_email);
    if ($ava_exist) {
        $comment_class[] = 'existimg';
    }
    ?>
<li <?php comment_class($comment_class); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment_container">
        <?php if ($ava_exist) : ?>
            <div class="reviews-i-img">
                <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                <time class="reviews-i-date" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date(); ?></time>
            </div>
        <?php endif; ?>
        <div class="reviews-i-cont">

            <?php if (!$ava_exist) : ?>
                <time class="reviews-i-date" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date(); ?></time>
            <?php endif; ?>

            <?php if ($comment->comment_approved == '0') : ?>
                <p><i><?php echo esc_html__( 'Your comment is awaiting moderation.', 'allstore' ); ?></i></p>
            <?php endif; ?>
            <?php comment_text() ?>
            <h3 class="reviews-i-ttl"><?php echo get_comment_author_link() ?> <?php edit_comment_link('(Edit)', '  ', '') ?></h3>
            
            <p class="reviews-i-showanswer"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?> <i class="fa fa-angle-down"></i></p>
            
        </div>

    </div>
    <?php
}


// Get Image Source by ID
if (!function_exists('allstore_get_img_src')) {
    function allstore_get_img_src($img_size, $id = '') {
        if (empty($id)) {
            $id = get_post_thumbnail_id();
        }
        $img_src = wp_get_attachment_image_src($id, $img_size);
        return esc_html($img_src[0]);
    }
}



// Include Header/Footer Custom Styles
if (!function_exists('allstore_include_vc_custom_styles')) {
    function allstore_include_vc_custom_styles($items) {
        if (!empty($items)) {
            $custom_vc_styles = '';
            foreach ($items as $item) {
                $item_meta = get_post_meta($item, '_wpb_shortcodes_custom_css', true);
                if (!empty($item_meta)) {
                    $custom_vc_styles .= $item_meta;
                }
            }
            if (!empty($custom_vc_styles)) {
                $custom_vc_styles = preg_replace(
                    array('/:\s*/', '/\s*{\s*/', '/(;)*\s*}\s*/', '/\s+/'),
                    array(':', '{', '}', ' '),
                    $custom_vc_styles
                );
                wp_add_inline_style('dashicons', $custom_vc_styles);
                wp_enqueue_style('dashicons');
            }
        }
    }
}