<?php

namespace App\Models;

use CodeIgniter\Model;

class RuleSetModel extends Model
{
  protected $table = 'rule';

  public function getAllRule()
  {
    return $this->findAll();
  }
  public function getSelectedRules($zeroValueFuzzyfication)
  {
    $db = db_connect();
    $builder = $db->table('rule');

    foreach ($zeroValueFuzzyfication as $variable => $categories) {
      $builder->whereNotIn($variable, $categories);
    }
    $query = $builder->get()->getResultArray();
    return $query;
  }
}
