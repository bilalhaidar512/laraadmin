<?php
/**
 * Plugin Name: RealtyCore Property Listings
 * Plugin URI: https://example.com/realtycore-property-listings
 * Description: Property listings plugin with Elementor widgets, templates, and enquiry handling.
 * Version: 1.0.0
 * Author: RealtyCore
 * Text Domain: realtycore-property-listings
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

define('REALTYCORE_PROPERTY_LISTINGS_VERSION', '1.0.0');
define('REALTYCORE_PROPERTY_LISTINGS_PATH', plugin_dir_path(__FILE__));
define('REALTYCORE_PROPERTY_LISTINGS_URL', plugin_dir_url(__FILE__));

require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'includes/class-realtycore-activator.php';
require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'includes/class-realtycore-deactivator.php';
require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'includes/class-realtycore.php';

register_activation_hook(__FILE__, ['RealtyCore_Activator', 'activate']);
register_deactivation_hook(__FILE__, ['RealtyCore_Deactivator', 'deactivate']);

function run_realtycore_property_listings()
{
    $plugin = new RealtyCore();
    $plugin->run();
}
run_realtycore_property_listings();
