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
}
