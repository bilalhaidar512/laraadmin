<?php

if (!defined('ABSPATH')) {
    exit;
}

class CubeRealty_Webhooks
{
    public static function boot(): void
    {
        add_action('rest_api_init', [__CLASS__, 'register_routes']);
    }

    public static function register_routes(): void
    {
        register_rest_route('cuberealty/v1', '/pixxi-webhook', [
            'methods' => 'POST',
            'callback' => [__CLASS__, 'handle_pixxi_webhook'],
            'permission_callback' => '__return_true',
        ]);
    }

    public static function handle_pixxi_webhook(WP_REST_Request $request): WP_REST_Response
    {
        if (!self::is_valid_signature($request)) {
            return new WP_REST_Response(['message' => 'Invalid signature'], 401);
        }

        $payload = $request->get_json_params();
        if (!is_array($payload)) {
            return new WP_REST_Response(['message' => 'Invalid payload'], 400);
        }

        $postId = CubeRealty_Plugin::upsert_property($payload);

        if (!$postId) {
            return new WP_REST_Response(['message' => 'Unable to sync property'], 422);
        }

        return new WP_REST_Response(['message' => 'Property synced', 'post_id' => $postId], 200);
    }

    private static function is_valid_signature(WP_REST_Request $request): bool
    {
        $settings = CubeRealty_Settings::get_settings();
        $secret = $settings['webhook_secret'] ?? '';
        $signature = (string) $request->get_header('X-Pixxi-Signature');
        $body = $request->get_body();

        if (!$secret || !$signature || !$body) {
            return false;
        }

        $computed = hash_hmac('sha256', $body, $secret);

        return hash_equals($computed, $signature);
    }
}
