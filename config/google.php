<?php

return [
    'application_name' => env('GOOGLE_APP_NAME'),
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'spreadsheet_id' => env('GOOGLE_SPREADSHEET_ID'),
    'access_token' => null,
    'refresh_token' => null,
    'scopes' => [
        'https://www.googleapis.com/auth/spreadsheets',
        'https://www.googleapis.com/auth/drive.file',
    ],
    'service_account_credentials_json' => storage_path('app/google/apikey.json'),
];
