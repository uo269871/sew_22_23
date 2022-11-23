"use strict"

class StackLIFO{

    constructor(){
        this.datos = new Array();
    }

    push(arg){
        this.datos.push(arg);
    }

    pop(){
        return this.datos.pop();
    }

    show(){
        var s = ""
        var tam = this.size() - 1

        for(var i in this.datos){
            s += 'Indice: ' + tam-- +"\t Valor: " + this.datos[i] +"\n"
        }

        return s;
    }

    size(){
        return this.datos.length;
    }

}


class CalculadoraRPN{
    constructor(){
        this.screen = '';
        this.pila = new StackLIFO();
        this.pointUsed = false

        document.addEventListener("keydown", (event) => {
            if (["*", "/", "-", "+", "."].some(el => event.key.includes(el))) {
                switch (event.key) {
                    case "+":
                        this.suma()
                        break;
                    case "-":
                        this.resta()
                        break;
                    case "*":
                        this.mult()
                        break;
                    case "/":
                        this.div()
                        break;
                    case ".":
                        this.punto()
                        break;
                }
            }
            else if (!isNaN(event.key)) {
                this.digitos(event.key)
            }
            else if (event.key == "Enter") {
                this.enter()
            }
        });
    }

    enter(){
        if(this.screen.length == 0)
            return
        var i = this.screen
        this.pila.push(i);
        this.screen = ''
        document.querySelector("#pantalla").textContent = this.screen
        document.querySelector("#pila").textContent = this.pila.show();
    }

    digitos(num){
        this.screen += num
        document.querySelector("#pantalla").textContent = this.screen
    }

    punto() {
        if(!this.pointUsed){
            this.screen += ".";
            document.querySelector("#pantalla").textContent = this.screen;
            this.pointUsed = true
        }
    }

    suma() {
        if(this.pila.size()>= 2){
            var j = Number.parseFloat(this.pila.pop())
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(i+j)
            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    resta() {
        if(this.pila.size()>= 2){
            var j = Number.parseFloat(this.pila.pop())
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(i-j)
            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    mult() {
        if(this.pila.size()>= 2){
            var j = Number.parseFloat(this.pila.pop())
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(i*j)
            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    div() {
        if(this.pila.size()>= 2){
            var j = Number.parseFloat(this.pila.pop())
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(i/j)

            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    sin(){
        if(this.pila.size()>= 1){
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(Math.sin(i))

            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    cos(){
        if(this.pila.size()>= 1){
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(Math.cos(i))

            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    tan(){
        if(this.pila.size()>= 1){
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(Math.tan(i))

            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    asin(){
        if(this.pila.size()>= 1){
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(Math.asin(i))

            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    acos(){
        if(this.pila.size()>= 1){
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(Math.acos(i))

            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    atan(){
        if(this.pila.size()>= 1){
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(Math.atan(i))

            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    raiz(){
        if(this.pila.size()>= 1){
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(Math.sqrt(i))

            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    pow(){
        if(this.pila.size()>= 1){
            var i = Number.parseFloat(this.pila.pop())
            this.pila.push(Math.pow(i,2))

            this.solved = false;
            this.pointUsed = false;
            document.querySelector("#pila").textContent = this.pila.show();
        }
    }

    borrar(){
        this.pointUsed = false
        this.screen = ''
        document.querySelector("#pantalla").textContent = this.screen;
    }
}

var c = new CalculadoraRPN();