<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="page-heading">
  <h1 class="page-title">Dataset Forecasting Result</h1>
</section>
<section class="page-content">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Actual Rainfall Data</th>
        <th scope="col">Rainfall Prediction</th>
        <th scope="col">Absolute Percentage Error (APE)</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i = 0; $i < count($rainfalls); $i++) : ?>
        <tr>
          <td><?= $date[$i]; ?></td>
          <td><?= $rainfalls[$i]; ?></td>
          <td><?= $forecastingResults[$i]; ?></td>
          <td><?= $ape[$i]; ?></td>
        </tr>
      <?php endfor; ?>
    </tbody>
  </table>
  <div>
    <h5>Mean Absolute Percentage Error : <b><?= $mape; ?></b></h5>
  </div>
</section>
<?= $this->endSection(); ?>