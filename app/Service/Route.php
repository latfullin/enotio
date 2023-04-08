<?php

namespace App\Service;

class Route
{
  private static array $instance = [];
  public array $controller;
  public array $middlewares = [];

  public static function get(string $url, array $controller): self
  {
    return self::instance($url, ['url' => $url, 'controller' => $controller], 'get');
  }


  public static function post(string $url, array $controller): self
  {
    return self::instance($url, ['url' => $url, 'controller' => $controller], 'post');
  }

  private static function instance(string $url, array $controller, string $method)
  {
    if (empty(self::$instance[$method][$url])) {
      self::$instance[$method][$url] = new self($controller);
    }

    return self::$instance[$method][$url];
  }

  public function __construct(array $controller)
  {
    $this->controller = $controller['controller'];
  }

  public function middleware(string|array $middlewares)
  {
    if (is_array($middlewares)) {
      foreach ($middlewares as $middleware) {
        $this->middlewares[] = $middleware;
      }
    }

    if (is_string($middlewares)) {
      $this->middlewares[] = $middlewares;
    }
  }

  public static function getRoute(string $url, string $requestMethod)
  {
    if (isset(self::$instance[strtolower($requestMethod)][$url])) {
      return self::$instance[strtolower($requestMethod)][$url];
    }

    return throw new \Exception("Error Processing Request");
  }
}
