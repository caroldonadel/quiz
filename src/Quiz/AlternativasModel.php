<?php


namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\User\Model;

class AlternativasModel extends Model
{
    private $idperguntas;
    private $descricao;
    private $idalternativas;
    private $correta;

    /**
     * @return mixed
     */
    public function getIdperguntas()
    {
        return $this->idperguntas;
    }

    /**
     * @param mixed $idperguntas
     */
    public function setIdperguntas($idperguntas)
    {
        $this->idperguntas = $idperguntas;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getIdalternativas()
    {
        return $this->idalternativas;
    }

    /**
     * @param mixed $idalternativas
     */
    public function setIdalternativas($idalternativas)
    {
        $this->idalternativas = $idalternativas;
    }

    /**
     * @return mixed
     */
    public function getCorreta()
    {
        return $this->correta;
    }

    /**
     * @param mixed $correta
     */
    public function setCorreta($correta)
    {
        $this->correta = $correta;
    }

    public function inserir()
    {
        $query = 'INSERT INTO alternativas (descricao, idperguntas, correta) VALUES (:descricao, :idperguntas, :correta)';
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':descricao', $this->descricao);
        $stmt->bindValue(':idperguntas', $this->idperguntas);
        $stmt->bindValue(':correta', $this->correta);
        $stmt->execute();
    }

    public function listarPorPergunta()
    {
        $query = "SELECT * FROM alternativas WHERE idperguntas = :idperguntas";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idperguntas', $this->idperguntas);
        $stmt->execute();
        $alternativas = $stmt->fetchAll();

        return $alternativas;
    }

    public function listar()
    {
        $query = "SELECT * FROM alternativas";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idperguntas', $this->idperguntas);
        $stmt->execute();
        $alternativas = $stmt->fetchAll();

        return $alternativas;
    }
    public function carregarSomenteACorreta()
    {
        $query = "SELECT * FROM alternativas WHERE idperguntas = :idperguntas AND correta = 1";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idperguntas', $this->idperguntas);
        $stmt->execute();
        $alternativa = $stmt->fetch();

        if (!$alternativa === false) {
            $this->descricao = $alternativa['descricao'];
            $this->idalternativas = $alternativa['idalternativas'];
            $this->correta = $alternativa['correta'];
        }
    }

    public function atualizar()
    {
        $query = "UPDATE alternativas set descricao = :descricao, correta = :correta WHERE idalternativas = :idalternativas";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':descricao', $this->descricao);
        $stmt->bindValue(':$idalternativas', $this->idalternativas);
        $stmt->bindValue(':correta', $this->correta);
        $stmt->execute();
    }

    public function excluirTodas()
    {
        $query = "DELETE FROM alternativas WHERE idperguntas = :idperguntas";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idperguntas', $this->idperguntas);
        $stmt->execute();
    }

    public function excluir()
    {
        $query = "DELETE FROM alternativas WHERE idalternativas = :idalternativas";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idalternativas', $this->idalternativas);
        $stmt->execute();
    }

}