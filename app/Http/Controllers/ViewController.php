<?php

namespace App\Http\Controllers;

class ViewController
{

  public function authorization()
  {
    return view('authorization.html');
  }

  public function registration()
  {
    return view('registration.html');
  }

  public function dashboard()
  {
    return view('test.php', ['items' => [1, 2, 3, 4, 5]]);
  }
}
