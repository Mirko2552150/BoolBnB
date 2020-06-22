// funzione per Slider su HTML

slider('#slider-range', '.valueRange');
slider('#slider-rooms', '.valueRooms');
slider('#slider-beds', '.valueBeds');
slider('#slider-bath', '.valueBath');


function slider(input, span) {
    const $valueSpan = $(span);
    const $value = $(input);
    $valueSpan.html($value.val());
    $value.on('input change', () => {
        $valueSpan.html($value.val());
    });
}
