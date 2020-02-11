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
// let perguntas = document.querySelectorAll(".pergunta");
let perguntaIncompleta=false;
// let radioRespondido=true;
let alternativaIncompleta=false;
let altCorreta;
let campoVazioAlternativas = false;

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

    let perguntas = document.querySelectorAll(".pergunta");
    let perguntasValor = [];
    let perguntasCompletas = [];

    let arrayPerguntas = [];
    let arrayAlternativas = [];

    if (tituloQuiz === "") {
        tituloIncompleto = true;
    }

    for (let i = 0; i < perguntas.length; i++) {
        if (perguntas[i].value === "") {
            perguntaIncompleta = true;
            break;
        } else {
            let fieldset = perguntas[i].closest("fieldset");
            // let radio = fieldset.querySelectorAll("input.radio");
            let idPergunta = fieldset.querySelector("#idPergunta");

            if(idPergunta !== null){

                perguntaEditada = {
                    idquiz: idquiz,
                    tituloPergunta: perguntas[i].value
                };

                arrayPerguntas.push(perguntaEditada);

                let alternativas = fieldset.querySelectorAll(".alternativa");

                for (let i = 0; i < alternativas.length; i++) {

                    if (alternativas[i].value === "") {
                        alternativaIncompleta = true;
                        break;
                    }

                    divAlternativa = alternativas[i].closest("div");
                    radioAlternativa = divAlternativa.querySelector("input.radio");
                    // console.log(radioAlternativa);

                    if (radioAlternativa.classList.contains("check") === true) {
                        altCorreta = 1;
                    } else {
                        altCorreta = 0;
                    }

                    alternativaEditada = {
                        idpergunta: idPergunta.value,
                        descricao: alternativas[i].value,
                        correta: altCorreta
                    };

                    arrayAlternativas.push(alternativaEditada);
                }
            }else {
                perguntasValor.push(perguntas[i].value);
                perguntasCompletas.push(perguntas[i])
            }
        }
    }
    addPerguntasAjax(idquiz, perguntasValor, perguntasCompletas);

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
        // console.log(quizEditado);
        editaQuizAjax(quizEditado);

        for (let i = 0; i < arrayPerguntas.length; i++) {
            editaPerguntasAjax(arrayPerguntas[i]);
        }
        // console.log(arrayPerguntas);

        for (let i = 0; i < arrayAlternativas.length; i++) {
            editaAlternativasAjax(arrayAlternativas[i]);
        }
        // console.log(arrayAlternativas);
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

let addPerguntasAjax = function(idQuizAdicionado, perguntasValor, perguntasCompletas) {

    let alternativasNovas = [];
    let alternativasPraAdicionar = [];

    for(let i = 0; i < perguntasCompletas.length; i++){
        let fieldset = perguntasCompletas[i].closest("fieldset");
        let alternativas = fieldset.querySelectorAll(".alternativa");
        alternativasNovas.push(alternativas);
    }

    for(let i = 0; i< alternativasNovas.length; i++){
        if(alternativasNovas[i].value===""){
            campoVazioAlternativas=true;
            break;
        }
    }

    let perguntasNovas = {idquiz: idQuizAdicionado, perguntas:perguntasValor};

    if (campoVazioAlternativas===true){

        alert("Você não definiu o quiz!");
        campoVazioAlternativas=false;

    }else {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/quiz/public/cadastra-perguntas");
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onload = function () {
            if (xhr.status === 200) {

                // if(PerguntasEid === null){
                PerguntasEid = JSON.parse(xhr.responseText);
                // console.log(PerguntasEid);
                // let perguntasLista = listaPerguntas.querySelectorAll(".pergunta");
                let alternativasPraAdicionar = [];

                for (let i = 0; i < perguntasCompletas.length; i++) {
                    radioCheck = false;
                    if (procuraTexto(perguntasCompletas[i].value, PerguntasEid) === true) {
                        let pergunta = perguntasCompletas[i];
                        let fieldset = pergunta.closest("fieldset");
                        let alternativas = fieldset.querySelectorAll(".alternativa");

                        //CONECTAR AS ALTERNATIVAS COM O ID DAS PERGUNTAS RECEM ADICIONADAS
                        for (let i = 0; i < alternativas.length; i++) {
                            let divAlternativa = alternativas[i].closest("div");
                            let radio = divAlternativa.querySelector("input[type=radio]");

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
                    // console.log(alternativasPraAdicionar);
                    addAlternativasAjax(alternativasPraAdicionar);
                }
                // }
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

botaoAddQuiz.addEventListener("click", confereQuiz);
botaoAddPergunta.addEventListener("click", addNovaPergunta);

for(let i = 0; i < botoesAddAlternativa.length; i++){
    botoesAddAlternativa[i].addEventListener("click", addNovaAlternativa);
}

';