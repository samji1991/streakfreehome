<?php
/**
 * The header for our theme.
 */
global $allstore_options;
include( trailingslashit( get_template_directory() ) . 'inc/get_options.php' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php
$sticky_header = '';
if (!empty($allstore_options['header_sticky']) && $allstore_options['header_sticky']) {
	$sticky_header = 'header-sticky';
}
body_class($sticky_header);
?>>

	<header class="header">

		<?php
		if (!empty($allstore_options['header_before'])) {
			$header_before = $allstore_options['header_before'];
			if (function_exists('icl_object_id')) {
				$header_before = icl_object_id($allstore_options['header_before'], 'page', false, ICL_LANGUAGE_CODE);
			}
			$content = get_post_field('post_content', $header_before);
			if (!empty($content)) {
				echo '<div class="stylization site-header-before">'.do_shortcode( $content ).'</div>';
			}
		}
		?>

		<div class="header-middle">
			<div class="container header-middle-cont">
				
				<div class="toplogo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php if (!empty($allstore_options['header_logo'])) : ?>
							<img src="<?php echo esc_html($allstore_options['header_logo']); ?>" alt="<?php bloginfo('name'); ?>">
						<?php else: ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo('name'); ?>">
						<?php endif; ?>
					</a>
				</div>
				&nbsp;
				<div class="shop-menu">
					<ul>

						<?php if (!empty($allstore_options['wishlist']['id'])) : ?>
						<li>
							<a href="<?php echo esc_url($allstore_options['wishlist']['url']); ?>">
								<i class="fa fa-heart"></i>
								<span class="shop-menu-ttl"><?php esc_html_e('Wishlist', 'allstore'); ?></span>
								(<span id="h-wishlist-count"><?php $count = YITH_WCWL()->count_products(); echo intval($count); ?></span>)
							</a>
						</li>
						<?php endif; ?>

						<?php if (!empty($allstore_options['compare']['id'])) : ?>
						<li>
							<a href="<?php echo esc_url($allstore_options['compare']['url']); ?>">
								<i class="fa fa-bar-chart"></i>
								<span class="shop-menu-ttl"><?php esc_html_e('Compare', 'allstore'); ?></span> (<span id="h-compare-count"><?php echo intval($allstore_options['compare']['count']); ?></span>)
							</a>
						</li>
						<?php endif; ?>

						<?php if (!empty($allstore_options['account']['id'])) : ?>
							<?php if (is_user_logged_in()) : ?>
								<li class="topauth">
									<a href="<?php echo esc_url($allstore_options['account']['url']); ?>">
										<i class="fa fa-lock"></i>
										<span class="shop-menu-ttl"><?php esc_html_e('My account', 'allstore'); ?></span>
									</a>
									<a href="<?php echo esc_url( wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) ) ); ?>">
										<span class="shop-menu-ttl"><?php esc_html_e('Logout', 'allstore'); ?></span>
									</a>
								</li>
							<?php else: ?>
								<li class="topauth">
									<a href="<?php echo esc_url($allstore_options['account']['url']); ?>">
										<i class="fa fa-lock"></i>
										<span class="shop-menu-ttl"><?php esc_html_e('Registration', 'allstore'); ?></span>
									</a>
									<a href="<?php echo esc_url($allstore_options['account']['url']); ?>">
										<span class="shop-menu-ttl"><?php esc_html_e('Login', 'allstore'); ?></span>
									</a>
								</li>
							<?php endif; ?>
						<?php endif; ?>

						<?php if (class_exists( 'woocommerce' ) && !empty($allstore_options['cart']['id'])) : ?>
						<li>
							<div class="h-cart">
								<?php
								allstore_cart_link();
								the_widget( 'WC_Widget_Cart', 'title=' );
								?>
							</div>
						</li>
						<?php endif; ?>

					</ul>
				</div>
				
			</div>
		</div>

		<?php
		if (!empty($allstore_options['header_after'])) {
			$content = get_post_field('post_content', $allstore_options['header_after']);
			if (!empty($content)) {
				echo '<div class="stylization site-header-after">'.do_shortcode( $content ).'</div>';
			}
		}
		?>

		<div class="header-bottom">
			<div class="container">
				<nav class="topmenu">

					<div class="topcatalog">
						<a class="topcatalog-btn" href="<?php if (!empty($allstore_options['shop']['url'])) echo esc_url($allstore_options['shop']['url']); else '#'; ?>"><span><?php esc_html_e('All', 'allstore'); ?></span> <?php esc_html_e('catalog', 'allstore'); ?></a>
						<?php
						$args = array(
							'show_option_all'    => '',
							'show_option_none'   => '',
							'orderby'            => 'name',
							'order'              => 'ASC',
							'show_last_update'   => 0,
							'style'              => 'list',
							'show_count'         => 1,
							'hide_empty'         => 1,
							'use_desc_for_title' => 0,
							'child_of'           => 0,
							'exclude'            => '',
							'exclude_tree'       => '',
							'include'            => '',
							'hierarchical'       => true,
							'title_li'           => '',
							'echo'               => 1,
							'depth'              => 0,
							'current_category'   => 0,
							'pad_counts'         => 0,
							'taxonomy'           => 'product_cat',
							'walker'             => new Walker_Allstore_Allcatalog,
							'hide_title_if_empty' => false,
							'separator'          => '<br />',
						);

						echo '<ul class="topcatalog-list">';
						wp_list_categories( $args );
						echo '</ul>';
						?>
						
					</div>

					<button type="button" class="mainmenu-btn"><?php  esc_html_e('Menu', 'allstore'); ?></button>
					<?php
					wp_nav_menu( array(
						'menu' => 'primary',
						'container' => false,
						'container_class' => '',
						'container_id' => '',
						'menu_class' => 'menu mainmenu',
						'menu_id' => 'primary-menu',
						'echo' => true,
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'theme_location' => 'primary'
					) );
					?>

					<?php if ($allstore_options['header_search'] == 'simple') : ?>
					<div class="topsearch">
						<a id="topsearch-btn" class="topsearch-btn" href="#"><i class="fa fa-search"></i></a>
						<form class="topsearch-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_html_e('Search products', 'allstore'); ?>">
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<?php elseif ($allstore_options['header_search'] !== 'hide' && shortcode_exists('wcas-search-form')): ?>
					<div class="topsearch">
						<a id="topsearch-btn" class="topsearch-btn" href="#"><i class="fa fa-search"></i></a>
						<?php echo do_shortcode('[wcas-search-form]'); ?>
					</div>
					<?php endif; ?>

				</nav>
			</div>
		</div>

	</header>


	<main id="main" class="site-main">
