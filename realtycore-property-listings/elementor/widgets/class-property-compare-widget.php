<?php
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Property_Compare_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'property-compare';
    }

    public function get_title()
    {
        return __('Property Compare', 'realtycore-property-listings');
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
        echo '<div class="realtycore-widget property-compare">' . esc_html__('Property Compare output placeholder', 'realtycore-property-listings') . '</div>';
    }
}
