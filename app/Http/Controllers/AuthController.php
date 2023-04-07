<?php

namespace App\Http\Controllers;

use App\Models\Users;

class AuthController
{
  public function registration($request)
  {
    $users = new Users();

    if (!$users->getUser($request['login'])) {
      return $users->newUser($request['login'], $request['password']);
    }

    return response('Пользователь с данным логином сущестует');
  }
}
