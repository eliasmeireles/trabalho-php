<?php
include 'menu.php';
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';
$cargo = new Cargo();
$cargoDao = new CargoDao($conexao, $cargo);
$cargos = $cargoDao->selectAll();
$cargoId = $_POST['cargoId'];
?>
<h2 class="text-center">Atualização salarial</h2>
<form action="cargo-salario-atualiza.php" method="post" class="form max-form">
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
                            value="<?php echo $cargo['id'] ?>"  <?php if ($cargoId == $cargo['id']) {echo 'selected'; } ?>><?php echo $cargo['nome'] ?></option>
                        <?php
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="input">
                <label class="form-label">Valor atual do salário</label>
                <input type="text" value="" disabled class="salario-atual input-box">
            </div>
        </div>
        <div class="input">
            <label class="form-label">Insira o novo salário</label>
            <input type="number" name="valorSalario" required="required" class="salario-haAlter input-box">
        </div>
        <div class="button background-secondary btn-primary">
            <button type="submit" class="btn">Atualizar</button>
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

