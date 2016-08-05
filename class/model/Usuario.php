<?php
Class Usuario {
	private $id;
	private $funcionario;
	private $senha;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function getFuncionario() {
		return $this->funcionario;
	}
	public function setFuncionario($funcionario) {
		$this->funcionario = $funcionario;
	}
}