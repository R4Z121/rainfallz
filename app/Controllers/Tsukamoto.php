<?php

namespace App\Controllers;

use App\Models\TsukamotoModel;
use App\Models\RuleSetModel;
use App\Models\ClimateModel;

class Tsukamoto extends BaseController
{
  protected $tsukamotoModel;
  protected $climateModel;
  protected $ruleSetModel;

  public function __construct()
  {
    $this->tsukamotoModel = new TsukamotoModel();
    $this->ruleSetModel = new RuleSetModel();
    $this->climateModel = new ClimateModel();
  }

  public function manualForecast()
  {
    $input = $this->request->getPost();
    $forecastingResult = $this->forecast($input);
    $errorRate = $this->getDataErrorRate();
    $data = [
      "title" => "Forecasting Result",
      "input" => $input,
      "errorRate" => $errorRate,
      "finalResult" => $forecastingResult,
      "method" => "FIS Tsukamoto"
    ];
    return view('Pages/result', $data);
  }

  public function datasetForecast()
  {
    $climateData = $this->climateModel->getAllClimateData();
    $actualData = $this->climateModel->getRainfallData();
    $dateData = $this->climateModel->getDateData();
    $forecastingResults = [];
    $apeValues = [];

    foreach ($climateData as $index => $data) {
      $variables = [
        "temperature" => $data["temperature"],
        "airPressure" => $data["air_pressure"],
        "humidity" => $data["humidity"],
        "windVelocity" => $data["wind_velocity"]
      ];
      $forecastResult = $this->forecast($variables);
      $ape = $this->getAPEValue($actualData[$index], $forecastResult);
      array_push($forecastingResults, $forecastResult);
      array_push($apeValues, $ape);
    }

    $mape = $this->tsukamotoModel->meanAbsolutePercentageError($apeValues);

    $data = [
      "title" => "Dataset Forecasting Result | FIS Tsukamoto",
      "date" => $dateData,
      "rainfalls" => $actualData,
      "forecastingResults" => $forecastingResults,
      "ape" => $apeValues,
      "mape" => $mape
    ];
    return view('Pages/datasetForecast', $data);
  }

  public function forecast($input, $parameters = false)
  {
    //Initialize parameters (membership function edge) for each variables
    if (!$parameters) {
      $parameters = [
        "temperature" => [26, 27.5, 29],
        "airPressure" => [1008.5, 1011, 1013],
        "humidity" => [63, 75, 85],
        "windVelocity" => [2, 4, 6.5]
      ];
    }

    //Do fuzzyfication process and get the result
    $fuzzyficationResult = $this->tsukamotoModel->fuzzyfication($input["temperature"], $input["airPressure"], $input["humidity"], $input["windVelocity"], $parameters);
    // echo "Fuzzyfication Result : <br>";
    // d($fuzzyficationResult);

    //Get group that has 0 value from fuzzyfication result
    $zeroValueFuzzyfication = $this->getZeroFuzzyfication($fuzzyficationResult);

    //Get all rule sets that dont have zero value fuzzyfication category
    $ruleSet = $this->ruleSetModel->getSelectedRules($zeroValueFuzzyfication);
    // echo "Selected Rule Sets : <br>";
    // d($ruleSet);

    //Do implication process based on all rule sets
    $inferenceProcessResult = $this->tsukamotoModel->inference($ruleSet, $fuzzyficationResult);
    // echo "Implication Process Result : <br>";
    // d($inferenceProcessResult);

    //Do defuzzyfication process to get the final result
    $finalResult = $this->tsukamotoModel->defuzzyfication($inferenceProcessResult["alpha"], $inferenceProcessResult["z"]);
    // echo "Final Result : <br>";
    // dd($finalResult);
    return $finalResult;
  }

  public function getAPEValue($actualData, $forecastingResult)
  {
    return $this->tsukamotoModel->absolutePercentageError($forecastingResult, $actualData);
  }

  public function getDataErrorRate()
  {
    $climateData = $this->climateModel->getAllClimateData();
    $actualData = $this->climateModel->getRainfallData();
    $forecastingResults = [];

    foreach ($climateData as $data) {
      $variables = [
        "temperature" => $data["temperature"],
        "airPressure" => $data["air_pressure"],
        "humidity" => $data["humidity"],
        "windVelocity" => $data["wind_velocity"]
      ];
      $forecastingResult = $this->forecast($variables);
      array_push($forecastingResults, $forecastingResult);
    }
    return $this->getErrorRate($actualData, $forecastingResults);
  }

  public function getErrorRate($actualData, $forecastingResults)
  {
    return $this->tsukamotoModel->averageForecastingErrorRate($forecastingResults, $actualData);
  }

  public function getZeroFuzzyfication($fuzzyficationResult)
  {
    $zeroValueFuzzyfication = [
      "temperature" => [],
      "air_pressure" => [],
      "humidity" => [],
      "wind_velocity" => [],
    ];
    foreach ($fuzzyficationResult as $variable => $group) {
      if ($variable == 'airPressure') {
        $variable = 'air_pressure';
      } else if ($variable == 'windVelocity') {
        $variable = 'wind_velocity';
      }
      foreach ($group as $category => $value) {
        if ($value == 0) {
          array_push($zeroValueFuzzyfication[$variable], $category);
        }
      }
    }
    return $zeroValueFuzzyfication;
  }
}
