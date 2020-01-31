// <?php
// echo
//
// '
let botaoAddQuiz = document.querySelector("#botaoAddQuiz");
let tituloNovoQuiz = document.querySelector("#inputAddress");
let idUsuarioQuiz = document.querySelector("#idUsuario");
let listaPerguntas = document.querySelector("#listaPerguntas");
let botaoAddPergunta = document.querySelector("#botaoAddPergunta");
let numeroId = 1;

let addQuizAjax = function() {
    let quiz = {titulo: tituloNovoQuiz.value, idusuario: idUsuarioQuiz.value};

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/cadastra-quiz");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {

            console.log(JSON.parse(xhr.responseText));
            let idQuizAdicionado = JSON.parse(xhr.responseText);

            //chama função que manda request pro caminho da classe SalvarPerguntas e manda o id do quiz pra la

            let divAlerta = document.querySelector("#divAlerta");
            divAlerta.className = "alert alert-success";
            divAlerta.innerText = "Quiz salvo com sucesso";

            let perguntas = listaPerguntas.querySelectorAll("input[type=text]");
            let perguntasAEnviar = [];
            for(let i=0;i < perguntas.length;i++){
                console.log(perguntas[i].value);
                perguntasAEnviar.push(perguntas[i].value);
            }
            console.log(perguntasAEnviar);


            addPerguntasAjax(idQuizAdicionado, perguntasAEnviar);

        }
    }
    xhr.send(JSON.stringify(quiz));
};

let addPerguntasAjax = function(idQuizAdicionado, perguntas) {
    let perguntasNovas = {idquiz: idQuizAdicionado, perguntas:{perguntas}};

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/quiz/public/cadastra-perguntas");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {
        }
    }
    xhr.send(JSON.stringify(perguntasNovas));
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
    inputPergunta.className = "form-control";

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
};

let addNovaAlternativa = function(){

    let divTodasAlternativas =  document.createElement("div");
    divTodasAlternativas.className = "input-group mb-3";

    let divInputGroup = document.createElement("div");
    divInputGroup.className = "input-group-prepend";

    let divRadio =  document.createElement("div");
    divRadio.className = "input-group-text";

    let inputRadio = document.createElement("input");
    inputRadio.type = "radio";
    inputRadio.id = "inlineRadio" + numeroId;
    inputRadio.value = "option" + numeroId;
    inputRadio.name = "inlineRadioOptions";

    let inputAlternativa = document.createElement("input");
    inputAlternativa.type = "text";
    inputAlternativa.className = "form-control";
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
};

botaoAddQuiz.addEventListener("click", addQuizAjax);
botaoAddPergunta.addEventListener("click", addNovaPergunta);

// ';