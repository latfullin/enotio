<?php

namespace App;

use App\Http\HttpKernel;
use App\Service\Route;

class Kernel
{
  protected static $response = null;
  protected static $responseStatus = 200;
  protected $request = null;
  protected $contoller = null;
  protected ?HttpKernel $httpKernel = null;

  public function __construct()
  {
    require_once '../routes/web.php';
  }

  public function handle()
  {
    try {
      $this->init();
    } catch (\Exception $e) {
      $this->error500();
    }
  }

  protected function checkBodyRequest()
  {
    $this->request = $_POST;
  }

  public function init()
  {
    $this->initSeviceClass();
    $this->callBaseService();
    $this->checkBodyRequest();
    $this->executeController();
    $this->callMiddlewares($this->contoller);
    $this->callController($this->contoller);
  }

  protected function initSeviceClass()
  {
    $this->httpKernel = new HttpKernel();
  }

  protected function executeController()
  {
    try {
      $this->contoller = Route::getRoute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    } catch (\Exception $e) {
      $this->error404();
    }
  }

  public function callBaseService()
  {
    foreach ($this->httpKernel->getServices() as $service) {
      new $service();
    }
  }

  private function callController(Route $contoller)
  {
    $response = (new ($contoller->controller[0]))->{$contoller->controller[1]}($this->request);
    $this->response($response);
  }

  public function callMiddlewares(Route $middlewares)
  {
    foreach ($middlewares->middlewares as $middleware) {
      (new ($this->httpKernel->getMiddleware($middleware))())->handle();
    }
  }

  private function error404()
  {
    view('404.php');
  }

  public function error500()
  {
    view('500.php');
  }

  public function response($response)
  {
    if ($response) {
      echo $response;
    }
  }
}
