<?php
/**
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'allstore-sb-blog' ) ) {
	return;
}
?>
<aside class="stylization section-sb blog-sb">
	<?php dynamic_sidebar( 'allstore-sb-blog' ); ?>
</aside>
