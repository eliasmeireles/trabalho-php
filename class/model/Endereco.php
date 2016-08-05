<?php
require_once 'Funcionario.php';

class Endereco
{
    private $id;
    private $cep;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $estado;
    private $funcionario;

    function __construct($funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function setLogradouro($logradouro)
    {
        $this->logradouro = trim($logradouro);
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = trim($numero);
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = trim($complemento);
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = trim($bairro);
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = trim($cidade);
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = trim($estado);
    }

    public function getFuncionario()
    {
        return $this->funcionario;
    }

    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
    }

    function __toString()
    {
        echo $this->id . "<br/><br/>";
        echo $this->cep . "<br/><br/>";
        echo $this->logradouro . "<br/><br/>";
        echo $this->numero . "<br/><br/>";
        echo $this->complemento . "<br/><br/>";
        echo $this->bairro . "<br/><br/>";
        echo $this->cidade . "<br/><br/>";
        echo $this->estado . "<br/><br/>";
        echo $this->funcionario . "<br/><br/>";
        return "";
    }
}

?>