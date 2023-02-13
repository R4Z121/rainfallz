<?php

namespace App\Controllers;

use App\Models\ForecastingHistoryModel;

class ForecastingHistory extends BaseController
{
  protected $forecastingModel;
  public function __construct()
  {
    $this->forecastingModel = new ForecastingHistoryModel();
  }
  public function addData()
  {
    $input = $this->request->getPost();
    date_default_timezone_set('Asia/Jakarta');
    $data = [
      "forecasting_date" => date("d F Y"),
      "method" => $input["forecastingMethod"],
      "temperature" => $input["temperature"],
      "air_pressure" => $input["airPressure"],
      "humidity" => $input["humidity"],
      "wind_velocity" => $input["windVelocity"],
      "prediction_result" => $input["forecastingResult"],
      "error_rate" => $input["errorRate"]
    ];
    $this->forecastingModel->save($data);
    return redirect()->to('/history');
  }
}
