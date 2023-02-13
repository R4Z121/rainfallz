<?php

namespace App\Models;

use CodeIgniter\Model;

class ForecastingHistoryModel extends Model
{
  protected $table = 'forecasting_history';
  protected $allowedFields = [
    'forecasting_date',
    'method',
    'temperature',
    'air_pressure',
    'humidity',
    'wind_velocity',
    'prediction_result',
    'error_rate'
  ];

  public function getAllHistory()
  {
    return $this->findAll();
  }
}
