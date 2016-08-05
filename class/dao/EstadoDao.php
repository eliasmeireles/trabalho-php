<?php
class EstadoDao {
	private $conexao;

	public function __construct($conexao) {
		$this->conexao = $conexao;
	}

	public function selectEstados() {
		$estados = array();
		$query = "SELECT * FROM estados";
		$resultado = mysqli_query($this->conexao, $query);
		while ($estado = mysqli_fetch_assoc($resultado)) {
			array_push($estados, $estado);
		}
		return $estados;
	}
	public function selectEstado($id) {
		$estados = array();
		$query = "SELECT * FROM estados WHERE id = {$id}";
		$resultado = mysqli_query($this->conexao, $query);
		while ($estado = mysqli_fetch_assoc($resultado)) {
			array_push($estados, $estado);
		}
		return $estados;
	}
}