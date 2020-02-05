<?php
    echo
'

let botaoProxima = document.querySelector("#botaoProxima");
let idQuiz = document.querySelector("#idQuiz");
let idUser = document.querySelector("#idUser");
let indiceListaPerguntas=1;
let divConteudo = document.querySelector("#conteudo");
let botaoResultado = document.querySelector("#botaoResultado");
let radios2 = document.querySelectorAll(".alternativa");
let idAlt;

let carregaProximaPergunta = function() {

    let idQuizAtual = {id: idQuiz.value, indice: indiceListaPerguntas};

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/proxima-pergunta");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {

            let dadosQuiz = JSON.parse(xhr.responseText);

            if(dadosQuiz["fim"]==="yes"){

                let botao = document.querySelector("#botaoProxima");
                botao.remove();

                let botaoResultado = document.createElement("button");
                divConteudo.appendChild(botaoResultado);
                botaoResultado.innerText = "Resultado";
                botaoResultado.id = "botaoResultado";
                botaoResultado.className = "btn btn-light";
            }else {

                let titulo = document.querySelector("h1");
                titulo.innerHTML = dadosQuiz["titulo"];

                let pergunta = document.querySelector("h2");
                pergunta.innerHTML = dadosQuiz["listaPerguntas"][0]["titulo"];

                let lista = document.querySelector("#listaAlt");
                let listaDeLi = lista.querySelectorAll("button");
                // let listaDeRadio = lista.querySelectorAll("input[type=radio]");

                for (let i = 0; i < listaDeLi.length; i++) {
                    listaDeLi[i].remove("button");
                }

                // for (let i = 0; i < listaDeRadio.length; i++) {
                //     listaDeRadio[i].remove("li");
                // }

                for (let i = 0; i < dadosQuiz["listaAlternativas"].length; i++) {

                    // let radioAlternativa = document.createElement("input");
                    // radioAlternativa.type = "radio";
                    // radioAlternativa.className = "radio";
                    // radioAlternativa.id = dadosQuiz["listaAlternativas"][i]["idalternativas"];


                    let liAlternativa = document.createElement("button");
                    liAlternativa.type = "button";
                    liAlternativa.innerText = dadosQuiz["listaAlternativas"][i]["descricao"];
                    liAlternativa.className = "list-group-item list-group-item-action alternativa";
                    liAlternativa.id = dadosQuiz["listaAlternativas"][i]["idalternativas"];

                    // lista.appendChild(radioAlternativa);
                    lista.appendChild(liAlternativa);
                }

                let radios = document.querySelectorAll(".alternativa");
                console.log(radios);

                for(let i = 0; i < radios.length; i++){
                    radios[i].addEventListener("click", checkRadioButton);

                }

                // for(let i = 0; i < radios.length; i++){
                //     if(radios[i].classList.contains("check")){
                //         idAlt = radios[i].id;
                //     }
                // }
            }

        }
    };
    indiceListaPerguntas++;
    xhr.send(JSON.stringify(idQuizAtual));

};

let checkRadioButton = function (event) {
    let elementoAtivo = event.currentTarget;
    console.log(elementoAtivo);

    if(elementoAtivo.classList.contains("active")){
        console.log("possui a classe");
        elementoAtivo.className = "list-group-item list-group-item-action alternativa";
        console.log(idAlt.value);
    }else {
        elementoAtivo.className = "list-group-item list-group-item-action alternativa active";
        idAlt = elementoAtivo.id;
    }
};

let salvaRespostaAjax = function() {

    // for(let i=0; i < radios2.length;i++){
    //
    //     if(radios2[i].classList.contains("check")){
    //         idAlt = radios2[i].id;
    //     }
    // }
    idPergunta = document.querySelector("#idPergunta").value;
    let resposta = {iduser: idUser.value, idResp: idAlt};

    console.log(resposta);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/cadastra-respostas");
    xhr.setRequestHeader("Content-Type", "application/json");

       xhr.send(JSON.stringify(resposta));
};

console.log(radios2);
for(let i = 0; i < radios2.length; i++){
    radios2[i].addEventListener("click", checkRadioButton);
}
botaoProxima.addEventListener("click", carregaProximaPergunta);
botaoProxima.addEventListener("click", salvaRespostaAjax);
';