<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<article <?php post_class('realtycore-property-card'); ?>>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <p><?php echo esc_html(get_post_meta(get_the_ID(), '_realtycore_price', true)); ?></p>
</article>
