<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ChromeDriver Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may specify any additional ChromeDriver options that should be
    | passed to ChromeDriver when Dusk starts a new browser session.
    |
    */

    'chrome' => [
        '--disable-gpu',
        '--headless',
        '--window-size=1920,1080',
        '--no-sandbox',
        '--disable-dev-shm-usage',
    ],

    /*
    |--------------------------------------------------------------------------
    | Browser Screenshots
    |--------------------------------------------------------------------------
    |
    | This value determines whether screenshots should be kept after running
    | Dusk commands. You can disable this if you don't need screenshots.
    |
    */

    'screenshots' => false,

    /*
    |--------------------------------------------------------------------------
    | Browser Console Logs
    |--------------------------------------------------------------------------
    |
    | This value determines whether browser console logs should be stored
    | after running Dusk commands. Set this to true for debugging.
    |
    */

    'store_console_logs' => true,
];
