// funzione per Slider su HTML
$(document).ready(function() {

  const $valueSpan = $('.valueSpan');
  const $value = $('#slider-range');
  $valueSpan.html($value.val());
  $value.on('input change', () => {

    $valueSpan.html($value.val());
  });
});
