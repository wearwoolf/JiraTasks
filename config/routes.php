<?php

declare(strict_types=1);

use \JiraTasks\App\Controllers;
use \JiraTasks\Core\Route;

return [
    '/' => [Controllers\Index::class, [Route::ACTION_KEY => 'index']],
    '/tasks' => [Controllers\Tasks::class, [Route::ACTION_KEY => 'index']],
    '/tasks/add' => [Controllers\Tasks::class, [Route::ACTION_KEY => 'add']],
    '/tasks/edit/:id' => [Controllers\Tasks::class, [Route::ACTION_KEY => 'edit']],
];