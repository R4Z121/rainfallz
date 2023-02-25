<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<section class="page-heading">
  <h1 class="page-title">Forecasting Result</h1>
</section>
<section class="page-content">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Temperature</th>
        <th scope="col">Humidity</th>
        <th scope="col">Air Pressure</th>
        <th scope="col">Wind Velocity</th>
        <th scope="col">Rainfall</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?= $input["temperature"]; ?></td>
        <td><?= $input["humidity"]; ?></td>
        <td><?= $input["airPressure"]; ?></td>
        <td><?= $input["windVelocity"]; ?></td>
        <td><?= $finalResult; ?></td>
      </tr>
    </tbody>
  </table>
  <div>
    <h5>Mean Absolute Percentage Error : <b><?= $errorRate; ?></b></h5>
  </div>
  <div>
    <form class="hidden-form" action="/forecasting-history" method="post">
      <input type="hidden" id="forecastingMethod" name="forecastingMethod" value="<?= $method; ?>">
      <input type="hidden" id="temperature" name="temperature" value="<?= $input["temperature"]; ?>">
      <input type="hidden" id="airPressure" name="airPressure" value="<?= $input["airPressure"]; ?>">
      <input type="hidden" id="humidity" name="humidity" value="<?= $input["humidity"]; ?>">
      <input type="hidden" id="windVelocity" name="windVelocity" value="<?= $input["windVelocity"]; ?>">
      <input type="hidden" id="forecastingResult" name="forecastingResult" value="<?= $finalResult; ?>">
      <input type="hidden" id="errorRate" name="errorRate" value="<?= $errorRate; ?>">
      <label>Do you want to add this forecasting result to history table ?</label>
      <div class="button-form">
        <button type="submit" class="btn btn-primary">Yes, add it</button>
        <a class="btn btn-danger" href="/forecast/manual" role="button">No, go back</a>
      </div>
    </form>
  </div>
</section>
<?= $this->endSection(); ?>