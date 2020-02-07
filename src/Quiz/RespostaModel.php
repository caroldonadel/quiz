<?php


namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\User\Model;

class RespostaModel extends Model
{
    private $idusuarios;
    private $idalternativas;

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
        $query = 'INSERT INTO respostas (idusuarios, idalternativas) VALUES (:idusuarios, :idalternativas)';
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idusuarios', $this->idusuarios);
        $stmt->bindValue(':idalternativas', $this->idalternativas);
        $stmt->execute();
    }

    public function listar()
    {
        $query = "SELECT * FROM respostas WHERE idusuarios = :idusuarios";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idusuarios', $this->idusuarios);
        $stmt->execute();
        $lista = $stmt->fetchAll();

        return $lista;
    }

    public function carregar()
    {
        $query = "SELECT * FROM respostas WHERE idusuarios = :idusuarios AND idalternativas = :idalternativas";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idusuarios', $this->idusuarios);
        $stmt->bindValue(':idalternativas', $this->idalternativas);
        $stmt->execute();
        $resposta = $stmt->fetch();

//        private $idusuarios;
//        private $idalternativas;

//        $this->idalternativas = $resposta['idalternativas'];
        if ($resposta===false) {

            return null;
        }

        return $resposta;
    }
}