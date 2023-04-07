<?php

namespace App\Http\Controllers;

use App\Models\Users;

class AuthController
{
  public function registration($request)
  {
    $users = new Users();

    if (!$users->getUser($request['login'])) {
      $users->newUser($request['login'], $request['password']);

      return response('Вы успешно зарегистрировались');
    }

    return response('Пользователь с данным логином сущестует', 404);
  }

  public function authorization($request)
  {
    $user = (new Users())->authorization($request['login'], $request['password']);

    if ($user) {
      return response('Вы авторизовались');
    }

    return response('Введен неверный логин или пароль');
  }
}
