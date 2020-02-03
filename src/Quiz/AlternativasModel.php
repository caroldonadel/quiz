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

    public function carregar()
    {
        $query = "SELECT * FROM alternativas WHERE idperguntas = :idperguntas";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idperguntas', $this->idperguntas);
        $stmt->execute();
        $alternativas = $stmt->fetchAll();

        return $alternativas;
    }
}