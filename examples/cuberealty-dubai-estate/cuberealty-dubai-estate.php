<?php
/**
 * Plugin Name: CubeRealty Dubai Estate
 * Description: Custom enterprise real estate plugin blueprint with Pixxi CRM 2-way sync foundations.
 * Version: 0.1.0
 * Author: CubeRealty
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/includes/class-cuberealty-plugin.php';

CubeRealty_Plugin::boot();
