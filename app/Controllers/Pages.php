<?php

namespace App\Controllers;

use App\Models\ClimateModel;
use App\Models\ForecastingHistoryModel;

class Pages extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Home',
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
  public function datasetForecast()
  {
    $climateModel = new ClimateModel();
    $climate = $climateModel->getAllClimateData();
    $data = [
      'title' => 'Dataset Forecasting',
      'climates' => $climate,
    ];
    return view('pages/datasetForecast', $data);
  }
  public function history()
  {
    $forecastingHistoryModel = new ForecastingHistoryModel();
    $histories = $forecastingHistoryModel->getAllHistory();
    $data = [
      'title' => 'Prediction History',
      'histories' => $histories
    ];
    return view('pages/history', $data);
  }
}
