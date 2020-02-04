<?php


namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\User\Model;

class RespostaModel extends Model
{
    private $idperguntas;
    private $idusuarios;
    private $idalternativas;

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
    public function getIdusuarios()
    {
        return $this->idusuarios;
    }

    /**
     * @param mixed $idusuarios
     */
    public function setIdusuarios($idusuarios)
    {
        $this->idusuarios = $idusuarios;
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

    public function inserir()
    {
        $query = 'INSERT INTO respostas (idperguntas, idusuarios, idalternativas) VALUES (:idperguntas, :idusuarios, :idalternativas)';
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idperguntas', $this->idperguntas);
        $stmt->bindValue(':idusuarios', $this->idusuarios);
        $stmt->bindValue(':idalternativas', $this->idalternativas);
        $stmt->execute();
    }

}