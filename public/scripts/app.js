// DataTable
$(document).ready(function () {
  $('#climate-data').DataTable({
    lengthMenu: [12, 24, 36, 48, 60,]
  });
});

//switch form
$('#forecast_method').change(() => {
  $('form.active').removeClass('active');
  const showFormId = $('#forecast_method').find(":selected").val();
  $('form#'+showFormId).addClass('active');
});