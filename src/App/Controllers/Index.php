<?php

declare(strict_types=1);

namespace JiraTasks\App\Controllers;

use JiraTasks\Core\Controller;

class Index extends Controller
{
    public function indexAction()
    {
        echo self::class . ' ' . __FUNCTION__;
    }
}
