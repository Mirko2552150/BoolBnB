axios.get('/api/stats',
{
    'headers' : {
        'Authorization' : 'Bearer Pippo?123',
        'Content-Type':'application/json'
    },
})
.then(function (response) {
    var mesiAnno = moment.months();

    var variabileCasa = $('#homeid').val();

    var data = response['data'];
    // console.log(data);
    var dato = data.data;
    var home = dato[variabileCasa];
    if (home === undefined) {
        // console.log('nullo');
        myGraph(mesiAnno, [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
    } else {
    var datiMese = costruttoreDatiMesi(dato[variabileCasa]);
    // console.log(datiMese);
    visualTotali = datiMese.reduce(myFunc)
    // console.log(visualTotali);
    $('#visualAppart').text(visualTotali);
    // METTERE GRAFICO IN FUNZIONE E RIUSARLO NELL'IF A RIGA 35 E QUI SOTTO

    myGraph(mesiAnno, datiMese);
    }
})
.catch(function (error) {
    // handle error
    console.log(error);
});

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

function myGraph(mesi, views) {
  var ctx = $('#statsGrafico');
          var chart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: mesi,
                  datasets: [{
                      label: 'Visite per mese',
                      backgroundColor: 'lightgreen',
                      borderColor: 'Green',
                      lineTension: 0,
                      data: views
                  }]
              },
          });
}
