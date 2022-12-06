"use strict";
class GeoLocalizacion{
    constructor() {
        navigator.geolocation.getCurrentPosition(this.getPosicion.bind(this), this.verErrores.bind(this));
    }
    
    getPosicion(posicion) {
        this.oviedo = [posicion.coords.longitude,posicion.coords.latitude];
        this.apiKey = "pk.eyJ1IjoidW8yNjk4NzEiLCJhIjoiY2t3anJpaTBjMThzZzMxcGJlbnkzeXZwaiJ9.n977TEsECRb_69i8Unbq6A";
        this.container = "mapaDinamico";
        this.mapStyle = "mapbox://styles/mapbox/navigation-night-v1";
        this.mensaje = "Se ha realizado correctamente la petición de geolocalización";
        this.zoom = 15;
    }

    verErrores(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                this.mensaje = "El usuario no permite la petición de geolocalización"
                break;
            case error.POSITION_UNAVAILABLE:
                this.mensaje = "Información de geolocalización no disponible"
                break;
            case error.TIMEOUT:
                this.mensaje = "La petición de geolocalización ha caducado"
                break;
            case error.UNKNOWN_ERROR:
                this.mensaje = "Se ha producido un error desconocido"
                break;
        }
    }

    getMap(){       
        mapboxgl.accessToken = this.apiKey;
        let map = new mapboxgl.Map({
          container: this.container,
          style: this.mapStyle,
          center: this.oviedo,
          zoom: this.zoom
        });
        let marker1 = new mapboxgl.Marker()
            .setLngLat(this.oviedo)
            .addTo(map);
    }     

    toggleFullScreen() {
        var videoElement = document.getElementById("mapaDinamico");
        if (!document.mozFullScreen && !document.webkitFullScreen) {
            if (videoElement.mozRequestFullScreen) {
                videoElement.mozRequestFullScreen();
            } else {
                videoElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else {
                document.webkitCancelFullScreen();
            }
        }
    }
}

var g = new GeoLocalizacion();