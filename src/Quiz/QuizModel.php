<?php

namespace Quiz\Armazenamento\Quiz;

use Quiz\Armazenamento\User\Model;

class QuizModel extends Model
{
private $idQuizzes;
private $titulo;
private $idUsuarios;
//private $tituloUltimoAdicionado;

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

//    /**
//     * @return mixed
//     */
//    public function getTituloUltimoAdicionado()
//    {
//        return $this->tituloUltimoAdicionado;
//    }
//
//    /**
//     * @param mixed $tituloUltimoAdicionado
//     */
//    public function setTituloUltimoAdicionado($tituloUltimoAdicionado)
//    {
//        $this->tituloUltimoAdicionado = $tituloUltimoAdicionado;
//    }

    public function inserir()
    {
        $query = 'INSERT INTO quizzes (titulo, idusuarios) VALUES (:titulo, :idusuarios)';
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':titulo', $this->titulo);
        $stmt->bindValue(':idusuarios', $this->idUsuarios);
        $stmt->execute();

//        $query = "SELECT LAST_INSERT_ID() as last_id";
//        $query = "SELECT titulo FROM quizzes where  id = LAST_INSERT_ID()";
//        $stmt = $conexao->query($query);
//        $titulo = $stmt->fetch();
//        $this->tituloUltimoAdicionado = $titulo[0];
    }

    public function listar()
    {
        $query = "SELECT * FROM quizzes";
        $conexao = self::pegarConexao();
        $resultado = $conexao->query($query);
        $lista = $resultado->fetchAll();
        return $lista;
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