<?php

namespace App;

use App\Service\Route;

class Kernel
{
  public function __construct()
  {
    require_once '../routes/web.php';
  }

  public function handle()
  {
    try {
      $contoller = Route::getRoute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
      $this->callController($contoller);
    } catch (\Exception $e) {
      $this->error();
    }
  }

  private function callController(array $contoller)
  {
    (new ($contoller['controller'][0]))->{$contoller['controller'][1]}();
  }

  private function error()
  {
    view('404.html');
  }
}
