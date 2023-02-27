<?php

namespace App\Models;

use CodeIgniter\Model;

class ClimateModel extends Model
{
  protected $table = 'climate';

  public function getAllClimateData()
  {
    return $this->findAll();
  }

  public function getClimateDataVariables($limit = false)
  {
    $db = db_connect();
    $builder = $db->table('climate');
    $dataResults = [];
    if ($limit) {
      $builder->limit($limit);
    }
    $climateData = $builder->get()->getResultArray();
    foreach ($climateData as $data) {
      $variables = [
        "temperature" => $data["temperature"],
        "airPressure" => $data["air_pressure"],
        "humidity" => $data["humidity"],
        "windVelocity" => $data["wind_velocity"]
      ];
      array_push($dataResults, $variables);
    }
    return $dataResults;
  }

  public function getRainfallData()
  {
    return $this->findColumn("rainfall");
  }

  public function getTemperatureData()
  {
    return $this->findColumn("temperature");
  }

  public function getHumidityData()
  {
    return $this->findColumn("humidity");
  }

  public function getAirPressureData()
  {
    return $this->findColumn("air_pressure");
  }

  public function getWindVelocityData()
  {
    return $this->findColumn("wind_velocity");
  }

  public function getDateData()
  {
    return $this->findColumn("period");
  }
}
