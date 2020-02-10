<?php
echo
'
let botaoAddQuiz = document.querySelector("#botaoAddQuiz");
let tituloNovoQuiz = document.querySelector("#inputAddress");
let idUsuarioQuiz = document.querySelector("#idUsuario").value;
let listaPerguntas = document.querySelector("#listaPerguntas");
let botaoAddPergunta = document.querySelector("#botaoAddPergunta");
let numeroId = 1;
let numeroNomeRadio = 1;
let idPergunta;
let alternativaNova;
let vddOuFalso;
let campoVazioPerguntas = false;
let campoVazioAlternativas = false;
let radioCheck = false;


let addQuizAjax = function() {
    let perguntas = listaPerguntas.querySelectorAll(".pergunta");

    for(let i=0; i< perguntas.length; i++) {
        if (perguntas[i].value === ""){
            campoVazioPerguntas=true;
            console.log(campoVazioPerguntas);
            break;
        }
    }

    let quiz = {titulo: tituloNovoQuiz.value, idusuario: idUsuarioQuiz};

    if (tituloNovoQuiz.value === "" || campoVazioPerguntas===true){

        alert("Você não definiu o quiz!");
        campoVazioPerguntas=false;

    }else{
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/quiz/public/cadastra-quiz");
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onload = function () {
            if (xhr.status === 200) {

                let idQuizAdicionado = JSON.parse(xhr.responseText);

                if (idQuizAdicionado !== null) {
                    // let perguntas = listaPerguntas.querySelectorAll(".pergunta");
                    let perguntasAEnviar = [];

                    for (let i = 0; i < perguntas.length; i++) {
                        perguntasAEnviar.push(perguntas[i].value);
                    }

                    addPerguntasAjax(idQuizAdicionado, perguntasAEnviar);
                }
            }
        };
        xhr.send(JSON.stringify(quiz));
    }
};

let procuraTexto = function(valor, array){
    for(let i=0;i < array.length;i++){
        if (array[i][0].includes(valor)){

            vddOuFalso = true;
            idPergunta = array[i][1];
            break;
        } else {
            vddOuFalso =  false;
        }
    }
    return vddOuFalso;
};

let addPerguntasAjax = function(idQuizAdicionado, perguntas) {

    let alternativas = document.querySelectorAll(".alternativa");
    // let radio = document.querySelector(".radio");
    // console.log(radio);

    for(let i = 0; i< alternativas.length; i++){
        if(alternativas[i].value===""){
            campoVazioAlternativas=true;
            break;
        }
    }

    let perguntasNovas = {idquiz: idQuizAdicionado, perguntas:perguntas};
    console.log(perguntasNovas);
    if (campoVazioAlternativas===true){

        alert("Você não definiu o quiz!");
        campoVazioAlternativas=false;

    }else {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/quiz/public/cadastra-perguntas");
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onload = function () {
            if (xhr.status === 200) {
                let PerguntasEid = JSON.parse(xhr.responseText);
                let perguntasLista = listaPerguntas.querySelectorAll(".pergunta");
                let alternativasPraAdicionar = [];

                for (let i = 0; i < perguntasLista.length; i++) { //cada pergunta do quiz
                    radioCheck = false;
                    if (procuraTexto(perguntasLista[i].value, PerguntasEid) === true) {
                        let pergunta = perguntasLista[i];
                        let fieldset = pergunta.closest("fieldset");
                        let alternativas = fieldset.querySelectorAll(".alternativa");

                        for (let i = 0; i < alternativas.length; i++) {
                            let divAlternativa = alternativas[i].closest("div");
                            let radio = divAlternativa.querySelector("input[type=radio]");
                            console.log(radio);

                            if (radio.classList.contains("check") === true) {
                                alternativaNova = {
                                    idpergunta: idPergunta,
                                    descricao: alternativas[i].value,
                                    correta: 1
                                };
                            } else {
                                alternativaNova = {
                                    idpergunta: idPergunta,
                                    descricao: alternativas[i].value,
                                    correta: 0
                                };
                            }
                            alternativasPraAdicionar.push(alternativaNova);
                        }

                        let radios = fieldset.querySelectorAll("input.radio");

                        for(let i=0; i < radios.length;i++){
                            if(radios[i].classList.contains("check")){
                                radioCheck=true;
                                break;
                            }
                        }
                    }
                }
                if (radioCheck !== true){
                    alert("Você não definiu o quiz!");
                    radioCheck=false;
                }else{
                    console.log(alternativasPraAdicionar);
                    addAlternativasAjax(alternativasPraAdicionar);
                }
            }
        };

        xhr.send(JSON.stringify(perguntasNovas));
    }
};

let addAlternativasAjax = function(alternativas) {



    for(let i=0; i < alternativas.length; i++ ) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/quiz/public/cadastra-alternativas");
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onload = function () {
            if (xhr.status === 200) {

                let divAlerta = document.querySelector("#divAlerta");
                divAlerta.className = "alert alert-success";
                divAlerta.innerText = "Quiz salvo com sucesso";

            }
        };

        xhr.send(JSON.stringify(alternativas[i]));
    }
};

let addNovaPergunta = function(){

    let fieldsetPergunta = document.createElement("fieldset");
    fieldsetPergunta.className = "form-group";

    let divPergunta = document.createElement("div");
    divPergunta.className = "form-row";

    let divTexto = document.createElement("div");
    divTexto.className = "form-group col-md-6";

    let inputPergunta = document.createElement("input");
    inputPergunta.type = "text";
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

    let labelRadio = document.createElement("label");
    labelRadio.innerHTML = "Escolha a Correta";

    let divGroupLabelText = document.createElement("div");
    divGroupLabelText.className = "form-group col-md-6";

    let labelText = document.createElement("label");
    labelText.innerHTML = "Descrição";

    fieldsetAlternativas.appendChild(divRowLabel);
    divRowLabel.appendChild(divGroupLabelRadio);
    divGroupLabelRadio.appendChild(labelRadio);
    divRowLabel.appendChild(divGroupLabelText);
    divGroupLabelText.appendChild(labelText);

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
//    divTodasAlternativas.className = "input-group";

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

    console.log(elementoAtivo);
};

botaoAddQuiz.addEventListener("click", addQuizAjax);
botaoAddPergunta.addEventListener("click", addNovaPergunta);
';