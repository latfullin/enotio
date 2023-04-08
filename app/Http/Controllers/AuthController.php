<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\Session;

class AuthController
{
  public function registration($request)
  {
    $users = new User();

    if (!$users->getUser($request['login'])) {
      $users->newUser($request['login'], $request['password']);

      return response('Вы успешно зарегистрировались');
    }

    return response('Пользователь с данным логином сущестует', 404);
  }

  public function authorization($request)
  {
    $user = (new User())->authorization($request['login'], $request['password']);

    if ($user) {
      Session::set('auth', true);
      return response('Вы авторизовались');
    }

    return response('Введен неверный логин или пароль');
  }

  public function logout()
  {
    Session::destroy();
  }
}
