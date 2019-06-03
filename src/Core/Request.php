<?php

declare(strict_types=1);

namespace JiraTasks\Core;

class Request
{
    public const DEFAULT_PATH = '/';

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $requestParameters;

    public function __construct(App $app)
    {
        $this->host = $this->getHost();
        $this->uri = $this->getUri();
        $this->path = $this->getPath();
        $this->method = $this->getRequestMethod();
        $this->requestParameters = $this->getRequestParameters();
    }

    public function getHost() : string
    {
        return $this->host ?? $_SERVER['SERVER_NAME'] ?? '';
    }

    public function getUri() : string
    {
        if (empty($this->uri)) {
            $this->uri = empty($_SERVER['REQUEST_URI']) ? self::DEFAULT_PATH : $_SERVER['REQUEST_URI'];
        }
        return $this->uri;
    }

    public function getPath() : string
    {
        $uriParts = parse_url($this->getUri());
        return empty($uriParts['path']) ? self::DEFAULT_PATH : $uriParts['path'];
    }

    public function getRequestMethod() : string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getRequestParameters() : array
    {
        return $_REQUEST;
    }
}
