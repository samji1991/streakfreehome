<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 */

get_header();
?>

<section id="content" class="container site-content">

	<?php get_template_part('template-parts/breadcrumbs'); ?>

	<?php
	if ( have_posts() ) : ?>

		<?php
		$products_count = 0;
		$posts_count = 0;
		$others_count = 0;
		while ( have_posts() ) : the_post();
			if ( 'product' === get_post_type() ) {
				$products_count++;
			} elseif ( 'post' === get_post_type() ) {
				$posts_count++;
			} else {
				$others_count++;
			}
		endwhile;
		?>

		<?php if ($products_count > 0) : ?>

			<h1 class="main-ttl"><span><?php esc_html_e('Search Products by', 'allstore'); ?> "<?php echo get_search_query(); ?>"</span></h1>
			<div class="section-cont-full">
				<?php
				woocommerce_product_loop_start();
					while ( have_posts() ) : the_post();
						if ( 'product' === get_post_type() ) :
							wc_get_template_part( 'content', 'product' );
						endif;
					endwhile;
				woocommerce_product_loop_end();
				?>
			</div>

		<?php endif; ?>

		<?php if ($posts_count > 0) : ?>

			<h1 class="main-ttl"><span><?php esc_html_e('Search Posts by', 'allstore'); ?> "<?php echo get_search_query(); ?>"</span></h1>
			<div class="posts-list blog-page">
				<?php
				while ( have_posts() ) : the_post();
					if ( 'post' !== get_post_type() ) {
						continue;
					}
					get_template_part('template-parts/post/loop');
				endwhile;
				?>
			</div>

		<?php endif; ?>

		<?php if ($others_count > 0) : ?>

			<h1 class="main-ttl"><span><?php esc_html_e('Search Pages by', 'allstore'); ?> "<?php echo get_search_query(); ?>"</span></h1>
			<div class="posts-list blog-page">
				<?php
				while ( have_posts() ) : the_post();
					if ( 'post' == get_post_type() || 'product' == get_post_type()) {
						continue;
					}
					get_template_part('template-parts/post/loop');
				endwhile;
				?>
			</div>

		<?php endif; ?>

		<?php include(locate_template('template-parts/pagination.php')); ?>

		<?php

	endif; ?>

</section>

<?php
get_footer();
?>