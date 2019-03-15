<?php
class AllstoreCategories_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'allstorecategories_widget',
			esc_html__( 'AllStore Categories', 'allstore-custom-types' ),
			array(
				'classname'   => 'allstorecategories_widget',
				'description' => esc_html__( 'AllStore Categories', 'allstore-custom-types' )
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

		global $wp_query;
    	$title      = apply_filters( 'widget_title', $instance['title'] );
    	$start_level    = esc_html($instance['start_level']);

    	echo $before_widget;

    	if ( $title ) {
    		echo $before_title . $title . $after_title;
    	}

		if (!empty($wp_query->get_queried_object()->term_id) && $start_level !== 'level_0') {
			$current_ctg_id = $wp_query->get_queried_object()->term_id;
			if ($start_level == 'level_1') {
				$ancestors = get_ancestors($current_ctg_id, 'product_cat', 'taxonomy');
				$ctg_level_1 = end($ancestors);
				if (!$ctg_level_1) {
					$ctg_level_1 = $current_ctg_id;
				}
			} else {
				$ctg_level_1 = $current_ctg_id;
			}
		} else {
			$ctg_level_1 = 0;
		}

		echo '<div class="section-sb-current">';
		if (!empty($ctg_level_1)) {
			$ctg_level_1_arr = get_term_by( 'id', $ctg_level_1, 'product_cat' );
			echo '<h3><a href="'.get_category_link($ctg_level_1).'">'.$ctg_level_1_arr->name.' <span id="section-sb-toggle" class="section-sb-toggle"><span class="section-sb-ico"></span></span></a></h3>';
		}

		echo '<ul class="section-sb-list" id="section-sb-list">';
		wp_list_categories( array(
			'child_of'           => $ctg_level_1,
			'show_option_none'   => '',
			'orderby'            => 'name',
			'show_count'         => 1,
			'hide_empty'         => 1,
			'use_desc_for_title' => 0,
			'hierarchical'       => true,
			'title_li'           => '',
			'depth'              => 0,
			'current_category'   => 0,
			'pad_counts'         => 0,
			'taxonomy'           => 'product_cat',
			'walker'             => new Walker_Allstore_Categories_Widget,
		) );
		echo '</ul>';

		echo '</div>';


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
    	$instance['start_level'] = strip_tags( $new_instance['start_level'] );

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
    	if (!empty($instance['start_level'])) {
    		$start_level      = esc_attr( $instance['start_level'] );
    	} else {
    		$start_level      = '';
    	}
    	?>

    	<p>
    		<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'allstore-custom-types'); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    	</p>
    	<p>
    		<label for="<?php echo $this->get_field_id('start_level'); ?>"><?php esc_html_e('Start from:', 'allstore-custom-types'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('start_level'); ?>" name="<?php echo $this->get_field_name('start_level'); ?>">
				<option value="level_1"<?php if ($start_level == 'level_1') echo 'selected'; ?>><?php esc_html_e('Level 1', 'allstore-custom-types'); ?></option>
				<option value="level_0"<?php if ($start_level == 'level_0') echo 'selected'; ?>><?php esc_html_e('All', 'allstore-custom-types'); ?></option>
				<option value="level_cur"<?php if ($start_level == 'level_cur') echo 'selected'; ?>><?php esc_html_e('Current', 'allstore-custom-types'); ?></option>
			</select>
    	</p>

    	<?php 
    }

}

/* Register the widget */
function allstore_feature_posts_widget_init () {
	register_widget( 'AllstoreCategories_Widget' );
}
add_action( 'widgets_init', 'allstore_feature_posts_widget_init');