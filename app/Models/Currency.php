<?php

namespace App\Models;

class Currency extends Model
{
  protected string $table = 'currencies';

  protected array $columns = [
    'course_id',
    'num_code',
    'char_code',
    'nominal',
    'title',
    'value'
  ];

  public function getCurrency(string $num_code): static|bool
  {
    return $this
      ->prepare("SELECT * FROM {$this->table} WHERE num_code = :num_code")
      ->execute(['num_code' => $num_code])
      ->fetch();
  }

  public function insertCurrency(array $currency)
  {
    return $this->insert($currency);
  }


  public function update(object $data)
  {
    return $this
      ->prepare("UPDATE {$this->table} SET value = :value WHERE num_code = :num_code")
      ->execute(['value' => $data->Value, 'num_code' => $data->NumCode])
      ->fetch();
  }

  public function getAll()
  {
    return $this
      ->prepare("SELECT * FROM {$this->table}")
      ->fetchAll();
  }
}
