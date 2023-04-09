<?php

namespace App\Http\Controllers;

use App\Models\Currency;

class ViewController
{

  public function authorization()
  {
    return view('authorization.php');
  }

  public function registration()
  {
    return view('registration.php');
  }

  public function dashboard()
  {
    $data = (new Currency())->getAll();

    $currencies = array_map(fn ($e) => ['nominal' => $e->nominal, 'value' => ($e->value / $e->nominal), 'title' => $e->title], $data);

    return view('dashboard.php', ['currencies' => $currencies]);
  }
}
