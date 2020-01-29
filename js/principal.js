let botaoAddQuiz = document.querySelector("#botaoAddQuiz");
let tituloNovoQuiz = document.querySelector("#inputAddress");
let idUsuarioQuiz = document.querySelector("#idUsuario");

let addQuizAjax = function() {
    let quiz = {titulo: tituloNovoQuiz.value, idusuario: idUsuarioQuiz.value};
    console.log("js chamado");

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/quiz/public/cadastra-quiz');
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.send(JSON.stringify(quiz));
};

botaoAddQuiz.addEventListener("click", addQuizAjax);

