<?php
include 'menu.php'; ?>
<?php
require_once 'class/model/Funcionario.php';
require_once 'class/model/Endereco.php';
require_once 'class/dao/FuncionarioDao.php';
require_once 'class/dao/EnderecoDao.php';
require_once 'class/fw/Conexao.php';

$func = new Funcionario(); ?>

    <div class="page-menu">
        <ul class="menu-list">
            <li class="navlink">
                <a href="funcionarios.php" class="navcation font-primary-bold_mediun">Filtrar</a>
            </li>
            <li class="navlink">
                <a href="funcionario-form.php" class="navcation font-primary-bold_mediun">Cadastrar</a>
            </li>
            <li class="navlink active">
                <a href="localiza-funcionario.php" class="navcation font-primary-bold_mediun">Localizar</a>
            </li>
            <li class="navlink">
                <a href="grafico-cargos-funcionarios.php" class="navcation font-primary-bold_mediun">Gráfico</a>
            </li>
            <li class="navlink">
                <a href="funcionarios-relatorio.php" class="navcation font-primary-bold_mediun">Relatório</a>
            </li>
        </ul>
    </div>

<?php
if (isset($_POST['email'])) : ?>
    <?php
    $func->setNome(trim($_POST['nome']));
    $func->setEmail(trim($_POST['email']));
    $func->setCpf(trim($_POST['cpf']));
    $funcionarioDao = new FuncionarioDao($conexao, $func);
    if ($func->getNome() != null) {
        $funcionarioDados = $funcionarioDao->selectByNome();
    } else if ($func->getEmail() != null) {
        $funcionarioDados = $funcionarioDao->selectByEmail();
    } else {
        $funcionarioDados = $funcionarioDao->selectByCpf();
    }

    if (sizeof($funcionarioDados) == 0) {
        $funcionarioDados = $funcionarioDao->selectByEmail();
    }
    if (sizeof($funcionarioDados) == 0) {
        $funcionarioDados = $funcionarioDao->selectByCpf();
    }
    ?>
    <?php
    if (sizeof($funcionarioDados) == 0) : ?>
        <?php $resultado = "Nada encontrado"; ?>
        <h2 class="text-center"><?php echo $resultado ?></h2>
        <?php
        unset($_POST['cpf']);
        unset($_POST['email']);
    endif;
    ?>

    <?php if (!sizeof($funcionarioDados) == 0) {
        foreach ($funcionarioDados as $f) {
            $func->setId($f['id']);
        }
        $funcionarioDao = new FuncionarioDao($conexao, $func);
        $funcDados = $funcionarioDao->selectById();
        echo '<h6 class="text-center">Resultado da sua pesquisa</h6>';
        include 'funcionario-dados.php';

    }
endif;
?>

<?php if (!isset($_POST['email']) && !isset($_POST['cpf'])) : ?>
    <div class="localizar-opt">
        <div class="localiza-form">
            <h6 class="text-center">Dados específicos</h6>

            <form action="localiza-funcionario.php" method="POST" class="form" enctype="multipart/form-data">
                <div class="form-container">
                    <div class="input-conatiner">
                        <div class="input-half">
                            <div class="input">
                                <label class="form-label">Pelo nome</label>
                                <input type="text" name="nome" class="input-box">
                            </div>
                            <div class="input">
                                <label class="form-label">Pelo cpf</label>
                                <input type="text" name="cpf" data-mask="000.000.000-00" class="input-box">
                            </div>
                        </div>
                    </div>
                    <div class="input-conatiner">
                        <div class="input">
                            <label class="form-label">Pelo email</label>
                            <input type="email" name="email" class="input-box">
                        </div>
                    </div>
                    <div class="button background-secondary btn-primary">
                        <button type="submit" class="btn">Localizar</button>
                    </div>
                </div>
            </form>
        </div>
        <p class="cadastrar-cargo-info msg-info">Para realizar sua pesquisa, informe o nome, email ou cpf do
            funcionário!</p>
    </div>

    <?php
endif;
?>
<?php include 'footer.php'; ?>