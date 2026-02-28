<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/class-cuberealty-settings.php';
require_once __DIR__ . '/class-cuberealty-pixxi-api.php';
require_once __DIR__ . '/class-cuberealty-webhooks.php';
require_once __DIR__ . '/class-cuberealty-leads-repository.php';

class CubeRealty_Plugin
{
    public static function boot(): void
    {
        add_action('init', [__CLASS__, 'register_property_post_type']);
        add_action('init', [__CLASS__, 'register_property_taxonomies']);
        add_action('init', [__CLASS__, 'schedule_sync_job']);
        add_action('cuberealty_sync_properties', [__CLASS__, 'run_property_sync']);

        CubeRealty_Settings::boot();
        CubeRealty_Webhooks::boot();

        register_activation_hook(dirname(__DIR__) . '/cuberealty-dubai-estate.php', [__CLASS__, 'activate']);
        register_deactivation_hook(dirname(__DIR__) . '/cuberealty-dubai-estate.php', [__CLASS__, 'deactivate']);
    }

    public static function activate(): void
    {
        CubeRealty_Leads_Repository::create_table();
        self::schedule_sync_job();
    }

    public static function deactivate(): void
    {
        wp_clear_scheduled_hook('cuberealty_sync_properties');
    }

    public static function schedule_sync_job(): void
    {
        if (!wp_next_scheduled('cuberealty_sync_properties')) {
            wp_schedule_event(time(), 'fifteen_minutes', 'cuberealty_sync_properties');
        }
    }

    public static function run_property_sync(): void
    {
        $api = new CubeRealty_Pixxi_API();
        $properties = $api->request('/properties', 'GET');

        if (!is_array($properties)) {
            return;
        }

        foreach ($properties as $property) {
            self::upsert_property($property);
        }
    }

    public static function register_property_post_type(): void
    {
        register_post_type('cuberealty_property', [
            'label' => 'Properties',
            'public' => true,
            'show_in_rest' => true,
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        ]);
    }

    public static function register_property_taxonomies(): void
    {
        $taxonomies = [
            'cuberealty_property_type' => 'Property Type',
            'cuberealty_status' => 'Status',
            'cuberealty_emirate' => 'Emirate',
            'cuberealty_area' => 'Area',
            'cuberealty_developer' => 'Developer',
            'cuberealty_community' => 'Community',
        ];

        foreach ($taxonomies as $taxonomy => $label) {
            register_taxonomy($taxonomy, ['cuberealty_property'], [
                'label' => $label,
                'public' => true,
                'show_in_rest' => true,
                'hierarchical' => true,
            ]);
        }
    }

    public static function upsert_property(array $property): int
    {
        $pixxiId = sanitize_text_field($property['id'] ?? '');

        if (!$pixxiId) {
            return 0;
        }

        $postQuery = new WP_Query([
            'post_type' => 'cuberealty_property',
            'meta_key' => '_pixxi_property_id',
            'meta_value' => $pixxiId,
            'posts_per_page' => 1,
            'fields' => 'ids',
        ]);

        $postId = $postQuery->posts[0] ?? 0;

        $args = [
            'post_type' => 'cuberealty_property',
            'post_title' => sanitize_text_field($property['title'] ?? 'Untitled Property'),
            'post_content' => wp_kses_post($property['description'] ?? ''),
            'post_status' => 'publish',
        ];

        if ($postId) {
            $args['ID'] = $postId;
            $postId = wp_update_post($args, true);
        } else {
            $postId = wp_insert_post($args, true);
        }

        if (is_wp_error($postId) || !$postId) {
            return 0;
        }

        update_post_meta($postId, '_pixxi_property_id', $pixxiId);
        update_post_meta($postId, '_meta_price', floatval($property['price'] ?? 0));
        update_post_meta($postId, '_meta_bedrooms', intval($property['bedrooms'] ?? 0));
        update_post_meta($postId, '_meta_bathrooms', intval($property['bathrooms'] ?? 0));
        update_post_meta($postId, '_meta_size', sanitize_text_field($property['area'] ?? ''));

        self::assign_taxonomy($postId, 'cuberealty_status', $property['status'] ?? null);
        self::assign_taxonomy($postId, 'cuberealty_area', $property['location'] ?? null);

        return $postId;
    }

    private static function assign_taxonomy(int $postId, string $taxonomy, ?string $value): void
    {
        if (!$value) {
            return;
        }

        wp_set_object_terms($postId, [sanitize_text_field($value)], $taxonomy, false);
    }
}

add_filter('cron_schedules', static function ($schedules) {
    $schedules['fifteen_minutes'] = [
        'interval' => 15 * MINUTE_IN_SECONDS,
        'display' => __('Every 15 Minutes', 'cuberealty'),
    ];

    return $schedules;
});
