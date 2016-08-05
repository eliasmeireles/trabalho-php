<?php

class UsuarioDao
{
    private $conexao;
    private $usuario;

    public function __construct($conexao, $usuario)
    {
        $this->conexao = $conexao;
        $this->usuario = $usuario;
    }

    public function gravar()
    {
        $query = "INSERT INTO usuario_sistema (funcionario_id, senha) VALUES 
				('{$this->usuario->getFuncionario()->getId()}',
				'{$this->usuario->getSenha()}')";
        $resultadoDaInsercao = mysqli_query($this->conexao, $query);
        return $resultadoDaInsercao;
    }

    public function alterar()
    {
        $query = "UPDATE usuario_sistema SET senha = '{$this->usuario->getSenha()}' WHERE funcionario_id = '{$this->usuario->getFuncionario()->getId()}'";
        $resultadoDaInsercao = mysqli_query($this->conexao, $query);
        return $resultadoDaInsercao;
    }

    public function deletar()
    {
        $query = "DELETE FROM usuario_sistema WHERE funcionario_id = '{$this->usuario->getFuncionario()->getId()}'";
        $resultadoDaInsercao = mysqli_query($this->conexao, $query);
        return $resultadoDaInsercao;
    }

    public function selectAll()
    {
        $user = array();
        $query = "SELECT f.id, f.nome AS funcionarioNome, f.email, f.cpf, f.telefone, c.nome AS cargoNome FROM usuario_sistema u
                  JOIN funcionario f ON u.funcionario_id = f.id
                  JOIN cargo_funcionario cf ON f.id = cf.funcionario_id
                  JOIN cargo c ON c.id = cf.cargo_id";

        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($usuario = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($user, $usuario);
        }
        return $user;
    }

    public function select()
    {
        $user = array();
        $query = "SELECT f.id, nome, email, cpf, data_nascimento, telefone, filho, quantidade_filhos FROM usuario_sistema u
                JOIN funcionario f ON f.id = u.funcionario_id WHERE 
                senha = '{$this->usuario->getSenha()}' 
                AND f.cpf = '{$this->usuario->getFuncionario()->getCpf()}'";

        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($usuario = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($user, $usuario);
        }
        return $user;
    }
}