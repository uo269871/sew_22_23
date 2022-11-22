"use strict";
class CalculadoraBasica {
    constructor() {
        this.operation = ""
        this.memory = ""
        this.pointUsed = false
        this.pantalla = ""
        document.addEventListener("keydown", (event) => this.manejarEvento(event));
    }

    manejarEvento(event) {
        const keyName = event.key.replace(/[^\d.\-\/\*\+]/g, '');
        switch (keyName) {
            case '+':
                this.suma()
                break;
            case '-':
                this.resta()
                break;
            case '*':
                this.mult()
                break;
            case '/':
                this.div()
                break;
            case '0':
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
                this.digitos(keyName)
                break;
        }
        if (event.code.match("Enter")) {
            this.igual();
        }
    }

    digitos(arg) {
        if (this.solved) {
            this.solved = false;
            this.operation = "";
            this.pantalla = ""
        }
        if (this.pantalla.length <= 7 || (this.pantalla.length <= 8 && this.pantalla.includes('.'))) {
            this.pantalla += arg;
        }

        document.querySelector("body > form > input:nth-child(1)").value = this.pantalla;
    }

    punto() {
        if (!this.pointUsed) {
            this.pantalla += '.'
            document.querySelector("body > form > input:nth-child(1)").value = this.pantalla;
            this.pointUsed = true
        }
    }

    suma() {
        this.operation = Number(eval(this.operation + this.pantalla));
        this.operation += "+";
        this.pantalla = ''
        this.solved = false;
        this.pointUsed = false;
    }

    resta() {
        this.operation = Number(eval(this.operation + this.pantalla));
        this.operation += "-";
        this.pantalla = ''
        this.solved = false;
        this.pointUsed = false;
    }

    mult() {
        this.operation = Number(eval(this.operation + this.pantalla));
        this.operation += "*";
        this.pantalla = ''
        this.solved = false;
        this.pointUsed = false;
    }

    div() {
        this.operation = Number(eval(this.operation + this.pantalla));
        this.operation += "/";
        this.pantalla = ''
        this.solved = false;
        this.pointUsed = false;
    }

    igual() {
        this.operation = Number(eval(this.operation + this.pantalla));
        this.pantalla = this.operation
        document.querySelector("body > form > input:nth-child(1)").value = this.pantalla;
        this.operation = ''
        this.solved = true;
        this.pointUsed = false;
    }

    root() {
        this.pantalla = Math.sqrt(Number(this.pantalla))
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.pantalla
    }

    percentage() {
        if (this.operation.includes('/')) {
            this.operation += '*100'
        } else if (this.operation.includes('*')) {
            this.operation += '/100'
        } else if (this.operation.includes('+')) {
            var a = this.operation.split('+')
            this.operation = a[0] + '+' + a[0] * a[1] / 100
        } else if (this.operation.includes('-')) {
            var a = this.operation.split('-')
            this.operation = a[0] + '-' + a[0] * a[1] / 100
        }

        this.operation = eval(this.operation)

        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    sign() {
        this.pantalla = eval(this.pantalla + '*-1')
        document.querySelector("body > form > input:nth-child(1)").value = this.pantalla
    }

    borrar() {
        this.pantalla = ''
        document.querySelector("body > form > input:nth-child(1)").value = "";
        this.solved = false;
        this.pointUsed = false;
    }

    borrarTodo() {
        this.borrar();
        this.operation = ''
        this.memory = "";
    }

    mMenos() {
        if (!Number(document.querySelector("body > form > input:nth-child(1)").value).isNaN) {
            this.memory = Number(eval(this.memory + "-" + document.querySelector("body > form > input:nth-child(1)").value));
            this.operation = this.memory;
            document.querySelector("body > form > input:nth-child(1)").value = this.operation;
            this.solved = true
            this.pointUsed = false;
        }
    }

    mMas() {
        if (!Number(document.querySelector("body > form > input:nth-child(1)").value).isNaN) {
            this.memory = Number(eval(this.memory + "+" + document.querySelector("body > form > input:nth-child(1)").value));
            this.operation = this.memory;
            document.querySelector("body > form > input:nth-child(1)").value = this.operation;
            this.solved = true
            this.pointUsed = false;
        }
    }

    mrc() {
        var result = this.memory;
        document.querySelector("body > form > input:nth-child(1)").value = result;
        this.operation = resultado;
        this.memory = "";
        this.solved = true
        this.pointUsed = false;
    }

}

var c = new CalculadoraBasica()