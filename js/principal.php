<?php

echo '
let botaoAddQuiz = document.querySelector("#botaoAddQuiz");
let tituloNovoQuiz = document.querySelector("#inputAddress");
let idUsuarioQuiz = document.querySelector("#idUsuario");
let listaPerguntas = document.querySelector("#listaPerguntas");
let botaoAddPergunta = document.querySelector("#botaoAddPergunta");
let numeroId = "1";
let perguntas = document.querySelectorAll("input[type=text]");

let addQuizAjax = function() {
    let quiz = {titulo: tituloNovoQuiz.value, idusuario: idUsuarioQuiz.value};
    console.log("js chamado");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/cadastra-quiz");
    xhr.setRequestHeader("Content-Type", "application/json");
    
     xhr.onload = function() {   if (xhr.status === 200) { 
//     console.log("ok");  
//      let resultado =  JSON.parse(xhr.responseText);
//      console.log(resultado);

        let divAlerta = document.querySelector("#divAlerta");
        divAlerta.className = "alert alert-success";
        divAlerta.innerText = "Quiz salvo com sucesso";
     }
         }
    xhr.send(JSON.stringify(quiz));
};

let addNovaPergunta = function(){

    let divPergunta = document.createElement("div");
    divPergunta.className = "form-inline";
    let inputRadio = document.createElement("input");
//    inputRadio.type = "radio";
//    inputRadio.value = "option" + numeroId;
//    inputRadio.className = "form-check-input";
//    inputRadio.name = "exampleRadios";
//    inputRadio.id = "exampleRadios" + numeroId;
    let inputLabel = document.createElement("input");
    inputLabel.type = "text";
    inputLabel.className = "form-control col-sm-30 justify-content-between";
    inputLabel.setAttribute("for", ("exampleRadios" + numeroId));
    inputLabel.setAttribute("placeholder", "Pergunta Nova");
    let divInput = document.createElement("div");
    divInput.className = "form-group mb-2";
    let botaoAddAlternativa =  document.createElement("button");
    botaoAddAlternativa.className ="btn btn-primary mb-2";
    botaoAddAlternativa.innerHTML = "Criar Alternativa";
    let divRow = document.createElement("div");
    
    divPergunta.appendChild(divInput);
    divInput.appendChild(inputLabel);
    divPergunta.appendChild(botaoAddAlternativa);
    listaPerguntas.appendChild(divPergunta);
    
    numeroId++;
    console.log(numeroId);
}

botaoAddQuiz.addEventListener("click", addQuizAjax);
botaoAddPergunta.addEventListener("click", addNovaPergunta);
';

