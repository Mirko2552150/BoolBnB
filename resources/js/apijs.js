// console.log('test');
// $.ajax({
//     'url' : '/api/stats',
//     'method' : 'GET',
//     'headers' : {
//         'authorization' : 'Bearer Pippo?123'
//     },
//     'success' : function(response) {
//         console.log(response);
//     },
//     'error' : function(errors) {
//         console.log(errors);
//     }


    axios.get('/api/stats',
    {
        'headers' : {
            'Authorization' : 'Bearer Pippo?123',
            'Content-Type':'application/json'
        },
    })
    .then(function (response) {
        var moment = require('moment'); // require
        moment().format();

        var mesiAnno = moment.months();

        var variabileCasa = $('#homeid').val();

        var data = response['data'];
        // console.log(data);
        var dato = data.data;
        var prova2 = dato[variabileCasa];
        if (prova2 === undefined) {
            console.log('nullo');
        }
        var prova = costruttoreDatiMesi(dato[variabileCasa]);
        visualTotali = prova.reduce(myFunc)
        console.log(visualTotali);
        $('#visualAppart').text(visualTotali);
        // METTERE GRAFICO IN FUNZIONE E RIUSARLO NELL'IF A RIGA 35 E QUI SOTTO


        var ctx = $('#statsGrafico');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: mesiAnno,
                        datasets: [{
                            label: 'Visite per mese',
                            backgroundColor: 'lightgreen',
                            borderColor: 'Green',
                            data: prova
                        }]
                    },
                });

    })
    .catch(function (error) {
        // handle error
        console.log(error);
    })

    function costruttoreDatiMesi(array) {
        var objIntermedio = {};
        var dataPC = [];
        for (var x = 0; x < 12; x++) {
            if (objIntermedio[x] === undefined) {
                objIntermedio[x] = 0;
            }


        }
        for (var i = 0; i < array.length; i++) {
            var oggettoSingolo = array[i];
            var giornoVendita = oggettoSingolo.created_at;
            var meseVendita = moment(giornoVendita, "DD-MM-YYYY").clone().month(); // ottengo i numeri dei mesi che escono già ordinati nell'oggetto
            objIntermedio[meseVendita] += 1;

        }
        for (var key in objIntermedio) {
            dataPC.push(objIntermedio[key]);
        }
        return dataPC;
    };

    function myFunc(total, num) {
      return total + num;
    }
