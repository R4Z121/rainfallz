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
  protected $defaultParameters;
  protected $rainfallData;

  public function __construct()
  {
    $this->tsukamotoModel = new TsukamotoModel();
    $this->ruleSetModel = new RuleSetModel();
    $this->climateModel = new ClimateModel();
    $this->defaultParameters = [
      "temperature" => [26, 27.5, 29],
      "airPressure" => [1008.5, 1011, 1013],
      "humidity" => [63, 75, 85],
      "windVelocity" => [2, 4, 6.5]
    ];
    $this->rainfallData = $this->climateModel->getRainfallData();
  }

  public function manualForecast()
  {
    $request = \Config\Services::request();
    if ($request->isAJAX()) {
      $input = $request->getVar('input');
      $parameters = $request->getVar('parameters');
      $finalResult = $this->forecast($input, $parameters);
      return json_encode($finalResult);
    }
  }

  public function viewDatasetForecast()
  {
    $dateData = $this->climateModel->getDateData();
    $datasetForecastingResults = $this->datasetForecast();
    $data = [
      "title" => "Dataset Forecasting Result | FIS Tsukamoto",
      "date" => $dateData,
      "rainfalls" => $this->rainfallData,
      "forecastingResults" => $datasetForecastingResults["forecastingResults"],
      "ape" => $datasetForecastingResults["apeValues"],
      "mape" => $datasetForecastingResults["mape"]
    ];
    return view('Pages/datasetForecast', $data);
  }

  public function datasetForecast($parameters = false)
  {
    $climateData = $this->climateModel->getAllClimateData();

    $forecastingResults = [];
    $apeValues = [];
    $usedParameters = $this->defaultParameters;
    if ($parameters) {
      $usedParameters = $parameters;
    }

    foreach ($climateData as $index => $data) {
      $variables = [
        "temperature" => $data["temperature"],
        "airPressure" => $data["air_pressure"],
        "humidity" => $data["humidity"],
        "windVelocity" => $data["wind_velocity"]
      ];
      $forecastResult = $this->forecast($variables, $usedParameters);
      $ape = $this->getAPEValue($this->rainfallData[$index], $forecastResult);
      array_push($forecastingResults, $forecastResult);
      array_push($apeValues, $ape);
    }

    $mape = $this->tsukamotoModel->meanAbsolutePercentageError($apeValues);

    return [
      "forecastingResults" => $forecastingResults,
      "apeValues" => $apeValues,
      "mape" => $mape
    ];
  }

  public function forecast($input, $parameters)
  {
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
      $forecastingResult = $this->forecast($variables, $this->defaultParameters);
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
