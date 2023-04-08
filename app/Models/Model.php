<?php

namespace App\Models;

use App\Service\Db;

abstract class Model
{
  protected string $table;

  protected array $columns = ['id', 'created_at', 'update_at'];

  protected $data;

  protected array $collection = [];

  protected string $query;

  public function __construct(array $data = [])
  {
    $this->getModelName();

    foreach ($this->columns as $column) {
      if (isset($data[$column])) {
        $this->__set($column, $data[$column]);
      }
    }
  }

  // public static function find($id)
  public  function find(array $data)
  {
    $this->data = Db::getInstance()
      ->prepare("SELECT * FROM {$this->table}  WHERE id = :id")
      ->execute($data)
      ->fetch();

    return $this;
  }

  public function __get($name)
  {
    return $this->collection[$name];
  }

  public function __set($name, $value)
  {
    $this->collection[$name] = $value;
  }

  public function get()
  {
    if ($this->data) {
      return new static($this->data);
    }

    return false;
  }

  private function getModelName()
  {
    if (empty($this->table)) {
      $this->table = strtolower((new \ReflectionClass($this))->getShortName());
    }
  }

  protected function prepare(string $query): self
  {
    $this->query = $query;

    return $this;
  }

  protected function execute(array $execute): self
  {
    $this->execute = $execute;

    return $this;
  }

  public function fetch()
  {
    $this->data = Db::getInstance()
      ->prepare($this->query)
      ->execute($this->execute)
      ->fetch();

    return $this->get();
  }

  public function insert(array $data): bool
  {
    Db::getInstance()->insert($data);

    return true;
  }
}
