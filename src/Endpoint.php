<?php

namespace Fabstract\Component\Http;

use Fabstract\Component\Http\Constant\HttpMethods;
use Fabstract\Component\Router\RouteAwareInterface;

class Endpoint extends Injectable implements RouteAwareInterface
{
    /** @var string */
    private $route = null;
    /**
     * @var Action[]
     */
    private $method_action_lookup = [];

    protected function __construct($route)
    {
        Assert::isNotNullOrWhiteSpace($route, 'route');
        $this->route = $route;
    }

    /**
     * @param string $route
     * @return $this
     */
    public static function create($route)
    {
        return new static($route);
    }

    /**
     * @param Action|string|callable $action
     * @return $this
     */
    public function addPOST($action)
    {
        return $this->addAction(HttpMethods::POST, $action);
    }

    /**
     * @param Action|string|callable $action
     * @return $this
     */
    public function addGET($action)
    {
        return $this->addAction(HttpMethods::GET, $action);
    }

    /**
     * @param Action|string|callable $action
     * @return $this
     */
    public function addPUT($action)
    {
        return $this->addAction(HttpMethods::PUT, $action);
    }

    /**
     * @param Action|string|callable $action
     * @return $this
     */
    public function addHEAD($action)
    {
        return $this->addAction(HttpMethods::HEAD, $action);
    }

    /**
     * @param Action|string|callable $action
     * @return $this
     */
    public function addPATCH($action)
    {
        return $this->addAction(HttpMethods::PATCH, $action);
    }

    /**
     * @param Action|string|callable $action
     * @return $this
     */
    public function addOPTIONS($action)
    {
        return $this->addAction(HttpMethods::OPTIONS, $action);
    }

    /**
     * @param Action|string|callable $action
     * @return $this
     */
    public function addDELETE($action)
    {
        return $this->addAction(HttpMethods::DELETE, $action);
    }

    /**
     * @param string $http_method
     * @param Action|string|callable $action
     * @return $this
     */
    public function addAction($http_method, $action)
    {
        if (is_string($action)) {
            Assert::isNotNullOrWhiteSpace($action, 'action');
            $action = Action::create($this, $action);
        } elseif (is_callable($action)) {
            $action = Action::create($this, $action);
        }

        Assert::isType($action, Action::class, 'action');
        $http_method = strtoupper($http_method);

        $this->method_action_lookup[$http_method] = $action;
        return $this;
    }

    /**
     * @param string $http_method
     * @return Action|null
     */
    public function getAction($http_method)
    {
        $http_method = strtoupper($http_method);
        if (array_key_exists($http_method, $this->method_action_lookup) === true) {
            return $this->method_action_lookup[$http_method];
        }
        return null;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }
}
