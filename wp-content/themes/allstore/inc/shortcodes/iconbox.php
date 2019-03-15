<?php
add_action( 'vc_before_init', 'allstore_iconbox_integrate_vc' );
function allstore_iconbox_integrate_vc () {
    vc_map( array(
        'name' => esc_html__('Iconbox', 'allstore'),
        'base' => 'allstore_iconbox',
        'class' => '',
        'category' => esc_html__( 'AllStore', 'allstore' ),
        'icon' => get_template_directory_uri() . "/img/vc_allstore.png",
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Styles', 'allstore'),
                'param_name' => 'styles',
                'value' => array(
                    esc_html__('Icon on the Top', 'allstore') => 'icon_top',
                    esc_html__('Icon on the Left', 'allstore') => 'icon_left'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'allstore'),
                'param_name' => 'title',
            ),
            array(
                'type' => 'textarea_html',
                'heading' => esc_html__('Content', 'allstore'),
                'param_name' => 'content',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link', 'allstore'),
                'param_name' => 'link',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icon library', 'allstore' ),
                'value' => array(
                    esc_html__( 'Image', 'allstore' ) => 'image',
                    esc_html__( 'Font Awesome', 'allstore' ) => 'fontawesome',
                    esc_html__( 'Open Iconic', 'allstore' ) => 'openiconic',
                    esc_html__( 'Typicons', 'allstore' ) => 'typicons',
                    esc_html__( 'Entypo', 'allstore' ) => 'entypo',
                    esc_html__( 'Linecons', 'allstore' ) => 'linecons',
                    esc_html__( 'Mono Social', 'allstore' ) => 'monosocial',
                ),
                'admin_label' => true,
                'param_name' => 'type',
                'description' => esc_html__( 'Select icon library.', 'allstore' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'allstore'),
                'param_name' => 'image',
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'image',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'fontawesome',
                ),
                'description' => esc_html__( 'Select icon from library.', 'allstore' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_openiconic',
                'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'openiconic',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'openiconic',
                ),
                'description' => esc_html__( 'Select icon from library.', 'allstore' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_typicons',
                'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'typicons',
                ),
                'description' => esc_html__( 'Select icon from library.', 'allstore' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'entypo',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_linecons',
                'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'linecons',
                ),
                'description' => esc_html__( 'Select icon from library.', 'allstore' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'allstore' ),
                'param_name' => 'icon_monosocial',
                'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'monosocial',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'monosocial',
                ),
                'description' => esc_html__( 'Select icon from library.', 'allstore' ),
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

class WPBakeryShortCode_allstore_iconbox extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {

        $css = '';
        extract( shortcode_atts( array (
            'styles' => '',
            'title' => '',
            'image' => '',
            'link' => '',
            'type' => '',
            'icon_fontawesome' => '',
            'icon_openiconic' => '',
            'icon_typicons' => '',
            'icon_entypo' => '',
            'icon_linecons' => '',
            'icon_monosocial' => '',
            'css' => ''
        ), $atts ) );

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        ob_start();
        $class_prefix = '';
        if ($styles == 'icon_left') {
            $class_prefix = '-2';
        }

        // Enqueue needed icon font.
        if (empty($image)) {
            vc_icon_element_fonts_enqueue($type);
        }
        ?>
        <div class="iconbox-i<?php echo esc_html($class_prefix); ?><?php echo esc_attr( $css_class ); ?>">
            <p class="iconbox-i<?php echo esc_html($class_prefix); ?>-img"><?php
                if (!empty($image)) {
                    $image_src = wp_get_attachment_image_src($image, 'allstore-420x600');
                    echo '<img src="'.esc_attr($image_src[0]).'" alt="'.esc_attr($title).'">';
                } elseif (!empty($icon_fontawesome)) {
                    echo '<i class="'.esc_attr($icon_fontawesome).'"></i>';
                } elseif (!empty($icon_openiconic)) {
                    echo '<i class="'.esc_attr($icon_openiconic).'"></i>';
                } elseif (!empty($icon_typicons)) {
                    echo '<i class="'.esc_attr($icon_typicons).'"></i>';
                } elseif (!empty($icon_entypo)) {
                    echo '<i class="'.esc_attr($icon_entypo).'"></i>';
                } elseif (!empty($icon_linecons)) {
                    echo '<i class="'.esc_attr($icon_linecons).'"></i>';
                } elseif (!empty($icon_monosocial)) {
                    echo '<i class="'.esc_attr($icon_monosocial).'"></i>';
                }
                ?></p>
            <?php if (!empty($title)) : ?>
                <h3 class="iconbox-i<?php echo esc_html($class_prefix); ?>-ttl"><?php echo esc_attr($title); ?></h3>
            <?php endif; ?>
            <?php if (!empty($content)) : ?>
                <?php echo wpautop($content); ?>
            <?php endif; ?>
            <?php
            if (!empty($link)) {
                $link = vc_build_link($link);
                ?>
                <a class="iconbox-i<?php echo esc_html($class_prefix); ?>-link" href="<?php echo esc_url($link['url']); ?>"<?php if (!empty($link['target'])) echo ' target="'.esc_attr($link['target']).'"'; ?>><?php if (!empty($link['title'])) echo esc_attr($link['title']); ?> <i class="fa fa-angle-right"></i></a>
                <?php
            }
            ?>
        </div>
        <?php
        $output = ob_get_clean();

        return $output;
    }
}