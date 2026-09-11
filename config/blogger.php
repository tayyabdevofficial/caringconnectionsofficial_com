<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Blogger Admin API Base URL
    |--------------------------------------------------------------------------
    | The root endpoint for the backend API v1 (e.g. http://127.0.0.1:8000/api/v1)
    */
    'api_url' => rtrim(env('BLOGGER_API_URL', 'http://127.0.0.1:8000/api/v1'), '/'),

    /*
    |--------------------------------------------------------------------------
    | Website Authentication Credentials
    |--------------------------------------------------------------------------
    | Dedicated API Key and Secret for HMAC-SHA256 handshake verification.
    */
    'api_key' => env('BLOGGER_API_KEY', ''),
    'api_secret' => env('BLOGGER_API_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Registered Client Domain
    |--------------------------------------------------------------------------
    */
    'client_domain' => env('BLOGGER_CLIENT_DOMAIN', 'caringconnectionsofficial.com'),

    /*
    |--------------------------------------------------------------------------
    | HTTP Client Settings
    |--------------------------------------------------------------------------
    */
    'timeout' => (int) env('BLOGGER_API_TIMEOUT', 10),
    'connect_timeout' => (int) env('BLOGGER_API_CONNECT_TIMEOUT', 5),

    /*
    |--------------------------------------------------------------------------
    | Data Caching Strategy
    |--------------------------------------------------------------------------
    */
    'cache_enabled' => (bool) env('BLOGGER_CACHE_ENABLED', true),
    'cache_ttl' => (int) env('BLOGGER_CACHE_TTL', 120), // seconds
    'categories_cache_ttl' => (int) env('BLOGGER_CATEGORIES_CACHE_TTL', 300),

    /*
    |--------------------------------------------------------------------------
    | Media Proxy Settings
    |--------------------------------------------------------------------------
    */
    'media_cache_disk' => env('BLOGGER_MEDIA_DISK', 'local'),
];
