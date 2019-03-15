<?php
/**
 * The template for displaying all pages.
 */

if (class_exists('acf')) {
	$page_width = get_field('page_width');
	$page_ttl_bcrumbs = get_field('page_ttl_bcrumbs');
}
if (empty($page_ttl_bcrumbs)) {
	$page_ttl_bcrumbs = 'show_both';
}

get_header();
?>

<?php if (!empty($page_width) && $page_width == 'full') : ?>

	<section id="content" <?php post_class( array(/*'container-fluid', */'stylization', 'site-content', 'page-full') ); ?>>

		<?php
		while ( have_posts() ) : the_post();
			if (!empty($page_ttl_bcrumbs) && $page_ttl_bcrumbs !== 'hide') {
				echo "<div class='container'>";
				if ($page_ttl_bcrumbs !== 'show_ttl') {
					get_template_part('template-parts/breadcrumbs');
				}
				if ($page_ttl_bcrumbs !== 'show_bcrumbs') {
					the_title( '<h1 class="main-ttl"><span>', '</span></h1>' );
				}
				echo "</div>";
			}

			the_content();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
			<?php
		endwhile; // End of the loop.
		?>
	</section>

<?php else : ?>

	<article id="content" <?php post_class( array('container', 'stylization', 'site-content', 'page-container') ); ?>>
		<?php
		while ( have_posts() ) : the_post();
			$page_content = get_the_content();

			$compare_page = false;
			if (defined( 'WCCM_VERISON' )) {
				$wccm_compare_page = get_option('wccm_compare_page');
				if (get_the_ID() == $wccm_compare_page) {
					$compare_page = true;
				}
			}
			if (!empty($page_content) || $compare_page) :

				if (!empty($page_ttl_bcrumbs) && $page_ttl_bcrumbs !== 'hide') {
					if ($page_ttl_bcrumbs !== 'show_ttl') {
						get_template_part('template-parts/breadcrumbs');
					}
					if ($page_ttl_bcrumbs !== 'show_bcrumbs') {
						the_title( '<h1 class="main-ttl"><span>', '</span></h1>' );
					}
				}

				the_content();

				wp_link_pages( array(
					'before'           => '<p class="link-pages">',
					'after'            => '</p>',
					'link_before'      => '<span>',
					'link_after'       => '</span>',
					'nextpagelink'     => '<i class="fa fa-angle-right"></i>',
					'previouspagelink' => '<i class="fa fa-angle-left"></i>',
				) );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
				<?php
			endif;
		endwhile; // End of the loop.
		?>
	</article>

<?php endif; ?>

<?php
get_footer();
?>