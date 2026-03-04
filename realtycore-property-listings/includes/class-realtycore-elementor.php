<?php
class RealtyCore_Elementor
{
    public function register_hooks()
    {
        if (!did_action('elementor/loaded')) {
            return;
        }

        require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'elementor/class-realtycore-elementor-widgets.php';
        $widgets = new RealtyCore_Elementor_Widgets();
        $widgets->register();
    }
}
