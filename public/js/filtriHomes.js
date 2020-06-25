// console.log('collegato');
  $('#invia-filtri').on('click', function () {
    var beds = $('#slider-beds').val(); // prendiamo i VAL dagli SLIDER
    var rooms = $('#slider-rooms').val();
    var bathrooms = $('#slider-bath').val();
    var serviceFilter = serviziFiltro();
    $.ajax({
      url: "http://127.0.0.1:8000/api/search",
      method: "GET",
      data: {
        lat: $('#lat-invisible').val(), // INVIAMO I DATI LONG LAT E RANGE AL CONTROLLER
        long: $('#long-invisible').val(),
        range: $('#range-invisible').val()
      },
      success: function success(data) { // CI RESTITUISCE I DATA
        var risultati = data;
        var servicesActive = [];

        for (var i = 0; i < risultati.data.length; i++) {
            var risultato = risultati.data[i];
            $('#' + risultato.id).show();


            if (risultato.n_beds < beds || risultato.n_rooms < rooms || risultato.n_bath < bathrooms) {
                $('#' + risultato.id).hide();
            } else {
                $('#' + risultato.id).find('.services').each(function () {
                var service = parseInt($(this).data('services'));
                servicesActive.push(service);
                });

                for (var x = 0; x < serviceFilter.length; x++) {
                    var check = servicesActive.includes(serviceFilter[x]);

                    if (check === false ) {
                        $('#' + risultato.id).hide();
                        break;
                    } else {
                        $('#' + risultato.id).show();
                    }
                }
            }

            // if (risultato.n_rooms < rooms) {
            // $('#' + risultato.id).hide();
            // }
            //
            // if (risultato.n_bath < bathrooms) {
            // $('#' + risultato.id).hide();
            // }


        }


    },

      error: function error() {
        alert("E' avvenuto un errore. ");
      }
    });

});

function serviziFiltro() { // Funzione che crea un array filters inserendo i valori delle checkbox che sono stati cliccati dall'utente
    var filters = [];
    $('.filtri-servizi').each(function(){ // CICLIAMO SUI DIV
        if ($(this).prop('checked')) {
           filters.push(parseInt($(this).val())); // SE SONO CHECK ISERIAMO L'ID NELL'ARRAY
        }
    });
    return filters;
};






// axios.get('/api/search',
// {
//     'headers' : {
//         'Authorization' : 'Bearer Pippo?123',
//         'Content-Type':'application/json'
//     },
// })
// .then(function (response) {
//     var data = response['data'];
//     console.log(response);
//
//     // $('#invia-filtri').on('click', function () {
//     //     var arrayInput = $('.services-form-group input');
//     //     var servizi = serviziChecked(arrayInput);
//     //     var rooms = $('#slider-rooms').val();
//     //     var beds = $('#slider-beds').val();
//     //     var bath = $('#slider-bath').val();
//     // });
// })
// .catch(function (error) {
//     // handle error
//     console.log(error);
// })
//
// // FUNZIONI
// function serviziChecked(array) {
//     var selected = [];
//     for (var i = 0; i < array.length; i++) {
//         if (array[i].checked) {
//             selected.push(array[i].value);
//         }
//     }
//     return selected;
// }
