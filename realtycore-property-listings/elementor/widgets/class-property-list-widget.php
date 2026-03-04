<?php
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Property_List_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'property-list';
    }

    public function get_title()
    {
        return __('Property List', 'realtycore-property-listings');
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
        echo '<div class="realtycore-widget property-list">' . esc_html__('Property List output placeholder', 'realtycore-property-listings') . '</div>';
    }
}
