<?php
class RealtyCore_Taxonomies
{
    public function register()
    {
        $taxonomies = [
            'property_type' => 'Property Type',
            'property_status' => 'Property Status',
            'property_location' => 'Property Location',
        ];

        foreach ($taxonomies as $taxonomy => $label) {
            register_taxonomy($taxonomy, 'property', [
                'label' => __($label, 'realtycore-property-listings'),
                'public' => true,
                'hierarchical' => true,
                'show_in_rest' => true,
            ]);
        }
    }
}
