<?php
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Property_Map_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'property-map';
    }

    public function get_title()
    {
        return __('Property Map', 'realtycore-property-listings');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function render()
    {
        echo '<div class="realtycore-widget property-map">' . esc_html__('Property Map output placeholder', 'realtycore-property-listings') . '</div>';
    }
}
