// DataTable
$(document).ready(function () {
  $('#climate-data').DataTable({
    lengthMenu: [12, 24, 36, 48, 60,]
  });
});

$(document).ready(function () {
  $('#history-data').DataTable({
    lengthMenu: [10, 20, 30, 40, 50,]
  });
});

//switch form
$('#forecast_method').change(() => {
  $('form.active').removeClass('active');
  const showFormId = $('#forecast_method').find(":selected").val();
  $('form#'+showFormId).addClass('active');
});