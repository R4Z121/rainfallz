<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('styles/app.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('styles/responsive.css'); ?>">
  <title><?= $title; ?></title>
</head>

<body>
  <?= $this->include('layouts/navbar'); ?>
  <main>
    <?= $this->renderSection('content'); ?>
  </main>
  <footer class="footer bg-primary text-light">
    <span class="footer-copy">copyright &copy; 2023 RZ121. All rights reserved</span>
  </footer>
  <script src="<?= base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
  <script src="<?= base_url('scripts/app.js'); ?>"></script>
</body>

</html>