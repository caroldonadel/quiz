<?php

namespace Quiz\Armazenamento\User;

class UserModel extends Model
{
private $idUsuario;
private $nome;
private $email;
private $senha;
private $nivel;

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

    public function inserirUsuario()
    {
        $query = 'INSERT INTO usuarios (nome, email, senha, nivel) VALUES (:nome, :email, :senha, :nivel)';
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':senha', $this-> senha);
        $stmt->bindValue(':nivel', $this-> nivel); //DEFINIR COMO PADRAO COMO SENDO GUEST
        $stmt->execute();
    }

    public function carregar()
    {
        $query = "SELECT nome, email, senha, nivel,idusuarios FROM usuarios WHERE email = :email";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':email', $this->email);
        $stmt->execute();
        $usuario = $stmt->fetch();

        if (!$usuario===false) {
            $this->nome = $usuario['nome'];
            $this->senha = $usuario['senha'];
            $this->nivel = $usuario['nivel'];
            $this->idUsuario = $usuario['idusuarios'];
        }
    }



    public static function CarregaAdmin()
    {
        $query = "SELECT * from usuarios WHERE nivel = 'admin'";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $listaAdmin = $stmt->fetchAll();

        foreach ($listaAdmin as $lista){
            $senhaHash = password_hash($lista['senha'], PASSWORD_ARGON2I);
            self::AlteraSenhaAdmin($senhaHash, $lista);
        }
    }

    public static function AlteraSenhaAdmin($senhaHash,$lista)
    {
        $query = "UPDATE usuarios set senha = :senha  WHERE idusuarios = :id";
        $conexao = self::pegarConexao();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id', $lista['idusuarios']);
        $stmt->bindValue(':senha', $senhaHash);
        $stmt->execute();
    }

    public function senhaEstaCorreta(string $senhaPura): bool
    {
        return password_verify($senhaPura, $this->senha);
    }
}