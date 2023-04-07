<?php

namespace App\Service;

class Route
{
  private static array $get = [];
  private static array $post = [];

  public static function get(string $url, array $controller): void
  {
    self::$get[$url] = ['url' => $url, 'controller' => $controller];
  }

  public static function getRoute(string $url, string $requestMethod)
  {
    if (isset(self::${strtolower($requestMethod)}[$url])) {
      return self::$get[$url];
    }

    return throw new \Exception("Error Processing Request", 1);
  }
}
