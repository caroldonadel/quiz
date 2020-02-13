let botaoAddQuiz = document.querySelector("#botaoAddQuiz");
let tituloNovoQuiz = document.querySelector("#inputAddress");
let idUsuarioQuiz = document.querySelector("#idUsuario").value;
let listaPerguntas = document.querySelector("#listaPerguntas");
let botaoAddPergunta = document.querySelector("#botaoAddPergunta");
let numeroId = 1;
let numeroNomeRadio = 1;
let idPergunta;
let alternativaNova;
let perguntaEstaNoBD;
let campoVazioPerguntas = false;
let campoVazioAlternativas = false;
let radioCheck = false;
let PerguntasEid = null;

//Verifica se input radio esta selecionado ou não
let checkRadio = function (event) {
    let elementoAtivo = event.currentTarget;

    if(elementoAtivo.classList.contains("check")){
        elementoAtivo.className = "radio";
    }else {
        elementoAtivo.className = "radio check";
    }
};

/*verifica se o texto de um input de nova pergunta esta no array retornado pelo controller que adiciona as perguntas
novas no BD para pegar seus ids e relacionar a suas alternativas */
let procuraTexto = function(valor, array){
    for(let i=0;i < array.length;i++){
        if (array[i][0].includes(valor)){

            perguntaEstaNoBD = true;
            idPergunta = array[i][1];
            break;
        } else {
            perguntaEstaNoBD =  false;
        }
    }
    return perguntaEstaNoBD;
};

let addQuizAjax = function() {
    let perguntas = listaPerguntas.querySelectorAll(".pergunta");

    for(let i=0; i< perguntas.length; i++) {
        if (perguntas[i].value === ""){
            campoVazioPerguntas=true;
            break;
        }
    }

    let quiz = {titulo: tituloNovoQuiz.value, idusuario: idUsuarioQuiz};

    if (tituloNovoQuiz.value === "" || campoVazioPerguntas === true){

        alert("Você não definiu o quiz!");
        campoVazioPerguntas=false;

    }else{
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/cadastra-quiz");
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onload = function () {
            if (xhr.status === 200) {

                let idQuizAdicionado = JSON.parse(xhr.responseText);

                if (idQuizAdicionado !== null) {
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

let addPerguntasAjax = function(idQuizAdicionado, perguntas) {

    let alternativas = document.querySelectorAll(".alternativa");

    for(let i = 0; i< alternativas.length; i++){
        if(alternativas[i].value===""){
            campoVazioAlternativas=true;
            break;
        }
    }

    let perguntasNovas = {idquiz: idQuizAdicionado, perguntas:perguntas};

    if (campoVazioAlternativas===true){

        alert("Você não definiu o quiz!");
        campoVazioAlternativas=false;

    }else {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/cadastra-perguntas");
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onload = function () {
            if (xhr.status === 200) {

                PerguntasEid = JSON.parse(xhr.responseText);
                let perguntasLista = listaPerguntas.querySelectorAll(".pergunta");
                let alternativasPraAdicionar = [];

                for (let i = 0; i < perguntasLista.length; i++) {
                    radioCheck = false;
                    if (procuraTexto(perguntasLista[i].value, PerguntasEid) === true) {
                        let pergunta = perguntasLista[i];
                        let fieldset = pergunta.closest("fieldset");
                        let alternativas = fieldset.querySelectorAll(".alternativa");

                        for (let i = 0; i < alternativas.length; i++) {
                            let divAlternativa = alternativas[i].closest("div");
                            let radio = divAlternativa.querySelector("input[type=radio]");

                            //idPergunta é definida na chamada a função procuraTexto
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

                        //verificando se pelo menos uma das alternativas de uma pergunta está marcada como correta
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
        xhr.open("POST", "/cadastra-alternativas");
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
    fieldsetPergunta.className = "form-group border bg-light rounded p-1";

    let divPergunta = document.createElement("div");
    divPergunta.className = "form-row";

    let divTexto = document.createElement("div");
    divTexto.className = "form-group col-md-6";

    let inputPergunta = document.createElement("input");
    inputPergunta.type = "text";
    inputPergunta.placeholder = "Nova Pergunta";
    inputPergunta.className = "form-control pergunta";

    let spanBotoes = document.createElement("span");

    let botaoAddAlternativa =  document.createElement("button");
    botaoAddAlternativa.type = "submit";
    botaoAddAlternativa.className ="btn btn-outline-info mb-2 mr-1";
    botaoAddAlternativa.innerHTML = "Criar Alternativa";

    let botaoExcluir =  document.createElement("button");
    botaoExcluir.innerHTML = "Excluir";
    botaoExcluir.className ="btn btn-outline-danger mb-2";

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
    // divPergunta.appendChild(divBotao);
    divPergunta.appendChild(spanBotoes);
    spanBotoes.appendChild(botaoAddAlternativa);
    spanBotoes.appendChild(botaoExcluir);
    // divBotao.appendChild(botaoAddAlternativa);

    let botoesalternativas = listaPerguntas.querySelectorAll("button[type=submit]");

    botaoExcluir.addEventListener("click", excluiPergunta);

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
    inputAlternativa.className = "form-control w-50 alternativa";
    inputAlternativa.id = "alternativaTexto" + numeroId;

    let divBotaoExcluirAlt = document.createElement("div");
    divBotaoExcluirAlt.className = "input-group-append";

    let botaoExcluirAlt =  document.createElement("button");
    botaoExcluirAlt.innerText = "Excluir";
    botaoExcluirAlt.className ="btn btn-outline-danger";

    let botaoParent = this.parentNode;
    let divParent = botaoParent.closest(".form-row");
    let fieldsetParent = divParent.closest("fieldset");
    let fieldsetAlternativas = fieldsetParent.querySelector("fieldset");

    fieldsetAlternativas.appendChild(divTodasAlternativas);
    divTodasAlternativas.appendChild(divInputGroup);
    divInputGroup.appendChild(divRadio);
    divRadio.appendChild(inputRadio);
    divTodasAlternativas.appendChild(inputAlternativa);
    divTodasAlternativas.appendChild(divBotaoExcluirAlt);
    divBotaoExcluirAlt.appendChild(botaoExcluirAlt);

    numeroId++;

    inputRadio.addEventListener("click", checkRadio);
    botaoExcluirAlt.addEventListener('click', excluiAlternativa);
};

let excluiAlternativa = function(event){

    let elementoAtivo = event.currentTarget;
    let divAlternativa = elementoAtivo.closest(".mb-3");
    divAlternativa.remove();
};

let excluiPergunta = function(event){

    let elementoAtivo = event.currentTarget;
    let fieldsetPergunta = elementoAtivo.closest(".p-1");
    fieldsetPergunta.remove();
};

botaoAddQuiz.addEventListener("click", addQuizAjax);
botaoAddPergunta.addEventListener("click", addNovaPergunta);
