"use strict";
class GeoLocalizacion{
    constructor(){
        this.center = [-5.38987,43.648564];
        this.apiKey = "pk.eyJ1IjoidW8yNjk4NzEiLCJhIjoiY2t3anJpaTBjMThzZzMxcGJlbnkzeXZwaiJ9.n977TEsECRb_69i8Unbq6A";
        this.container = "mapaDinamico";
        this.mapStyle = "mapbox://styles/mapbox/dark-v10";
        this.zoom = 12;
    }

    getMap() {
        mapboxgl.accessToken = this.apiKey;
        let map = new mapboxgl.Map({
          container: this.container,
          style: this.mapStyle,
          center: this.center,
          zoom: this.zoom
        });
        let marker1 = new mapboxgl.Marker()
            .setLngLat(this.center)
            .addTo(map);
    }
}

var g = new GeoLocalizacion();