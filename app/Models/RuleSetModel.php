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
}
