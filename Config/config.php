<?php

return [
    'name' => 'LogDB',
    // Enable logging activity
    'logActivity' => env('LOG_ACTIVITY', true),

    // Specific logging control when logActivity option enabled
    'emergency'   => false,
    'alert'       => false,
    'critical'    => false,
    'error'       => true,
    'warning'     => false,
    'notice'      => false,
    'info'        => false,
    'debug'       => false,
];
