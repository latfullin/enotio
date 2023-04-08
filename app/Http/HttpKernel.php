<?php

namespace App\Http;

class HttpKernel
{
  protected array $middlewares = [
    'auth' => \App\Http\Middleware\Auth::class,
    'guest' => \App\Http\Middleware\Guest::class,
  ];

  protected array $services = [
    \App\Service\Session::class,
  ];

  public function getMiddleware($key)
  {
    return $this->middlewares[$key];
  }

  public function getServices()
  {
    return $this->services;
  }
}
