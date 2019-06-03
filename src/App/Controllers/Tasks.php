<?php

declare(strict_types=1);

namespace JiraTasks\App\Controllers;

use JiraTasks\Core\Controller;
use JiraTasks\Core\View;

class Tasks extends Controller
{
    public function indexAction()
    {

        return $this->app->getService(View::class)->render('tasks/tasks', ['var1' => 1]);
    }

    public function addAction()
    {
        echo self::class . ' ' . __FUNCTION__;
    }

    public function editAction()
    {
        echo self::class . ' ' . __FUNCTION__;
    }
}
