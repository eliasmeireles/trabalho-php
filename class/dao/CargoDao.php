<?php
class CargoDao{
	private $cargo;
	private $conexao;
	
	function __construct($conexao, $cargo) {
		$this->cargo = $cargo;
		$this->conexao = $conexao;
	}
	
	public function gravar() {
		$query = "INSERT INTO cargo(nome, salario) VALUES (
				'{$this->cargo->getNome()}',
				{$this->cargo->getSalario()})";
		$resultadoDaInsercao = mysqli_query ( $this->conexao, $query );
		return $resultadoDaInsercao;
	}

	public function update() {
		$query = "UPDATE cargo SET nome = '{$this->cargo->getNome()}',  salario = '{$this->cargo->getSalario()}' WHERE id = {$this->cargo->getId()}";
		$result = mysqli_query ( $this->conexao, $query );
		return $result;
	}
	public function updateBonificacao() {
		$query = "UPDATE cargo SET bonificacao = '{$this->cargo->getBonificacao()}' WHERE id = {$this->cargo->getId()}";
		$result = mysqli_query ( $this->conexao, $query );
		return $result;
	}
	public function deletar() {
		$query = "DELETE FROM cargo WHERE id = {$this->cargo->getId()}";
		echo $query;
		$result = mysqli_query ( $this->conexao, $query );
		return $result;
	}
	
	public function selectAll() {
		$cargos = array();
		$query = "SELECT c.id, c.nome, c.salario, c.bonificacao FROM cargo c ORDER BY salario DESC";
		$resultadoDaBusca = mysqli_query($this->conexao, $query);
		while ($cargo = mysqli_fetch_assoc($resultadoDaBusca)) {
			array_push($cargos, $cargo);
		}
		return $cargos;
	}

	public function selectPorcetagem() {
		$cargos = array();
		$query = "SELECT c.nome, COUNT(*) AS total FROM cargo c
				  JOIN cargo_funcionario cf ON cf.cargo_id = c.id
				  JOIN funcionario f ON cf.funcionario_id = f.id GROUP BY c.nome ORDER BY total DESC";
		$resultadoDaBusca = mysqli_query($this->conexao, $query);
		while ($cargo = mysqli_fetch_assoc($resultadoDaBusca)) {
			array_push($cargos, $cargo);
		}
		return $cargos;
	}

	public function selectAtivos() {
		$cargos = array();
		$query = "SELECT c.id, c.nome, COUNT(cargo_id) AS total FROM cargo c 
					JOIN cargo_funcionario cf ON cf.cargo_id = c.id GROUP BY c.id";
		$resultadoDaBusca = mysqli_query($this->conexao, $query);
		while ($cargo = mysqli_fetch_assoc($resultadoDaBusca)) {
			array_push($cargos, $cargo);
		}
		return $cargos;
	}
}