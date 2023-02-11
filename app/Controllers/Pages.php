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
  public function forecast()
  {
    $data = [
      'title' => 'Forecast',
    ];
    return view('pages/forecast', $data);
  }
  public function history()
  {
    $data = [
      'title' => 'Prediction History',
    ];
    return view('pages/history', $data);
  }
}
