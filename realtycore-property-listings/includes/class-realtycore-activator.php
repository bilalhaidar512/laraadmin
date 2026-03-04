<?php
class RealtyCore_Activator
{
    public static function activate()
    {
        if (!post_type_exists('property')) {
            register_post_type('property', [
                'public' => true,
                'label' => __('Properties', 'realtycore-property-listings'),
            ]);
        }
        flush_rewrite_rules();
    }
}
