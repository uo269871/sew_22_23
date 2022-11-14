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

    percentage(){
        if(this.operation.includes('/') ){
            this.operation += '*100'
        } else if(this.operation.includes('*')){
            this.operation += '/100'
        } else if(this.operation.includes('+')){
            var a = this.operation.split('+')
            this.operation = a[0] + '+' + a[0]*a[1]/100
        } else if(this.operation.includes('-')){
            var a = this.operation.split('-')
            this.operation = a[0] + '-' + a[0]*a[1]/100
        }
             
        this.operation = eval(this.operation)
        
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    sign(){
        this.operation = eval(this.operation);
        this.operation = eval(this.operation + '*-1')
        this.solved = false;
        if(!this.pointUsed)
            this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    borrar() {
        document.querySelector("body > form > input:nth-child(1)").value = "";
        this.operation = "";
        this.solved = false;
        this.pointUsed = false;
    }

    borrarTodo(){
        this.borrar();
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

class CalculadoraCientifica extends CalculadoraBasica{
    constructor(){
        super()
    }

    ln(){
        this.operation = Math.log(document.querySelector("body > form > textarea").textContent)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    log(){
        this.operation = Math.log10(document.querySelector("body > form > textarea").textContent)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    pi(){
        this.operation = Math.PI
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    e(){
        this.operation = Math.E
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    abs(){
        this.operation = Math.abs(document.querySelector("body > form > textarea").textContent)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    fact(){
        this.operation = Math.PI
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    pow10(){
        this.operation = Math.pow(10,document.querySelector("body > form > textarea").textContent)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    x2(){
        this.operation = Math.pow(document.querySelector("body > form > textarea").textContent,2)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    x3(){
        this.operation = Math.pow(document.querySelector("body > form > textarea").textContent,3)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    dosX(){
        this.operation = Math.pow(2,document.querySelector("body > form > textarea").textContent)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    xy(){
        this.operation = document.querySelector("body > form > textarea").textContent + "**"
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    ex(){
        this.operation = Math.exp(Number(document.querySelector("body > form > textarea").textContent))
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
        
    }


    v3(){
        this.operation = Math.cbrt(Number(document.querySelector("body > form > textarea").textContent))
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    inv(){
        this.operation = "1/" + document.querySelector("body > form > textarea").textContent
        this.solved = true
        this.pointUsed = false
        document.querySelector("body > form > textarea").textContent = eval(this.operation)
    }

    mod(){
        this.operation = document.querySelector("body > form > textarea").textContent + "%"
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    sin(){
        this.operation = Math.sin(Number(document.querySelector("body > form > textarea").textContent))
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    cos(){
        this.operation = Math.cos(Number(document.querySelector("body > form > textarea").textContent))
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    tan(){
        this.operation = Math.tan(Number(document.querySelector("body > form > textarea").textContent))
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    parIzq(){
        this.operation = document.querySelector("body > form > textarea").textContent + "("
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    parDer(){
        this.operation = document.querySelector("body > form > textarea").textContent + ")"
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    exp(){
        this.operation = document.querySelector("body > form > textarea").textContent + ".e+"
        this.solved = false;
        this.pointUsed = true;
        document.querySelector("body > form > textarea").textContent = this.operation
    }
      
    factorial(n) {
        var f = [];
        if (n == 0 || n == 1)
            return 1;
        if (f[n] > 0)
            return f[n];
        return f[n] = this.factorial(n - 1) * n;
    }

    fact(){
        var i = Number(document.querySelector("body > form > textarea").textContent)
        this.operation = this.factorial(i)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > textarea").textContent = this.operation
    }

    mc(){
        this.memory = "";
    }

    mr(){
        document.querySelector("body > form > textarea").textContent = this.memory;
        this.operation = this.memory;
    }

    ms(){
        if (!isNaN(document.querySelector("body > form > textarea").textContent))
            this.memory = document.querySelector("body > form > textarea").textContent;
    }
}

var c = new CalculadoraCientifica();