<?php

return [
    'forms'           => [],
    'sitekey'         => env('RECAPTCHA_SITEKEY', ''),
    'secret'          => env('RCAPTCHA_SECRET', ''),
    'score_threshold' => 0.5,
    'hide_badge'      => false,
];