<?php
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Property_Filter_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'property-filter';
    }

    public function get_title()
    {
        return __('Property Filter', 'realtycore-property-listings');
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
        echo '<div class="realtycore-widget property-filter">' . esc_html__('Property Filter output placeholder', 'realtycore-property-listings') . '</div>';
    }
}
