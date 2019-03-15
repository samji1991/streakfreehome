<?php
add_action( 'vc_before_init', 'allstore_pricing_integrate_vc' );
function allstore_pricing_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Pricing Tables', 'allstore'),
        'base' => 'allstore_pricing',
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
                'heading' => esc_html__('Subtitle', 'allstore'),
                'param_name' => 'subtitle',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Price', 'allstore'),
                'param_name' => 'price',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link', 'allstore'),
                'param_name' => 'link',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Larger', 'allstore'),
                'param_name' => 'larger',
            ),
            array(
                'type' => 'textarea_html',
                'heading' => esc_html__('Content', 'allstore'),
                'param_name' => 'content',
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

class WPBakeryShortCode_allstore_pricing extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'title' => '',
            'subtitle' => '',
            'price' => '',
            'link' => '',
            'larger' => '',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();
        ?>
        <div class="pricing-i<?php if (!empty($larger)) echo ' pricing-i-marked'; ?><?php echo esc_attr( $css_class ); ?>">
            <?php
            if (!empty($title) || !empty($subtitle)) {
                echo "<div class='pricing-i-top'>";
                if (!empty($title)) {
                    echo "<h3 class='pricing-i-ttl'>" . esc_attr($title) . "</h3>";
                }
                if (!empty($subtitle)) {
                    echo "<p class='pricing-i-subttl'>" . esc_attr($subtitle) . "</p>";
                }
                echo "</div>";
            }
            if (!empty($price)) {
                echo "<p class='pricing-i-price'>".esc_attr($price)."</p>";
            }
            if (!empty($content) || !empty($link)) {
                echo "<div class='pricing-i-desc'>";
                if (!empty($content)) {
                    echo wpautop($content);
                }
                if (!empty($link)) {
                    $link = vc_build_link($link);
                    ?>
                    <p class="pricing-i-order"><a href="<?php echo esc_url($link['url']); ?>"<?php if (!empty($link['target'])) echo ' target="'.esc_attr($link['target']).'"'; ?> class="pricing-table-action"><?php if (!empty($link['title'])) echo esc_attr($link['title']); ?></a></p>
                    <?php
                }
                echo "</div>";
            }
            ?>
        </div>
        <?php
        $output = ob_get_clean();

        return $output;
    }
}