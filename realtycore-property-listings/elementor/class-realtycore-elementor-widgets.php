<?php
class RealtyCore_Elementor_Widgets
{
    public function register()
    {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    public function register_widgets($widgets_manager)
    {
        $widget_files = [
            'class-property-search-widget.php' => 'Property_Search_Widget',
            'class-property-grid-widget.php' => 'Property_Grid_Widget',
            'class-property-list-widget.php' => 'Property_List_Widget',
            'class-property-carousel-widget.php' => 'Property_Carousel_Widget',
            'class-property-map-widget.php' => 'Property_Map_Widget',
            'class-property-filter-widget.php' => 'Property_Filter_Widget',
            'class-featured-properties-widget.php' => 'Featured_Properties_Widget',
            'class-recent-properties-widget.php' => 'Recent_Properties_Widget',
            'class-agent-profile-widget.php' => 'Agent_Profile_Widget',
            'class-property-compare-widget.php' => 'Property_Compare_Widget',
        ];

        foreach ($widget_files as $file => $class_name) {
            require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'elementor/widgets/' . $file;
            if (class_exists($class_name)) {
                $widgets_manager->register(new $class_name());
            }
        }
    }
}
