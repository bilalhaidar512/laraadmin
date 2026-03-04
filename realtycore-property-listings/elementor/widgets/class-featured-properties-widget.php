<?php
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Featured_Properties_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'featured-properties';
    }

    public function get_title()
    {
        return __('Featured Properties', 'realtycore-property-listings');
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
        echo '<div class="realtycore-widget featured-properties">' . esc_html__('Featured Properties output placeholder', 'realtycore-property-listings') . '</div>';
    }
}
