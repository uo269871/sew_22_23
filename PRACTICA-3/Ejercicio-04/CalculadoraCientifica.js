"use strict";
class CalculadoraMilan {
    constructor() {
        this.operation = ""
        this.memory = ""
        this.pointUsed = false
        this.pantalla = ""
        document.addEventListener("keydown", (event) => this.manejarEvento(event));
    }

    manejarEvento(event) {
        switch (event.key) {
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
            this.operation += this.pantalla + '*100'
        } else if (this.operation.includes('*')) {
            this.operation += this.pantalla + '/100'
        } else if (this.operation.includes('+')) {
            var a = this.operation.split('+')
            this.operation = a[0] + '+' + a[0] * this.pantalla / 100
        } else if (this.operation.includes('-')) {
            var a = this.operation.split('-')
            this.operation = a[0] + '-' + a[0] * this.pantalla / 100
        } else{
            this.operation =  this.pantalla + '/100'
        }

        this.operation = eval(this.operation)
        console.log(this.operation)
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
class CalculadoraCientifica extends CalculadoraMilan{
    constructor(){
        super()
    }

    manejarEvento(event) {
        switch (event.key) {
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
            case '.':
                this.punto();
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
                this.digitos(event.key)
                break;
            case '(':
                this.parIzq()
                break;
            case ')':
                this.parDer()
                break;
            case '%':
                this.mod();
                break;
            case '!':
                this.fact();
                break;
            case 'Enter':
                this.igual();
                break;
            case 'Backspace':
                this.retroceder()
                break
            default:
                console.log(event.key)
        }
    
    }

    digitos(arg) {
        if (this.solved) {
            this.solved = false;
            this.operation = "";
            this.pantalla = ""
        }
        
        this.operation += arg;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    punto() {
        if (!this.pointUsed) {
            this.operation += '.'
            document.querySelector("body > form > input:nth-child(1)").value = this.operation;
            this.pointUsed = true
        }
    }

    suma() {
        this.operation += "+";
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
        this.solved = false;
        this.pointUsed = false;
    }

    resta() {
        this.operation += "-";
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
        this.solved = false;
        this.pointUsed = false;
    }

    mult() {
        this.operation += "*";
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
        this.solved = false;
        this.pointUsed = false;
    }

    div() {
        this.operation += "/";
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
        this.solved = false;
        this.pointUsed = false;
    }

    log(){
        this.operation = Math.log10(document.querySelector("body > form > input:nth-child(1)").value)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    pi(){
        this.operation = Math.PI
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    retroceder(){
        this.operation = this.operation.slice(0,this.operation.length-1)
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    pow10(){
        this.solved = false;
        this.pointUsed = false;
        this.operation += "**10";
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    x2(){
        this.solved = false;
        this.pointUsed = false;
        this.operation += "**2";
        document.querySelector("body > form > input:nth-child(1)").value = this.operation;
    }

    dosX(){
        this.operation = Math.pow(2,document.querySelector("body > form > input:nth-child(1)").value)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    xy(){
        this.operation = document.querySelector("body > form > input:nth-child(1)").value + "**"
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    flecha(){
        console.log('implementar')
    }

    mod(){
        this.operation = document.querySelector("body > form > input:nth-child(1)").value + "%"
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    sin(){
        this.operation = Math.sin(Number(document.querySelector("body > form > input:nth-child(1)").value))
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    cos(){
        this.operation = Math.cos(Number(document.querySelector("body > form > input:nth-child(1)").value))
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    tan(){
        this.operation = Math.tan(Number(document.querySelector("body > form > input:nth-child(1)").value))
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    parIzq(){
        this.operation = document.querySelector("body > form > input:nth-child(1)").value + "("
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    parDer(){
        this.operation = document.querySelector("body > form > input:nth-child(1)").value + ")"
        this.solved = false;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    exp(){
        this.operation = document.querySelector("body > form > input:nth-child(1)").value + ".e+"
        this.solved = false;
        this.pointUsed = true;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
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
        var i = Number(document.querySelector("body > form > input:nth-child(1)").value)
        this.operation = this.factorial(i)
        this.solved = true;
        this.pointUsed = false;
        document.querySelector("body > form > input:nth-child(1)").value = this.operation
    }

    mc(){
        this.memory = "";
    }

    mr(){
        document.querySelector("body > form > input:nth-child(1)").value = this.memory;
        this.operation = this.memory;
    }

    ms(){
        if (!isNaN(document.querySelector("body > form > input:nth-child(1)").value))
            this.memory = document.querySelector("body > form > input:nth-child(1)").value;
    }
}

var c = new CalculadoraCientifica();