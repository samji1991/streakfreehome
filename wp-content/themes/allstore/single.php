<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */
get_header();

global $allstore_options;

$post_related_pos = allstore_option('post_related', true);
?>

<article id="content" <?php post_class( array('container', 'site-content') ); ?>>

<?php if ( have_posts() ) : ?>

	<?php  while ( have_posts() ) : the_post(); ?>

		<?php get_template_part('template-parts/breadcrumbs'); ?>

		<h1 class="main-ttl">
			<?php
			if (!empty($wp_query->queried_object->post_title)) {
				echo '<span>'.esc_attr($wp_query->queried_object->post_title).'</span>';
			}
			?>
		</h1>

		<?php
		$post_class = array('post-wrap', 'stylization');
		$category = get_the_category();
		if (class_exists('acf')) {
			$post_related = get_field('post_related');
			$post_products = get_field('post_products');
			$post_video = get_field( 'post_video' );
			$post_slider = get_field( 'post_slider' );
		}
		if (empty($post_products) || $post_related_pos == 'bottom') {
			$post_class[] = 'post-wrap-full';
		}
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>



<?php if ($allstore_options['single_post_sidebar'] == 'show') : ?>
<div class="row">
	<div class="col-sm-9">
<?php endif; ?>
		


			<?php
			if (!empty($post_slider)) :
				?>
				<div class="flexslider post-slider" id="post-slider-car">
					<ul class="slides">
						<?php foreach ($post_slider as $slide) : ?>
							<li>
								<a data-fancybox-group="fancy-img" class="fancy-img" href="<?php echo esc_attr($slide['url']); ?>"><img src="<?php echo esc_attr($slide['sizes']['allstore-1140x1140']); ?>" alt="<?php the_title(); ?>"></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php
			elseif (has_post_thumbnail()) :
        		$img_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'allstore-1140x1140');
        		?>
				<img class="post-img" src="<?php echo esc_attr($img_src[0]); ?>" alt="<?php the_title(); ?>">
			<?php endif; ?>

			<?php if (!empty($post_video)) : ?>
				<div class="post-video">
					<?php echo wp_oembed_get($post_video); ?>
				</div>
			<?php endif; ?>

			<?php
			the_content();

			wp_link_pages( array(
				'before'           => '<p class="link-pages">',
				'after'            => '</p>',
				'link_before'      => '<span>',
				'link_after'       => '</span>',
				'nextpagelink'     => '<i class="fa fa-angle-right"></i>',
				'previouspagelink' => '<i class="fa fa-angle-left"></i>',
			) );
			?>

			<?php
			// Tags
			the_tags('<ul class="post-tags"><li class="post-tags-label"><i class="fa fa-tags"></i></li><li>', '</li><li>', '</li></ul>');
			?>
			<div class="post-share-wrap">
				<?php
				// Social Share
				if (!empty($allstore_options['other_share'])) {
					include( trailingslashit( get_template_directory() ) . 'template-parts/share.php' );
				}
				?>
				
				<ul class="post-info">
					<li><time datetime="<?php echo get_the_date('Y-m-d H:i'); ?>"><?php echo get_the_date('d F, Y'); ?></time></li>
					<li>
						<?php foreach ($category as $key=>$cat) : ?>
							<a class="blog-i-categ" href="<?php echo esc_attr(get_term_link($cat->term_id)); ?>"><?php echo esc_attr($cat->name); ?></a><?php echo ($key+1<count($category)) ? ', ' : ''; ?>
						<?php endforeach; ?>
					</li>
					<li><?php esc_html_e('Comments:', 'allstore'); ?> <a href="#"><?php echo get_comments_number(); ?></a></li>
				</ul>

			</div>




<?php if ($allstore_options['single_post_sidebar'] == 'show') : ?>
	</div>
	<div class="col-sm-3">
		<?php get_sidebar('post'); ?>
	</div>
</div>
<?php endif; ?>



			<?php
			if (!empty($post_related)) :
				$page_for_posts = get_option('page_for_posts');
				?>
				<div class="flexslider post-rel-wrap" id="post-rel-car">
					<ul class="slides">
					<?php
					foreach ($post_related as $rel) :
						$post_class = array('stylization', 'posts-i');
						$rel_category = get_the_category( $rel['related']->ID );
						$img_src = allstore_get_img_src('allstore-420x600', get_post_thumbnail_id($rel['related']));
						if (empty($img_src)) {
							$post_class[] = 'posts-i-noimg';
						}
						?>
						<li id="post-<?php echo intval($rel['related']->ID); ?>" <?php post_class($post_class, $rel['related']->ID); ?>>
							<a class="posts-i-img" href="<?php echo get_permalink($rel['related']->ID); ?>">
								<?php if (!empty($img_src)) : ?><span<?php echo ' style="background-image: url('.esc_html($img_src).')"'; ?>></span><?php endif; ?>
							</a>
							<time class="posts-i-date" datetime="<?php echo get_the_date('Y-m-d H:i', $rel['related']); ?>"><span><?php echo get_the_date('d', $rel['related']); ?></span> <?php echo get_the_date('F', $rel['related']); ?></time>
							<div class="posts-i-info">
								<p class="posts-i-ctg">
								<?php
								if (!empty($rel_category)) {
									foreach ($rel_category as $key=>$categ) {
										echo '<a href="'.esc_attr(get_term_link($categ->term_id)).'">'.esc_attr($categ->name).'</a>';
										echo ($key+1<count($rel_category)) ? ', ' : '';
									}
								}
								?>
								</p>
								<h3 class="posts-i-ttl"><a href="<?php echo get_permalink($rel['related']->ID); ?>"><?php echo esc_attr($rel['related']->post_title); ?></a></h3>
							</div>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>


		</div>





		<?php
		if (!empty($post_products)) : ?>
		<div class="prod-related<?php
		$int_count = 4;
		if ($post_related_pos == 'bottom') {
			echo ' prod2-related';
			$int_count = 6;
		}
		?>">
			<h2><span><?php esc_html_e('Related products', 'allstore'); ?></span></h2>
			<div class="prod-related-car" id="prod-related-car">
				<ul class="slides">
					<?php
					$items_count = count($post_products);
					$int_key = 0;
					foreach ($post_products as $item) :
						if ($int_key % $int_count == 0) {
							echo '<li class="prod-rel-wrap">';
						}
						
						$prod_id = $item['related']->ID;
						$prod_ttl = $item['related']->post_title;
						
						include(locate_template('woocommerce/content-product-small.php'));

						if ($int_key % $int_count == ($int_count-1) || ($int_key + 1) >= $items_count) {
							echo "</li>";
						}
						$int_key++;
					
					endforeach; ?>

				</ul>
			</div>
		</div>
		<?php endif; ?>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>

	<?php endwhile; ?>

<?php endif; ?>

</article>

<?php
get_footer();
