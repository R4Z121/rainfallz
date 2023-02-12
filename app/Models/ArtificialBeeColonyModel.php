<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtificialBeeColonyModel extends Model
{
  public function generateParameters($totalBees)
  {
    $parameters = [];
    for ($i = 1; $i <= $totalBees; $i++) {
      $parameter = $this->generateParameter();
      array_push($parameters, $parameter);
    }
    return $parameters;
  }
  public function generateParameter()
  {
    return [
      "temperature" => $this->generateRandomTemperatureParams(21, 31),
      "humidity" => $this->generateRandomHumidityParams(44, 84),
      "airPressure" => $this->generateRandomAirPressureParams(1002, 1015),
      "windVelocity" => $this->generateRandomWindVelocityParams(2, 5)
    ];
  }
  public function generateNewFoodLocation($oldFoodLocation, $partnerFoodLocation)
  {
    $pie = mt_rand(-100, 100) / 100;
    return $oldFoodLocation + round(($pie * ($oldFoodLocation - $partnerFoodLocation)), 2);
  }
  public function getFitnessValueChance($fitnessValues)
  {
    $chances = [];
    $totalFitnessValue = array_sum($fitnessValues);
    foreach ($fitnessValues as $fitnessValue) {
      $fitnessValueChance = round(($fitnessValue / $totalFitnessValue), 2);
      array_push($chances, $fitnessValueChance);
    }
    return $chances;
  }
  private function generateRandomTemperatureParams($lowerBound, $upperBound)
  {
    $temperatureParameters = [];
    for ($i = 1; $i <= 3; $i++) {
      $randomDecimals = mt_rand(0, 100) / 100;
      $randomTemperatureValue = $lowerBound + ($randomDecimals * ($upperBound - $lowerBound));
      array_push($temperatureParameters, $randomTemperatureValue);
    }
    sort($temperatureParameters);
    return $temperatureParameters;
  }
  private function generateRandomAirPressureParams($lowerBound, $upperBound)
  {
    $airPressureParameters = [];
    for ($i = 1; $i <= 3; $i++) {
      $randomDecimals = mt_rand(0, 100) / 100;
      $randomAirPressureValue = $lowerBound + ($randomDecimals * ($upperBound - $lowerBound));
      array_push($airPressureParameters, $randomAirPressureValue);
    }
    sort($airPressureParameters);
    return $airPressureParameters;
  }
  private function generateRandomHumidityParams($lowerBound, $upperBound)
  {
    $humidityParameters = [];
    for ($i = 1; $i <= 3; $i++) {
      $randomDecimals = mt_rand(0, 100) / 100;
      $randomHumidityValue = $lowerBound + ($randomDecimals * ($upperBound - $lowerBound));
      array_push($humidityParameters, $randomHumidityValue);
    }
    sort($humidityParameters);
    return $humidityParameters;
  }
  private function generateRandomWindVelocityParams($lowerBound, $upperBound)
  {
    $windVelocityParameters = [];
    for ($i = 1; $i <= 3; $i++) {
      $randomDecimals = mt_rand(0, 100) / 100;
      $randomWindVelocityValue = $lowerBound + ($randomDecimals * ($upperBound - $lowerBound));
      array_push($windVelocityParameters, $randomWindVelocityValue);
    }
    sort($windVelocityParameters);
    return $windVelocityParameters;
  }
}
