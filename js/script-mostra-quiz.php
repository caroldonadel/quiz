<?php
echo
'

let botaoProxima = document.querySelector("button");
let inputHidden = document.querySelector("input[type=hidden");
let indiceListaPerguntas=0;

let carregaProximaPergunta = function() {

    let idQuizAtual = {id: inputHidden.value, indice: indiceListaPerguntas};

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/proxima-pergunta");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {

            let dadosQuiz = JSON.parse(xhr.responseText);
            let titulo = document.querySelector("h1");
            titulo.innerHTML  = dadosQuiz["titulo"];

            let pergunta = document.querySelector("p");
            pergunta.innerHTML = dadosQuiz["listaPerguntas"]["1"]["titulo"];


            // let divAlerta = document.querySelector("#divAlerta");
            // divAlerta.className = "alert alert-success";
            // divAlerta.innerText = "Quiz salvo com sucesso";
            //
            // let perguntas = listaPerguntas.querySelectorAll(".pergunta");
            // // let perguntas = listaPerguntas.querySelectorAll("input[type=text]");
            // let perguntasAEnviar = [];
            //
            // for(let i=0;i < perguntas.length;i++){
            //     console.log(perguntas[i].value);
            //     perguntasAEnviar.push(perguntas[i].value);
            // }
            // console.log(perguntasAEnviar);
            //
            // addPerguntasAjax(idQuizAdicionado, perguntasAEnviar);
        }
    };
    indiceListaPerguntas++;
    console.log(indiceListaPerguntas);
    xhr.send(JSON.stringify(idQuizAtual));
};

botaoProxima.addEventListener("click", carregaProximaPergunta);
';