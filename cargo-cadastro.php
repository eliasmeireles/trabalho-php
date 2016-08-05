<?php include 'menu.php';
?>

<div class="page-menu">
    <ul class="menu-list">
        <li class="navlink">
            <a href="lista-cargos.php" class="navcation font-primary-bold_mediun">Lista</a>
        </li>
        <li class="navlink active">
            <a href="cargo-cadastro.php" class="navcation font-primary-bold_mediun">Adicionar</a>
        </li>
        <li class="navlink">
            <a href="cad-bonificacao.php" class="navcation font-primary-bold_mediun">Bonificar</a>
        </li>
        <li class="navlink">
            <a href="cargos-grafico.php" class="navcation font-primary-bold_mediun">Gráfico</a>
        </li>
    </ul>
</div>


<h2 class="text-center">Cadastro de cargos</h2>
<div class="cargo">
    <?php if (!empty($_SESSION['__cadastroCargo'])) : ?>
        <span
            class="<?php echo $_SESSION['resultado']; ?> resultado-info"><?php echo $_SESSION['__cadastroCargo']; ?></span>
        <?php
    endif;
    ?>
    <?php unset($_SESSION['__cadastroCargo']);
    unset($_SESSION['resultado']); ?>


    <form action="cadastrar-cargo.php" method="post" class="form max-form">
        <div class="form-container">
            <div class="input">
                <label class="form-label">Nome do cargo</label>
                <input type="text" required="required" name="nome" class="input-box">
            </div>
            <div class="input">
                <label class="form-label">Valor do salário</label>
                <input type="number" required="required" name="salario" class="input-box">
            </div>
            <div class="button background-secondary btn-primary">
                <button type="submit" class="btn">Adicionar</button>
            </div>
        </div>
    </form>

    <p class="cadastrar-cargo-info msg-info">Favor informar o nome e o valor do salário do cargo as ser registrado!</p>
</div>
<?php include 'footer.php'; ?>
