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
  public function start()
  {
    $input = $this->request->getPost();
    $finalResult = $this->forecast($input);
    $errorRate = $this->getDataErrorRate();
    $data = [
      "title" => "Forecasting Result",
      "input" => $input,
      "finalResult" => $finalResult,
      "errorRate" => $errorRate
    ];
    return view('Pages/result', $data);
  }
  public function forecast($input, $parameters = false)
  {
    if (!$parameters) {
      $parameters = [
        "temperature" => [26, 27.5, 29],
        "airPressure" => [1008.5, 1011, 1013],
        "humidity" => [63, 75, 85],
        "windVelocity" => [2, 4, 6.5]
      ];
    }

    $fuzzyficationResult = $this->tsukamotoModel->fuzzyfication($input["temperature"], $input["airPressure"], $input["humidity"], $input["windVelocity"], $parameters);
    $ruleSet = $this->ruleSetModel->getAllRule();
    $inferenceProcessResult = $this->tsukamotoModel->inference($ruleSet, $fuzzyficationResult);
    $finalResult = $this->tsukamotoModel->defuzzyfication($inferenceProcessResult["alpha"], $inferenceProcessResult["z"]);
    return $finalResult;
  }
  public function getDataErrorRate()
  {
    $climateData = $this->climateModel->getAllClimateData();
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
    $actualData = $this->climateModel->getRainfallData();
    return $this->getErrorRate($actualData, $forecastingResults);
  }
  public function getErrorRate($actualData, $forecastingResults)
  {
    return $this->tsukamotoModel->meanAbsoluteDeviation($forecastingResults, $actualData);
  }
}
