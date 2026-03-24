<?php

return [
    'url' => env('CENTRIFUGO_URL', 'http://localhost:8000'),
    'api_key' => env('CENTRIFUGO_API_KEY'),
    'token_secret' => env('CENTRIFUGO_TOKEN_SECRET'),
    'token_ttl' => (int) env('CENTRIFUGO_TOKEN_TTL', 3600),
];
