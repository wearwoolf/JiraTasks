<?php

declare(strict_types=1);

namespace JiraTasks\Core;

class Route
{
    public const ACTION_KEY = 'action';
    public const ACTION_SUFFIX = 'Action';

    /**
     * @var string
     */
    private $controller;

    /**
     * @var array
     */
    private $parameters;

    public function __construct(string $controller, array $parameters = [])
    {
        $this->controller = $controller;
        $this->parameters = $parameters;
    }

    public function getController() : string
    {
        return $this->controller;
    }

    public function getAction() : ?string
    {
        $action = $this->getParameter(self::ACTION_KEY);
        return $action ? $action . self::ACTION_KEY : $action;
    }

    public function getParameters() : array
    {
        return $this->parameters;
    }

    public function getParameter(string $name, $default = null)
    {
        return $this->getParameters()[$name] ?? $default;
    }

    public function isValid() : bool
    {
        $result = true;
        if (empty($this->getController()) || empty($this->getAction())) {
            $result = false;
        }
        return $result;
    }
}
