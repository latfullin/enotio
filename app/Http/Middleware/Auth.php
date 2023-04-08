<?php

namespace App\Http\Middleware;

class Auth
{
  public function handle()
  {
    if ($_SESSION['auth'] ?? false) {
      return true;
    }
    return header('Location: /');
  }
}
