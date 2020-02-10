<?php
    echo
'

let botaoAddPergunta = document.querySelector("#botaoAddPergunta");
let botoesAddAlternativa = document.querySelectorAll("button.mb-2");
let botaoAddQuiz = document.querySelector("#botaoAddQuiz");
let numeroNomeRadio = 1;
let numeroId = 1;
let tituloIncompleto=false;
let idquiz = document.querySelector("#idquiz").value;
let tituloQuiz = document.querySelector("#inputAddress").value;
let perguntas = document.querySelectorAll(".pergunta");
let perguntaIncompleta=false;
let radioRespondido=true;
let alternativaIncompleta=false;
let arrayPerguntas = [];
let arrayAlternativas = [];
let altCorreta;

let addNovaPergunta = function(){

    let fieldsetPergunta = document.createElement("fieldset");
    fieldsetPergunta.className = "form-group";

    let divPergunta = document.createElement("div");
    divPergunta.className = "form-row";

    let divTexto = document.createElement("div");
    divTexto.className = "form-group col-md-6";

    let inputPergunta = document.createElement("input");
    inputPergunta.type = "text";
    inputPergunta.placeholder = "Nova Pergunta";
    inputPergunta.className = "form-control pergunta";

    let divBotao = document.createElement("div");
    divBotao.className = "form-group col-md-2";

    let botaoAddAlternativa =  document.createElement("button");
    botaoAddAlternativa.type = "submit";
    botaoAddAlternativa.className ="btn btn-primary mb-2";
    botaoAddAlternativa.innerHTML = "Criar Alternativa";

    let fieldsetAlternativas = document.createElement("fieldset");
    fieldsetAlternativas.className = "form-check";

    let divRowLabel = document.createElement("div");
    divRowLabel.className = "form-row";

    let divGroupLabelRadio = document.createElement("div");
    divGroupLabelRadio.className = "form-group col-md-6";

    let labelRadio = document.createElement("h6");

    let labelRadioHighlight = document.createElement("mark");
    labelRadioHighlight.innerText = "Escolha a alternativa correta";

    let divGroupLabelText = document.createElement("div");
    divGroupLabelText.className = "form-group col-md-6";



    fieldsetAlternativas.appendChild(divRowLabel);
    divRowLabel.appendChild(divGroupLabelRadio);
    divGroupLabelRadio.appendChild(labelRadio);
    labelRadio.appendChild(labelRadioHighlight);

    fieldsetPergunta.appendChild(divPergunta);
    fieldsetPergunta.appendChild(fieldsetAlternativas);
    listaPerguntas.appendChild(fieldsetPergunta);
    divPergunta.appendChild(divTexto);
    divTexto.appendChild(inputPergunta);
    divPergunta.appendChild(divBotao);
    divBotao.appendChild(botaoAddAlternativa);

    let botoesalternativas = listaPerguntas.querySelectorAll("button[type=submit]");

    for(let i=0;i < botoesalternativas.length;i++){
        botoesalternativas[i].addEventListener("click", addNovaAlternativa);
    }

    numeroNomeRadio++;
};

let addNovaAlternativa = function(){

    let divTodasAlternativas =  document.createElement("div");
    divTodasAlternativas.className = "input-group mb-3";

    let divInputGroup = document.createElement("div");
    divInputGroup.className = "input-group-prepend";

    let divRadio =  document.createElement("div");
    divRadio.className = "input-group-text radio";

    let inputRadio = document.createElement("input");
    inputRadio.className = "radio";
    inputRadio.type = "radio";
    inputRadio.id = "inlineRadio" + numeroId;
    inputRadio.value = "option" + numeroId;
    inputRadio.name = "inlineRadioOptions" + numeroNomeRadio;

    let inputAlternativa = document.createElement("input");
    inputAlternativa.type = "text";
    inputAlternativa.placeholder = "Nova Alternativa";
    inputAlternativa.className = "form-control alternativa";
    inputAlternativa.id = "alternativaTexto" + numeroId;

    botaoParent = this.parentNode;
    divParent = botaoParent.closest(".form-row");
    fieldsetParent = divParent.closest("fieldset");
    fieldsetAlternativas = fieldsetParent.querySelector("fieldset");

    fieldsetAlternativas.appendChild(divTodasAlternativas);
    divTodasAlternativas.appendChild(divInputGroup);
    divInputGroup.appendChild(divRadio);
    divRadio.appendChild(inputRadio);
    divTodasAlternativas.appendChild(inputAlternativa);

    numeroId++;

    inputRadio.addEventListener("click", checkRadioButton);
};

let checkRadioButton = function (event) {
    let elementoAtivo = event.currentTarget;

    if(elementoAtivo.classList.contains("check")){
        elementoAtivo.className = "radio";
    }else {
        elementoAtivo.className = "radio check";
    }
};

let confereQuiz = function(){

    if (tituloQuiz === "") {
        tituloIncompleto = true;
    }

    for (let i = 0; i < perguntas.length; i++) {
        if (perguntas[i].value === "") {
            perguntaIncompleta = true;
            break;
        } else {
            let fieldset = perguntas[i].closest("fieldset");
            let radio = fieldset.querySelectorAll("input.radio");
            let idPergunta = fieldset.querySelector("#idPergunta");

            for (let i = 0; i < radio.length; i++) {
                if (radio[i].classList.contains("check") === true) {
                    radioNaoRespondido = false;
                    break;
                }else{
                    radioNaoRespondido = true;
                }
            }
            if (radioNaoRespondido === true) {
                break;
            }

            perguntaEditada = {
                idquiz: idquiz,
                tituloPergunta: perguntas[i].value
            }

            arrayPerguntas.push(perguntaEditada);

            let alternativas = fieldset.querySelectorAll(".alternativas");
            console.log(fieldset);

            for (let i = 0; i < alternativas.length; i++) {

                if (alternativas[i].value === "") {
                    alternativaIncompleta = true;
                    break;
                }

                divAlternativa = alternativas[i].closest("div");
                radioAlternativa = divAlternativa.querySelector(".radio");

                if(radioAlternativa.classList.contains("check") === true){
                    altCorreta = 1;
                }else{
                    altCorreta = 0;
                }

                alternativaEditada = {
                    idpergunta: idPergunta,
                    descricao: alternativas[i].value,
                    correta: altCorreta
                };

                arrayAlternativas.push(alternativaEditada);
            }
        }
    }

    if (tituloIncompleto === true || perguntaIncompleta === true ||
        alternativaIncompleta === true) {
        // radioNaoRespondido === true || alternativaIncompleta === true) {

        alert("Você não definiu o quiz!");
        tituloIncompleto = false;
        perguntaIncompleta = false;
        // radioNaoRespondido = false;
        alternativaIncompleta = false;
    } else {
        quizEditado = {titulo: tituloQuiz};
        console.log(quizEditado);
        editaQuizAjax(quizEditado);

        for (let i = 0; i < arrayPerguntas.length; i++) {
            editaPerguntasAjax(arrayPerguntas[i]);
        }
        console.log(arrayPerguntas);


        for (let i = 0; i < arrayAlternativas.length; i++) {
            editaAlternativasAjax(arrayAlternativas[i]);
        }
        console.log(arrayAlternativas);

    }
};

let editaAlternativasAjax = function(alternativa){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/edita-alternativas");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log("edita alt");
            // let divAlerta = document.querySelector("#divAlerta");
            // divAlerta.className = "alert alert-success";
            // divAlerta.innerText = "Quiz editado com sucesso";
        }
    };

    xhr.send(JSON.stringify(alternativa));
};

let editaPerguntasAjax = function(pergunta){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/edita-perguntas");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function () {
        if (xhr.status === 200) {

            console.log("edita p");
            // let divAlerta = document.querySelector("#divAlerta");
            // divAlerta.className = "alert alert-success";
            // divAlerta.innerText = "Quiz salvo com sucesso";

        }
    };

    xhr.send(JSON.stringify(pergunta));
};

let editaQuizAjax = function(quiz){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/edicao-quiz");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function () {
        if (xhr.status === 200) {

            console.log("edita quiz");
            // let divAlerta = document.querySelector("#divAlerta");
            // divAlerta.className = "alert alert-success";
            // divAlerta.innerText = "Quiz salvo com sucesso";
        }
    };

    xhr.send(JSON.stringify(quiz));
};

botaoAddQuiz.addEventListener("click", confereQuiz);
botaoAddPergunta.addEventListener("click", addNovaPergunta);

';