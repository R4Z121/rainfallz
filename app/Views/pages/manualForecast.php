<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="page-heading flex-heading">
  <h1 class="page-title"><?= $title; ?></h1>
  <div>
    <h3 class="heading-level-content">Rainfall Forecasting Result : <span id="rainfall-forecasting-result">0.00</span>
    </h3>
  </div>
</section>
<!-- Modal -->
<div class="modal fade" id="abcConfiguration" tabindex="-1" aria-labelledby="abcConfigurationLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="abcConfigurationLabel">Artificial Bee Colony Configuration</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
      </div>
      <div class="modal-body">
        <form class="modal-form d-flex flex-column gap-3">
          <section class="form-section">
            <div class="form-input">
              <label for="totalBees">Total of Bees</label>
              <input type="number" step="any" id="totalBees" name="totalBees" max="25" min="2" required>
            </div>
            <div class="form-input">
              <label for="totalIterations">Total of Iterations</label>
              <input type="number" step="any" id="totalIterations" name="totalIterations" max="25" min="1" required>
            </div>
          </section>
          <button class="btn btn-primary full-button" type="button" id="generateBestParameters">Generate Best Parameters</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal -->
<section class="page-content form-content">
  <form class="section-form">
    <?= csrf_field(); ?>
    <section class="form-section">
      <h4 class="w-full text-center">Membership Function Parameters</h4>
      <div class="form-input">
        <label for="temperature-parameters">Temperature Parameters</label>
        <input type="text" step="any" id="temperature-parameters" name="temperature-parameters" value="26, 27.5, 29" disabled required>
      </div>
      <div class="form-input">
        <label for="airPressure-parameters">Air Pressure Parameters</label>
        <input type="text" step="any" id="airPressure-parameters" name="airPressure-parameters" value="1008.5, 1011, 1013" disabled required>
      </div>
      <div class="form-input">
        <label for="humidity-parameters">Humidity Parameters</label>
        <input type="text" step="any" id="humidity-parameters" name="humidity-parameters" value="63, 75, 85" disabled required>
      </div>
      <div class="form-input">
        <label for="windVelocity-parameters">Wind Velocity Parameters</label>
        <input type="text" step="any" id="windVelocity-parameters" name="windVelocity-parameters" value="2, 4, 6.5" disabled required>
      </div>
      <div class="w-full d-flex justify-content-center gap-3">
        <button class="btn btn-primary" type="button" id="generateDefaultParameters">Generate Default Parameters</button>
        <button class="btn btn-primary" type="button" id="generateAbcParameters" data-bs-toggle="modal" data-bs-target="#abcConfiguration">Generate Bee Colony Parameters</button>
      </div>
    </section>
    <section class="form-section">
      <h4 class="w-full text-center">Fuzzy Variable Inputs</h4>
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
    <button class="btn btn-primary full-button" id="manualCalculateRainfall" type="button">Calculate Rainfall</button>
  </form>
</section>
<?= $this->endSection(); ?>