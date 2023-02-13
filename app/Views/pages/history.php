<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<section class="page-heading">
  <h1 class="page-title">Forecasting History</h1>
</section>
<section class="page-content">
  <table id="history-data" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>#</th>
        <th>Forecasting Date</th>
        <th>Forecasting Method</th>
        <th>Temperature</th>
        <th>Air Pressure</th>
        <th>Humidity</th>
        <th>Wind Velocity</th>
        <th>Prediction Result</th>
        <th>Error Rate</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($histories as $history) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><?= $history['forecasting_date']; ?></td>
          <td><?= $history['method']; ?></td>
          <td><?= $history['temperature']; ?></td>
          <td><?= $history['air_pressure']; ?></td>
          <td><?= $history['humidity']; ?></td>
          <td><?= $history['wind_velocity']; ?></td>
          <td><?= $history['prediction_result']; ?></td>
          <td><?= $history['error_rate']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>
<?= $this->endSection(); ?>