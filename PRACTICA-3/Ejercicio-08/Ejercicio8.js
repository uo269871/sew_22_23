"use strict";
class Meteo {
    constructor(ciudad) {
        this.apikey = "b9a1c7779d5e3a1e0c4c45330a0f7752";
        this.ciudad = ciudad;
        this.url = "https://api.openweathermap.org/data/2.5/weather?q=" + this.ciudad + "&APPID=" + this.apikey;
        this.correcto = "¡Todo correcto! JSON recibido de <a href='http://openweathermap.org'>OpenWeatherMap</a>"
    }
    cargarDatos() {
        $.ajax({
            dataType: "json",
            url: this.url,
            method: 'GET',
            success: function(datos) {
                $("body").append('<h2></h2>');
                $("h2").html("Datos en JSON desde <a href='http://openweathermap.org'>OpenWeatherMap</a>");
                $("body").append('<h3></h3>');
                $('h3').html("¡Todo correcto! JSON recibido de <a href='http://openweathermap.org'>OpenWeatherMap</a>");
                $("body").append('<h4>Datos</h4>');
                var stringDatos = '<li><img alt="Imagen del tiempo" src="http://openweathermap.org/img/w/' + datos.weather[0].icon + '.png" height="64px" width="64px"></li>';
                stringDatos += "<li>Ciudad: " + datos.name + "</li>";
                stringDatos += "<li>País: " + datos.sys.country + "</li>";
                stringDatos += "<li>Latitud: " + datos.coord.lat + " grados</li>";
                stringDatos += "<li>Longitud: " + datos.coord.lon + " grados</li>";
                stringDatos += "<li>Temperatura: " + datos.main.temp + " grados Celsius</li>";
                stringDatos += "<li>Presión: " + datos.main.pressure + " milibares</li>";
                stringDatos += "<li>Humedad: " + datos.main.humidity + " %</li>";
                stringDatos += "<li>Amanece a las: " + new Date(datos.sys.sunrise * 1000).toLocaleTimeString() + "</li>";
                stringDatos += "<li>Oscurece a las: " + new Date(datos.sys.sunset * 1000).toLocaleTimeString() + "</li>";
                stringDatos += "<li>Dirección del viento: " + datos.wind.deg + " grados</li>";
                stringDatos += "<li>Velocidad del viento: " + datos.wind.speed + " metros/segundo</li>";
                stringDatos += "<li>Hora de la medida: " + new Date(datos.dt * 1000).toLocaleTimeString() + "</li>";
                stringDatos += "<li>Fecha de la medida: " + new Date(datos.dt * 1000).toLocaleDateString() + "</li>";
                stringDatos += "<li>Descripción: " + datos.weather[0].description + "</li>";
                stringDatos += "<li>Visibilidad: " + datos.visibility + " metros</li>";
                stringDatos += "<li>Nubosidad: " + datos.clouds.all + " %</li>";

                $("body").append('<ul></ul>');
                $("ul").html(stringDatos);
            },
            error: function() {
                $("h3").html("¡Tenemos problemas! No puedo obtener JSON de <a href='http://openweathermap.org'>OpenWeatherMap</a>");
                $("h4").remove();
                $("ul").remove();
            }
        });
    }
    verJSON() {
        $("ul").remove();
        $("section").empty();
        this.cargarDatos();
    }
}