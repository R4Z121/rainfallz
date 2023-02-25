<?php

namespace App\Controllers;

use App\Controllers\Tsukamoto;

use App\Models\ClimateModel;
use App\Models\ArtificialBeeColonyModel;

class ArtificialBeeColony extends BaseController
{
  protected $tsukamoto;
  protected $climateModel;
  protected $artificialBeeColonyModel;
  protected $climateData;
  protected $rainfallData;

  public function __construct()
  {
    $this->tsukamoto = new Tsukamoto();
    $this->climateModel = new ClimateModel();
    $this->artificialBeeColonyModel = new ArtificialBeeColonyModel();
    $this->climateData = $this->climateModel->getClimateDataVariables();
    $this->rainfallData = $this->climateModel->getRainfallData();
  }

  public function start()
  {
    //TAKE USER INPUT FOR VARIABLE VALUES, CLIMATE DATA, TOTAL OF BEES, AND TOTAL OF ITERATIONS
    $input = $this->request->getPost();
    $climateInput = [
      "temperature" => $input["temperature"],
      "airPressure" => $input["airPressure"],
      "humidity" => $input["humidity"],
      "windVelocity" => $input["windVelocity"]
    ];
    $totalBees = $input["totalBees"];
    $maxIteration = $input["totalIterations"];
    $bestFoodSource = [
      "parameters" => [],
      "fitnessValue" => 0,
    ];

    //DEFINE COLONY SIZE, DIMENTIONS, LIMIT
    $dimentions = 12;
    $colonySize = $totalBees * 12;
    $limit = ($dimentions * $colonySize) / 2;

    //DO INITIALIZATION PHASE (TOTAL OF BEES) => RETURN ARRAY OF FOOD SOURCE WITH FITNESS VALUE FOR EACH SOLUTION AND TRIAL VALUE
    $foodSource = $this->initializationPhase($totalBees);

    //START LOOPING UNTIL ITERATION = TOTAL ITERATION
    for ($iteration = 1; $iteration <= $maxIteration; $iteration++) {
      //DO EMPLOYED BEE PHASE
      $foodSource = $this->employedBeePhase($foodSource);
      //DO ONLOOKER BEE PHASE
      $foodSource = $this->onlookerBeePhase($foodSource, $totalBees);
      //MEMORIZE BEST FOOD SOURCE SO FAR
      $bestFoodSource = $this->memorizeBestFoodSource($bestFoodSource, $foodSource);
      //DO SCOUT BEE PHASE
      $abandonedFoodSources = $this->abandonedFoodSource($foodSource["trial"], $limit);
      if ($abandonedFoodSources) {
        $foodSource = $this->scoutBeePhase($foodSource, $abandonedFoodSources);
      }
    }
    //FORECAST USING BEST FOOD SOURCE
    $forecastingResult = $this->tsukamoto->forecast($climateInput, $bestFoodSource["parameters"]);

    $data = [
      "title" => "Forecasting Result",
      "input" => $climateInput,
      "finalResult" => $forecastingResult,
      "errorRate" => $bestFoodSource["fitnessValue"],
      "method" => "FIS Tsukamoto & Artificial Bee Colony"
    ];
    return view('Pages/result', $data);
  }

  public function initializationPhase($totalBees)
  {
    $foodSource = [
      "parameters" => $this->artificialBeeColonyModel->generateParameters($totalBees),
      "fitnessValue" => [],
      "trial" => []
    ];
    foreach ($foodSource["parameters"] as $parameters) {
      $fitnessValue = $this->calculateFitnessValue($parameters);
      array_push($foodSource["fitnessValue"], $fitnessValue);
      array_push($foodSource["trial"], 0);
    }
    return $foodSource;
  }

  public function employedBeePhase($foodSource)
  {
    $newFoodSource = $foodSource;

    for ($i = 0; $i < count($foodSource["parameters"]); $i++) {
      $exploringResult = $this->exploringFoodSource($foodSource, $i);
      $newFoodSource = $this->greedySelection($foodSource, $newFoodSource, $exploringResult, $i);
    }
    return $newFoodSource;
  }

  public function onlookerBeePhase($foodSource, $totalBees)
  {
    $newFoodSource = $foodSource;
    $chances = $this->artificialBeeColonyModel->getFitnessValueChance($foodSource["fitnessValue"]);
    $onlookerBee = 1;
    for ($index = 0; $index < $totalBees; $index++) {
      $randomChanceRate = mt_rand(0, 100) / 100;
      if ($randomChanceRate < $chances[$index]) {
        $exploringResult = $this->exploringFoodSource($foodSource, $index);
        $newFoodSource = $this->greedySelection($foodSource, $newFoodSource, $exploringResult, $index);
        $onlookerBee++;
      }
      if ($onlookerBee <= $totalBees && $index == ($totalBees - 1)) {
        $index = 0;
      }
    }
    return $newFoodSource;
  }

  public function scoutBeePhase($foodSource, $abandonedFoodSources)
  {
    $newFoodSource = $foodSource;
    foreach ($abandonedFoodSources as $index) {
      $newFoodSource["parameters"][$index] = $this->artificialBeeColonyModel->generateParameter();
      $newFoodSource["fitnessValue"][$index] = $this->calculateFitnessValue($newFoodSource["parameters"][$index]);
      $newFoodSource["trial"][$index] = 0;
    }
    return $newFoodSource;
  }

  public function calculateFitnessValue($parameters)
  {
    $forecastingResults = [];
    for ($i = 0; $i < count($this->climateData); $i++) {
      $input = [
        "temperature" => $this->climateData[$i]["temperature"],
        "airPressure" => $this->climateData[$i]["airPressure"],
        "humidity" => $this->climateData[$i]["humidity"],
        "windVelocity" => $this->climateData[$i]["windVelocity"],
      ];
      $forecastingResult = $this->tsukamoto->forecast($input, $parameters);
      array_push($forecastingResults, $forecastingResult);
    }
    $errorRate = $this->tsukamoto->getErrorRate($forecastingResults, $this->rainfallData);
    return $errorRate;
  }

  public function exploringFoodSource($foodSource, $i)
  {
    $variables = ["temperature", "humidity", "airPressure", "windVelocity"];
    $parameters = $foodSource["parameters"];

    $randomCategory = $variables[mt_rand(0, 3)];
    $randomIndex = mt_rand(0, 2);
    $loop = true;
    $randomPartner = 0;
    while ($loop) {
      $randomPartner = mt_rand(0, (count($parameters)) - 1);
      if ($randomPartner != $i) {
        $loop = false;
      }
    }

    $newParametersCandidate = $parameters[$i];
    $oldFoodLocation = $newParametersCandidate[$randomCategory][$randomIndex];
    $partnerFoodSource = $parameters[$randomPartner][$randomCategory][$randomIndex];
    $newParametersCandidate[$randomCategory][$randomIndex] = $this->artificialBeeColonyModel->generateNewFoodLocation($oldFoodLocation, $partnerFoodSource);
    $newFitnessValue = $this->calculateFitnessValue($newParametersCandidate);

    return [
      "newParametersCandidate" => $newParametersCandidate,
      "newFitnessValue" => $newFitnessValue
    ];
  }

  public function greedySelection($oldFoodSource, $newFoodSource, $exploringResult, $i)
  {
    $newParametersCandidate = $exploringResult["newParametersCandidate"];
    $newFitnessValue = $exploringResult["newFitnessValue"];

    if ($oldFoodSource["fitnessValue"][$i] > $newFitnessValue) {
      $newFoodSource["parameters"][$i] = $newParametersCandidate;
      $newFoodSource["fitnessValue"][$i] = $newFitnessValue;
      $newFoodSource["trial"][$i] = 0;
    } else {
      $newFoodSource["trial"][$i] += 1;
    }
    return $newFoodSource;
  }

  public function memorizeBestFoodSource($bestFoodSource, $foodSource)
  {

    $fitnessValues = $foodSource["fitnessValue"];
    $lowestFitnessValue = min($fitnessValues);
    $indexOfBestFoodSource = array_search($lowestFitnessValue, $fitnessValues);

    if (!$bestFoodSource["parameters"] || $bestFoodSource["fitnessValue"] > $lowestFitnessValue) {
      $bestFoodSource = [
        "parameters" => $foodSource["parameters"][$indexOfBestFoodSource],
        "fitnessValue" => $foodSource["fitnessValue"][$indexOfBestFoodSource],
      ];
    }
    return $bestFoodSource;
  }

  public function abandonedFoodSource($trialValue, $limit)
  {
    $abandonedFoodSources = [];
    foreach ($trialValue as $key => $value) {
      if ($value >= $limit) {
        array_push($abandonedFoodSources, $key);
      }
    }
    return $abandonedFoodSources;
  }
}
