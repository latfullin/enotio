<?php

namespace App\Service;

class Session
{
  protected $session;

  public function __construct()
  {
    session_start();
  }

  public static function set($key, $value): void
  {
    $_SESSION[$key] = $value;
  }

  public static function get($key): string
  {
    return $_SESSION[$key];
  }

  public static function unset(string $key): bool
  {
    if (isset($_SESSION[$key])) {
      unset($_SESSION[$key]);
      return true;
    }

    return false;
  }

  public static function destroy(): bool
  {
    return session_destroy();
  }
}
