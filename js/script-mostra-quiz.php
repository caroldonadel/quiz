<?php
echo
'

let botaoProxima = document.querySelector("#botaoProxima");
let idQuiz = document.querySelector("#idQuiz");
let idUser = document.querySelector("idUser");
let indiceListaPerguntas=1;
let divConteudo = document.querySelector("#conteudo");
let botaoResultado = document.querySelector("#botaoResultado");
let radios2 = document.querySelectorAll(".radio");

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
            }else {

                let titulo = document.querySelector("h1");
                titulo.innerHTML = dadosQuiz["titulo"];

                let pergunta = document.querySelector("p");
                pergunta.innerHTML = dadosQuiz["listaPerguntas"][0]["titulo"];

                let lista = document.querySelector("#listaAlt");
                let listaDeLi = lista.querySelectorAll("li");
                let listaDeRadio = lista.querySelectorAll("input[type=radio]");

                for (let i = 0; i < listaDeLi.length; i++) {
                    listaDeLi[i].remove("li");
                }

                for (let i = 0; i < listaDeRadio.length; i++) {
                    listaDeRadio[i].remove("li");
                }

                for (let i = 0; i < dadosQuiz["listaAlternativas"].length; i++) {

                    let radioAlternativa = document.createElement("input");
                    radioAlternativa.type = "radio";
                    radioAlternativa.className = "radio";
                    radioAlternativa.id = dadosQuiz["listaAlternativas"][i]["idalternativas"];

                    let liAlternativa = document.createElement("li");
                    liAlternativa.innerText = dadosQuiz["listaAlternativas"][i]["descricao"];

                    lista.appendChild(radioAlternativa);
                    lista.appendChild(liAlternativa);
                }

                let radios = document.querySelectorAll(".radio");
                console.log(radios);

                for(let i = 0; i < radios.length; i++){
                    radios[i].addEventListener("click", checkRadioButton);
                }
            }

        }
    };
    indiceListaPerguntas++;
    xhr.send(JSON.stringify(idQuizAtual));

};

let salvaRespostaAjax = function() {

    console.log("salvar resposta");
    let elementoAtivo = event.currentTarget;
    console.log(elementoAtivo);
    let idAlt = elementoAtivo.id;
    idPergunta = document.querySelector("#idPergunta").value;
    let resposta = {idpergunta: idPergunta, iduser: idUser, idResp: idAlt};

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/salva-resposta");
    xhr.setRequestHeader("Content-Type", "application/json");

       xhr.send(JSON.stringify(resposta));
}

let checkRadioButton = function (event) {
    let elementoAtivo = event.currentTarget;
    console.log("teste 1");
    console.log(elementoAtivo);

    if(elementoAtivo.classList.contains("check")){
        elementoAtivo.className = "radio";
    }else {
        elementoAtivo.className = "radio check";
    }
};

console.log(radios2);
for(let i = 0; i < radios2.length; i++){
    radios2[i].addEventListener("click", checkRadioButton);
}
botaoProxima.addEventListener("click", carregaProximaPergunta);
botaoProxima.addEventListener("click", salvaRespostaAjax);
';