<?php
require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'includes/class-realtycore-loader.php';
require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'includes/class-realtycore-post-types.php';
require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'includes/class-realtycore-taxonomies.php';
require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'includes/class-realtycore-meta-boxes.php';
require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'includes/class-realtycore-shortcodes.php';
require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'includes/class-realtycore-elementor.php';
require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'includes/class-realtycore-enquiries.php';
require_once REALTYCORE_PROPERTY_LISTINGS_PATH . 'admin/class-realtycore-admin.php';

class RealtyCore
{
    protected $loader;

    public function __construct()
    {
        $this->loader = new RealtyCore_Loader();
        $this->define_hooks();
    }

    protected function define_hooks()
    {
        $post_types = new RealtyCore_Post_Types();
        $taxonomies = new RealtyCore_Taxonomies();
        $meta_boxes = new RealtyCore_Meta_Boxes();
        $shortcodes = new RealtyCore_Shortcodes();
        $elementor = new RealtyCore_Elementor();
        $enquiries = new RealtyCore_Enquiries();
        $admin = new RealtyCore_Admin();

        $this->loader->add_action('init', $post_types, 'register');
        $this->loader->add_action('init', $taxonomies, 'register');
        $this->loader->add_action('add_meta_boxes', $meta_boxes, 'register');
        $this->loader->add_action('save_post_property', $meta_boxes, 'save');
        $this->loader->add_action('init', $shortcodes, 'register');
        $this->loader->add_action('init', $elementor, 'register_hooks');
        $this->loader->add_action('wp_ajax_realtycore_submit_enquiry', $enquiries, 'handle');
        $this->loader->add_action('wp_ajax_nopriv_realtycore_submit_enquiry', $enquiries, 'handle');
        $this->loader->add_action('admin_enqueue_scripts', $admin, 'enqueue_assets');
    }

    public function run()
    {
        $this->loader->run();
    }
}
