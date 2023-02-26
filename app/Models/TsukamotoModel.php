<?php

namespace App\Models;

use CodeIgniter\Model;

class TsukamotoModel extends Model
{

  public function fuzzyfication($temperature, $airPressure, $humidity, $windVelocity, $parameters)
  {
    $temperatureParameters = array(
      "cold" => $parameters["temperature"][0],
      "warm" => $parameters["temperature"][1],
      "hot" => $parameters["temperature"][2]
    );
    $airPressureParameters = array(
      "low" => $parameters["airPressure"][0],
      "medium" => $parameters["airPressure"][1],
      "high" => $parameters["airPressure"][2]
    );
    $humidityParameters = array(
      "dry" => $parameters["humidity"][0],
      "wet" => $parameters["humidity"][1],
      "moist" => $parameters["humidity"][2]
    );
    $windVelocityParameters = array(
      "calm" => $parameters["windVelocity"][0],
      "strong" => $parameters["windVelocity"][1],
      "veryStrong" => $parameters["windVelocity"][2]
    );
    $temperatureFuzzyficationValue = $this->temperatureFuzzyfication($temperature, $temperatureParameters);
    $airPressureFuzzyficationValue = $this->airPressureFuzzyfication($airPressure, $airPressureParameters);
    $humidityFuzzyficationValue = $this->humidityFuzzyfication($humidity, $humidityParameters);
    $windVelocityFuzzyficationValue = $this->windVelocityFuzzyfication($windVelocity, $windVelocityParameters);

    return array(
      "temperature" => $temperatureFuzzyficationValue,
      "airPressure" => $airPressureFuzzyficationValue,
      "humidity" => $humidityFuzzyficationValue,
      "windVelocity" => $windVelocityFuzzyficationValue
    );
  }

  public function inference($ruleSet, $fuzzyficationResult)
  {
    $z = [];
    $alpha = [];
    foreach ($ruleSet as $rule) {
      $temperatureFuzzyfication = $fuzzyficationResult["temperature"][$rule["temperature"]];
      $humidityFuzzyfication = $fuzzyficationResult["humidity"][$rule["humidity"]];
      $airPressureFuzzyfication = $fuzzyficationResult["airPressure"][$rule["air_pressure"]];
      $windVelocityFuzzyfication = $fuzzyficationResult["windVelocity"][$rule["wind_velocity"]];
      $minValue = min($temperatureFuzzyfication, $humidityFuzzyfication, $airPressureFuzzyfication, $windVelocityFuzzyfication);
      array_push($alpha, $minValue);
      array_push($z, $this->rainfallFuzzyficattion($minValue, $rule["rainfall"]));
    }
    return array(
      "z" => $z,
      "alpha" => $alpha
    );
  }

  public function defuzzyfication($alpha, $z)
  {
    $alphaZ = 0;
    $totalAlpha = 0;
    for ($i = 0; $i < count($alpha); $i++) {
      $alphaZ += ($alpha[$i] * $z[$i]);
      $totalAlpha += $alpha[$i];
    }
    return round(($alphaZ / $totalAlpha), 2);
  }

  public function absolutePercentageError($forecastingResult, $actualData)
  {
    return round((abs($actualData - $forecastingResult) / $actualData), 2) * 100;
  }

  public function meanAbsolutePercentageError($forecastingResults, $actualData)
  {
    $result = 0;
    for ($i = 0; $i < count($forecastingResults); $i++) {
      $difference = round((abs($actualData[$i] - $forecastingResults[$i]) / $actualData[$i]), 2);
      $result += $difference;
    }
    $result = round(($result / count($actualData)), 2) * 100;
    return $result;
  }

  public function getMAPEResult($apeValues)
  {
    return round((array_sum($apeValues) / count($apeValues)), 2);
  }

  private function temperatureFuzzyfication($temperature, $parameters)
  {
    $coldFuzzyfication = $warmFuzzyfication = $hotFuzzyfication = 0;

    if ($temperature <= $parameters["cold"]) {
      $coldFuzzyfication = 1;
    } else if ($temperature <= $parameters["warm"]) {
      $coldFuzzyfication = round(($parameters["warm"] - $temperature) / ($parameters["warm"] - $parameters["cold"]), 2);
      $warmFuzzyfication = round(($temperature - $parameters["cold"]) / ($parameters["warm"] - $parameters["cold"]), 2);
    } else if ($temperature <= $parameters["hot"]) {
      $warmFuzzyfication = round(($parameters["hot"] - $temperature) / ($parameters["hot"] - $parameters["warm"]), 2);
      $hotFuzzyfication = round(($temperature - $parameters["warm"]) / ($parameters["hot"] - $parameters["warm"]), 2);
    } else {
      $hotFuzzyfication = 1;
    }

    return array(
      "cold" => $coldFuzzyfication,
      "warm" => $warmFuzzyfication,
      "hot" => $hotFuzzyfication
    );
  }

  private function airPressureFuzzyfication($airPressure, $parameters)
  {
    $lowFuzzyfication = $mediumFuzzyfication = $highFuzzyfication = 0;

    if ($airPressure <= $parameters["low"]) {
      $lowFuzzyfication = 1;
    } else if ($airPressure <= $parameters["medium"]) {
      $lowFuzzyfication = round(($parameters["medium"] - $airPressure) / ($parameters["medium"] - $parameters["low"]), 2);
      $mediumFuzzyfication = round(($airPressure - $parameters["low"]) / ($parameters["medium"] - $parameters["low"]), 2);
    } else if ($airPressure <= $parameters["high"]) {
      $mediumFuzzyfication = round(($parameters["high"] - $airPressure) / ($parameters["high"] - $parameters["medium"]), 2);
      $highFuzzyfication = round(($airPressure - $parameters["medium"]) / ($parameters["high"] - $parameters["medium"]), 2);
    } else {
      $highFuzzyfication = 1;
    }

    return array(
      "low" => $lowFuzzyfication,
      "medium" => $mediumFuzzyfication,
      "high" => $highFuzzyfication
    );
  }

  private function humidityFuzzyfication($humidity, $parameters)
  {
    $dryFuzzyfication = $wetFuzzyfication = $moistFuzzyfication = 0;

    if ($humidity <= $parameters["dry"]) {
      $dryFuzzyfication = 1;
    } else if ($humidity <= $parameters["wet"]) {
      $dryFuzzyfication = round(($parameters["wet"] - $humidity) / ($parameters["wet"] - $parameters["dry"]), 2);
      $wetFuzzyfication = round(($humidity - $parameters["dry"]) / ($parameters["wet"] - $parameters["dry"]), 2);
    } else if ($humidity <= $parameters["moist"]) {
      $wetFuzzyfication = round(($parameters["moist"] - $humidity) / ($parameters["moist"] - $parameters["wet"]), 2);
      $moistFuzzyfication = round(($humidity - $parameters["wet"]) / ($parameters["moist"] - $parameters["wet"]), 2);
    } else {
      $moistFuzzyfication = 1;
    }

    return array(
      "dry" => $dryFuzzyfication,
      "wet" => $wetFuzzyfication,
      "moist" => $moistFuzzyfication
    );
  }

  private function windVelocityFuzzyfication($windVelocity, $parameters)
  {
    $calmFuzzyfication = $strongFuzzyfication = $veryStrongFuzzyfication = 0;

    if ($windVelocity <= $parameters["calm"]) {
      $calmFuzzyfication = 1;
    } else if ($windVelocity <= $parameters["strong"]) {
      $calmFuzzyfication = round(($parameters["strong"] - $windVelocity) / ($parameters["strong"] - $parameters["calm"]), 2);
      $strongFuzzyfication = round(($windVelocity - $parameters["calm"]) / ($parameters["strong"] - $parameters["calm"]), 2);
    } else if ($windVelocity <= $parameters["veryStrong"]) {
      $strongFuzzyfication = round(($parameters["veryStrong"] - $windVelocity) / ($parameters["veryStrong"] - $parameters["strong"]), 2);
      $veryStrongFuzzyfication = round(($windVelocity - $parameters["strong"]) / ($parameters["veryStrong"] - $parameters["strong"]), 2);
    } else {
      $veryStrongFuzzyfication = 1;
    }

    return array(
      "calm" => $calmFuzzyfication,
      "strong" => $strongFuzzyfication,
      "veryStrong" => $veryStrongFuzzyfication
    );
  }

  private function rainfallFuzzyficattion($alpha, $group)
  {
    $z = 0;
    if ($group == "sunny") {
      if ($alpha == 0) {
        $z = 105;
      } else if ($alpha < 1) {
        $z = 105 - ($alpha * 10);
      } else {
        $z = 95;
      }
    } else if ($group == "cloudy") {
      if ($alpha == 0) {
        $z = 305;
      } else if ($alpha < 1) {
        $z = (200 * $alpha) + 95;
      } else {
        $z = 295;
      }
    } else if ($group == "light rain") {
      if ($alpha == 0) {
        $z = 405;
      } else if ($alpha < 1) {
        $z = (100 * $alpha) + 295;
      } else {
        $z = 395;
      }
    } else if ($group == "rain") {
      if ($alpha == 0) {
        $z = 395;
      } else if ($alpha < 1) {
        $z = (105 * $alpha) + 395;
      } else {
        $z = 500;
      }
    }
    return $z;
  }
}
