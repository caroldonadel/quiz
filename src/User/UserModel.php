<?php

namespace Quiz\Armazenamento\User;

class UserModel extends Model
{
private $idUsuario;
private $nome;
private $email;
private $senha;
private $nivel;

    public function inserirUsuario()
    {
        $query = "INSERT INTO usuarios (nome, email, senha, nivel) VALUES (:nome, :email, :senha, :nivel)";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this-> senha);
        $stmt->bindValue(':nivel', $this-> nivel); //DEFINIR COMO PADRAO COMO SENDO GUEST
        $stmt->execute();

//        $query = "SELECT LAST_INSERT_ID() as last_id";
//        $stmt = $conexao->query($query); //usar bindValue
//        $id = $stmt->fetch();
//        $this->id = $id[0]; //ID DO ULTIMO ITEM ADD NA TABELA
    }

//    public static function listarUsuarios()
//    {
////        $query = "SELECT nome,email, senha,nivel FROM usuarios";
//        $query = "SELECT * FROM usuarios";
//        $conexao = self::pegarConexao();
//        $resultado = $conexao->query($query);
//        $listaUsuarios = $resultado->fetchAll();
//        return $listaUsuarios;
//    }

    public static function carregar(){
        $query = "SELECT email, senha FROM usuarios";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);

        $stmt->execute();

//        $query = "SELECT LAST_INSERT_ID() as last_id";
//        $stmt = $conexao->query($query); //usar bindValue
//        $id = $stmt->fetch();
//        $this->id = $id[0];
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * @param mixed $nivel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;
    }
}