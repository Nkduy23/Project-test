<?php

use App\Controllers\HomeController;
use App\Controllers\ContactController;

return [
    '/' => [HomeController::class, 'index'],
    '/contact' => [ContactController::class, 'show']
];
