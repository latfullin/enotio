<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Request\RegistrationRequest;
use App\Service\Session;

class AuthController
{
  public function registration($request)
  {
    $user = new User();

    if ($user->getUser($request['login'])) {
      return response(['error' => ['login' => 'Логин занят']]);
    }
    $validate = new RegistrationRequest($request);

    if (!$validate->validateFields()) {
      return response($validate->getErrors());
    }

    $user->newUser($request['login'], $request['password']);

    return response(['success' => 'Вы успешно зарегистрировались']);
  }

  public function authorization($request)
  {
    $user = (new User())->authorization($request['login'], $request['password']);

    if ($user) {
      Session::set('auth', true);
      return response(['success' => 'ok']);
    }

    return response(['error' => 'Введен неверный логин или пароль']);
  }

  public function logout()
  {
    Session::destroy();

    return response('Ok');
  }
}
