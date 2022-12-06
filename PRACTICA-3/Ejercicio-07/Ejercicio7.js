"use strict"
class Ejercicio7 {
    constructor() { }

    show() {
        $("p").show();
        $("table").show();
    }

    hide() {
        $("p").hide();
        $("table").hide();
    }

    change() {
        $("h2").text("Comienzos");
    }

    add() {
        $("table").after("<footer><address>uo269871@uniovi.es</address></footer>");
    }

    remove() {
        $("h1").remove();
        $("footer").remove();
    }

    run() {
        
        var t = ''
        $("*", document.body).each(function () {
            var etiquetaPadre = $(this).parent().get(0).tagName;
            if (!this.toString().includes('HTMLTable')) {
                t += "Etiqueta padre : <" + etiquetaPadre + "> elemento : <" + $(this).get(0).tagName + "> valor: " +  $(this).parent().get(0).text + '\n';
            }
            else {
                $(this).prepend(document.createTextNode("Etiqueta padre : <" + etiquetaPadre + "> elemento : <" + $(this).get(0).tagName + "> valor: "));
            }
        });
        $("textarea").remove()
        $("body").append('<textarea id="recorrer" readonly></textarea>');
        $("textarea").text(t);
    }

    sum() {
        $("textarea").remove()
        $("body").append('<textarea id="total" readonly></textarea>');
        $(document).ready(function () {
            var total = 0;
            $("table td").each(function () {
                if (!isNaN($(this).text()))
                    total += parseInt($(this).text());
            });
            $("textarea").text("El total es: " + total);
        });
    }
}
var ejercicio7 = new Ejercicio7();