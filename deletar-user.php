<?php 
include 'menu.php';
require_once 'class/dao/UsuarioDao.php';
require_once 'class/model/Usuario.php';
require_once 'class/model/Funcionario.php';

if(!isset($_POST['funcionarioId'])) {
    echo "<script>location.href = '/';</script>";
}
$funcionario = new Funcionario();

$funcionario->setId($_POST['funcionarioId']);

$usuario = new Usuario();
$usuario->setFuncionario($funcionario);

$usuarioDao = new UsuarioDao($conexao, $usuario);

$usuarioGravar = $usuarioDao->delet();
?>

<?php if ($usuarioGravar) : ?>
	<h2 class="sucesso">O usuário foi removido com sucesso</h2>
 <?php
    endif;
 ?>
 <?php if (!$usuarioGravar) : ?>
	<h6 class="error falha-cadastro">Ocorreu um erro inesperado, por favor tente novamente!</h6>
 <?php 
    endif;
 ?>
    <div class="link-retornar">
        <a href="/usuario-remover.php" class="retornar">Volta</a>
    </div>
<?php include 'footer.php'; ?>