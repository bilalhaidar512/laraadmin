<?php
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Agent_Profile_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'agent-profile';
    }

    public function get_title()
    {
        return __('Agent Profile', 'realtycore-property-listings');
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
        echo '<div class="realtycore-widget agent-profile">' . esc_html__('Agent Profile output placeholder', 'realtycore-property-listings') . '</div>';
    }
}
