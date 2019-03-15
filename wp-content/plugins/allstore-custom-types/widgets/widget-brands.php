<?php
class AllStoreBrands_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'allstorebrands_widget',
			esc_html__( 'AllStore Brands', 'allstore-custom-types' ),
			array(
				'classname'   => 'allstorebrands_widget',
				'description' => esc_html__( 'Brands List', 'allstore-custom-types' )
				)
		);
	}

    /**  
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

    	extract( $args );

    	$title      = apply_filters( 'widget_title', $instance['title'] );
    	$posts_count    = intval($instance['posts_count']);
    	if (empty($posts_count)) {
    		$posts_count = '';
    	}
    	$brands_name    = $instance['brands_name'];

    	echo $before_widget;

    	if ( $title ) {
    		echo $before_title . $title . $after_title;
    	}

    	$terms_list = get_terms(array(
			'taxonomy'      => 'product_brands',
			'orderby'       => 'name', 
			'order'         => 'DESC',
			'hide_empty'    => true,
			'number'        => $posts_count,
			'hierarchical'  => false, 
    	));
    	if (!empty($terms_list)) :
    	?>
    	<ul class="brands-sb">
			<?php foreach ($terms_list as $brand) : ?>
				<li<?php if (!empty($brands_name) && $brands_name == 'yes') echo ' class="brands-sb-img"'; else echo '  class="brands-sb-noimg"'; ?>>
					<a class="brands-i-link" href="<?php echo get_term_link($brand->term_id, 'product_brands'); ?>">
						<?php if (!empty($brands_name) && $brands_name == 'yes') :
							$brand_img = get_option("taxonomy_brands_".$brand->term_id);
							?>
							<span class="brands-i-img">
								<?php if (!empty($brand_img['img'])) : ?>
									<img src="<?php echo $brand_img['img']; ?>"
										 alt="<?php echo esc_attr($brand->name); ?>">
								<?php endif; ?>
							</span>
							<?php if ($brands_name == 'yes') : ?>
								<p class="brands-i-ttl"><?php echo esc_attr($brand->name); ?> <span class="brands-i-count">(<?php echo esc_attr($brand->count); ?>)</span></p>
							<?php endif; ?>
						<?php else: ?>
							<p class="brands-i-ttl">
								<?php echo $brand->name; ?>
								<?php echo '<span class="brands-i-count">('.$brand->count.')</span>'; ?>
							</p>
						<?php endif; ?>
					</a>
				</li>
			<?php endforeach; ?>
    	</ul>
    	<?php

    	endif;

		echo $after_widget;

	}


    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {        

    	$instance = $old_instance;

    	$instance['title'] = strip_tags( $new_instance['title'] );
    	$instance['posts_count'] = strip_tags( $new_instance['posts_count'] );
    	$instance['brands_name'] = strip_tags( $new_instance['brands_name'] );

    	return $instance;

    }

    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {    

    	if (!empty($instance['title'])) {
    		$title      = esc_attr( $instance['title'] );
    	} else {
    		$title      = '';
    	}
    	if (!empty($instance['posts_count'])) {
    		$posts_count      = esc_attr( $instance['posts_count'] );
    	} else {
    		$posts_count      = '';
    	}
    	if (!empty($instance['brands_name'])) {
    		$brands_name      = esc_attr( $instance['brands_name'] );
    	} else {
    		$brands_name      = '';
    	}
    	?>

    	<p>
    		<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'allstore-custom-types'); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    	</p>
    	<p>
    		<label for="<?php echo $this->get_field_id('posts_count'); ?>"><?php esc_html_e('Brands Max Count:', 'allstore-custom-types'); ?></label>
    		<input class="widefat" id="<?php echo $this->get_field_id('posts_count'); ?>" name="<?php echo $this->get_field_name('posts_count'); ?>" type="text" value="<?php echo $posts_count; ?>" />
    	</p>
    	<p>
    		<label for="<?php echo $this->get_field_id('posts_count'); ?>"><?php esc_html_e('Show brands with image:', 'allstore-custom-types'); ?></label>
    		<input class="widefat" id="<?php echo $this->get_field_id('brands_name'); ?>" name="<?php echo $this->get_field_name('brands_name'); ?>" type="checkbox" value="yes"<?php if ($brands_name == 'yes') echo ' checked'; ?>>
    	</p>

    	<?php 
    }

}

/* Register the widget */
function allstore_brands_widget_init () {
	register_widget( 'AllStoreBrands_Widget' );
}
add_action( 'widgets_init', 'allstore_brands_widget_init');