<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">RainfallZ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      <span class="navbar-toggler-icon"></span>
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto d-flex justify-content-between">
        <a class="nav-link <?= ($title == 'Home') ? 'active" aria-current="page' : ''; ?>" href="/">Home</a>
        <a class="nav-link <?= ($title == 'Manual Forecasting') ? 'active" aria-current="page' : ''; ?>" href="/forecast/manual">Manual Forecasting</a>
      </div>
    </div>
  </div>
</nav>