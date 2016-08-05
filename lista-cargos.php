<?php include 'menu.php';
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';
$cargo = new Cargo();
$cargoDao = new CargoDao($conexao, $cargo);
$cargos = $cargoDao->selectAll();
$cargoAtivos = $cargoDao->selectAtivos();
?>

<div class="page-menu">
    <ul class="menu-list">
        <li class="navlink active">
            <a href="/lista-cargos.php" class="navcation font-primary-bold_mediun">Lista</a>
        </li>
        <li class="navlink">
            <a href="/cargo-cadastro.php" class="navcation font-primary-bold_mediun">Adicionar</a>
        </li>
        <li class="navlink">
            <a href="/cad-bonificacao.php" class="navcation font-primary-bold_mediun">Bonificar</a>
        </li>
        <li class="navlink">
            <a href="cargos-grafico.php" class="navcation font-primary-bold_mediun">Gráfico</a>
        </li>
    </ul>
</div>
<div class="result-info">
    <?php
    if (isset($_SESSION['cargoDeletado'])) {
        if ($_SESSION['cargoDeletado']) {
            echo '<h6 class="text-center sucesso">Cargo deletado com sucesso!</h6>';
        } else {
            echo '<h6 class="text-center error">Falha ao tentar deletar o cargo!</h6>';
        }
        unset($_SESSION['cargoDeletado']);
    }
    if (isset($_SESSION['cargoAtualidado'])) {
        if ($_SESSION['cargoAtualidado']) {
            echo '<h6 class="text-center sucesso">Cargo alterado com sucesso!</h6>';
        } else {
            echo '<h6 class="text-center error">Falha ao tentar alterar os dados cargo!</h6>';
        }
        unset($_SESSION['cargoAtualidado']);
    }
    if (isset($_SESSION['resultadoBonificar'])) {
        if ($_SESSION['resultadoBonificar']) {
            echo '<h6 class="text-center sucesso">A bonificação doi adicionada com sucesso!</h6>';
        } else {
            echo '<h6 class="text-center error">Falha ao adicionar a bonificação!</h6>';
        }
        unset($_SESSION['resultadoBonificar']);
    }
    ?>
</div>
<div class="cargo-grafico-container">
    <div class="lista-cargos">
        <h6 class="text-center">Cargos registrados</h6>
        <table class="table-container">
            <tr class="background-secondary-dark_light">
                <th class="table-title">Cargo</th>
                <th class="table-title">Salário</th>
                <th class="table-title">Bonus</th>
                <th class="table-title">Valor total</th>
                <th class="table-title">Opções</th>
            </tr>
            <?php foreach ($cargos as $cg)  : ?>
                <tr class="container-info">
                    <td class="table-data"><?php echo $cg['nome'] ?></td>
                    <td class="table-data"><?php echo'R$: ' . number_format($cg['salario'], 2); ?></td>
                    <td class="table-data"><?php if ($cg['bonificacao'] == "" || $cg['bonificacao'] == 00.0) {
                            echo "-";
                        } else {
                            echo number_format($cg['bonificacao']) . '%';
                        } ?>
                    </td>
                    <td class="table-data">
                        <?php if ($cg['bonificacao'] == "") {
                            echo 'R$: ' . number_format($cg['salario'], 2);
                        } else {
                            $total = ($cg['salario'] * $cg['bonificacao']) + $cg['salario'];
                            echo 'R$: ' . number_format($total);
                        } ?>
                    </td>
                    <td class="table-data">
                        <div class="options">
                            <form action="cargo-alterar.php" method="POST" class="table-opt">
                                <input type="hidden" name="cargoId" value="<?php echo $cg['id'] ?>">
                                <button type="submit" class="btn alterar">
									<img class="opt-ico" src="resources/img/edit.png" title="Editar os dados">
								</button>
                            </form>
                            <?php
                            $verificador = true;
                            for ($i = 0; $i < sizeof($cargoAtivos); $i++) {
                                if (in_array($cg['id'], $cargoAtivos[$i])) {
									if($cargoAtivos[$i]['id'] === $cg['id']) {
										$verificador = false;
										break;
									}
                                }
                            }
                            if ($verificador) {
                                include 'cargo-excluir-form.php';
                            } else {
                                include 'cargo-excluir-false.php';
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
    </div>
</div>
<?php include 'footer.php'; ?>

