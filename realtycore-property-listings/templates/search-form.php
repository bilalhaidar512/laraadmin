<?php if (!defined('ABSPATH')) { exit; } ?>
<form class="realtycore-search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="hidden" name="post_type" value="property" />
    <input type="text" name="s" placeholder="<?php esc_attr_e('Search properties...', 'realtycore-property-listings'); ?>" />
    <button type="submit"><?php esc_html_e('Search', 'realtycore-property-listings'); ?></button>
</form>
