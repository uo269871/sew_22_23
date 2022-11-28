"use strict";
class Light {
    constructor(){

    }

    price() {
        const fecha = new Date()
        var url = 'https://apidatos.ree.es/es/datos/mercados/precios-mercados-tiempo-real?start_date=' + fecha.getFullYear() + '-' + fecha.getMonth() + '-' + fecha.getDate() + 'T00:00&end_date=' + fecha.getFullYear() + '-' + fecha.getMonth() + '-' + fecha.getDate() + 'T' + fecha.getHours() +':'+ fecha.getMinutes() + '&time_trunc=hour'
        $.ajax({
            url: url,
            dataType: 'json',
            success: function (json) {
                $('section').append('<h3>PVPC</h3>')
                $('section').append('<ul></ul>')
                var precios = json.included[0].attributes.values
                var html = ''
                for(var i = 0; i < precios.length; i++){
                    html += '<li>Precio a las ' + precios[i].datetime + ': ' + precios[i].value + '€</li>'
                }
                $('ul').html(html)
            },error: function(json){
                $("section").append(JSON.stringify(json,2,null))
            }
        })
    }

    create(type, text) {
        var elemento = document.createElement(type);
        elemento.innerHTML = text;
        $("section").append(elemento);
    }

    mostrar(){
        $("section").empty();
        this.create("h2", "Datos");
        this.price();
    }
}

var l = new Light();