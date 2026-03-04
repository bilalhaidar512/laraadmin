<?php
class RealtyCore_Shortcodes
{
    public function register()
    {
        add_shortcode('realtycore_properties', [$this, 'render_properties']);
    }

    public function render_properties($atts)
    {
        $query = new WP_Query([
            'post_type' => 'property',
            'posts_per_page' => isset($atts['limit']) ? (int) $atts['limit'] : 6,
        ]);

        ob_start();
        echo '<div class="realtycore-properties-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            include REALTYCORE_PROPERTY_LISTINGS_PATH . 'templates/content-property-card.php';
        }
        echo '</div>';
        wp_reset_postdata();

        return ob_get_clean();
    }
}
