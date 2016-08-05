<?php
class Cargo{
	private $id;
	private $nome;
	private $salario;
	private $bonificacao;
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getNome() {
		return $this->nome;
	}
	
	public function setNome($nome) {
		$this->nome = $nome;
	}
	
	public function getSalario() {
		return $this->salario;
	}
	
	public function setSalario($salario) {
		$this->salario = $salario;
	}
	
	public function getBonificacao() {
		return $this->bonificacao;
	}
	
	public function setBonificacao($bonificacao) {
		$this->bonificacao = $bonificacao;
	}
}