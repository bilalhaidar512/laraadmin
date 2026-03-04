<?php
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Recent_Properties_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'recent-properties';
    }

    public function get_title()
    {
        return __('Recent Properties', 'realtycore-property-listings');
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
        echo '<div class="realtycore-widget recent-properties">' . esc_html__('Recent Properties output placeholder', 'realtycore-property-listings') . '</div>';
    }
}
