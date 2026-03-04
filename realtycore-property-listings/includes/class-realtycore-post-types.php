<?php
class RealtyCore_Post_Types
{
    public function register()
    {
        register_post_type('property', [
            'labels' => [
                'name' => __('Properties', 'realtycore-property-listings'),
                'singular_name' => __('Property', 'realtycore-property-listings'),
            ],
            'public' => true,
            'has_archive' => true,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
            'rewrite' => ['slug' => 'properties'],
        ]);
    }
}
