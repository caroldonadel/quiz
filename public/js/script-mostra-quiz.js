let botaoProxima = document.querySelector("#botaoProxima");
let idQuiz = document.querySelector("#idQuiz");
let idUser = document.querySelector("#idUser");
let indiceListaPerguntas=1;
let divConteudo = document.querySelector("#conteudo");
let botaoResultado = document.querySelector("#botaoResultado");
let radios2 = document.querySelectorAll("button[name]");
let idAlt;
let quizRespondido = document.querySelector("#quiz-respondido");


let carregaProximaPergunta = function() {

    if (quizRespondido.value === "nao-respondido") {

        alert("Você não respondeu a pergunta!");

    }else {

        let idQuizAtual = {id: idQuiz.value, indice: indiceListaPerguntas};

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "/proxima-pergunta");
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onload = function () {
            if (xhr.status === 200) {

                let dadosQuiz = JSON.parse(xhr.responseText);

                if (dadosQuiz["fim"] === "yes") {

                    let botaoProximaPergunta = document.querySelector("#botaoProxima");
                    botaoProximaPergunta.remove();

                    let botaoResultado = document.createElement("a");
                    divConteudo.appendChild(botaoResultado);
                    botaoResultado.innerText = "Resultado";
                    botaoResultado.id = "botaoResultado";
                    botaoResultado.className = "btn btn-light";
                    botaoResultado.href = "/resultado?idquiz=" + idQuiz.value + "&iduser=" + idUser.value;

                } else {

                    let titulo = document.querySelector("h1");
                    titulo.innerHTML = dadosQuiz["titulo"];

                    let pergunta = document.querySelector("h2");
                    pergunta.innerHTML = dadosQuiz["listaPerguntas"][0]["titulo"];

                    let lista = document.querySelector("#listaAlt");
                    let listaDeLi = lista.querySelectorAll("button");

                    for (let i = 0; i < listaDeLi.length; i++) {
                        listaDeLi[i].remove("button");
                    }

                    for (let i = 0; i < dadosQuiz["listaAlternativas"].length; i++) {

                        let liAlternativa = document.createElement("button");
                        liAlternativa.type = "button";
                        liAlternativa.innerText = dadosQuiz["listaAlternativas"][i]["descricao"];
                        liAlternativa.className = "list-group-item list-group-item-action";
                        liAlternativa.id = dadosQuiz["listaAlternativas"][i]["idalternativas"];
                        liAlternativa.name = "alternativa";

                        lista.appendChild(liAlternativa);
                    }

                    let alternativasDaPergunta = document.querySelectorAll("button[name]");

                    for (let i = 0; i < alternativasDaPergunta.length; i++) {
                        alternativasDaPergunta[i].addEventListener("click", function (event) {
                            verificaSeAlternativaFoiEscolhida(event, alternativasDaPergunta);
                        });
                    }

                }

            }
        };
        indiceListaPerguntas++;
        xhr.send(JSON.stringify(idQuizAtual));
    }
};

let verificaSeAlternativaFoiEscolhida = function (event, botoes) {

    let elementoAtivo = event.currentTarget;

    if(elementoAtivo.classList.contains("active")){
        elementoAtivo.className = "list-group-item list-group-item-action ";
    }else {
        elementoAtivo.className = "list-group-item list-group-item-action active";
        idAlt = elementoAtivo.id;
        quizRespondido.value = "respondido";

        for(let i=0; i < botoes.length; i++){
            if(botoes[i].id !== idAlt)
            {
                botoes[i].className = "list-group-item list-group-item-action disabled";
            }
        }
    }
};

let salvaRespostaAjax = function() {

    idPergunta = document.querySelector("#idPergunta").value;
    let resposta = {iduser: idUser.value, idResp: idAlt};

    console.log(resposta);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/cadastra-respostas");
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.send(JSON.stringify(resposta));
};

for(let i = 0; i < radios2.length; i++){
    radios2[i].addEventListener("click",function(event){
        verificaSeAlternativaFoiEscolhida(event, radios2);
    } );
}

botaoProxima.addEventListener("click", carregaProximaPergunta);
botaoProxima.addEventListener("click", salvaRespostaAjax);

