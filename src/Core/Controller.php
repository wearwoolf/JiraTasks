<?php

declare(strict_types=1);

namespace JiraTasks\Core;

class Controller
{
    /**
     * @var App
     */
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }
    
    public function getResponse()
    {
        
    }
}
