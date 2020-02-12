<?php include __DIR__ . '/../inicio-html.php'; ?>
<?php $valorIncrementadoId = 1;
      $valorIncrementadoName = 1;
?>

<fieldset id="formularioQuiz">
    <div class="form-group">
        <label for="inputAddress">Título do Quiz</label>
        <input type="text"  class="form-control" id="inputAddress" value="<?= $tituloQuiz ?>">
        <input type="hidden" value="<?php echo $idUsuario; ?>" id="idUsuario">
        <input type="hidden" value="<?php echo $idquiz; ?>" id="idquiz">
    </div>

    <div id="listaPerguntas">
        <div class="form-group">
            <button id="botaoAddPergunta" class="btn btn-primary">Criar pergunta</button>
        </div>
        <?php foreach ($listaPerguntas as $pergunta) : ?>

        <fieldset class="form-group">
            <input type="hidden" value="<?= $pergunta['idperguntas']?>" id="idPergunta">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control pergunta" value="<?= $pergunta['titulo'] ?>">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary mb-2">Criar Alternativa </button>
                </div>
            </div>
            <fieldset class="form-check">
                <div class="form-row">
                       <div class="form-group col-md-6">
                           <h6><mark>Escolha a alternativa correta</mark></h6>
                       </div>
<!--                    <div class="form-group col-md-6">-->
<!--                        <label>Descrição da Alternativa</label>-->
<!--                    </div>-->
                </div>
                <?php foreach ($listaAlternativas as $alternativa) :
                    if($alternativa['idperguntas']===$pergunta['idperguntas']) : ?>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text radio">
                            <input class="radio <?php if($alternativa['correta']==1) : echo 'check'; endif; ?>" type="radio" id="inlineRadio<?= $valorIncrementadoId?>"
                                   value= "option<?= $valorIncrementadoId?>" name="inlineRadioOptions<?= $valorIncrementadoName?>"
                            <?php if($alternativa['correta']==1) : echo 'checked'; endif; ?> >
                        </div>
                    </div>
                    <input type="text" class="form-control alternativa" id="<?= $alternativa['idalternativas']?>"
                     value="<?= $alternativa['descricao'] ?>">
                </div>

                <?php $valorIncrementadoId++;?>
                <?php endif; ?>
                <?php endforeach; ?>
            </fieldset>
                <?php $valorIncrementadoName++?>

        </fieldset>
        <?php endforeach; ?>
    </div>

</fieldset>

<div class="form-group">
    <button id="botaoAddQuiz" class="btn btn-primary">Salvar Quiz</button>
</div>

<script type="text/javascript" src= "/js/script-edita-quiz.js"></script>

</body>
</html>