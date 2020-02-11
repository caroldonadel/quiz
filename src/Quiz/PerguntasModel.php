<?php


namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\User\Model;

class PerguntasModel extends Model
{
    private $idquizzes;
    private $titulo;
    private $idperguntas;

    /**
     * @return mixed
     */
    public function getIdquiz()
    {
        return $this->idquizzes;
    }

    /**
     * @param mixed $idquiz
     */
    public function setIdquiz($idquiz)
    {
        $this->idquizzes = $idquiz;
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
        $stmt->bindValue(':idquiz', $this->idquizzes);
        $stmt->execute();

        $query = "SELECT LAST_INSERT_ID() as last_id";
        $stmt = $conexao->query($query);
        $id = $stmt->fetch();
        $this->setIdperguntas($id[0]);
    }

    public function lastId(){
        $query = "SELECT LAST_INSERT_ID() as last_id";
        $conexao = self::pegarConexao();
        $stmt = $conexao->query($query);
        $id = $stmt->fetch();
        $this->idperguntas = $id[0];
        var_dump($id);
    }

    public function listar()
    {
        $query = "SELECT * FROM perguntas WHERE idquizzes = :idquiz";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idquiz', $this->idquizzes);
        $stmt->execute();
        $lista = $stmt->fetchAll();

        return $lista;
    }

    public function carregar()
    {
        $query = "SELECT * FROM perguntas WHERE idperguntas = :idperguntas";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idperguntas', $this->idperguntas);
        $stmt->execute();
        $pergunta = $stmt->fetch();

        if (!$pergunta===false) {
            $this->titulo = $pergunta['titulo'];
        }
    }

    public function carregarTitulo()
    {
        $query = "SELECT * FROM perguntas WHERE titulo = :titulo";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':titulo', $this->titulo);
        $stmt->execute();
        $pergunta = $stmt->fetch();

        if (!$pergunta===false) {
            $this->titulo = $pergunta['titulo'];
            $this->idperguntas = $pergunta['idperguntas'];
        }
    }

    public function excluir()
    {
        $query = "DELETE FROM perguntas WHERE idquizzes = :idquizzes";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idquizzes', $this->idquizzes);
        $stmt->execute();
    }
}