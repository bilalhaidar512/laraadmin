<?php
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Property_Carousel_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'property-carousel';
    }

    public function get_title()
    {
        return __('Property Carousel', 'realtycore-property-listings');
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
        echo '<div class="realtycore-widget property-carousel">' . esc_html__('Property Carousel output placeholder', 'realtycore-property-listings') . '</div>';
    }
}
