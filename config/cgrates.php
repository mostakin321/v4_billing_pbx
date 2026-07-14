<?php

return [
    'url' => env('CGRATES_URL', env('CGRATES_JSONRPC_URL', 'http://127.0.0.1:2080/jsonrpc')),
    'tenant' => env('CGRATES_TENANT', 'cgrates.org'),
    'timeout' => (int) env('CGRATES_TIMEOUT', 5),
    'fail_silently' => (bool) env('CGRATES_FAIL_SILENTLY', true),
];
