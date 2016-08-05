<?php
class CargoFuncionarioDao {
    private $cargoFuncionario;
    private $conexao;

    public function __construct($conexao, $cargoFuncionario)
    {
        $this->conexao = $conexao;
        $this->cargoFuncionario = $cargoFuncionario;
    }
    
    public function gravar() {
        $query = "INSERT INTO cargo_funcionario (cargo_id, funcionario_id) VALUES (
        '{$this->cargoFuncionario->getCargoId()}', 
        '{$this->cargoFuncionario->getFuncionarioId()}') ";
        $resultadoDaInsercao = mysqli_query($this->conexao, $query);
        return $resultadoDaInsercao;
    }
    
    public function update() {
    	$query = "UPDATE cargo_funcionario SET cargo_id = '{$this->cargoFuncionario->getCargoId()}' 
    	WHERE funcionario_id = '{$this->cargoFuncionario->getFuncionarioId()}'";
    	$resultadoDaInsercao = mysqli_query($this->conexao, $query);
    	return $resultadoDaInsercao;
    }
    
    public function select($funcionarioId) {
    	$query = "SELECT cf.cargo_id, c.nome FROM cargo_funcionario cf 
        JOIN cargo c ON cf.cargo_id = c.id WHERE funcionario_id = '{$funcionarioId}'";
    	$result = mysqli_query($this->conexao, $query);
    	return mysqli_fetch_assoc($result);
    }
    public function deletar()
    {
        $query = "DELETE FROM cargo_funcionario WHERE funcionario_id = '{$this->cargoFuncionario->getFuncionarioId()}'";
        $resultado = mysqli_query($this->conexao, $query);
        return $resultado;
    }
}