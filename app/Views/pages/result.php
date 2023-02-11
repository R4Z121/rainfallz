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
    <h5>Error Rate : <b><?= $errorRate; ?></b></h5>
  </div>
</section>
<?= $this->endSection(); ?>