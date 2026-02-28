# CubeRealty Dubai Estate (Starter Blueprint)

This folder contains a **starter structure** for a custom WordPress plugin tailored for Dubai real estate teams that need a Pixxi CRM 2-way sync foundation.

## Included foundations

- Property custom post type (`cuberealty_property`)
- Dubai-focused taxonomies (type, status, emirate, area, developer, community)
- Admin settings page for Pixxi credentials
- Pixxi API client wrapper
- Webhook endpoint (`/wp-json/cuberealty/v1/pixxi-webhook`) with HMAC verification
- Leads table bootstrap (`wp_cuberealty_leads`)
- 15-minute cron sync hook for importing properties

## Key files

- `cuberealty-dubai-estate.php`: plugin bootstrap
- `includes/class-cuberealty-plugin.php`: CPT/taxonomies/sync orchestration
- `includes/class-cuberealty-settings.php`: settings registration and sanitization
- `includes/class-cuberealty-pixxi-api.php`: authenticated HTTP layer
- `includes/class-cuberealty-webhooks.php`: secure webhook listener
- `includes/class-cuberealty-leads-repository.php`: lead storage table and inserts

## Next implementation phases

1. Add Elementor widgets (grid/search/carousel/lead form/mortgage calculator).
2. Implement full lead submission pipeline with retries and notifications.
3. Expand field mapping profiles for Pixxi-to-WordPress transformations.
4. Add sync logging and observability dashboard in wp-admin.
5. Add permission/rate-limit middleware for webhook abuse protection.
