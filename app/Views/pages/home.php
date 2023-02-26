<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<section class="page-heading">
  <h1 class="page-title">Banyuasin Regency Climate (2019 - 2021)</h1>
</section>
<section class="page-content">
  <table id="climate-data" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        <th>#</th>
        <th>Period</th>
        <th>Temperature</th>
        <th>Air Pressure</th>
        <th>Humidity</th>
        <th>Wind Velocity</th>
        <th>Rainfall</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($climates as $climate) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><?= $climate['period']; ?></td>
          <td><?= $climate['temperature']; ?></td>
          <td><?= $climate['air_pressure']; ?></td>
          <td><?= $climate['humidity']; ?></td>
          <td><?= $climate['wind_velocity']; ?></td>
          <td><?= $climate['rainfall']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Artificial Bee Colony Configuration</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="modal-form d-flex flex-column gap-3" action="" method="post">
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
            <button class="btn btn-primary full-button" type="submit">Start Forecasting</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column justify-content-center p-4 gap-2">
    <hr>
    <h6 class="text-center">SELECT FORECASTING METHOD</h6>
    <div class="d-flex flex-row justify-content-center gap-3 flex-wrap">
      <a class="btn btn-primary" href="/forecast/dataset/tsukamoto" role="button">Fuzzy Inference System Tsukamoto</a>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        FIS Tsukamoto & Artificial Bee Colony
      </button>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>