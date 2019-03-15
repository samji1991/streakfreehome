<?php
add_action( 'vc_before_init', 'allstore_team_integrate_vc' );
function allstore_team_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Team', 'allstore'),
        'base' => 'allstore_team',
        'class' => '',
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Name', 'allstore'),
                'param_name' => 'name',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Position', 'allstore'),
                'param_name' => 'position',
            ),
            array(
                'type' => 'textarea_html',
                'heading' => esc_html__('Description', 'allstore'),
                'param_name' => 'content',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link', 'allstore'),
                'param_name' => 'link',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'allstore'),
                'param_name' => 'image',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Facebook', 'allstore'),
                'param_name' => 'social_fb',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Twitter', 'allstore'),
                'param_name' => 'social_twitter',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Google Plus', 'allstore'),
                'param_name' => 'social_gplus',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Vkontakte', 'allstore'),
                'param_name' => 'social_vk',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Instagram', 'allstore'),
                'param_name' => 'social_insta',
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

class WPBakeryShortCode_allstore_team extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'name' => '',
            'position' => '',
            'link' => '',
            'image' => '',
            'social_fb' => '',
            'social_twitter' => '',
            'social_gplus' => '',
            'social_vk' => '',
            'social_insta' => '',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();
        ?>
        <div class="team-i<?php echo esc_attr( $css_class ); ?>">
            <?php
            if (!empty($image)) {
                $image_src = wp_get_attachment_image_src($image, 'allstore-360x280-c');
                if (!empty($link)) {
                    $link = vc_build_link($link);
                    echo '<a href="'.esc_url($link['url']).'" class="team-i-img"'.(!empty($link['target']) ? ' target="'.esc_attr($link['target']).'"' : '').'><img src="'.esc_attr($image_src[0]).'" alt="'.esc_attr($name).'"></a>';
                } else {
                    echo '<p class="team-i-img"><img src="'.esc_attr($image_src[0]).'" alt="'.esc_attr($name).'"></p>';
                }
            }
            if (!empty($name)) {
                echo "<h3 class='team-i-ttl'>".wp_kses_post($name)."</h3>";
            }
            if (!empty($position)) {
                echo '<p class="team-i-post">'.esc_attr($position).'</p>';
            }
            if (!empty($content)) {
                echo wpautop($content);
            }
            ?>
            <?php if (!empty($social_fb) || !empty($social_twitter) || !empty($social_gplus) || !empty($social_vk) || !empty($social_insta)) : ?>
                <ul class="team-i-social">
                    <?php
                    if (!empty($social_fb)) :
                        $social_fb = vc_build_link($social_fb);
                        ?>
                        <li>
                            <a href="<?php echo esc_url($social_fb['url']); ?>"<?php if (!empty($social_fb['target'])) echo ' target="'.esc_attr($social_fb['target']).'"'; ?> rel="nofollow">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($social_insta)) :
                        $social_insta = vc_build_link($social_insta);
                        ?>
                        <li>
                            <a href="<?php echo esc_url($social_insta['url']); ?>"<?php if (!empty($social_insta['target'])) echo ' target="'.esc_attr($social_insta['target']).'"'; ?> rel="nofollow">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($social_twitter)) :
                        $social_twitter = vc_build_link($social_twitter);
                        ?>
                        <li>
                            <a href="<?php echo esc_url($social_twitter['url']); ?>"<?php if (!empty($social_twitter['target'])) echo ' target="'.esc_attr($social_twitter['target']).'"'; ?> rel="nofollow">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($social_vk)) :
                        $social_vk = vc_build_link($social_vk);
                        ?>
                        <li>
                            <a href="<?php echo esc_url($social_vk['url']); ?>"<?php if (!empty($social_vk['target'])) echo ' target="'.esc_attr($social_vk['target']).'"'; ?> rel="nofollow">
                                <i class="fa fa-vk"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($social_gplus)) :
                        $social_gplus = vc_build_link($social_gplus);
                        ?>
                        <li>
                            <a href="<?php echo esc_url($social_gplus['url']); ?>"<?php if (!empty($social_gplus['target'])) echo ' target="'.esc_attr($social_gplus['target']).'"'; ?> rel="nofollow">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </div>
        <?php
        $output = ob_get_clean();

        return $output;
    }
}