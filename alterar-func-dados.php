<?php
include 'menu.php';
require_once 'class/model/Funcionario.php';
require_once 'class/model/Endereco.php';
require_once 'class/dao/FuncionarioDao.php';
require_once 'class/dao/EnderecoDao.php';
require_once 'class/fw/Conexao.php';
require_once 'class/dao/CargoFuncionarioDao.php';
require_once 'class/model/CargoFuncionario.php';
require_once 'class/model/Cargo.php';
require_once 'class/dao/CargoDao.php';

if(!isset($_SESSION['funcionarioErros']) && empty($_POST['funci_id'])) {
	echo "<script>location.href = '/funcionarios.php';</script>";
}
$funcionariosErros = array();
$funcinonarioId = "";
$cargoErro = array();

$cargoEscolhido = array();

$cargo = new Cargo();
$cargoDao = new CargoDao($conexao, $cargo);
$cargos = $cargoDao->selectAll();


if(isset($_SESSION['funcionarioErros'])) {
	$funcionariosErros = $_SESSION['funcionarioErros'];
}
if(!empty($_POST['funci_id'])) {
	$funcinonarioId = $_POST['funci_id'];
}

$funci = new Funcionario();
if (isset($_SESSION['funcionario'])) {
    $funcinonarioDados = $_SESSION['funcionario'];
    $funci->setId($funcinonarioDados['id']);
} else {
    $funci->setId($funcinonarioId);
}
$funcinonarioDao = new FuncionarioDao($conexao, $funci);
$funcinonarioDados = $funcinonarioDao->selectById();
$cargoFuncDao = new CargoFuncionarioDao($conexao, $cargo);
$cargoId = $cargoFuncDao->select($funci->getId());
$funciCargoId = "";

if ($cargoId > 0) {
	$funciCargoId = $cargoId['cargo_id'];
}
?>

	<div class="alterar-func">
		<h2 class="text-center">Alterar dados do Funcionario</h2>
		
		<form action="func-alterar.php" method="POST" class="form" enctype="multipart/form-data">
			<div class="form-container">
	
				<div class="input-conatiner">
					<div class="cool-form">
						<?php foreach ($funcinonarioDados as $funcionario) : ?>
							<?php include 'dados-pessoais-form.php';?>
						<?php 
						endforeach;
						?>
					</div>
				</div>				
				<input type="hidden" name="funcionarioId" value="<?php echo $funcionario['funcionarioId']?>">
				<div class="button background-secondary btn-primary">
					<button type="submit" class="btn">Alterar</button>
				</div>
			</div>
		</form>
	</div>

<?php unset($_SESSION['cargoEscolha']); ?>
<?php unset($_SESSION['cargoErro']); ?>
<?php unset($_SESSION['funcionario']); ?>
<?php unset($_SESSION['funcionarioErros']); ?>
<?php include 'footer.php';?>
