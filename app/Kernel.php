<?php

namespace App;

use App\Service\Route;

class Kernel
{
  protected static $response = null;
  protected static $responseStatus = 200;
  protected $request = null;
  protected $contoller = null;

  public function __construct()
  {
    require_once '../routes/web.php';
  }

  public function handle()
  {
    $this->checkBodyRequest();
    $this->executeController();
    $this->callController($this->contoller);
  }

  protected function checkBodyRequest()
  {
    $this->request = $_POST;
  }

  protected function executeController()
  {
    try {
      $this->contoller = Route::getRoute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    } catch (\Exception $e) {
      $this->error();
    }
  }

  private function callController(array $contoller)
  {
    $response = (new ($contoller['controller'][0]))->{$contoller['controller'][1]}($this->request);
    $this->response($response);
  }

  private function error()
  {
    view('404.html');
  }

  public function response($response)
  {
    if ($response) {
      echo $response;
    }
  }
}
