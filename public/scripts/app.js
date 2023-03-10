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

//Generate ABC Parameters
$('#generateBestParameters').on('click', () => {
  $('#closeModal').click();
  $.ajax({
    url: "/generateParameters/abc",
    type: "POST",
    data: {
      totalBees : $('input#totalBees').val(),
      totalIterations : $('input#totalIterations').val()
    },
    datatype: 'json',
    success: (response) => {
      parameters = JSON.parse(response);
      Object.keys(parameters).forEach(key => {
        const variable = parameters[key];
        const newParameters = variable.map(value => value.toFixed(2));
        $(`#${key}-parameters`).val(newParameters.join(", "));
      });
    }
  });
});

//Generate Default Parameters
$('#generateDefaultParameters').on('click', () => {
  $('input#temperature-parameters').val('26, 27.5, 29');
  $('input#airPressure-parameters').val('1008.5, 1011, 1013');
  $('input#humidity-parameters').val('63, 75, 85');
  $('input#windVelocity-parameters').val('2, 4, 6.5');
});