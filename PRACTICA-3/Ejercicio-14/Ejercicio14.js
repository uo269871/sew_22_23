"use strict";

class F{
// TRACK
// FILE
// WEB STORAGE

    showPreviousData(){
        var s = document.querySelector("body > section");
        var datos = '<h2>Datos del audio</h2>';
        datos += '<p>Tamaño del archivo anterior: ' + localStorage.getItem("tamaño") + ' bytes</p>';
        datos += '<p>Nombre del archivo anterior: ' + localStorage.getItem("nombre") + '</p>';
        datos += '<p>Tipo del archivo anterior: ' + localStorage.getItem("tipo") + '</p>';
        s.innerHTML = datos;
    }

    loadFile(files) {
        var archivo = files[0]
        var lector = new FileReader();
        localStorage.setItem("tamaño",archivo.size)
        localStorage.setItem("nombre",archivo.name)
        localStorage.setItem("tipo",archivo.type)
        this.showPreviousData();

        lector.onload = function (event) {
             
        }
        lector.readAsArrayBuffer(archivo);

        var url = URL.createObjectURL(archivo);
        var a = document.querySelector("audio");

        a.src = url; 
        a.play();
    }

}

var f = new F();    