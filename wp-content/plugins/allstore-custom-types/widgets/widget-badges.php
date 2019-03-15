<?php
class AllStoreBadges_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'allstorebadges_widget',
            esc_html__( 'Allstore Badges', 'allstore-custom-types' ),
            array(
                'classname'   => 'allstorebadges_widget',
                'description' => esc_html__( 'Badges List', 'allstore-custom-types' )
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

        echo $before_widget;

        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        $terms_list = get_terms(array(
            'taxonomy'      => 'product_badges',
            'orderby'       => 'name',
            'order'         => 'DESC',
            'hide_empty'    => true,
            'number'        => $posts_count,
            'hierarchical'  => false,
        ));
        if (!empty($terms_list)) :
            ?>
            <ul class="brands-sb">
                <?php foreach ($terms_list as $term) :
                    $badge_color = get_option("taxonomy_badges_".$term->term_id);
                    ?>
                    <li class="brands-sb-noimg">
                        <a class="brands-i-link" href="<?php echo get_term_link($term->term_id, 'product_badges'); ?>">
                            <p class="brands-i-ttl"<?php if (!empty($badge_color['color'])) echo ' style="color:'.$badge_color['color'].'"'; ?>>
                                <?php echo $term->name; ?>
                                <?php echo '<span class="brands-i-count">('.$term->count.')</span>'; ?>
                            </p>
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
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'allstore-custom-types'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts_count'); ?>"><?php esc_html_e('Posts Count:', 'allstore-custom-types'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('posts_count'); ?>" name="<?php echo $this->get_field_name('posts_count'); ?>" type="text" value="<?php echo $posts_count; ?>" />
        </p>

        <?php
    }

}

/* Register the widget */
function allstore_badges_widget_init () {
    register_widget( 'AllstoreBadges_Widget' );
}
add_action( 'widgets_init', 'allstore_badges_widget_init');