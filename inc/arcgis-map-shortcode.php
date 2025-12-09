<?php
/**
 * ArcGIS Map Shortcode
 * 
 * Usage: [arcgis_map layers="0f8130f83d7b4faab7ecc4e148b4fd4f" height="600"]
 */

if (!defined('ABSPATH')) {
    exit;
}

function elementor_blank_arcgis_map_shortcode($atts) {
    $atts = shortcode_atts([
        'layers' => '0f8130f83d7b4faab7ecc4e148b4fd4f',
        'height' => '600',
        'width' => '100%'
    ], $atts);
    
    $url = 'https://www.arcgis.com/apps/mapviewer/index.html?layers=' . esc_attr($atts['layers']);
    
    return sprintf(
        '<iframe width="%s" height="%s" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="%s" style="border:0; display:block;"></iframe>',
        esc_attr($atts['width']),
        esc_attr($atts['height']),
        esc_url($url)
    );
}
add_shortcode('arcgis_map', 'elementor_blank_arcgis_map_shortcode');
