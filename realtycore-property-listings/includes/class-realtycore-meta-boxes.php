<?php
class RealtyCore_Meta_Boxes
{
    public function register()
    {
        add_meta_box('realtycore_property_data', __('Property Data', 'realtycore-property-listings'), [$this, 'render_data_metabox'], 'property');
    }

    public function render_data_metabox($post)
    {
        wp_nonce_field('realtycore_property_data', 'realtycore_property_data_nonce');
        $price = get_post_meta($post->ID, '_realtycore_price', true);
        echo '<label for="realtycore_price">' . esc_html__('Price', 'realtycore-property-listings') . '</label>';
        echo '<input type="text" id="realtycore_price" name="realtycore_price" value="' . esc_attr($price) . '" class="widefat" />';
    }

    public function save($post_id)
    {
        if (!isset($_POST['realtycore_property_data_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['realtycore_property_data_nonce'])), 'realtycore_property_data')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['realtycore_price'])) {
            update_post_meta($post_id, '_realtycore_price', sanitize_text_field(wp_unslash($_POST['realtycore_price'])));
        }
    }
}
