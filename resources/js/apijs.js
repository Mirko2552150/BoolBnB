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
        var counter = 0;
        // handle success
        // console.log(response);
        var data = response['data'];
        // console.log(data);
        var dato = data.data;
        var grouped = _.mapValues(_.groupBy(dato, 'home_id'),
            clist => clist.map(dato => _.omit(dato, 'updated_at')));

        console.log(grouped);
        for (var key in grouped) {
            console.log(grouped[key].home_id + ' ' + grouped[key].length);
        }
        for (var i = 0; i < grouped.length; i++) {
            // for (var key in dato[i]) {
            //     var idMessaggio = dato[i].id;
            //     var idHome = dato[i].home_id;
            //     var creazione = dato[i].created_at;
            // }
            // console.log('id ' + idMessaggio);
            // console.log('casa ' + idHome);
            // console.log('data ' + creazione);

        }
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    })
