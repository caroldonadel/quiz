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
let  vddOuFalso;


let addQuizAjax = function() {
    let quiz = {titulo: tituloNovoQuiz.value, idusuario: idUsuarioQuiz};

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/cadastra-quiz");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {

            let idQuizAdicionado = JSON.parse(xhr.responseText);
            console.log(idQuizAdicionado);
            let divAlerta = document.querySelector("#divAlerta");

            //mandar um ok como resposta de sucesso da função de addalternativas e aqui um if
            divAlerta.className = "alert alert-success";
            divAlerta.innerText = "Quiz salvo com sucesso";

            let perguntas = listaPerguntas.querySelectorAll(".pergunta");
            // let perguntas = listaPerguntas.querySelectorAll("input[type=text]");
            let perguntasAEnviar = [];

            for(let i=0;i < perguntas.length;i++){
                console.log(perguntas[i].value);
                perguntasAEnviar.push(perguntas[i].value);
            }
            console.log(perguntasAEnviar);

            addPerguntasAjax(idQuizAdicionado, perguntasAEnviar);
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

let addPerguntasAjax = function(idQuizAdicionado, perguntas) {

    let perguntasNovas = {idquiz: idQuizAdicionado, perguntas:perguntas};

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/cadastra-perguntas");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {
            let PerguntasEid = JSON.parse(xhr.responseText);

            let perguntasLista = listaPerguntas.querySelectorAll(".pergunta");

            for(let i=0;i < perguntasLista.length;i++){

                if(procuraTexto(perguntasLista[i].value,PerguntasEid)===true){
                    console.log("sao iguais");
                    let alternativas;
                    let pergunta = perguntasLista[i];
                    let fieldset = pergunta.closest("fieldset");
                    alternativas = fieldset.querySelectorAll(".alternativa");

                    console.log(alternativas);

                    for(let i=0;i < alternativas.length;i++){
                        let divAlternativa = alternativas[i].closest("div");
                        let radio = divAlternativa.querySelector("input[type=radio]");
                        console.log(radio);

                        if(radio.classList.contains("check") === true){
                            alternativaNova = {idpergunta: idPergunta, descricao:alternativas[i].value, correta: 1};
                        }else{
                            alternativaNova = {idpergunta: idPergunta, descricao:alternativas[i].value, correta: 0};
                        }

                        console.log(alternativaNova);
                        addAlternativasAjax(alternativaNova);
                    }
                }
            }
        }
    };

    xhr.send(JSON.stringify(perguntasNovas));
};

let addAlternativasAjax = function(AlternativaNova) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/cadastra-alternativas");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.send(JSON.stringify(AlternativaNova));
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
    // divTodasAlternativas.className = "input-group mb-3";
    divTodasAlternativas.className = "input-group";

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