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

    public function inserirUsuario()
    {
        $query = 'INSERT INTO quizzes (titulo, idusuarios) VALUES (:titulo, :idusuarios)';
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':titulo', $this->titulo);
        $stmt->bindValue(':idusuarios', $this->idUsuarios);
        $stmt->execute();
    }

//    public function carregar()
//    {
//        $query = "SELECT titulo, idquizzes, idusuarios FROM quizzes WHERE email = :email";
//        $conexao = self::pegarConexao();
//        $stmt = $conexao->prepare($query);
//        $stmt->bindValue(':email', $this->email);
//        $stmt->execute();
//        $usuario = $stmt->fetch();
//
//        if (!$usuario===false) {
//            $this->nome = $usuario['nome'];
//            $this->senha = $usuario['senha'];
//            $this->nivel = $usuario['nivel'];
//            $this->idUsuario = $usuario['idusuarios'];
//        }
//    }
}