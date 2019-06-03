<?php

declare(strict_types=1);

namespace JiraTasks\Core;

class Db
{
    /**
     * @var App
     */
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }
}
