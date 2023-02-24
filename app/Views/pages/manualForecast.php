<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="page-heading flex-heading">
  <h1 class="page-title">Rainfall Forecasting</h1>
  <div class="option-container">
    <select class="form-select" aria-label="Default select example" id="forecast_method">
      <option value="1">FIS Tsukamoto</option>
      <option value="2">FIS Tsukamoto & Artificial Bee Colony</option>
    </select>
  </div>
</section>
<section class="page-content form-content">
  <form class="active forecasting-form" action="/forecast/tsukamoto" method="post" id="1">
    <?= csrf_field(); ?>
    <div class="form-input">
      <label for="temperature">Temperature</label>
      <input type="number" step="any" id="temperature" name="temperature" required>
    </div>
    <div class="form-input">
      <label for="airPressure">Air Pressure</label>
      <input type="number" step="any" id="airPressure" name="airPressure" required>
    </div>
    <div class="form-input">
      <label for="humidity">Humidity</label>
      <input type="number" step="any" id="humidity" name="humidity" required>
    </div>
    <div class="form-input">
      <label for="windVelocity">Wind Velocity</label>
      <input type="number" step="any" id="windVelocity" name="windVelocity" required>
    </div>
    <button class="btn btn-primary" type="submit">Calculate Rainfall</button>
  </form>
  <form class="section-form forecasting-form" action="/forecast/artificial-bee-colony" method="POST" id="2">
    <?= csrf_field(); ?>
    <section class="form-section">
      <div class="form-input">
        <label for="temperature">Temperature</label>
        <input type="number" step="any" id="temperature" name="temperature" required>
      </div>
      <div class="form-input">
        <label for="airPressure">Air Pressure</label>
        <input type="number" step="any" id="airPressure" name="airPressure" required>
      </div>
      <div class="form-input">
        <label for="humidity">Humidity</label>
        <input type="number" step="any" id="humidity" name="humidity" required>
      </div>
      <div class="form-input">
        <label for="windVelocity">Wind Velocity</label>
        <input type="number" step="any" id="windVelocity" name="windVelocity" required>
      </div>
    </section>
    <section class="form-section">
      <div class="form-input">
        <label for="totalBees">Total of Bees</label>
        <input type="number" step="any" id="totalBees" name="totalBees" max="10" min="2" required>
      </div>
      <div class="form-input">
        <label for="totalIterations">Total of Iterations</label>
        <input type="number" step="any" id="totalIterations" name="totalIterations" max="25" min="1" required>
      </div>
    </section>
    <button class="btn btn-primary full-button" type="submit">Calculate Rainfall</button>
  </form>
</section>
<?= $this->endSection(); ?>