<?php

class Funcionario
{
    private $id;
    private $nome;
    private $email;
    private $cpf;
    private $dataNascimento;
    private $telefone;
    private $filho;
    private $quantidadeFilhos;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento)
    {
        if (!$dataNascimento == null) {
            $timestamp = strtotime($dataNascimento);
            $this->dataNascimento = date("Y-m-d H:i:s", $timestamp);
        }
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getFilho()
    {
        return $this->filho;
    }

    public function setFilho($filho = false)
    {
        $this->filho = $filho;
    }

    public function getQuantidadeFilhos()
    {
        return $this->quantidadeFilhos;
    }

    public function setQuantidadeFilhos($quantidadeFilhos)
    {
        if ($this->getFilho()) {
            $this->quantidadeFilhos = $quantidadeFilhos;
        } else {
            $this->quantidadeFilhos = 0;
        }
    }

    function __toString()
    {
        echo $this->id . "<br/><br/>";
        echo $this->nome . "<br/><br/>";
        echo $this->email . "<br/><br/>";
        echo $this->cpf . "<br/><br/>";
        echo $this->dataNascimento . "<br/><br/>";
        echo $this->telefone . "<br/><br/>";
        echo $this->filho . "<br/><br/>";
        echo $this->quantidadeFilhos . "<br/><br/>";
        return "";
    }
}

?>