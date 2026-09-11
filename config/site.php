<?php

return [
    /*
    |--------------------------------------------------------------------------
    | White-Label Site Brand & Identity
    |--------------------------------------------------------------------------
    */
    'name' => env('SITE_NAME', 'Caring Connections'),
    'tagline' => env('SITE_TAGLINE', 'The Empathy, Wellness & Community Collective'),
    'domain' => env('SITE_DOMAIN', 'caringconnectionsofficial.com'),
    'url' => env('APP_URL', 'http://localhost:8002'),

    'description' => env('SITE_DESCRIPTION', 'Discover uplifting stories, caregiving resources, mental wellbeing advice, and heartwarming community support on Caring Connections.'),
    'keywords' => 'caring connections, wellness, caregiving, empathy, mental health, senior care, community support, kindness',

    /*
    |--------------------------------------------------------------------------
    | Brand Visual Identity & Logos
    |--------------------------------------------------------------------------
    */
    'logo' => '/logo.png',
    'logo_sm' => '/logo-sm.png',
    'logo_dark' => '/logo.png',
    'favicon' => '/favicon.ico',

    /*
    |--------------------------------------------------------------------------
    | Theme & Palette Tokens
    |--------------------------------------------------------------------------
    */
    'theme_storage_key' => 'cc_theme',
    'primary_color' => '#281858',
    'accent_color' => '#8b5cf6',
    'rose_color' => '#f472b6',

    /*
    |--------------------------------------------------------------------------
    | Communication & Legal Details
    |--------------------------------------------------------------------------
    */
    'support_email' => env('SITE_SUPPORT_EMAIL', 'support@caringconnectionsofficial.com'),
    'copyright_year' => date('Y'),

    'social' => [
        'facebook' => 'https://facebook.com/caringconnections',
        'twitter' => 'https://twitter.com/caringconnect',
        'instagram' => 'https://instagram.com/caringconnectionsofficial',
        'youtube' => 'https://youtube.com/@caringconnections',
    ],
];
