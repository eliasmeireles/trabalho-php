<?php

class FuncionarioValidation
{
    private $funcionario;
    private $funcionarioDao;

    function __construct($funcionario, $funcionarioDao)
    {
        $this->funcionario = $funcionario;
        $this->funcionarioDao = $funcionarioDao;
    }

    public function funcionarioValidation()
    {
        $funci = array();
        $erros = array();

        if ($this->funcionario->getNome() == null) {
            $erros["nome"] = "Campo obrigatório!";
        }
        if ($this->funcionario->getEmail() == null) {
            $erros["email"] = "Campo obrigatório!";
        }

        if (!$this->funcionarioDao->selectByEmail() == 0) {
            $erros['email'] = "Email já cadastrado!";
        }

        if (!$this->funcionarioDao->selectByEmail() == 0) {
            $validaEmail = $this->funcionarioDao->selectById();
            if ($validaEmail) {
                unset($erros['email']);
            }
        }


        if ($this->funcionario->getCpf() == null) {
            $erros["cpf"] = "Campo obrigatório!";
        }

        if (!$this->funcionarioDao->selectByCpf() == 0) {
            $erros['cpf'] = "Cpf já cadastrado!";
        }

        if (!$this->funcionarioDao->selectByCpf() == 0) {
            $validaCpf = $this->funcionarioDao->selectById();
            if ($validaCpf) {
                unset($erros['cpf']);
            }
        }

        if ($this->funcionario->getDataNascimento() == null) {
            $erros["dataNascimento"] = "Campo obrigatório!";
        }
        if ($this->funcionario->getTelefone() == null) {
            $erros["telefone"] = "Campo obrigatório!";
        }
        if ($this->funcionario->getFilho()) {
            if ($this->funcionario->getQuantidadeFilhos() == null || $this->funcionario->getQuantidadeFilhos() == 0) {
                $erros["quantidadeFilhos"] = "Campo obrigatório!";
            }
        }
        return $erros;
    }

    public function recuperaDadosInseridos()
    {
        $funcionarioData = array();
        $funcionarioData['id'] = $this->funcionario->getId();
        $funcionarioData['nome'] = $this->funcionario->getNome();
        $funcionarioData['email'] = $this->funcionario->getEmail();
        $funcionarioData['cpf'] = $this->funcionario->getCpf();
        $funcionarioData['telefone'] = $this->funcionario->getTelefone();
        $funcionarioData['filho'] = $this->funcionario->getFilho();
        $funcionarioData['quantidade_filhos'] = $this->funcionario->getQuantidadeFilhos();
        $funcionarioData['dataNascimento'] = $this->funcionario->getDataNascimento();
        return $funcionarioData;
    }

}