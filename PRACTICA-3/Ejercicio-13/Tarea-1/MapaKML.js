"use strict";
class MapaKML {
    initMap() {
        L.mapbox.accessToken = 'pk.eyJ1IjoidW8yNjk4NzEiLCJhIjoiY2t3anJpaTBjMThzZzMxcGJlbnkzeXZwaiJ9.n977TEsECRb_69i8Unbq6A';
        var map = L.mapbox.map('map')
            .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

        var runLayer = omnivore.kml('red_social.kml')
            .on('ready', function () {
                map.fitBounds(runLayer.getBounds());
            })
            .addTo(map);
    }
}

var k = new MapaKML();