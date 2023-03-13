<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<section class="page-heading">
  <h1 class="page-title">Tsukamoto-ABC Forecasting Test</h1>
</section>
<section class="page-content form-content">
  <form class="active forecasting-form" action="/forecast/testing" method="post" id="1">
    <?= csrf_field(); ?>
    <div class="form-input">
      <label for="totalBees">Total of Bees</label>
      <input type="number" step="any" id="totalBees" name="totalBees" required>
    </div>
    <div class="form-input">
      <label for="totalIterations">Total of Iterations</label>
      <input type="number" step="any" id="totalIterations" name="totalIterations" required>
    </div>
    <div class="form-input">
      <label for="totalTesting">Total of Testing</label>
      <input type="number" step="any" id="totalTesting" name="totalTesting" required>
    </div>
    <button class="btn btn-primary" type="submit">Calculate Rainfall</button>
  </form>
</section>
<?= $this->endSection(); ?>