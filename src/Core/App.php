<?php

declare(strict_types=1);

namespace JiraTasks\Core;

use function defined;
use function file_exists;
use function is_readable;
use function sprintf;

class App
{
    private const CONFIG_PATH = 'config' . DS;
    private const CONFIG_DEFAULT_NAME = 'default';

    /**
     * @var null|array
     */
    private $config;

    /**
     * @var null|array
     */
    private $services;

    private function __construct(array $config)
    {
        $this->config = $config;
    }

    public static function init() : self
    {
        $config = [];
        if (!defined('ROOT_PATH')) {
            throw new \RuntimeException('Please define ROOT_PATH of site');
        }
        $configFile = ROOT_PATH . DS . self::CONFIG_PATH . self::CONFIG_DEFAULT_NAME . '.php';
        if (file_exists($configFile) and is_readable($configFile)) {
            $config = include $configFile;
        }
        if (empty($config)) {
            throw new \RuntimeException(sprintf('Please create and fill configuration file %s', $configFile));
        }

        return new self($config);
    }

    public function bootstrap() : void
    {
        /* @var Router $router */
        $router = $this->getService(Router::class);
        $route = $router->getActiveRoute();
        $controller = $route->getController();
        $action = $route->getAction();
        $controllerObject = new $controller($this);
        $controllerObject->$action();
        //$result = $controllerObject->$action();
        //$controllerObject->getResponce();
    }

    public function getService(string $service) : ?object
    {
        return $this->services[$service] ?? new $service($this);
    }

    public function getConfig() : array
    {
        return $this->config ?? [];
    }
}
