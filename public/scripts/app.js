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
  $('#generateAbcParameters').html("<span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span> Generating Parameters...");
  $('.form-content button').prop('disabled',true);
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
        $('#generateAbcParameters').html("Generate Bee Colony Parameters");
        $('.form-content button').prop('disabled',false);
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

//Calculate Rainfall - Manual Forecasting
$('#manualCalculateRainfall').on('click', () => {
  $('#manualCalculateRainfall').html("<span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span> Calculating Rainfall...");
  $('.form-content button').prop('disabled',true);

  const input = {
    temperature: Number($('input#temperature').val()),
    airPressure: Number($('input#airPressure').val()),
    humidity: Number($('input#humidity').val()),
    windVelocity: Number($('input#windVelocity').val())
  }

  const parameters = {
    temperature: $('input#temperature-parameters').val().split(", "),
    airPressure: $('input#airPressure-parameters').val().split(", "),
    humidity: $('input#humidity-parameters').val().split(", "),
    windVelocity: $('input#windVelocity-parameters').val().split(", ")
  };

  $.ajax({
    url: '/forecast/manual',
    type: 'POST',
    data: {
      input: input,
      parameters: parameters,
    },
    datatype: 'json',
    success: (response) => {
      const forecastingResult = JSON.parse(response);
      $('#rainfall-forecasting-result').html(forecastingResult);
      $('#manualCalculateRainfall').html("Calculate Rainfall");
      $('.form-content button').prop('disabled',false);
    }
  })
});