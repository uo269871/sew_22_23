"use strict";
class MapaGeoJSON {
    initMap(files) {
        var archivo = files[0]
        var lector = new FileReader();
        lector.onload = function (event) {
            var text = lector.result;
            var geojson = JSON.parse(text);
            L.mapbox.accessToken = 'pk.eyJ1IjoidW8yNjk4NzEiLCJhIjoiY2t3anJpaTBjMThzZzMxcGJlbnkzeXZwaiJ9.n977TEsECRb_69i8Unbq6A';
            L.mapbox.map('map')
                .setView([43.363433, -5.8633631], 8)
                .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'))
                .featureLayer.setGeoJSON(geojson);
        }

        lector.readAsText(archivo);
    }
}

var m = new MapaGeoJSON();