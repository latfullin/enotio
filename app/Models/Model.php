<?php

namespace App\Models;

class Model
{
  protected static ?Model $intance = null;
  protected ?\PDO $connect = null;
  protected ?string $table = null;

  protected function __construct()
  {
    $dns = 'mysql:dbname=database;host=mysql';
    $user = 'user';
    $password = 'password';
    $this->table = (new \ReflectionClass($this))->getShortName();
    $this->connect = new \PDO($dns, $user, $password);
  }

  public static function getInstance()
  {
    if (is_null(self::$intance)) {
      self::$intance = new self();
    }

    return self::$intance;
  }

  protected function __clone()
  {
  }
}
