<?php
require_once 'class/fw/Conexao.php';
require_once 'class/model/Endereco.php';

class EnderecoDao
{
    private $conexao;
    private $endereco;

    function __construct($conexao, $endereco)
    {
        $this->endereco = $endereco;
        $this->conexao = $conexao;
    }

    public function gravar()
    {
        $query = "INSERT INTO endereco (id,cep, logradouro, numero,
 		complemento, bairro, cidade, estado_id, funcionario_id) VALUES (
 		'{$this->endereco->getId()}',
 		'{$this->endereco->getCep()}',
 		'{$this->endereco->getLogradouro()}',
 		'{$this->endereco->getNumero()}',
 		'{$this->endereco->getComplemento()}',
 		'{$this->endereco->getBairro()}',
 		'{$this->endereco->getCidade()}',
 		'{$this->endereco->getEstado()}',
 		'{$this->endereco->getFuncionario()->getId()}')";

        $resultadoDaInsercao = mysqli_query($this->conexao, $query);
        return $resultadoDaInsercao;
    }

    public function update()
    {
        $query = "UPDATE endereco  		
 		SET cep = '{$this->endereco->getCep()}',
					logradouro = '{$this->endereco->getLogradouro()}',
					numero = '{$this->endereco->getNumero()}',
					complemento = '{$this->endereco->getComplemento()}',
					bairro = '{$this->endereco->getBairro()}',
					cidade = '{$this->endereco->getCidade()}',
					estado_id = '{$this->endereco->getEstado()}' WHERE id = '{$this->endereco->getId()}'";
        $resultadoDaInsercao = mysqli_query($this->conexao, $query);
        return $resultadoDaInsercao;
    }

    public function selectAll()
    {
        $enderecos = array();
        $query = "SELECT en.id, en.cep,  en.logradouro, en.numero, en.complemento, en.bairro, en.cidade, en.estado_id, es.nome FROM endereco en 
		JOIN estados es ON es.id = en.estado_id WHERE funcionario_id = '{$this->endereco->getFuncionario()->getId()}'";
        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($endereco = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($enderecos, $endereco);
        }
        return $enderecos;
    }

    public function select()
    {
        $enderecos = array();
        $query = "SELECT e.id, e.cep, e.logradouro, e.numero, e.complemento, e.bairro, e.cidade, e.estado_id, e.funcionario_id, f.nome FROM endereco e 
		  JOIN funcionario f ON e.funcionario_id = f.id
		  WHERE e.id = '{$this->endereco->getId()}'";
        $resultadoDaBusca = mysqli_query($this->conexao, $query);
        while ($endereco = mysqli_fetch_assoc($resultadoDaBusca)) {
            array_push($enderecos, $endereco);
        }
        return $enderecos;
    }
    public function deletar()
    {
        $query = "DELETE FROM endereco WHERE funcionario_id = '{$this->endereco->getFuncionario()->getId()}'";
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }
}