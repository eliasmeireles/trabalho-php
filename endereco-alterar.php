<?php
include 'menu.php';
require_once 'class/model/Funcionario.php';
require_once 'class/model/Endereco.php';
require_once 'class/dao/EnderecoDao.php';
require_once 'class/fw/Conexao.php';

$enderecoErros = array();
$endereco = array();

if(!empty($_POST['enderecoErros']) && empty($_POST['enderecoId'])) {
    echo "<script>location.href = '/funcionarios.php';</script>";
    exit();
}


if (isset($_SESSION['enderecoErros'])) {
    $enderecoErros = $_SESSION['enderecoErros'];
}
if (isset($_SESSION['endereco'])) {
    $endereco = $_SESSION['endereco'];
}

$funcionario = new Funcionario();
$endereco = new Endereco($funcionario);

if (!empty($_POST['__id'])) {
    $endereco->setId($_POST['__id']);
}
if (!empty($_SESSION['enderecoId'])) {
    $endereco->setId($_SESSION['enderecoId']);
}

$enderecoDao = new EnderecoDao($conexao, $endereco);

$dadosEndereco = $enderecoDao->select();
?>

<div>
    <h6 class="text-center">Atualização de endereço</h6>
    <div class="text-center">
        <span class="f-info">Nome do funcionário: </span>
        <span class="func-nome"><?php foreach ($dadosEndereco as $endereco) {echo $endereco['nome'];} ?></span>
    </div>
    <form action="endereco-alter-dados.php" method="POST" class="form" enctype="multipart/form-data">
        <div class="form-container">

            <div class="input-conatiner">
                <div class="cool-form">

                    <?php foreach ($dadosEndereco as $endereco) : ?>
                        <?php include 'endereco-form.php'; ?>
						<input type="hidden" value="<?php echo $endereco['id']; ?>" name="id">
						<input type="hidden" value="<?php echo $endereco['funcionario_id']; ?>" name="funcionarioId">
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <div class="button background-secondary btn-primary">
                <button type="submit" class="btn">Alterar</button>
            </div>
        </div>
    </form>
</div>
<?php unset($_SESSION['enderecoId']);
unset($_SESSION['enderecoErros']);
unset($_SESSION['endereco']);
?>
<?php include 'footer.php'; ?>
