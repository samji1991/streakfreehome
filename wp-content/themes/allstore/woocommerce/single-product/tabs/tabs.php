<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (class_exists('acf')) {
	$video = get_field('product_video');
	$articles = get_field('articles');
	$product_descwidth = get_field('product_descwidth');
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
if ( ! empty( $tabs ) ) : ?>

	<div class="prod-tabs-wrap">
		<div class="container">
			<ul class="prod-tabs">
				<?php $int_key = 0; ?>
				<?php foreach ( $tabs as $key => $tab ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>_tab">
						<a<?php if ($int_key == 0) echo ' class="active"'; ?> data-prodtab-num="<?php echo esc_attr( $key ); ?>" data-prodtab="#prod-tab-<?php echo esc_attr( $key ); ?>" href="#"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
					</li>
					<?php $int_key++; ?>
				<?php endforeach; ?>
	
				<?php if (!empty($video)) : ?>
					<li><a data-prodtab-num="video" href="#" data-prodtab="#prod-tab-video"><?php esc_html_e('Video', 'allstore'); ?></a></li>
				<?php endif; ?>
	
				<?php if (!empty($articles)) : ?>
					<li><a data-prodtab-num="articles" href="#" data-prodtab="#prod-tab-articles"><?php echo esc_html__('Articles', 'allstore').' ('.count($articles).')'; ?></a></li>
				<?php endif; ?>
	
			</ul>
		</div>
		<div class="prod-tab-cont">
			<?php $int_key = 0; ?>
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<p data-prodtab-num="<?php echo esc_attr( $key ); ?>" class="prod-tab-mob<?php if ($int_key == 0) echo ' active'; ?>" data-prodtab="#prod-tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></p>
				<div class="<?php
				if ($key == 'description' && !empty($product_descwidth) && $product_descwidth == 'full') {
					echo "page-full ";
				} else {
					echo "container page-container ";
				}
				?>prod-tab<?php
					if ($key == 'description') {
						echo ' stylization';
					} elseif ($key == 'additional_information') {
						echo ' prod-props';
					} ?>" id="prod-tab-<?php echo esc_html($key); ?>">
					<?php call_user_func( $tab['callback'], $key, $tab ); ?>
				</div>
				<?php $int_key++; ?>
			<?php endforeach; ?>

			<?php if (!empty($video)) : ?>
				<p data-prodtab-num="video" class="prod-tab-mob" data-prodtab="#prod-tab-video"><?php esc_html_e('Video', 'allstore'); ?></p>
				<div class="container prod-tab prod-tab-video" id="prod-tab-video">
					<?php echo $video; ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($articles)) : ?>
				<p data-prodtab-num="articles" class="prod-tab-mob" data-prodtab="#prod-tab-articles"><?php echo esc_html__('Articles', 'allstore').' ('.count($articles).')'; ?></p>
				<div class="container prod-tab prod-tab-articles" id="prod-tab-articles">
					<div class="flexslider post-rel-wrap" id="post-rel-car">
						<ul class="slides">
							<?php
							foreach ($articles as $article) :
								$category = get_the_category($article->ID);
								$post_class = array('stylization', 'posts-i');

								$img_src = '';
								if (!has_post_thumbnail($article)) {
									$post_class[] = 'posts-i-noimg';
								} else {
									$img_src = allstore_get_img_src('allstore-420x600', get_post_thumbnail_id($article->ID));
								}
								?>
								<li id="post-<?php echo intval($article->ID); ?>" <?php wc_product_class($post_class, $article->ID); ?>>
									<a class="posts-i-img" href="<?php echo get_the_permalink($article->ID); ?>"><?php if (!empty($img_src)) : ?><span<?php echo ' style="background-image: url('.esc_html($img_src).')"'; ?>></span><?php endif; ?></a>
									<time class="posts-i-date" datetime="<?php echo get_the_date('Y-m-d H:i'); ?>"><span><?php echo get_the_date('d', $article); ?></span> <?php echo get_the_date('F'); ?></time>
									<div class="posts-i-info">
										<p class="posts-i-ctg">
											<?php if (get_post_type($article) == 'post') : ?>
												<?php foreach ($category as $key=>$cat) : ?>
													<a href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_attr($cat->name); ?></a><?php echo ($key+1<count($category)) ? ', ' : ''; ?>
												<?php endforeach; ?>
											<?php else: ?>
												<span><?php echo get_post_type($article); ?></span>
											<?php endif; ?>
										</p>
										<h3 class="posts-i-ttl"><a href="<?php echo get_the_permalink($article->ID); ?>"><?php echo esc_html($article->post_title); ?></a></h3>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>

<?php endif; ?>
