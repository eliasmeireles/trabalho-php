<?php include 'menu.php';
require_once 'class/model/Usuario.php';
require_once 'class/model/Funcionario.php';
require_once 'class/dao/FuncionarioDao.php';
require_once 'class/model/Endereco.php';
require_once 'class/dao/EnderecoDao.php';
require_once 'class/model/Encryptor.php';

if (empty($_POST['password'])) {
    echo "<script>location.href = '/funcionarios.php';</script>";
}

$funcionario = new Funcionario();

$usuario = new Usuario();

$senha = trim($_POST['password']);

$funcionario->setCpf(trim($_POST['cpf']));
$funcionario->setEmail(trim($_POST['email']));

$funcionarioDao = new FuncionarioDao($conexao, $funcionario);

$funcDados = $funcionarioDao->selectByEmailECpf();
?>
<?php if ($funcDados) : ?>
    <h6 class="text-center">Dados encontrados</h6>
    <?php include 'funcionario-dados.php' ?>

    <div class="cadastro-usuario">
        <form class="form" action="/cad-usuario.php" method="POST">
            <div class="form-container">
                <input type="hidden" name="funcionarioId" value="<?php echo $funcDados[0]['funcionarioId'] ?>">
                <input type="hidden" name="password" value="<?php echo $senha ?>">
                <div class="user-opt">
                    <div class="button background-secondary btn-primary">
                        <button class="btn">Cadastrar</button>
                    </div>
                    <div class="button background-secondary btn-primary">
                        <a href="/usuario-form.php" class="btn btn-cancelar">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <p class="msg-info">Antes de liberar o acesso do funcionário ao sistema,
        certifique-se que os dados informados conferem com os dados do mesmo!</p>
    <?php
endif;
?>
<?php if (!$funcDados) : ?>
    <h6 class="text-center error">Nenhum funcionário foi encontrado com os dados inceridos!</h6>
    <div class="link-retornar">
        <a href="/usuario-form.php" class="retornar">Tentar novamente</a>
    </div>
    <?php
endif;
?>
<?php include 'footer.php'; ?>

