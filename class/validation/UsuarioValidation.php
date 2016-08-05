<?php
class usuarioValidation {
	private $usuario;
	private $usuarioDao;
	
	function __construct($usuario, $usuario) {
		$this->usuario = $usuario;
		$this->usuarioDao = $usuarioDao;
	}
	
	public function usuarioValidation() {
		$erros = array();
			
		if ($this->usuario->getNome() == null) {
			$erros["nome"] = "Campo obrigatório!";
		}
		if ($this->usuario->getEmail() == null) {
			$erros["email"] = "Campo obrigatório!";
		}
			
		if ($this->usuarioDao->selectByEmail() == 0) {
			if ($this->usuarioDao->selectById() == 0) {
				$erros['email']  = "Email já cadastrado!";
			}
		}
		if ($this->usuario->getCpf() == null) {
			$erros["cpf"] = "Campo obrigatório!";
		}
			
		if (!$this->usuarioDao->selectByCpf() == 0) {
	
			if ($this->usuarioDao->selectById() == 0) {
				$erros['cpf']  = "Cpf já cadastrado!";
			}
		}
		return $erros;
	}
	
	public function recuperaDadosInseridos() {
		$usuarioData = array();
		$usuarioData['nome'] = $this->usuario->getNome();
		$usuarioData['email'] = $this->usuario->getEmail();
		$usuarioData['cpf'] = $this->usuario->getCpf();
		return $usuarioData;
	}	
}
