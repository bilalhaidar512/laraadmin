<?php

if (!defined('ABSPATH')) {
    exit;
}

class CubeRealty_Leads_Repository
{
    public static function create_table(): void
    {
        global $wpdb;

        $tableName = $wpdb->prefix . 'cuberealty_leads';
        $charset = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$tableName} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(191) NOT NULL,
            email VARCHAR(191) NOT NULL,
            phone VARCHAR(50) NULL,
            property_id BIGINT UNSIGNED NULL,
            agent_id BIGINT UNSIGNED NULL,
            pixxi_lead_id VARCHAR(191) NULL,
            status VARCHAR(50) NOT NULL DEFAULT 'new',
            created_at DATETIME NOT NULL,
            PRIMARY KEY (id),
            KEY idx_property_id (property_id),
            KEY idx_agent_id (agent_id),
            KEY idx_pixxi_lead_id (pixxi_lead_id)
        ) {$charset};";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    public static function insert_lead(array $leadData): int
    {
        global $wpdb;

        $tableName = $wpdb->prefix . 'cuberealty_leads';

        $result = $wpdb->insert($tableName, [
            'name' => sanitize_text_field($leadData['name'] ?? ''),
            'email' => sanitize_email($leadData['email'] ?? ''),
            'phone' => sanitize_text_field($leadData['phone'] ?? ''),
            'property_id' => isset($leadData['property_id']) ? intval($leadData['property_id']) : null,
            'agent_id' => isset($leadData['agent_id']) ? intval($leadData['agent_id']) : null,
            'pixxi_lead_id' => sanitize_text_field($leadData['pixxi_lead_id'] ?? ''),
            'status' => sanitize_text_field($leadData['status'] ?? 'new'),
            'created_at' => current_time('mysql'),
        ]);

        if ($result === false) {
            return 0;
        }

        return (int) $wpdb->insert_id;
    }
}
