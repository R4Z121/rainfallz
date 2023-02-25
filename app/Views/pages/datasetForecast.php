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
</section>
<?= $this->endSection(); ?>