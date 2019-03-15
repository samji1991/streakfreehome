<?php
/**
 * The template for displaying the footer.
 */
global $allstore_options;
?>

</main><?php // #main ?>

<?php
if (!empty($allstore_options['footer_template'])) {
	$footer_template = $allstore_options['footer_template'];
	if (function_exists('icl_object_id')) {
		$footer_template = icl_object_id($allstore_options['footer_template'], 'page', false, ICL_LANGUAGE_CODE);
	}
	$content = get_post_field('post_content', $footer_template);
	if (!empty($content)) {
		echo '<footer class="stylization site-footer">'.do_shortcode( $content ).'</footer>';
	}
}
?>

<?php wp_footer(); ?>

</body>
</html>
