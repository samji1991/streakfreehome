<?php
/**
 * @param FW_Ext_Backups_Demo[] $demos
 * @return FW_Ext_Backups_Demo[]
 */
function allstore_filter_theme_fw_ext_backups_demos($demos) {
    $demos_array = array(
        'allstore-demo-id' => array(
            'title' => esc_html__('AllStore Demo', 'allstore'),
            'screenshot' => 'http://real-web.pro/allstore/screenshot.png',
            'preview_link' => 'http://allstore.realwwweb.com',
        ),
    );

    $download_url = 'http://real-web.pro/1/2410-allstore/index.php';

    foreach ($demos_array as $id => $data) {
        $demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
            'url' => esc_url($download_url),
            'file_id' => $id,
        ));
        $demo->set_title($data['title']);
        $demo->set_screenshot($data['screenshot']);
        $demo->set_preview_link($data['preview_link']);

        $demos[ $demo->get_id() ] = $demo;

        unset($demo);
    }

    return $demos;
}
add_filter('fw:ext:backups-demo:demos', 'allstore_filter_theme_fw_ext_backups_demos');