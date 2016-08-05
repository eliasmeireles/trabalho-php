<?php
require_once 'class/model/Endereco.php';
	class EnderecoValidation {
		
		private $endereco;
		
		function __construct($endereco) {
			$this->endereco = $endereco;
		}
		
		
		public function enderecoValidation() {
			$erros = array();
			if ($this->endereco->getCep() == null) {
				$erros['cep'] = "Campo obrigatório!";
			}
			if ($this->endereco->getLogradouro() == null) {
				$erros['logradouro'] = "Campo obrigatório!";
			}
			if ($this->endereco->getNumero() == null) {
				$erros['numero'] = "Campo obrigatório!";
			}
			if ($this->endereco->getBairro() == null) {
				$erros['bairro'] = "Campo obrigatório!";
			}
			if ($this->endereco->getCidade() == null) {
				$erros['cidade'] = "Campo obrigatório!";
			}
			if ($this->endereco->getEstado() == null) {
				$erros['estado'] = "Campo obrigatório!";
			}
			return $erros;
		}
		
		public function recuperaDadosInseridos() {
			$enderecoData = array();
			$enderecoData['cep'] = $this->endereco->getCep();
			$enderecoData['logradouro'] = $this->endereco->getLogradouro();
			$enderecoData['numero'] = $this->endereco->getNumero();
			$enderecoData['bairro'] = $this->endereco->getBairro();
			$enderecoData['cidade'] = $this->endereco->getCidade();
			$enderecoData['estado'] = $this->endereco->getEstado();
			return $enderecoData;
		}
	}