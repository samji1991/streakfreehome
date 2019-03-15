<?php
/**
 * The template for displaying 404 pages (not found).
 */
get_header();
?>
<div id="content" <?php post_class( array('container', 'site-content') ); ?>>
	<div class="err404">
		<h1 class="err404-ttl"><?php esc_html_e('404', 'allstore'); ?></h1>
		<p class="err404-subttl"><?php esc_html_e('Error. Page not found.', 'allstore'); ?></p>
		<form class="err404-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input name="s" type="text" placeholder="<?php esc_html_e( 'Search...', 'allstore' ); ?>">
			<button type="submit" value="<?php esc_html_e( 'Search', 'allstore' ); ?>"><i class="fa fa-search"></i></button>
		</form>
	</div>
</div>
<?php
get_footer();
?>