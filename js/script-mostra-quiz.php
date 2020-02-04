<?php
echo
'

let botaoProxima = document.querySelector("button");
let inputHidden = document.querySelector("input[type=hidden");


let carregaProximaPergunta = function() {

    let idQuizAtual = {id: inputHidden.value};

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/proxima-pergunta");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {

            let dadosQuiz = JSON.parse(xhr.responseText);
            let titulo = document.querySelector("h1");
            console.log(dadosQuiz["listaPerguntas"]["1"]);
            titulo.innerHTML  = dadosQuiz["titulo"];
            // titulo.innerHTML  = "teste";

            let div1 = document.getElementById("dom-target1");
            div1.textContent = dadosQuiz["listaPerguntas"];
            let div2 = document.getElementById("dom-target2");
            div2.textContent = dadosQuiz["listaAlternativas"];

            console.log(dadosQuiz["listaPerguntas"]);
            console.log(dadosQuiz["listaAlternativas"]);

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

    xhr.send(JSON.stringify(idQuizAtual));
};

botaoProxima.addEventListener("click", carregaProximaPergunta);
';