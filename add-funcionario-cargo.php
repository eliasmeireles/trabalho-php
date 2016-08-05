<?php include 'menu.php';
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';
$cargo = new Cargo();
$cargoDao = new CargoDao($conexao, $cargo);
$cargos = $cargoDao->selectAll();
?>
<h2 class="text-center">Cadastro de cargo de funcionario</h2>
<form action="cargo-cadastrar.php" method="post" class="form max-form">
	<div class="form-container">
		<div class="input">
			<label class="input-label">Email</label>
			<input type="email" name="nome" class="input-box">
		</div>
		<div class="input">
			<label class="input-label">Cpf</label>
			<input type="text" name="salario"  data-mask="000.000.000-00" class="input-box">
		</div>
		<div class="input">
			<label class="input-label">Cargo</label>
			<select name="cargo" class="input-box input-mediun select-box">
					<option value="0">Selecione o cargo</option>
					<?php
					foreach ($cargos as $cargo) : ?>
						<option
						<?php 
						?>
						value="<?php echo $cargo['id'] ?>"><?php echo $cargo['nome'] ?></option>
					<?php 
						endforeach;
					?>
			</select>
		</div>
		<div class="button background-secondary btn-primary">
			<button type="submit" class="btn">Adicionar</button>
		</div>
	</div>
</form>		

<p class="cadastrar-cargo-info">Para cadastrar o cargo de um funcionario, favor informar o email ou o cpf do funcionario a ser cadastrado!</p>
<?php include 'footer.php';?>
