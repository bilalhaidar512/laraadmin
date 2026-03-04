<?php
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Property_Search_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'property-search';
    }

    public function get_title()
    {
        return __('Property Search', 'realtycore-property-listings');
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
        echo '<div class="realtycore-widget property-search">' . esc_html__('Property Search output placeholder', 'realtycore-property-listings') . '</div>';
    }
}
