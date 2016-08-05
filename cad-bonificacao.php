<?php
include 'menu.php';
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';
$cargo = new Cargo();
$cargoDao = new CargoDao($conexao, $cargo);
$cargos = $cargoDao->selectAll();
?>

<div class="page-menu">
	<ul class="menu-list">
		<li class="navlink">
			<a href="lista-cargos.php" class="navcation font-primary-bold_mediun">Lista</a>
		</li>
		<li class="navlink">
			<a href="lista-cargos.php" class="navcation font-primary-bold_mediun">Adicionar</a>
		</li>
		<li class="navlink active">
			<a href="cad-bonificacao.php" class="navcation font-primary-bold_mediun">Bonificar</a>
		</li>
		<li class="navlink">
			<a href="cargos-grafico.php" class="navcation font-primary-bold_mediun">Gráfico</a>
		</li>
	</ul>
</div>

<h2 class="text-center">Bonificação salarial</h2>
<form action="/salario-bonificar.php" method="post" class="form max-form">
	<div class="form-container">
		<div class="input-half">
			<div class="input">
				<label class="form-label">Ecolha o cargo</label>
				<select name="cargo" class="input-box cargo-salario input-mediun select-box" required>
					<option value="" disabled selected>Selecione o cargo</option>
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
				<input type="hidden" value="" disabled class="armazena-valor">
			</div>
			<div class="input">
				<label class="form-label">Valor normal do salário</label>
				<input type="text" value="" disabled class="salario-atual input-box">
			</div>
		</div>
		<div class="input-half">
			<div class="input">
				<label class="form-label">Valor da bonificação em %</label>
				<input type="text" name="bonus" data-mask="00" placeholder="10"  class="valor-bonifica input-box">
			</div>
			<div class="input">
				<label class="form-label">Valor com bonificação</label>
				<input type="text" value="" class="salario-calculado input-box" disabled>
			</div>
		</div>
		<div class="button background-secondary btn-primary">
			<button type="submit" class="btn">Adicionar</button>
		</div>
	</div>
</form>
<div class="salarios">
<?php
foreach ($cargos as $cargo) : ?>
	<input type="hidden" value="<?php echo $cargo['id'] ?>">
	<input type="hidden" value="<?php echo $cargo['salario'] ?>" class="salario">
	<?php
endforeach;
?>
</div>

<p class="cadastrar-cargo-info msg-info">Selecione o cargo para alterar o valor do salário!</p>
<?php include 'footer.php'; ?>

