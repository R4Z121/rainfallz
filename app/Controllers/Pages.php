<?php

namespace App\Controllers;

use App\Models\ClimateModel;

class Pages extends BaseController
{
  public function index()
  {
    $climateModel = new ClimateModel();
    $climate = $climateModel->getAllClimateData();
    $data = [
      'title' => 'Home',
      'climates' => $climate,
    ];
    return view('pages/home', $data);
  }
  public function manualForecast()
  {
    $data = [
      'title' => 'Manual Forecasting',
    ];
    return view('pages/manualForecast', $data);
  }
  public function testing()
  {
    $data = [
      'title' => 'Testing Tsukamoto-ABC Forecasting',
    ];
    return view('pages/testingForecast', $data);
  }
}
