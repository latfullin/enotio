<?php

namespace App\Models;

class Users extends Model
{

  public function getUser(string $login)
  {
    $prepare = $this->connect
      ->prepare("SELECT * FROM {$this->table} WHERE login = :login");

    $prepare->execute(['login' => $login]);

    return $prepare->fetch(\PDO::FETCH_ASSOC);
  }

  public function newUser(string $login, string $password,)
  {
    $this->insert(['login' => $login, 'password' => $password]);
  }
}
