<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<section class="page-heading">
  <h1 class="page-title">Forecasting Result</h1>
</section>
<section class="page-content">
  <div>
    <h4>Total Iterations : <?= $totalIterations; ?></h4>
    <h4>Total Bees : <?= $totalBees; ?></h4>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Testing Number</th>
        <th scope="col">MAPE</th>
        <th scope="col">Execution Time</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($testingResult as $result) : ?>
        <tr>
          <td><?= $result["testingNumber"]; ?></td>
          <td><?= $result["MAPE"]; ?></td>
          <td><?= $result["executionTime"]; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>
<?= $this->endSection(); ?>