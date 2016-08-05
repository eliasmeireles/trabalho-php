<?php

class CargoFuncionario
{
    private $cargoId;
    private $funcionarioId;

    public function getCargoId()
    {
        return $this->cargoId;
    }

    public function setCargoId($cargoId)
    {
        $this->cargoId = $cargoId;
    }

    public function getFuncionarioId()
    {
        return $this->funcionarioId;
    }

    public function setFuncionarioId($funcionarioId)
    {
        $this->funcionarioId = $funcionarioId;
    }
}