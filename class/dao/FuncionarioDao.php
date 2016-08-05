<?php
require_once 'class/model/Funcionario.php';
require_once 'class/fw/Conexao.php';

class FuncionarioDao
{
    private $conexao;
    private $funcionario;

    function __construct($conexao, $funcionario)
    {
        $this->funcionario = $funcionario;
        $this->conexao = $conexao;
    }

    public function gravar()
    {
        $query = "INSERT INTO funcionario (id, nome, email, cpf, data_nascimento, telefone, filho, quantidade_filhos) VALUES 
				('{$this->funcionario->getId()}',
				'{$this->funcionario->getNome()}',
				'{$this->funcionario->getEmail()}',
				'{$this->funcionario->getCpf()}',
				'{$this->funcionario->getDataNascimento()}',
				'{$this->funcionario->getTelefone()}',
				'{$this->funcionario->getFilho()}',
				'{$this->funcionario->getQuantidadeFilhos()}')";
        $resultadoDaInsercao = mysqli_query($this->conexao, $query);
        return $resultadoDaInsercao;
    }

    public function update()
    {
        $query = "UPDATE funcionario SET 
			nome = '{$this->funcionario->getNome()}',
			email = '{$this->funcionario->getEmail()}', 
			cpf =  '{$this->funcionario->getCpf()}',
			data_nascimento = '{$this->funcionario->getDataNascimento()}',
			telefone = '{$this->funcionario->getTelefone()}',
			filho = '{$this->funcionario->getFilho()}',
			quantidade_filhos = '{$this->funcionario->getQuantidadeFilhos()}'
			WHERE id = '{$this->funcionario->getId()}'";
        $resultadoDaInsercao = mysqli_query($this->conexao, $query);
        return $resultadoDaInsercao;
    }

    public function selectAll()
    {
        $funcionarios = array();
        $query = "SELECT f.id AS funcionarioId, f.nome AS funcionarioNome, f.email, f.cpf, f.data_nascimento, f.telefone,
				f.filho, f.quantidade_filhos, en.id AS enderecoId, en.cep, en.logradouro, en.numero, en.complemento,
				en.bairro, en.cidade, es.nome AS estado, c.nome AS cargoNome FROM funcionario f
				JOIN endereco en ON f.id = en.funcionario_id
				JOIN estados es ON en.estado_id = es.id
				JOIN cargo_funcionario cf ON f.id = cf.funcionario_id
				JOIN cargo c ON c.id = cf.cargo_id";
        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($funcionario = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($funcionarios, $funcionario);
        }
        return $funcionarios;
    }

    public function selectPorFiltro($query)
    {
        $funcionarios = array();
        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($funcionario = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($funcionarios, $funcionario);
        }
        return $funcionarios;
    }

    public function selectById()
    {
        $funcionarios = array();
        $query = "SELECT f.id AS funcionarioId, f.nome AS funcionarioNome, f.email, f.cpf, f.data_nascimento, f.telefone,
				f.filho, f.quantidade_filhos, en.id AS enderecoId, en.cep, en.logradouro, en.numero, en.complemento,
				en.bairro, en.cidade, es.nome AS estado, c.nome AS cargoNome FROM funcionario f
				JOIN endereco en ON f.id = en.funcionario_id
				JOIN estados es ON en.estado_id = es.id
				JOIN cargo_funcionario cf ON f.id = cf.funcionario_id
				JOIN cargo c ON c.id = cf.cargo_id
				WHERE f.id = '{$this->funcionario->getId()}'";
        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($funcionario = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($funcionarios, $funcionario);
        }
        return $funcionarios;
    }

    public function selectByCpf()
    {
        $funcionarios = array();
        $query = "SELECT * FROM funcionario WHERE cpf = '{$this->funcionario->getCpf()}'";
        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($funcionario = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($funcionarios, $funcionario);
        }
        return $funcionarios;
    }

    public function selectByNome()
    {
        $funcionarios = array();
        $query = "SELECT * FROM funcionario WHERE nome = '{$this->funcionario->getNome()}'";
        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($funcionario = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($funcionarios, $funcionario);
        }
        return $funcionarios;
    }

    public function deletar()
    {
        $query = "DELETE FROM funcionario WHERE id = '{$this->funcionario->getId()}'";
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }

    public function selectByEmail()
    {
        $funcionarios = array();
        $query = "SELECT * FROM funcionario WHERE email = '{$this->funcionario->getEmail()}'";
        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($funcionario = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($funcionarios, $funcionario);
        }
        return $funcionarios;
    }

    public function selectByEmailECpf()
    {
        $funcionarios = array();
        $query = "SELECT f.id AS funcionarioId, f.nome AS funcionarioNome, f.email, f.cpf, f.data_nascimento, f.telefone,
				f.filho, f.quantidade_filhos, en.id AS enderecoId, en.cep, en.logradouro, en.numero, en.complemento,
				en.bairro, en.cidade, es.nome AS estado, c.nome AS cargoNome FROM funcionario f
				JOIN endereco en ON f.id = en.funcionario_id
				JOIN estados es ON en.estado_id = es.id
				JOIN cargo_funcionario cf ON f.id = cf.funcionario_id
				JOIN cargo c ON c.id = cf.cargo_id
				WHERE f.cpf = '{$this->funcionario->getCpf()}' 
				AND cpf = '{$this->funcionario->getCpf()}'";
        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($funcionario = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($funcionarios, $funcionario);
        }
        return $funcionarios;
    }
}