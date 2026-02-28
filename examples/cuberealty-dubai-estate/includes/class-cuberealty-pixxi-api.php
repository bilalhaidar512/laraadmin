<?php

if (!defined('ABSPATH')) {
    exit;
}

class CubeRealty_Pixxi_API
{
    private string $apiUrl;
    private string $apiKey;

    public function __construct()
    {
        $settings = CubeRealty_Settings::get_settings();
        $this->apiUrl = rtrim($settings['base_url'] ?? '', '/');
        $this->apiKey = $settings['api_key'] ?? '';
    }

    public function request(string $endpoint, string $method = 'GET', array $body = []): ?array
    {
        if (!$this->apiUrl || !$this->apiKey) {
            return null;
        }

        $response = wp_remote_request($this->apiUrl . $endpoint, [
            'method' => strtoupper($method),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'body' => !empty($body) ? wp_json_encode($body) : null,
            'timeout' => 20,
        ]);

        if (is_wp_error($response)) {
            error_log('CubeRealty Pixxi API error: ' . $response->get_error_message());
            return null;
        }

        $statusCode = wp_remote_retrieve_response_code($response);
        $rawBody = wp_remote_retrieve_body($response);

        if ($statusCode < 200 || $statusCode > 299) {
            error_log('CubeRealty Pixxi API non-success status: ' . $statusCode . ' body: ' . $rawBody);
            return null;
        }

        $parsed = json_decode($rawBody, true);

        return is_array($parsed) ? $parsed : null;
    }

    public function push_lead(array $lead): ?array
    {
        return $this->request('/leads', 'POST', $lead);
    }
}
