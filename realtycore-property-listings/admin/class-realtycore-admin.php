<?php
class RealtyCore_Admin
{
    public function enqueue_assets()
    {
        wp_enqueue_style('realtycore-admin', REALTYCORE_PROPERTY_LISTINGS_URL . 'assets/css/realtycore-admin.css', [], REALTYCORE_PROPERTY_LISTINGS_VERSION);
        wp_enqueue_script('realtycore-admin', REALTYCORE_PROPERTY_LISTINGS_URL . 'assets/js/realtycore-admin.js', ['jquery'], REALTYCORE_PROPERTY_LISTINGS_VERSION, true);
    }
}
