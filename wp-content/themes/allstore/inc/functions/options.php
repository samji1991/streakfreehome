<?php
if (!function_exists('allstore_option')) {
    function allstore_option($option, $allow_get = false) {
        global $allstore_options;
        if (!empty($_GET[$option]) && $allow_get) {
            $value = esc_html($_GET[$option]);
        } elseif (!empty($allstore_options[$option])) {
            $value = $allstore_options[$option];
        } elseif (empty($allstore_options)) {
            include( trailingslashit( get_template_directory() ) . 'inc/get_options.php');
            $value = $allstore_options[$option];
        } else {
            $value = get_theme_mod($option, '');
        }

        // Values from Cookies
        /*switch ($option) {
            // Catalog
            case 'catalog_viewmode':
                if (!empty($_GET[$option]) && $allow_get) {
                    $_COOKIE['allstore_catalog_viewmode'] = $value;
                } elseif (!empty($_COOKIE['allstore_catalog_viewmode'])) {
                    $value = $_COOKIE['allstore_catalog_viewmode'];
                }
                break;
        }*/

        return $value;
    }
}
