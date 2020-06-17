if ($('#map-example-container').length > 0) { // SE l'id ESISTE (e quindi ha una length) allora eseguo i comandi sotto
    // RELATIVO ALLA MAPPA
    var placesAutocomplete = places({
    appId: 'plVDX21IBPXQ',
    apiKey: 'a8de2e8e20b7ff08907af0462c505d74',
    // container: null,
    container: document.querySelector('#input-map')
    });

    var map = L.map('map-example-container', {
    scrollWheelZoom: false,
    zoomControl: true

    });

    var osmLayer = new L.TileLayer(
    'https://api.tomtom.com/map/1/tile/basic/main/{z}/{x}/{y}.png?key=MOZx4LKXnjKwAAouxzQpxbZ5Y6GsEPwr&view=Unified', {
      minZoom: 1,
      maxZoom: 18,
    }
    );

    var markers = [];

    if ($('#lat-valore').length > 0) { // se l'id esiste (e quindi ha una length) allora eseguo i comandi sotto
        $('.algolia-places').addClass('invisible');
        var lat = $('#lat-valore').val();
        var long = $('#long-valore').val();
        // console.log(long);
        var tessera = L.marker([lat, long]).addTo(map); // VAR CH INDICA IL MARKER NELLA MAPS
        map.setView(new L.LatLng(lat, long), 10); // PUNTO INIZIALE MAPS CON ZOOM
    } else {
        map.setView(new L.LatLng(0, 0), 1); // PUNTO default iniziale
    }

    map.addLayer(osmLayer);

    placesAutocomplete.on('suggestions', handleOnSuggestions);
    placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
    placesAutocomplete.on('change', handleOnChange);
    placesAutocomplete.on('clear', handleOnClear);

    function handleOnSuggestions(e) {
    markers.forEach(removeMarker);
    markers = [];

    if (e.suggestions.length === 0) {
      map.setView(new L.LatLng(0, 0), 1);
      return;
    }

    e.suggestions.forEach(addMarker);
        findBestZoom();
    }

    function handleOnChange(e) {
    markers
      .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
          markers = [marker];
          marker.setOpacity(1);
          findBestZoom();
        } else {
          removeMarker(marker);
        }
      });
    }

    function handleOnClear() {
    map.setView(new L.LatLng(0, 0), 1);
    markers.forEach(removeMarker);
    }

    function handleOnCursorchanged(e) {
    markers
      .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
          marker.setOpacity(1);
          marker.setZIndexOffset(1000);
        } else {
          marker.setZIndexOffset(0);
          marker.setOpacity(0.5);
        }
      });
    }

    function addMarker(suggestion) {
        var marker = L.marker(suggestion.latlng, {opacity: .4});
        marker.addTo(map);
        markers.push(marker);
    }

    function removeMarker(marker) {
        map.removeLayer(marker);
    }

    function findBestZoom() {
        var featureGroup = L.featureGroup(markers);
        map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: true});
    }

    // AL CLICK O INVIO SULLA RICERCA MAPPA
    $('#input-map').on('keyup', function (event) {
        if (event.key == 'Enter') { // le righe seguenti vengono eseguite solo dopo pressione tasto enter
            var posizione = $('#input-map').val(); // così prendo il valore dell’input => indirizzo selezionato
            var mark = markers[0];
            var lat = mark._latlng.lat;
            var long = mark._latlng.lng;
            // console.log(lat, long);
            $('#lat').val(lat);
            $('#long').val(long);

        }
    });

    $('#algolia-places-listbox-0').on('click', function (event) {
      var posizione = $('#input-map').val(); // così prendo il valore dell’input => indirizzo selezionato
      var mark = markers[0];
      var lat = mark._latlng.lat;
      var long = mark._latlng.lng;
      // console.log(lat, long);
      $('#lat').val(lat);
      $('#long').val(long);
      console.log(markers);

    });


    var posizione = $('#input-map-show').val(); // così prendo il valore dell’input => indirizzo selezionato
}
