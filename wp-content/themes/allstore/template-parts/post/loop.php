<?php
$category = get_the_category();
$post_class = array('cf-sm-6', 'cf-lg-4', 'col-xs-6', 'col-sm-6', 'col-md-4', 'stylization', 'posts-i');
if (!empty($post_sidebar) && $post_sidebar !== 'hide') {
    $post_class = array('cf-sm-6', 'cf-lg-6', 'col-xs-6', 'col-sm-6', 'col-md-6', 'stylization', 'posts-i');
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
    <div class="posts-i-info">
        <p class="posts-i-ctg">
            <?php if (get_post_type() == 'post') : ?>
                <?php foreach ($category as $key=>$cat) : ?>
                    <a href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_attr($cat->name); ?></a><?php echo ($key+1<count($category)) ? ', ' : ''; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <span><?php echo get_post_type(); ?></span>
            <?php endif; ?>
        </p>
        <h3 class="posts-i-ttl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    </div>
</article>