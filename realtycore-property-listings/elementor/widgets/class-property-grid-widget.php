<?php
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Property_Grid_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'property-grid';
    }

    public function get_title()
    {
        return __('Property Grid', 'realtycore-property-listings');
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
        echo '<div class="realtycore-widget property-grid">' . esc_html__('Property Grid output placeholder', 'realtycore-property-listings') . '</div>';
    }
}
