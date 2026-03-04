<?php
class RealtyCore_Enquiries
{
    public function handle()
    {
        check_ajax_referer('realtycore_enquiry_nonce', 'nonce');

        $name = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
        $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
        $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

        wp_send_json_success([
            'message' => __('Enquiry submitted successfully.', 'realtycore-property-listings'),
            'data' => compact('name', 'email', 'message'),
        ]);
    }
}
