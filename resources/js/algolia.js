var placesAutocomplete = places({
appId: 'plVDX21IBPXQ',
apiKey: 'a8de2e8e20b7ff08907af0462c505d74',
container: document.querySelector('#input-map')
});

var map = L.map('map-example-container', {
scrollWheelZoom: true,
zoomControl: true
});

var osmLayer = new L.TileLayer(
'https://api.tomtom.com/map/1/tile/basic/main/{z}/{x}/{y}.png?key=MOZx4LKXnjKwAAouxzQpxbZ5Y6GsEPwr&view=Unified', {
  minZoom: 1,
  maxZoom: 20,
}
);

var markers = [];

map.setView(new L.LatLng(0, 0), 1);
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

// console.log(markers);
$('#input-map').on('click', '#invia-form',function (event) {
    var lat = markers[0]._latlng.lat; //  poi prendo direttamente la latitudine
    var long = markers[0]._latlng.lng; // e la longitudine dell'indirizzo selezionato
    $('#id_blocco').val(lat);
    $('#id_blocco2').val(long);
});
