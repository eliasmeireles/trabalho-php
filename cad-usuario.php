<?php include 'menu.php';
require_once 'class/dao/UsuarioDao.php';
require_once 'class/model/Usuario.php';
require_once 'class/model/Funcionario.php';
require_once 'class/model/Encryptor.php';

if (empty($_POST['password'])) {
    echo "<script>location.href = '/funcionarios.php';</script>";
}
$funcionario = new Funcionario();
$funcionario->setId($_POST['funcionarioId']);

$usuario = new Usuario();

$encriptor = new Encryptor(trim($_POST['password']));
$senha = $encriptor->encrypt();

$usuario->setSenha($senha);
$usuario->setFuncionario($funcionario);

$usuarioDao = new UsuarioDao($conexao, $usuario);

$usuarioGravar = $usuarioDao->gravar();
?>

<?php if ($usuarioGravar) : ?>
	<h2 class="sucesso">O usuário foi registrado com sucesso</h2>
    <p class="cad-usuario-info msg-info">Para efetuar o login, informe o "CPF" e a senha</p>
 <?php
 	endif;
 ?>
 <?php if (!$usuarioGravar) : ?>
	<h6 class="error falha-cadastro">Não foi possivel efetuar o cadastro deste usúario</h6>
	<span class="cad-usuario-info msg-info">Sertifique-se se o mesmo já não se encontra cadastrado no sistema!</span>
 <?php 
 	endif;
 ?>
<?php include 'footer.php'; ?>