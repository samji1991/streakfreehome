<?php
/**
 * The main template file.
 */
get_header();

$post_sidebar = allstore_option('post_sidebar', true);
$post_type = allstore_option('post_type', true);
?>

<section id="content" class="container site-content">

	<?php if ( have_posts() ) : ?>

		<?php get_template_part('template-parts/breadcrumbs'); ?>

		<h1 class="main-ttl main-ttl-categs">
		<?php
		if (!empty($wp_query->queried_object->post_title)) {
			echo '<span>'.esc_attr($wp_query->queried_object->post_title).'</span>';
		}
		?>
		</h1>

		<?php
		$blog_categories = wp_list_categories(array(
			'show_option_all' => esc_html__('All', 'allstore'),
			'show_count' => 0,
			'hide_empty' => true,
			'use_desc_for_title' => false,
			'hierarchical' => true,
			'title_li' => '',
			'echo' => 0,
			'depth' => 1,
		));
		if (!empty($blog_categories)) {
			echo '<ul class="blog-categs">' . $blog_categories . '</ul>';
		}
		?>

		<?php if ($post_sidebar !== 'hide') : ?>
		<div class="row"<?php if ($post_sidebar == 'sticky') echo ' blog-sticky-wrap'; ?>>
			<div class="col-sm-9"<?php if ($post_sidebar == 'sticky') echo ' id="blog-sticky-cont"'; ?>>

			<?php if ($post_sidebar == 'sticky') { ?>
			<div class="theiaStickySidebar">
			<?php } ?>

		<?php endif; ?>

			<div class="posts-list blog-page">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					if ($post_type == 'type_1') {
						include(locate_template('template-parts/post/loop.php'));
					} else {
						include(locate_template('template-parts/post/loop-2.php'));
					}
					?>
				<?php endwhile; ?>
			</div>

			<?php include(locate_template('template-parts/pagination.php')); ?>

		<?php if ($post_sidebar !== 'hide') : ?>

			<?php if ($post_sidebar == 'sticky') { ?>
			</div><!-- .theiaStickySidebar -->
			<?php } ?>

			</div>
			<div class="col-sm-3"<?php if ($post_sidebar == 'sticky') echo ' id="blog-sticky-sb"'; ?>>

				<?php if ($post_sidebar == 'sticky') { ?>
				<div class="theiaStickySidebar">
				<?php } ?>

				<?php get_sidebar(); ?>

				<?php if ($post_sidebar == 'sticky') { ?>
				</div><!-- .theiaStickySidebar -->
				<?php } ?>
	
			</div>
		</div>
		<?php endif; ?>

	<?php endif; ?>

</section>

<?php
get_footer();
?>