<?php

namespace App\Models;

class Users extends Model
{

  public function getUser(string $login)
  {
    return $this
      ->prepare("SELECT * FROM {$this->table} WHERE login = :login")
      ->execute(['login' => $login])
      ->fetch();
  }

  public function newUser(string $login, string $password,)
  {
    $this->insert(['login' => $login, 'password' => $password]);
  }

  public function authorization(string $login, string $password)
  {
    return $this
      ->prepare("SELECT * FROM {$this->table} WHERE login = :login AND password = :password")
      ->execute(['login' => $login, 'password' => $password])
      ->fetch();
  }
}
