<?php

if (!defined('ABSPATH')) {
    exit;
}

class CubeRealty_Settings
{
    private const OPTION_KEY = 'cuberealty_pixxi_settings';

    public static function boot(): void
    {
        add_action('admin_menu', [__CLASS__, 'register_menu']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
    }

    public static function register_menu(): void
    {
        add_options_page(
            'CubeRealty Settings',
            'CubeRealty',
            'manage_options',
            'cuberealty-settings',
            [__CLASS__, 'render_settings_page']
        );
    }

    public static function register_settings(): void
    {
        register_setting('cuberealty_settings_group', self::OPTION_KEY, [
            'type' => 'array',
            'sanitize_callback' => [__CLASS__, 'sanitize_settings'],
            'default' => [],
        ]);

        add_settings_section('cuberealty_api', 'Pixxi CRM API', '__return_false', 'cuberealty-settings');

        $fields = [
            'base_url' => 'Pixxi API Base URL',
            'api_key' => 'API Key',
            'secret_key' => 'Secret Key',
            'webhook_secret' => 'Webhook Secret',
            'sync_mode' => 'Sync Frequency (manual / cron)',
        ];

        foreach ($fields as $field => $label) {
            add_settings_field(
                $field,
                $label,
                [__CLASS__, 'render_text_field'],
                'cuberealty-settings',
                'cuberealty_api',
                ['field' => $field]
            );
        }
    }

    public static function sanitize_settings($input): array
    {
        return [
            'base_url' => esc_url_raw($input['base_url'] ?? ''),
            'api_key' => sanitize_text_field($input['api_key'] ?? ''),
            'secret_key' => sanitize_text_field($input['secret_key'] ?? ''),
            'webhook_secret' => sanitize_text_field($input['webhook_secret'] ?? ''),
            'sync_mode' => in_array($input['sync_mode'] ?? 'cron', ['manual', 'cron'], true) ? $input['sync_mode'] : 'cron',
        ];
    }

    public static function render_text_field(array $args): void
    {
        $field = $args['field'];
        $options = get_option(self::OPTION_KEY, []);
        $value = esc_attr($options[$field] ?? '');

        printf(
            '<input type="text" class="regular-text" name="%s[%s]" value="%s" />',
            esc_attr(self::OPTION_KEY),
            esc_attr($field),
            $value
        );
    }

    public static function render_settings_page(): void
    {
        ?>
        <div class="wrap">
            <h1>CubeRealty Dubai Estate Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('cuberealty_settings_group');
                do_settings_sections('cuberealty-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public static function get_settings(): array
    {
        return get_option(self::OPTION_KEY, []);
    }
}
