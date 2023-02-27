<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="page-heading">
  <h1 class="page-title"><?= $title; ?></h1>
</section>
<section class="page-content">
  <table id="climate-data" class="table table-striped table-bordered" style="width:100%">
    <thead class="bg-warning">
      <tr>
        <th class="text-center">#</th>
        <th class="text-center">Date</th>
        <th class="text-center">Actual Rainfall Data</th>
        <th class="text-center">Rainfall Prediction</th>
        <th class="text-center">Absolute Percentage Error (APE)</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i = 0; $i < count($rainfalls); $i++) : ?>
        <tr>
          <td class="text-center"><?= $i + 1; ?></td>
          <td class="text-center"><?= $date[$i]; ?></td>
          <td class="text-center"><?= $rainfalls[$i]; ?></td>
          <td class="text-center"><?= $forecastingResults[$i]; ?></td>
          <td class="text-center"><?= $ape[$i] . "%"; ?></td>
        </tr>
      <?php endfor; ?>
    </tbody>
  </table>
  <div>
    <h5>Mean Absolute Percentage Error : <b><?= $mape . "%"; ?></b></h5>
  </div>
</section>
<?= $this->endSection(); ?>