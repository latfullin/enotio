<?php

namespace App\Service;

class Db
{
  protected static ?Db $intance = null;
  protected ?\PDO $connect = null;
  protected ?string $table = null;
  protected $prepare = null;

  public function __construct()
  {
    $dns = 'mysql:dbname=database;host=mysql';
    $user = 'user';
    $password = 'password';
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

  public function prepare($query): self
  {
    $this->prepare = $this->connect->prepare($query);

    return $this;
  }

  public function execute(array $execute)
  {
    $this->prepare->execute($execute);

    return $this;
  }

  public function fetch()
  {
    return $this->prepare->fetch(\PDO::FETCH_ASSOC);
  }

  public function fetchAll()
  {
    return $this->prepare->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function insert(array $values)
  {
    ['column' => $column, 'value' => $value] = $this->splitData($values);

    $this->connect
      ->query("INSERT INTO {$this->table} ({$column}) VALUES ({$value})")
      ->fetch(\PDO::FETCH_ASSOC);
  }

  private function splitData(array $array)
  {
    $result = ['column' => '', 'value' => ''];
    $count = count($array) - 1;
    $i = 0;

    foreach ($array as $key => $item) {
      $result['column'] .= $count === $i ? "`{$key}`" : "`{$key}`,";
      $result['value'] .= $count === $i ? "'{$item}'" : "'{$item}',";
      $i++;
    }

    return $result;
  }
}
