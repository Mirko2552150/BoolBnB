// console.log('collegato');
  $('#invia-filtri').on('click', function () {
    var beds = $('#slider-beds').val();
    var rooms = $('#slider-rooms').val();
    var bathrooms = $('#slider-bath').val();
    // var amenitiesfilter = amenityFilter();
    $.ajax({
      url: "http://127.0.0.1:8000/api/search",
      method: "GET",
      data: {
        lat: $('#lat-invisible').val(),
        long: $('#long-invisible').val(),
        range: $('#range-invisible').val()
      },
      success: function success(data) {
        var risultati = data;
        var servicesActive = [];
        console.log(risultati);
        console.log(risultati.data.length);

        for (var i = 0; i < risultati.data.length; i++) {
            var risultato = risultati.data[i];
            // $('#' + risultato.id).show();


            if (risultato.n_beds < beds || risultato.n_rooms < rooms || risultato.n_bath < bathrooms) {
                $('#' + risultato.id).hide();
            } else {
                $('#' + risultato.id).show();
            }

            // if (risultato.n_rooms < rooms) {
            // $('#' + risultato.id).hide();
            // }
            //
            // if (risultato.n_bath < bathrooms) {
            // $('#' + risultato.id).hide();
            // }

            $('#' + risultato.id).find('.services').each(function () {
            var service = parseInt($(this).data('services'));
            servicesActive.push(service);
            });
            console.log('i servizi sono: ' + servicesActive);

            for (var x = 0; x < servicesActive.length; x++) {
                console.log('service filter corrisponde: ' + servicesActive[x]);
                console.log('service home corrisponde: ' + servicesActive);
                var check = servicesActive.includes(servicesActive[x]);
                console.log(check);

                if (check === false) {
                    $('#' + risultato.id).hide();
                }
            }
        }

    },
      error: function error() {
        alert("E' avvenuto un errore. ");
      }
    });
});







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
