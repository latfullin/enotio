<?php

namespace App\Http\Middleware;

class Guest
{
  public function handle()
  {
    if (isset($_SESSION['auth'])) {
      return header('Location: /dashboard');
    }
    return true;
  }
}
