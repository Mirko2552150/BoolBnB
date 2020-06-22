

axios.get('/api/stats',
{
    'headers' : {
        // 'Authorization' : 'Bearer Pippo?123',
        // 'Content-Type':'application/json'
    },
})
.then(function (response) {
    var data = response['data'];
    console.log(data);

    $('#invia-filtri').on('click', function () {
        var arrayInput = $('.services-form-group input');
        var servizi = serviziChecked(arrayInput);
        var rooms = $('#slider-rooms').val();
        var beds = $('#slider-beds').val();
        var bath = $('#slider-bath').val();
    });
})
.catch(function (error) {
    // handle error
    console.log(error);
})

// FUNZIONI
function serviziChecked(array) {
    var selected = [];
    for (var i = 0; i < array.length; i++) {
        if (array[i].checked) {
            selected.push(array[i].value);
        }
    }
    return selected;
}
