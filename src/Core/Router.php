<?php

declare(strict_types=1);

namespace JiraTasks\Core;

class Router
{
    public const CONFIG_KEY = 'routes';
    public const PARAMETER_PREFIX = ':';

    /**
     * @var App
     */
    private $app;

    /**
     * @var Route
     */
    private $route;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function getActiveRoute() : Route
    {
        $this->handle();
        return $this->route;
    }

    private function handle() : void
    {
        /* @var Request $request */
        if ($this->route === null) {
            $request = $this->app->getService(Request::class);
            $path = $request->getPath();
            $routes = $this->getRoutes();
            $this->route = $this->findRoute($path, $routes);
            if ($this->route === null || ! $this->route->isValid()) {
                throw new \RuntimeException(sprintf('Route for path [%s] not found', $path));
            }
        }
    }

    private function getRoutes() : array
    {
        $config = $this->app->getConfig();
        $result = $config[self::CONFIG_KEY] ?? [];
        if (empty($result)) {
            throw new \RuntimeException(sprintf('Please fill [%s] config', self::CONFIG_KEY));
        }
        return $result;
    }

    private function findRoute(string $path, array $routes) : ?Route
    {
        $result = null;
        $controller = '';
        $parameters = [];
        if (isset($routes[$path])) {
            [$controller, $parameters] = $routes[$path];
        } else {
            $pathSegments = $this->removeEmptySegments(explode('/', $path));
            $pathSegmentsCount = count($pathSegments);
            foreach ($routes as $routePath => $routeData) {
                $routeSegments = $this->removeEmptySegments(explode('/', $routePath));
                $routeSegmentsCount = count($routeSegments);
                if ($pathSegmentsCount === $routeSegmentsCount) {
                    $isMatched = true;
                    foreach ($routeSegments as $routeSegmentIndex => $routeSegment) {
                        if ($routeSegment[0] === self::PARAMETER_PREFIX) {
                            $parameterName = str_replace(self::PARAMETER_PREFIX, '', $routeSegment);
                            $parameters[$parameterName] = $pathSegments[$routeSegmentIndex];
                        } elseif ($pathSegments[$routeSegmentIndex] !== $routeSegments[$routeSegmentIndex]) {
                            $isMatched = false;
                            break;
                        }
                    }
                    if ($isMatched) {
                        $controller = $routeData[0];
                        $parameters = array_merge($routeData[1], $parameters);
                        break;
                    }
                }
            }
        }
        if (! empty($controller)) {
            $result = new Route($controller, $parameters);
        }
        return $result;
    }

    private function removeEmptySegments(array $segments) : array
    {
        $result = [];
        foreach ($segments as $segment) {
            if (! empty($segment)) {
                $result[] = $segment;
            }
        }
        return $result;
    }
}
