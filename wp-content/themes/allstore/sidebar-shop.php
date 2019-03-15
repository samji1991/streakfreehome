<?php
/**
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'allstore-sb-1' ) ) {
    return;
}

$sidebar = allstore_option('catalog_sidebar', true);
?>
<aside class="stylization section-sb"<?php if ($sidebar == 'sticky') echo ' id="section-sticky-sb"'; ?>>

	<?php if ($sidebar == 'sticky') { ?>
	<div class="theiaStickySidebar">
	<?php } ?>

    <?php dynamic_sidebar( 'allstore-sb-1' ); ?>

	<?php if ($sidebar == 'sticky') { ?>
	</div><!-- .theiaStickySidebar -->
	<?php } ?>

</aside>
