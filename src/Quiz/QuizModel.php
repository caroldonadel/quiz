<?php

namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\User\Model;

class QuizModel extends Model
{
private $idQuizzes;
private $titulo;
private $idUsuarios;

    /**
     * @return mixed
     */
    public function getIdQuizzes()
    {
        return $this->idQuizzes;
    }

    /**
     * @param mixed $idQuizzes
     */
    public function setIdQuizzes($idQuizzes)
    {
        $this->idQuizzes = $idQuizzes;
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
    public function getIdUsuarios()
    {
        return $this->idUsuarios;
    }

    /**
     * @param mixed $idUsuarios
     */
    public function setIdUsuarios($idUsuarios)
    {
        $this->idUsuarios = $idUsuarios;
    }

    public function inserir()
    {
        $query = 'INSERT INTO quizzes (titulo, idusuarios) VALUES (:titulo, :idusuarios)';
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':titulo', $this->titulo);
        $stmt->bindValue(':idusuarios', $this->idUsuarios);
        $stmt->execute();

        $query = "SELECT LAST_INSERT_ID() as last_id";
//        $query = "SELECT titulo FROM quizzes where  id = LAST_INSERT_ID()";
        $stmt = $conexao->query($query);
        $id = $stmt->fetch();
        $this->idQuizzes = $id[0];
        }

    public function listar()
    {
        $query = "SELECT * FROM quizzes";
        $conexao = self::pegarConexao();
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
    }

    public function carregar()
    {
        $query = "SELECT * FROM quizzes WHERE idquizzes = :idquiz";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':idquiz', $this->idQuizzes);
        $stmt->execute();
        $quiz = $stmt->fetch();

        if (!$quiz===false) {
            $this->titulo = $quiz['titulo'];
            $this->idUsuarios = $quiz['idusuarios'];
        }
    }

    public function excluir()
    {
        echo 'metodo chamado';
        $query = "DELETE FROM quizzes WHERE idquizzes = :idquizzes";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        echo $this->idQuizzes;
        $stmt->bindValue(':idquizzes', $this->idQuizzes);
        $stmt->execute();
    }


}