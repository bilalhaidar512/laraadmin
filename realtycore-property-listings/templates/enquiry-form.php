<?php if (!defined('ABSPATH')) { exit; } ?>
<form class="realtycore-enquiry-form">
    <input type="text" name="name" placeholder="<?php esc_attr_e('Your name', 'realtycore-property-listings'); ?>" required />
    <input type="email" name="email" placeholder="<?php esc_attr_e('Your email', 'realtycore-property-listings'); ?>" required />
    <textarea name="message" placeholder="<?php esc_attr_e('Message', 'realtycore-property-listings'); ?>" required></textarea>
    <button type="submit"><?php esc_html_e('Send Enquiry', 'realtycore-property-listings'); ?></button>
</form>
