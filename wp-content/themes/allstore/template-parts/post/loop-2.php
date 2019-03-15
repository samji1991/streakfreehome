<?php
$category = get_the_category();
$post_class = array('cf-sm-6', 'cf-lg-4', 'col-xs-6', 'col-sm-6', 'col-md-4', 'stylization', 'posts2-i');
if (!empty($post_sidebar) && $post_sidebar !== 'hide') {
    $post_class = array('cf-sm-6', 'cf-lg-6', 'col-xs-6', 'col-sm-6', 'col-md-6', 'stylization', 'posts2-i');
}

$img_src = '';
if (!has_post_thumbnail()) {
    $post_class[] = 'posts-i-noimg';
} else {
    $img_src = allstore_get_img_src('allstore-420x600');
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
    <a class="posts-i-img" href="<?php the_permalink(); ?>"><?php if (!empty($img_src)) : ?><span<?php echo ' style="background-image: url('.esc_html($img_src).')"'; ?>></span><?php endif; ?></a>
    <time class="posts-i-date" datetime="<?php echo get_the_date('Y-m-d H:i'); ?>"><span><?php echo get_the_date('d'); ?></span> <?php echo get_the_date('M'); ?></time>
    <h3 class="posts-i-ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>" class="posts-i-more"><?php esc_html_e('Read more...', 'allstore'); ?></a>
</article>