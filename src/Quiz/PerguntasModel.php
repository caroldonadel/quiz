<?php


namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\User\Model;

class PerguntasModel extends Model
{
    private $idquiz;
    private $titulo;
    private $idperguntas;

    /**
     * @return mixed
     */
    public function getIdquiz()
    {
        return $this->idquiz;
    }

    /**
     * @param mixed $idquiz
     */
    public function setIdquiz($idquiz)
    {
        $this->idquiz = $idquiz;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

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

    public function inserir()
    {
        $query = 'INSERT INTO perguntas (titulo, idquizzes) VALUES (:titulo, :idquiz)';
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':titulo', $this->titulo);
        $stmt->bindValue(':idquiz', $this->idquiz);
        $stmt->execute();

        $query = "SELECT LAST_INSERT_ID() as last_id";
        $stmt = $conexao->query($query);
        $id = $stmt->fetch();
        $this->idperguntas = $id[0];
    }
}