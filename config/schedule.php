<?php

return [
    'log_path' => env('SCHEDULE_LOG_PATH'),

    'check_expiration' => [
        'cron' => env('CHECK_EXPIRATION_CRON'),
    ],
];
