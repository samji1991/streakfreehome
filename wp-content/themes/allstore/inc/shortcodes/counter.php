<?php
add_action( 'vc_before_init', 'allstore_counter_integrate_vc' );
function allstore_counter_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Counter', 'allstore'),
        'base' => 'allstore_counter',
        'class' => '',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'allstore'),
                'param_name' => 'title',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Value', 'allstore'),
                'param_name' => 'value',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'allstore'),
                'param_name' => 'title_color',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Value Color', 'allstore'),
                'param_name' => 'value_color',
            ),
            array(
                'type' => 'textarea_html',
                'heading' => esc_html__('Content', 'allstore'),
                'param_name' => 'content',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Value - Percent or Number', 'allstore'),
                'param_name' => 'styles',
                'value' => array(
                    esc_html__('Number', 'allstore') => 'number',
                    esc_html__('Percent', 'allstore') => 'percent'
                ),
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'Css', 'allstore' ),
                'param_name' => 'css',
                'group' => esc_html__( 'Design options', 'allstore' ),
            ),
        )
    ) );
}

class WPBakeryShortCode_allstore_counter extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'title' => '',
            'value' => '',
            'title_color' => '',
            'value_color' => '',
            'styles' => '',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();
        ?>
        <div class="facts-i<?php echo esc_attr( $css_class ); ?>">
            <?php if ($styles == 'percent') :
                $value = intval($value)/100;
                ?>
                <p id="facts-i-percent-<?php echo intval(rand(1, 10000)); ?>" data-num="<?php echo esc_attr($value); ?>" class="facts-i-percent"<?php if (!empty($value_color)) echo ' style="color: '.esc_attr($value_color).'"'; ?>></p>
            <?php else:
                $value = intval($value);
                ?>
                <p data-num="<?php echo esc_attr($value); ?>" class="facts-i-num"<?php if (!empty($value_color)) echo ' style="color: '.esc_attr($value_color).'"'; ?>><?php echo esc_attr($value); ?></p>
            <?php endif; ?>
            <?php if (!empty($title)) : ?>
                <h3 class="facts-i-ttl<?php if ($styles == 'percent') echo ' facts-i-ttl-2'; ?>"<?php if (!empty($title_color)) echo ' style="color: '.esc_attr($title_color).'"'; ?>><?php echo esc_attr($title); ?></h3>
            <?php endif; ?>
            <?php
            if (!empty($content)) {
                echo wpautop($content);
            }
            ?>
        </div>
        <?php
        $output = ob_get_clean();

        return $output;
    }
}