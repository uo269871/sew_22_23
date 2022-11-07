"use strict";
class CalculadoraBasica{
    constructor(){
        this.operation = ""
        this.memory = ""
        this.pointUsed = false

        document.addEventListener("keydown", (event) => {
            const keyName = event.key.replace(/[^\d.\-\/\*\+]/g, '');
            if (this.solved && !["*", "/", "-", "+"].some(el => keyName.includes(el))) {
                document.querySelector("body > form > input:nth-child(1)").value = "";
                this.solved = false;
                this.operation = "";
                
            }
            if (["*", "/", "-", "+"].some(el => keyName.includes(el))) {
                this.solved = false;
            }
            document.querySelector("body > form > input:nth-child(1)").value += keyName;
            this.operation += keyName
            if (event.code.match("Enter")) {
                this.igual();
                this.solved = true;
            }
        });
    }

    digitos(arg) {
        if (this.solved) {
            document.querySelector("body > form > input:nth-child(1)").value = "";
            this.solved = false;
            this.operation = "";
            this.shown = ""
        }
        this.operation += arg;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    punto() {
        if(!this.pointUsed){
            this.operation += ".";
            document.querySelector("body > form > input:nth-child(1)").value = this.operation;
            this.pointUsed = true
        }
    }

    suma() {
        this.operation += "+";
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    resta() {
        this.operation += "-";
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    mult() {
        this.operation += "*";
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    div() {
        this.operation += "/";
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    igual() {
        this.operation = Number(eval(this.operation));
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
        this.solved = true;
        this.pointUsed = false;
    }

    root(){
        this.operation = Math.sqrt(Number(document.querySelector("body > form > input:nth-child(1)").value))
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    borrar() {
        document.querySelector("body > form > input:nth-child(1)").value = "";
        this.operation = "";
        this.pointUsed = false;
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